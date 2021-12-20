<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return \view('auth.login');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('transactions');
        }
        return back()->withErrors([
            'name' => 'The provided credentials do not match our records.',
            'password' => 'The provided credentials do not match our records.',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('logout', 'Berhasil keluar');
    }

    //register new user
    public function registerUser(Request $req)
    {
        //check jika user sudah login baru boleh membuat user baru
        if (auth()->check()) {
            $req->validate([
                'name' => 'required|unique:users,name',
                'password' => 'required|min:6'
            ]);
            try {
                User::create([
                    'name' => $req->name,
                    'email' => $req->name . '@mail.dummy.com',
                    'password' => Hash::make($req->password),
                    'email_verified_at' => now(),
                    'remember_token' => \rand(5, 10)
                ]);
                return \back()->with('msg', "Berhasil menambah admin $req->name");
            } catch (\Exception $e) {
                return \back()->with('msg', 'Gagal Menambah USER!!! dengan error : ' . $e->getMessage());
            }
        }
        return \back()->with('msg', 'Anda harus login!!!');
    }
}
