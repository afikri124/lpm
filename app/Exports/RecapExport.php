<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class RecapExport implements FromView
{
    use Exportable;
    protected $MINSCORE,$data,$hod;

    public function __construct($MINSCORE,$data,$hod)
    {
        //
        $this->MINSCORE = $MINSCORE;
        $this->data = $data;
        $this->hod = $hod;
    }

    public function view(): View
    {
        return view('pdf.recapExcel',
        [
            'MINSCORE' => $this->MINSCORE,
            'data' => $this->data,
            'hod' => $this->hod,
        ]);
    }

}
