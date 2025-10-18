<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function admin()
    {
        // Total Siswa
        $totalSiswa = User::where('role', 'siswa')->count();

        // Total Pembimbing
        $totalPembimbing = User::where('role', 'pembimbing')->count();

        return view('admin.dashboard',compact('totalSiswa','totalPembimbing'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
