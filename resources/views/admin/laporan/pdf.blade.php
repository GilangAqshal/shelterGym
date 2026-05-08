<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan {{ $namaBulan }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 11px; color: #1f2937; }
        .header { text-align: center; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #3b82f6; }
        .header h1 { font-size: 18px; color: #1d4ed8; }
        .header p { color: #6b7280; font-size: 11px; margin-top: 2px; }
        .stats { display: flex; gap: 12px; margin-bottom: 20px; }
        .stat-box { flex: 1; border: 1px solid #e5e7eb; border-radius: 8px; padding: 10px; text-align: center; }
        .stat-box .label { color: #6b7280; font-size: 10px; }
        .stat-box .value { font-size: 16px; font-weight: bold; color: #1d4ed8; margin-top: 2px; }
        .section-title { font-size: 13px; font-weight: bold; margin: 16px 0 8px; color: #374151; border-left: 3px solid #3b82f6; padding-left: 8px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 16px; }
        th { background: #eff6ff; color: #1d4ed8; font-size: 10px; padding: 7px 8px; text-align: left; }
        td { padding: 6px 8px; border-bottom: 1px solid #f3f4f6; font-size: 10px; }
        tr:nth-child(even) td { background: #f9fafb; }
        .badge { display: inline-block; padding: 2px 6px; border-radius: 9999px; font-size: 9px; font-weight: bold; }
        .badge-blue { background: #dbeafe; color: #1d4ed8; }
        .badge-purple { background: #ede9fe; color: #7c3aed; }
        .total-row td { font-weight: bold; background: #eff6ff; }
        .footer { text-align: right; margin-top: 20px; color: #9ca3af; font-size: 10px; }
    </style>
</head>
<body>

    <div class="header">
        <h1>ShelterGym - Laporan Bulanan</h1>
        <p>Periode: {{ $namaBulan }} | Dicetak: {{ now()->translatedFormat('d F Y, H:i') }}</p>
    </div>

    {{-- Statistik --}}
    <div class="stats">
        <div class="stat-box">
            <div class="label">Total Pendapatan</div>
            <div class="value">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
        </div>
        <div class="stat-box">
            <div class="label">Total Kunjungan</div>
            <div class="value">{{ $totalKunjungan }}</div>
        </div>
        <div class="stat-box">
            <div class="label">Kunjungan Harian</div>
            <div class="value">{{ $kunjunganHarian->count() }}</div>
        </div>
        <div class="stat-box">
            <div class="label">Kunjungan Member</div>
            <div class="value">{{ $kunjunganMember->count() }}</div>
        </div>
        <div class="stat-box">
            <div class="label">Member Baru</div>
            <div class="value">{{ $memberBaru }}</div>
        </div>
    </div>

    {{-- Kunjungan Harian --}}
    <div class="section-title">Kunjungan Harian ({{ $kunjunganHarian->count() }} transaksi)</div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Invoice</th>
                <th>Nama Pengunjung</th>
                <th>Paket</th>
                <th>Harga</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kunjunganHarian as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td><span class="badge badge-blue">{{ $item->invoice }}</span></td>
                <td>{{ $item->namaPengunjung }}</td>
                <td>{{ $item->paketHarian->namaKategori ?? '-' }}</td>
                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;color:#9ca3af;">Tidak ada data</td></tr>
            @endforelse
            <tr class="total-row">
                <td colspan="4">Total Pendapatan</td>
                <td colspan="2">Rp {{ number_format($kunjunganHarian->sum('harga'), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    {{-- Kunjungan Member --}}
    <div class="section-title">Kunjungan Member ({{ $kunjunganMember->count() }} kunjungan)</div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Invoice</th>
                <th>Kode Member</th>
                <th>Nama Member</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kunjunganMember as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td><span class="badge badge-purple">{{ $item->invoice }}</span></td>
                <td>{{ $item->member->kodeMember ?? '-' }}</td>
                <td>{{ $item->member->user->name ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center;color:#9ca3af;">Tidak ada data</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dokumen ini dibuat otomatis oleh sistem ShelterGym
    </div>

</body>
</html>