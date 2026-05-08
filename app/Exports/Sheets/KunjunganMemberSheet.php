<?php

namespace App\Exports\Sheets;

use App\Models\KunjunganMember;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KunjunganMemberSheet implements FromCollection, WithHeadings, WithTitle, WithStyles
{
    public function __construct(
        private int $bulan,
        private int $tahun
    ) {}

    public function title(): string { return 'Kunjungan Member'; }

    public function headings(): array
    {
        return ['No', 'Invoice', 'Kode Member', 'Nama Member', 'Tanggal'];
    }

    public function collection()
    {
        return KunjunganMember::with('member.user')
            ->whereMonth('tanggal', $this->bulan)
            ->whereYear('tanggal', $this->tahun)
            ->orderBy('tanggal')
            ->get()
            ->map(function ($item, $index) {
                return [
                    'No'          => $index + 1,
                    'Invoice'     => $item->invoice,
                    'Kode Member' => $item->member->kodeMember ?? '-',
                    'Nama Member' => $item->member->user->name ?? '-',
                    'Tanggal'     => $item->tanggal,
                ];
            });
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}