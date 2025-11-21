<?php

namespace App\Http\Controllers;

use App\Models\DevelopmentPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DevelopmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $selectedYear = $request->get('year');

        // Ambil semua tahun yang tersedia
        $years = DevelopmentPlan::select('year')
            ->distinct()
            ->orderBy('year')
            ->pluck('year');

        // Jika belum ada tahun di DB, paksa kosong
        if ($years->isEmpty()) {
            $selectedYear = null;
            $plans = collect();
        } else {
            // Default tahun pertama jika tidak ada yang dipilih
            if (!$selectedYear) {
                $selectedYear = $years->first();
            }

            // Ambil data per tahun, dikelompokkan per prioritas
            $plans = DevelopmentPlan::where('year', $selectedYear)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get()
                ->groupBy('priority');
        }

        return view('development.index', compact('years', 'plans', 'selectedYear'));
    }

    public function dev(Request $request)
    {
        $selectedYear = $request->get('year');

        $years = DevelopmentPlan::select('year')
            ->distinct()
            ->orderBy('year')
            ->pluck('year');

        if ($years->isEmpty()) {
            $selectedYear = null;
            $plans = collect();
        } else {
            if (!$selectedYear) {
                $selectedYear = $years->first();
            }

            $allPlans = DevelopmentPlan::orderBy('year')
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get();

            $plans = $allPlans->groupBy('year')->map(function ($yearGroup) {
                return $yearGroup->groupBy('priority');
            });
        }

        return view('page.rencana-pengembangan', compact('years', 'plans', 'selectedYear'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id'       => 'required|exists:development_plans,id',
            'rencana'  => 'nullable|max:255',  // boleh string/angka, hanya batasi panjang
            'tercapai' => 'nullable|numeric|min:0',
            'link'     => 'nullable|url|max:500',
        ]);

        $plan = DevelopmentPlan::findOrFail($request->id);

        $plan->rencana  = $request->rencana;
        $plan->tercapai = $request->tercapai;

        if ($request->has('link')) {
            $plan->link = $request->link;
        }

        $plan->save();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diperbarui',
            'data'    => $plan,
        ]);
    }

    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'updates'           => 'required|array',
            'updates.*.id'      => 'required|exists:development_plans,id',
            'updates.*.rencana' => 'nullable|max:255', // bisa string / numeric
            'updates.*.tercapai'=> 'nullable|numeric|min:0',
            'updates.*.link'    => 'nullable|url|max:500',
        ]);

        DB::beginTransaction();
        try {
            foreach ($request->updates as $update) {
                $plan = DevelopmentPlan::findOrFail($update['id']);
                if (array_key_exists('rencana', $update)) {
                    $plan->rencana = $update['rencana'];
                }
                if (array_key_exists('tercapai', $update)) {
                    $plan->tercapai = $update['tercapai'];
                }
                if (array_key_exists('link', $update)) {
                    $plan->link = $update['link'];
                }
                $plan->save();
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diperbarui',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Bulk update development plan error', ['exception' => $e]);
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function storeYear(Request $request)
    {
        $request->validate([
            'year'      => 'required|string|max:20|unique:development_plans,year',
            'base_year' => 'nullable|string|max:20',
        ]);

        $year     = $request->year;
        $baseYear = $request->base_year;

        // Jika tidak ada base_year, gunakan tahun terakhir yang ada sebagai template
        if (!$baseYear) {
            $baseYear = DevelopmentPlan::select('year')
                ->distinct()
                ->orderByDesc('year')
                ->value('year');
        }

        if (!$baseYear) {
            return back()->withErrors(['base_year' => 'Tahun dasar tidak ditemukan.'])->withInput();
        }

        $templates = DevelopmentPlan::where('year', $baseYear)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        if ($templates->isEmpty()) {
            return back()->withErrors(['base_year' => 'Data template untuk tahun dasar tidak ditemukan.'])->withInput();
        }

        DB::beginTransaction();
        try {
            foreach ($templates as $tpl) {
                $rencana  = null;
                $tercapai = null;

                if ($tpl->is_numeric) {
                    // Semua numeric di-set ke 0
                    $rencana  = 0;
                    $tercapai = 0;
                } else {
                    // Non-numeric, khusus Akreditasi Institusi di-set ke A/Sangat Baik
                    if (stripos($tpl->uraian, 'Akreditasi Institusi') !== false) {
                        $rencana = 'A/Sangat Baik';
                    } else {
                        $rencana = $tpl->rencana;
                    }
                    $tercapai = null;
                }

                DevelopmentPlan::create([
                    'year'       => $year,
                    'priority'   => $tpl->priority,
                    'uraian'     => $tpl->uraian,
                    'rencana'    => $rencana,
                    'tercapai'   => $tercapai,
                    'link'       => null,
                    'is_numeric' => $tpl->is_numeric,
                    'sort_order' => $tpl->sort_order,
                ]);
            }

            DB::commit();

            return redirect()
                ->route('development', ['year' => $year])
                ->with('success', 'Tahun akademik baru berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Store development year error', ['exception' => $e]);
            return back()->withErrors(['year' => 'Gagal membuat tahun baru: ' . $e->getMessage()])->withInput();
        }
    }

    public function deleteYear(Request $request)
    {
        $request->validate([
            'year' => 'required|string|max:20',
        ]);

        $year = $request->year;

        DB::beginTransaction();
        try {
            DevelopmentPlan::where('year', $year)->delete();

            DB::commit();

            return redirect()
                ->route('development')
                ->with('success', 'Tahun akademik berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Delete development year error', ['exception' => $e]);
            return back()->withErrors(['year' => 'Gagal menghapus tahun: ' . $e->getMessage()]);
        }
    }
}
