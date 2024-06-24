<?php

namespace App\Http\Controllers;

use App\Events\UserTaskCreatedEvent;
use App\Http\Requests\CreateTaskRequest;
use App\Models\Task;
use App\Models\Titles;
use App\Models\User;
use App\Notifications\UserTaskCreateNotification as NotificationsUserTaskCreateNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification as NotificationsNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Notifications\UserTaskCreateNotification;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch all tasks
        $tasks = Task::with('titles')->paginate(8);
        // Pass tasks to the view

        return view('admin.home', compact('tasks'));
    }


    public function create()
    {
        $users = User::all(); // Fetch all users
        return view('admin.admin-create', compact('users'));
    }



    public function store(CreateTaskRequest $request)
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

            $task = Task::create([

                'user_id' => Auth::id(),
                'task' => $request->task,
            ]);
            Titles::create([
                'task_id' => $task->id,
                'title' => $request->title,
                'description' => $request->description,
                'due_date' => $request->due_date,
                'datetime_field' => $request->datetime_field,
                'attachment' => $request->attachment,
                'status' => $request->input('status'),
            ]);



            return redirect()->route('admin-home')->with('success', 'Task created successfully!');
        } catch (\Exception $e) {
            // Log the error or handle it based on your application's needs
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
    //     public function store(CreateTaskRequest $request)
    // {
    //     try {
    //         $validatedData = $request->validated();

    //         // Handle file upload if attachment exists in the request
    //         if ($request->hasFile('attachment')) {
    //             $attachment = $request->file('attachment');
    //             $filePath = $attachment->store('attachments', 'public'); // Store file in storage/app/public/attachments
    //             $validatedData['attachment'] = $filePath; // Save file path to database
    //         }

    //         // Create Task using validated data and authenticated user's id
    //         $task = Task::create([
    //             'user_id' => $request->user_id, // Assign the task to the selected user
    //             'task' => $validatedData['task'],
    //         ]);

    //         Titles::create([
    //             'task_id' => $task->id,
    //             'title' => $validatedData['title'],
    //             'description' => $validatedData['description'],
    //             'due_date' => $validatedData['due_date'],
    //             'attachment' => $validatedData['attachment'] ?? null,
    //         ]);

    //         return redirect()->route('admin-home')->with('success', 'Task created successfully!');
    //     } catch (\Exception $e) {
    //         // Log the error or handle it based on your application's needs
    //         return back()->withInput()->withErrors(['error' => $e->getMessage()]);
    //     }
    // }


    public function show($id)
    {
        $userTask = Task::with('titles')->findOrFail($id);
        // dd($userTask);
        if ($userTask === null) {
            abort(404, 'Task not found');
        }
        // Log the retrieved task
        Log::info('Retrieved task:', ['task' => $userTask]);
        return view('admin.admin-show')->with('userTask', $userTask);
    }

    public function edit($id)
    {

        $task = Task::with('titles')->findOrFail($id);

        if (Auth::user('usertype', 'admin')) {
            return view('admin.admin-edit')->with('task', $task);
        }
    }

    public function update(CreateTaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);

        // Check if the user is authorized to update the task
        if ($task->user_id != Auth::id() && Auth::user()->usertype != 'admin') {
            return redirect()->route('admin-home')->withErrors(['error' => 'You are not authorized to update this task']);
        }

        $validatedData = $request->validated();

        // Handle file upload
        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment');
            $filePath = $attachment->storeAs('attachments', $attachment->getClientOriginalName(), 'public'); // Store file in storage/app/public/attachments
            $validatedData['attachment'] = $filePath; // Save file path to database
        }

        // Update the task
        $task->update([
            'task' => $validatedData['task'],
        ]);

        // Update the title related to the task
        $title = Titles::where('task_id', $task->id)->first();
        $title->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'due_date' => $validatedData['due_date'],
            'attachment' => $validatedData['attachment'] ?? $title->attachment, // Keep existing attachment if not updated
        ]);

        return redirect()->route('admin-home')->with('success', 'Task updated successfully!');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        // Additional authorization check if required
        $task->delete();

        return redirect()->route('admin-home')->with('success', 'Task deleted successfully');
    }


    public function adminNotifications()
    {
        $notifications = Auth::user()->notifications;

        return view('admin.admin-notification', compact('notifications'));
    }
    public function assignTask()
    {
        $tasks = Task::with('titles')->get();
        $users = User::all(); // Get all users for assignment
        $titles = Titles::all(); // Fetch all titles
        return view('admin.admin-assign', compact('tasks', 'users'));
    }

    public function assign(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->user_id = $request->input('user_id');
        $task->save();

        return redirect()->route('admin-home')->with('success', 'Task assigned successfully!');
    }
}
