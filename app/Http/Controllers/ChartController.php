<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChartController extends Controller
{
    public function chart()
    {
        $user = Auth::user();

        $scanCounts = Registration::selectRaw('telah_scan, count(*) as count')
            ->groupBy('telah_scan')
            ->pluck('count', 'telah_scan');

        $data = [
            'belum_scan' => $scanCounts->get('Belum Scan', 0),
            'sudah_scan' => $scanCounts->get('Sudah Scan', 0),
        ];

        return view('admin.chart.chart', compact('data', 'user'));
    }
}
