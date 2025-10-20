<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'=> ['required','email',],
            'password'=> ['required'],
        ]);


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }elseif ($user->role === 'pembimbing') {
                return redirect()->route('pembimbing.dashboard');
            }elseif ($user->role === 'siswa') {
                return redirect()->route('siswa.dashboard');
            }else{
                Auth::logout();
                return redirect()->route('login')->with('error','Role pengunna tidak di temukan');
            }
            
        }

        return back()->withErrors(['login' => 'Email atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login')->with('status', 'Anda telah berhasil logout.')->onlyInput('email');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        User::where('id', $id)->delete();
    }
}
