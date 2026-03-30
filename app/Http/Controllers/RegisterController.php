<?php

namespace App\Http\Controllers;

use App\Models\LoanContract;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index() {
        return view('registration');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:255',
            'telepon' => 'required|max:15',
            'ktp' => 'required|file|mimes:jpeg,jpg,png,pdf|max:5120',
        ]);

        $path = $request->file('ktp')->store('ktp', 'public');

        $validated['password'] = Hash::make($validated['password']);
        $validated['ktp_path'] = $path;
        unset($validated['ktp']);

        $user = User::create($validated);

        LoanContract::create([
            'user_id' => $user->id,
            'contract_text' => LoanContract::defaultContractText(),
        ]);

        return redirect(route('home'))->with('registrasi', 'Registrasi Berhasil, Silakan login untuk mulai menyewa');
    }
}
