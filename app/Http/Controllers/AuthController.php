<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister(){ return view('auth.register'); }

    public function register(Request $r){
        $r->validate(['name'=>'required','email'=>'required|email|unique:users','password'=>'required|min:6|confirmed']);
        User::create(['name'=>$r->name,'email'=>$r->email,'password'=>Hash::make($r->password),'role'=>'user']);
        return redirect()->route('login')->with('success','Registrasi berhasil');
    }

    public function showLogin(){ return view('auth.login'); }

    public function login(Request $r){
        $r->validate(['email'=>'required|email','password'=>'required']);
        if (Auth::attempt($r->only('email','password'))){
            $r->session()->regenerate();
            return Auth::user()->role === 'admin' ? redirect()->route('admin.dashboard') : redirect()->route('user.dashboard');
        }
        return back()->with('error','Email atau password salah');
    }

    public function logout(Request $r){
        Auth::logout();
        $r->session()->invalidate();
        $r->session()->regenerateToken();
        return redirect()->route('home');
    }
}
