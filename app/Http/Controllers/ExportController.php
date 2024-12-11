<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\RegistrationsExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportExcel()
    {
        return Excel::download(new RegistrationsExport, 'registrations.xlsx');
    }
}
