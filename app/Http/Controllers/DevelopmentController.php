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

    public function index(Request $request) {
        $selectedYear = $request->get('year', '2020/2021');
        
        // Get all unique years
        $years = DevelopmentPlan::select('year')
            ->distinct()
            ->orderBy('year')
            ->pluck('year');
        
        // Get all priorities
        $priorities = DevelopmentPlan::select('priority')
            ->distinct()
            ->orderBy('priority')
            ->pluck('priority');
        
        // Get data for selected year, grouped by priority
        $plans = DevelopmentPlan::where('year', $selectedYear)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->groupBy('priority');
        
        // Debug: Check if plans is empty
        if ($plans->isEmpty()) {
            Log::info('Development Plans Empty', [
                'selectedYear' => $selectedYear,
                'totalPlans' => DevelopmentPlan::count(),
                'years' => DevelopmentPlan::distinct('year')->pluck('year')->toArray()
            ]);
        }
        
        return view('development.index', compact('years', 'priorities', 'plans', 'selectedYear'));
    }

    public function update(Request $request) {
        $request->validate([
            'id' => 'required|exists:development_plans,id',
            'rencana' => 'nullable|string|max:255',
            'tercapai' => 'nullable|numeric|min:0',
            'link' => 'nullable|url|max:500'
        ]);

        $plan = DevelopmentPlan::findOrFail($request->id);
        
        $plan->rencana = $request->rencana;
        $plan->tercapai = $request->tercapai;
        
        if ($request->has('link')) {
            $plan->link = $request->link;
        }
        
        $plan->save();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diperbarui',
            'data' => $plan
        ]);
    }

    public function bulkUpdate(Request $request) {
        $request->validate([
            'updates' => 'required|array',
            'updates.*.id' => 'required|exists:development_plans,id',
            'updates.*.rencana' => 'nullable|string|max:255',
            'updates.*.tercapai' => 'nullable|numeric|min:0',
            'updates.*.link' => 'nullable|url|max:500'
        ]);

        DB::beginTransaction();
        try {
            foreach ($request->updates as $update) {
                $plan = DevelopmentPlan::findOrFail($update['id']);
                $plan->rencana = $update['rencana'] ?? $plan->rencana;
                $plan->tercapai = $update['tercapai'] ?? $plan->tercapai;
                if (isset($update['link'])) {
                    $plan->link = $update['link'];
                }
                $plan->save();
            }
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
