<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DasgboardController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }
}
