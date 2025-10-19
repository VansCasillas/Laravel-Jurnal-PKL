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

    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
    //         $role = Auth::user()->role;
    //         return $role === 'admin'
    //             ? redirect()->route('admin.dashboard')
    //             : redirect()->route('pembimbing.dashboard')
    //             : redirect()->route('siswa.dashboard');
    //     }

    //     return back()->withErrors(['login' => 'Email atau password salah.']);
    // }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $role = Auth::user()->role;

            return $role === 'admin' ? redirect()->route('admin.dashboard')
                : ($role === 'pembimbing' ? redirect()->route('pembimbing.dashboard')
                    : redirect()->route('siswa.dashboard'));
        }

        return back()->withErrors(['login' => 'Email atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login')->with('status', 'Anda telah berhasil logout.');
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
