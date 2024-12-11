<?php

namespace App\Exports;

use App\Models\Registration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RegistrationsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Registration::all()->map(function ($registration) {
            return [
                'id' => $registration->id,
                'nama' => $registration->nama,
                'email' => $registration->email,
                'no_hp' => $registration->no_hp,
                'domisili_perusahaan' => $registration->domisili_perusahaan,
                'peserta' => $registration->peserta,
                'jabatan' => $registration->jabatan,
                'akan_hadir' => $registration->akan_hadir,
                'telah_scan' => $registration->telah_scan,
                'kode' => $registration->kode,
                'tanggal' => $registration->created_at->format('Y-m-d H:i:s'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Email',
            'No HP',
            'Domisili Perusahaan',
            'Peserta',
            'Jabatan',
            'Akan Hadir',
            'Telah Scan',
            'Kode',
            'Tanggal',
        ];
    }
}


