<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalLatihan;
use App\Models\GerakanLatihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JadwalLatihanController extends Controller
{
    // ==================== JADWAL ====================

    public function index()
    {
        $jadwal = JadwalLatihan::withCount('gerakan')
                    ->orderByRaw("FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu')")
                    ->get();
        return view('admin.jadwal-latihan.index', compact('jadwal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hari'         => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'fokusLatihan' => 'required|string|max:100',
        ], [
            'hari.required'         => 'Hari wajib dipilih.',
            'fokusLatihan.required' => 'Fokus latihan wajib diisi.',
        ]);

        JadwalLatihan::create($request->all());

        return redirect()->route('admin.jadwal-latihan.index')
            ->with('success', 'Jadwal latihan berhasil ditambahkan.');
    }

    public function update(Request $request, JadwalLatihan $jadwalLatihan)
    {
        $request->validate([
            'hari'         => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'fokusLatihan' => 'required|string|max:100',
        ]);

        $jadwalLatihan->update($request->all());

        return redirect()->route('admin.jadwal-latihan.index')
            ->with('success', 'Jadwal latihan berhasil diperbarui.');
    }

    public function destroy(JadwalLatihan $jadwalLatihan)
    {
        // Hapus semua gambar gerakan yang terkait
        foreach ($jadwalLatihan->gerakan as $gerakan) {
            if ($gerakan->gambarGerakan) {
                Storage::disk('public')->delete($gerakan->gambarGerakan);
            }
        }

        $jadwalLatihan->delete();

        return redirect()->route('admin.jadwal-latihan.index')
            ->with('success', 'Jadwal latihan berhasil dihapus.');
    }

    // ==================== GERAKAN ====================

    public function detail(JadwalLatihan $jadwalLatihan)
    {
        $gerakan = GerakanLatihan::where('idJadwal', $jadwalLatihan->idJadwal)
                    ->orderBy('urutan')
                    ->get();
        return view('admin.jadwal-latihan.detail', compact('jadwalLatihan', 'gerakan'));
    }

    public function storeGerakan(Request $request, JadwalLatihan $jadwalLatihan)
    {
        $request->validate([
            'namaGerakan'  => 'required|string|max:150',
            'set_reps'     => 'nullable|string|max:50',
            'deskripsi'    => 'nullable|string',
            'gambarGerakan' => 'nullable|mimes:jpg,jpeg,png,webp,gif|max:5120',
        ], [
            'namaGerakan.required'  => 'Nama gerakan wajib diisi.',
            'gambarGerakan.mimes' => 'File harus berformat JPG, PNG, WEBP, atau GIF.',
            'gambarGerakan.max'   => 'Ukuran file maksimal 5MB.',
        ]);

        $lastUrutan = GerakanLatihan::where('idJadwal', $jadwalLatihan->idJadwal)
                        ->max('urutan') ?? 0;

        $data = [
            'idJadwal'    => $jadwalLatihan->idJadwal,
            'namaGerakan' => $request->namaGerakan,
            'set_reps'    => $request->set_reps,
            'deskripsi'   => $request->deskripsi,
            'urutan'      => $lastUrutan + 1,
        ];

        if ($request->hasFile('gambarGerakan')) {
            $data['gambarGerakan'] = $request->file('gambarGerakan')
                                        ->store('gerakan', 'public');
        }

        GerakanLatihan::create($data);

        return redirect()->route('admin.jadwal-latihan.detail', $jadwalLatihan->idJadwal)
            ->with('success', 'Gerakan berhasil ditambahkan.');
    }

    public function updateGerakan(Request $request, GerakanLatihan $gerakanLatihan)
    {
        $request->validate([
            'namaGerakan'  => 'required|string|max:150',
            'set_reps'     => 'nullable|string|max:50',
            'deskripsi'    => 'nullable|string',
            'gambarGerakan'=> 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'namaGerakan' => $request->namaGerakan,
            'set_reps'    => $request->set_reps,
            'deskripsi'   => $request->deskripsi,
        ];

        if ($request->hasFile('gambarGerakan')) {
            // Hapus gambar lama
            if ($gerakanLatihan->gambarGerakan) {
                Storage::disk('public')->delete($gerakanLatihan->gambarGerakan);
            }
            $data['gambarGerakan'] = $request->file('gambarGerakan')
                                        ->store('gerakan', 'public');
        }

        $gerakanLatihan->update($data);

        return redirect()->route('admin.jadwal-latihan.detail', $gerakanLatihan->idJadwal)
            ->with('success', 'Gerakan berhasil diperbarui.');
    }

    public function destroyGerakan(GerakanLatihan $gerakanLatihan)
    {
        $idJadwal = $gerakanLatihan->idJadwal;

        if ($gerakanLatihan->gambarGerakan) {
            Storage::disk('public')->delete($gerakanLatihan->gambarGerakan);
        }

        $gerakanLatihan->delete();

        return redirect()->route('admin.jadwal-latihan.detail', $idJadwal)
            ->with('success', 'Gerakan berhasil dihapus.');
    }
}