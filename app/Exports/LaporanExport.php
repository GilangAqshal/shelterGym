<?php

namespace App\Exports;

use App\Models\KunjunganHarian;
use App\Models\KunjunganMember;
use App\Models\Member;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
// use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanExport implements WithMultipleSheets
{
    public function __construct(
        private int $bulan,
        private int $tahun
    ) {}

    public function sheets(): array
    {
        return [
            'Kunjungan Harian' => new Sheets\KunjunganHarianSheet($this->bulan, $this->tahun),
            'Kunjungan Member' => new Sheets\KunjunganMemberSheet($this->bulan, $this->tahun),
            'Member Baru'      => new Sheets\MemberBaruSheet($this->bulan, $this->tahun),
        ];
    }
}

// class LaporanExport implements FromCollection
// {
//     /**
//     * @return \Illuminate\Support\Collection
//     */
//     public function collection()
//     {
//         //
//     }
// }
