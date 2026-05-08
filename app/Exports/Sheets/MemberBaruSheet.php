<?php

namespace App\Exports\Sheets;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MemberBaruSheet implements FromCollection, WithHeadings, WithTitle, WithStyles
{
    public function __construct(
        private int $bulan,
        private int $tahun
    ) {}

    public function title(): string { return 'Member Baru'; }

    public function headings(): array
    {
        return ['No', 'No. Daftar', 'Kode Member', 'Nama', 'Email', 'Paket', 'Tgl Daftar', 'Berlaku s/d', 'Status'];
    }

    public function collection()
    {
        return Member::with(['user', 'paket'])
            ->whereMonth('tanggalDaftar', $this->bulan)
            ->whereYear('tanggalDaftar', $this->tahun)
            ->orderBy('tanggalDaftar')
            ->get()
            ->map(function ($item, $index) {
                return [
                    'No'          => $index + 1,
                    'No. Daftar'  => $item->noPendaftaran,
                    'Kode Member' => $item->kodeMember,
                    'Nama'        => $item->user->name ?? '-',
                    'Email'       => $item->user->email ?? '-',
                    'Paket'       => $item->paket->namaPaket ?? '-',
                    'Tgl Daftar'  => $item->tanggalDaftar,
                    'Berlaku s/d' => $item->tanggalAkhir,
                    'Status'      => $item->statusMember,
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