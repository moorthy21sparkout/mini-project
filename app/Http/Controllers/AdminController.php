<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Models\Task;
use App\Models\Titles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification as NotificationsNotification;
use Illuminate\Support\Facades\Auth;
use Notifications\UserTaskCreateNotification;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch all tasks
        $tasks = Task::with('titles')->get();
        // Pass tasks to the view
        return view('admin.home', compact('tasks'));
    }


    public function create()
    {
        return view('admin.admin-create');
    }



    public function store(CreateTaskRequest $request)
    { {
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
                    'attachment' => $request->attachment,
                ]);


                return redirect()->route('admin-home')->with('success', 'Task created successfully!');
            } catch (\Exception $e) {
                // Log the error or handle it based on your application's needs
                return back()->withInput()->withErrors(['error' => $e->getMessage()]);
            }
        }
    }

    public function show($id)
    {
        $userTask = Task::where('id', $id)->with('titles')->get();
        return view('admin.admin-show')->with('userTasks', $userTask);
    }

    public function edit($id)
    {

        $task = Task::with('titles')->findOrFail($id);
        if ($task->user_id != Auth::id()) {
            return redirect()->route('admin-index')->withErrors(['error' => 'You are not authorized to edit this task']);
        }

        return view('admin-edit')->with('task', $task);
    }

    public function update(CreateTaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        if ($task->user_id != Auth::id()) {
            return redirect()->route('admin-home')->withErrors(['error' => 'You are not authorized to update this task']);
        }

        $validatedData = $request->validated();

        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment');
            $filePath = $attachment->move('attachments', $attachment->getClientOriginalName()); // Store file in storage/app/public/attachments
            $validatedData['attachment'] = $filePath; // Save file path to database
        }

        $task->update([
            'task' => $request->task,
        ]);

        $title = Titles::where('task_id', $task->id)->first();
        $title->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'attachment' => $request->attachment ?? $title->attachment, // Keep existing attachment if not updated
        ]);

        return redirect()->route('admin-home')->with('success', 'Task updated successfully!');
    }
    public function destroy($id)
    {


        $task = Task::findOrFail($id);
        if ($task->user_id != Auth::id()) {
            return redirect()->route('admin-home')->withErrors(['error' => 'You are not authorized to delete this task']);
        }

        // Delete the titles associated with the task
        Titles::where('task_id', $task->id)->delete();
        // Delete the task
        $task->delete();

        return redirect()->route('admin-home')->with('success', 'Task deleted successfully!');
    }
    public function notifications()
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login page if not authenticated
        }

        // Fetch admin users based on 'usertype'
        $admins = User::where('usertype', 'admin')->get();

        // Initialize an empty array to store all notifications
        $notifications = collect();

        // Iterate through each admin user and merge their notifications
        foreach ($admins as $admin) {
            $notifications = $notifications->merge($admin->notifications()->get());
        }

        // Paginate the merged notifications (adjust '10' as per your requirement)
        $notifications = $notifications->sortByDesc('created_at');

        return view('admin.admin-notification', compact('notifications'));
    }
}
