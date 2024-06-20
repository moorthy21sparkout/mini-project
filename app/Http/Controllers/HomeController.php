<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    public function redirect()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 'user') {
                return redirect('user_task');
            } else {
                return redirect()->route('admin-home');
            }
        }
    }
}
