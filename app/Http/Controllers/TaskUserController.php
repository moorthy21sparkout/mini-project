<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskUserController extends Controller
{
    public function index()
    {
        //


        $tasks = Task::where('user_id', Auth::id())->get();
        return view('layouts.user')->with('tasks', $tasks);
        // Fetch all tasks
        // $tasks = Task::all();

        // Pass tasks to the view
        // return view('tasks.index', compact('tasks'));
    }
    public function create()
    {
        //
        return view('user.create-task');
    }
    public function store(CreateTaskRequest  $request)

    {
        try {
            $validatedData = $request->validated();
            // Handle file upload if attachment exists in the request
            if ($request->hasFile('attachment')) {
                $attachment = $request->file('attachment');
                $filePath = $attachment->move('attachments', $attachment); // Store file in storage/app/public/attachments
                $validatedData['attachment'] = $filePath; // Save file path to database
            }
            // Create Task using validated data and authenticated user's id

            Task::create([

                'user_id' => Auth::id(),
                'task' => $request->title,
                'title' => $request->title,
                'description' => $request->description,
                'due_date' => $request->due_date,
                'attachment' => $request->attachment,
            ]);


            return redirect()->route('user-home')->with('success', 'Task created successfully!');
        } catch (\Exception $e) {
            // Log the error or handle it based on your application's needs
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit(CreateTaskRequest  $request)

    {
        try {
            $validatedData = $request->validated();
            // Handle file upload if attachment exists in the request
            if ($request->hasFile('attachment')) {
                $attachment = $request->file('attachment');
                $filePath = $attachment->move('attachments', $attachment); // Store file in storage/app/public/attachments
                $validatedData['attachment'] = $filePath; // Save file path to database
            }
            // Create Task using validated data and authenticated user's id

            Task::create([

                'user_id' => Auth::id(),
                'task' => $request->title,
                'title' => $request->title,
                'description' => $request->description,
                'due_date' => $request->due_date,
                'attachment' => $request->attachment,
            ]);


            return redirect()->route('user-home')->with('success', 'Task updated successfully!');
        } catch (\Exception $e) {
            // Log the error or handle it based on your application's needs
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
