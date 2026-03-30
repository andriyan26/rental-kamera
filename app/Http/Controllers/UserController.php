<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function promote($id) {
        $user = User::find($id);
        $user->update([
            'role' => 1,
        ]);

        return back();
    }

    public function demote($id) {
        $user = User::find($id);
        $user->update([
            'role' => 0,
        ]);

        return back();
    }

    public function edit() {
        return view('account',[
            'user' => User::find(Auth::id())
        ]);
    }

    public function update(Request $request) {
        $user = User::find(Auth::id());

        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'telepon' => 'required|max:15',
        ];

        if ((int) $user->role === 0) {
            $rules['ktp'] = 'nullable|file|mimes:jpeg,jpg,png,pdf|max:5120';
        }

        $this->validate($request, $rules);

        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->telepon = $request['telepon'];

        if ((int) $user->role === 0 && $request->hasFile('ktp')) {
            if ($user->ktp_path) {
                Storage::disk('public')->delete($user->ktp_path);
            }
            $user->ktp_path = $request->file('ktp')->store('ktp', 'public');
        }

        $user->save();

        return back()->with('updated', 'Berhasil melakukan perubahan');
    }

    public function changePassword(Request $request) {
        $user = User::find(Auth::id());

        $this->validate($request,[
            'oldPassword' => 'required',
            'newPassword' => 'required',
        ]);

        if(Hash::check($request['oldPassword'], $user->password)) {
            $user->update([
                'password' => Hash::make($request['newPassword'])
            ]);
            return back()->with('updated','Password berhasil diubah');
        } else {
            return back()->with('message','Password saat ini salah');
        }

    }
}
