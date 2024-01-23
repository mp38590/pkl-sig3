<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;

class RegisterController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.signup');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([

            'name' => 'required|min:3|max:255',
            'username' => 'required|min:3|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:7|max:255',
            'confirm_password' => 'required|min:7|max:255|same:password',
            'level' => 'required|min:5|max:255',
            'terms' => 'accepted',
        ], [
            'name.required' => 'Nama harus dimasukkan',
            'username.required' => 'Username harus dimasukkan',
            'email.required' => 'Email harus dimasukkan',
            'password.required' => 'Password harus dimasukkan',
            'confirm_password.required' => 'Password harus dimasukkan',
            'level.required' => 'Level harus dimasukkan',
            'terms.accepted' => 'You must accept the terms and conditions',
            'confirm_password.same' => 'Masukkan konfirmasi password sesuai dengan password',
            'username.unique' => 'Username sudah digunakan',
            'email.unique' => 'Email sudah digunakan',
            'email.email' => 'Format email tidak valid',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'confirm_password' => Hash::make($request->password),
            'level' => $request->level,
            'inserted_by' => $request->username,
            'updated_by' => null,
        ]);
        
        Auth::login($user);
        
        if ($user->wasRecentlyCreated) {
            $user->update(['updated_by' => $request->username]);
        }

        return redirect()->route('sign-in')->with('success', 'Akun berhasil dibuat dan disimpan');
    }
}
