<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeeExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Employee::all();
    }

    public function headings(): array
    {
        return ['id', 'uuid', 'nama_lengkap', 'email', 'tempat_lahir', 'tanggal_lahir', 'url_foto', 'domisili', 'pekerjaan', 'jabatan', 'gaji', 'divisi_id', 'pendidikan_terakhir', 'tanggal_bergabung', 'user_id', 'tempat_tinggal'];
    }
}
