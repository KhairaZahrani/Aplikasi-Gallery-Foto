<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SessionCotroller extends Controller
{
    function index(){
        return view('login');
    }

    function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ],[
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($infologin)){
            return redirect('/')->with('pesan', 'Berhasil Login');
        }else{ 
            return redirect('/login')->withErrors('Username dan Password yang dimasukan tidak valid');
        }
    }

    function register(){
        return view('register');
    }

    function create(Request $request){
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'alamat' => 'required',
            'password' => 'required|min:8|confirmed', 
            'nama_lengkap' => 'required', 
        ],[
            'username.required' => 'Username wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password harus minimal 8 karakter',
            'password.confirmed' => 'Password konfirmasi tidak cocok',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi', 
        ]);

        $data = [
          'username' => $request->username,
          'email' => $request->email,
          'password' => Hash::make( $request->password),
          'nama_lengkap' => $request->nama_lengkap,
          'alamat' => $request->alamat,
        ];

        User::create($data);
        return redirect('/login')->with('pesan', 'Berhasil Register Silahkan Login  ');
    }
}
