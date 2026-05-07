<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::whereIn('role', ['admin', 'owner'])
                    ->orderBy('id')
                    ->get();
        return view('admin.admin.index', compact('admins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'noTelp'   => 'nullable|string|max:20',
            'role'     => 'required|in:admin,owner',
        ], [
            'name.required'     => 'Nama wajib diisi.',
            'email.required'    => 'Email wajib diisi.',
            'email.unique'      => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 6 karakter.',
            'role.required'     => 'Role wajib dipilih.',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'noTelp'   => $request->noTelp,
            'role'     => $request->role,
        ]);

        return redirect()->route('admin.admin.index')
            ->with('success', 'Akun admin berhasil ditambahkan.');
    }

    public function update(Request $request, User $admin)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email,' . $admin->id,
            'noTelp'   => 'nullable|string|max:20',
            'role'     => 'required|in:admin,owner',
            'password' => 'nullable|min:6',
        ]);

        $data = [
            'name'   => $request->name,
            'email'  => $request->email,
            'noTelp' => $request->noTelp,
            'role'   => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return redirect()->route('admin.admin.index')
            ->with('success', 'Akun admin berhasil diperbarui.');
    }

    public function destroy(User $admin)
    {
        // Cegah hapus diri sendiri
        if ($admin->id === auth()->id()) {
            return redirect()->route('admin.admin.index')
                ->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        $admin->delete();

        return redirect()->route('admin.admin.index')
            ->with('success', 'Akun admin berhasil dihapus.');
    }
}