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
    // public function redirect()
    // {
    //     if (Auth::id()) {
    //         if (Auth::user()->usertype == 'user'||Auth::user()->usertype == 'admin' ) {
    //             return redirect('user_task');
    //         } else {
    //             return redirect()->route('admin-home');
    //         }
    //     }
    // }
    public function redirect()
    {
        if (Auth::check()) {
            if (Auth::user()->usertype == 'admin') {
                if (session('view_mode') == 'user') {
                    return redirect()->route('user_task');
                } else {
                    return redirect()->route('admin-home');
                }
            } elseif (Auth::user()->usertype == 'user') {
                return redirect()->route('user_task.index');
            }
        }

        return redirect()->route('login');
    }
}
