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
        // Check if the user is authenticated
        if (Auth::check()) {
            if (Auth::user()->usertype == 'admin') {
                if (session('view_mode') == 'user') {

                    return redirect()->route('user_task');
                } else {
                    // Redirect to the admin home page if view mode is not set or set to other than 'user'
                    return redirect()->route('admin-home');
                }
            } elseif (Auth::user()->usertype == 'user') {
                // Redirect to the user task index if the authenticated user is not an admin
                return redirect()->route('user_task.index');
            }
        }
        // Redirect to the login page if the user is not authenticated
        return redirect()->route('login');
    }
}
