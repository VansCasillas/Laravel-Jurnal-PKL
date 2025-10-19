<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    //
    public function index()
    {
        return view('admin.jurusans.index');
    }
}
