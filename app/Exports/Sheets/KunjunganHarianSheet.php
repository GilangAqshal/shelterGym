<?php

namespace App\Exports\Sheets;

use App\Models\KunjunganHarian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KunjunganHarianSheet implements FromCollection, WithHeadings, WithTitle, WithStyles
{
    public function __construct(
        private int $bulan,
        private int $tahun
    ) {}

    public function title(): string { return 'Kunjungan Harian'; }

    public function headings(): array
    {
        return ['No', 'Invoice', 'Nama Pengunjung', 'No. Telp', 'Paket', 'Harga', 'Tanggal'];
    }

    public function collection()
    {
        return KunjunganHarian::with('paketHarian')
            ->whereMonth('tanggal', $this->bulan)
            ->whereYear('tanggal', $this->tahun)
            ->orderBy('tanggal')
            ->get()
            ->map(function ($item, $index) {
                return [
                    'No'             => $index + 1,
                    'Invoice'        => $item->invoice,
                    'Nama Pengunjung'=> $item->namaPengunjung,
                    'No. Telp'       => $item->noTelp ?? '-',
                    'Paket'          => $item->paketHarian->namaKategori ?? '-',
                    'Harga'          => $item->harga,
                    'Tanggal'        => $item->tanggal,
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