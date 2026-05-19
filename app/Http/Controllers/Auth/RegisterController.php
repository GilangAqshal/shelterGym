<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:100',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required|min:6|confirmed',
            'noTelp'       => 'nullable|string|max:20',
            'jenisKelamin' => 'nullable|in:Laki-laki,Perempuan',
            'tanggalLahir' => 'nullable|date',
            'alamat'       => 'nullable|string',
        ], [
            'name.required'      => 'Nama wajib diisi.',
            'email.required'     => 'Email wajib diisi.',
            'email.unique'       => 'Email sudah digunakan.',
            'password.required'  => 'Password wajib diisi.',
            'password.min'       => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        User::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'noTelp'       => $request->noTelp,
            'jenisKelamin' => $request->jenisKelamin,
            'tanggalLahir' => $request->tanggalLahir,
            'alamat'       => $request->alamat,
            'role'         => 'user',
        ]);

        return redirect()->route('login')
            ->with('success_register', 'Registrasi berhasil! Silakan login.');
    }
}