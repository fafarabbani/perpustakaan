<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    /**
     * Write code on Method
     * 
     * @return response()
     * 
     */
    public function index() {

        return view('kasir.dashboard');
    }
}
