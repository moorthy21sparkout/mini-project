<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
             // Fetch all tasks
        $tasks = Task::all();

        // Pass tasks to the view
        return view('admin.home', compact('tasks'));
    }
}
