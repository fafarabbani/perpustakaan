<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Write code on Method
     * 
     * @return response()
     * 
     */
    public function index() {

        return view('dashboard');
    }
}
