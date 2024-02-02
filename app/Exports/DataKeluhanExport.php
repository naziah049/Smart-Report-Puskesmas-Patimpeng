<?php

namespace App\Exports;

use App\Models\DataKeluhan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DataKeluhanExport implements FromView
{
    private $keluhan;

    public function __construct($keluhan)
    {
        $this->keluhan = $keluhan;
    }

    public function view(): View
    {
        return view('exports.report_keluhan', [
            'data' => $this->keluhan,
        ]);
    }
}
