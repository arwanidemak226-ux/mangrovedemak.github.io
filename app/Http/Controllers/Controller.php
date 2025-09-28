<?php

namespace App\Http\Controllers;

use App\Exports\PendataanTanamanExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Routing\Controller;

class ExportController extends Controller
{
    public function pendataanTanaman()
    {
        return Excel::download(new PendataanTanamanExport, 'pendataan_tanaman.xlsx');
    }
}