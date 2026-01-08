<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use App\Models\Verifikasi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $pembimbings = User::role('pembimbing')->get();
        return view('auth.register', compact('pembimbings'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:verifikasis'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'max:50'],
            'nama_pembimbing' => $request->role === 'user'
                ? ['required', 'string', 'max:255']
                : ['nullable', 'string', 'max:255'],
        ]);


        Verifikasi::create([
            'name'            => $request->name,
            'email'           => $request->email,
            'nama_pembimbing' => $request->role === 'user' ? $request->nama_pembimbing : '-',
            'role'            => $request->role,
            'password_plain'  => Hash::make($request->password),
        ]);



        return redirect()->route('login')->with('status', 'Registrasi berhasil, tunggu verifikasi admin.');
    }
}
