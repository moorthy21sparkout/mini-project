<?php

namespace App\Http\Controllers;


use App\Http\Requests\CreateTaskRequest;
use App\Models\Task;
use App\Models\Titles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class AdminController extends Controller
{
    /**
     * Display a listing of tasks.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all tasks
        $tasks = Task::with('titles')->latest('updated_at')->paginate(8);

        // Pass tasks to the view
        return view('admin.admin-home', compact('tasks'));
    }
    /**
     * Show the form for creating a new task.
     * 
     * @return \Illuminate\View\View
     */

    public function create()
    {
        $users = User::all(); // Fetch all users
        return view('admin.admin-create', compact('users'));
    }

    /**
     * Store a newly created task in storage.
     * 
     * @param  \App\Http\Requests\CreateTaskRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */

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

    /**
     * Display the specified task.
     * 
     * @param  int  $id
     * @return \Illuminate\View\View
     */

    public function show($id)
    {
        $userTask = Task::with('titles')->findOrFail($id);

        if ($userTask === null) {
            abort(404, 'Task not found');
        }
        // Log the retrieved task
        Log::info('Retrieved task:', ['task' => $userTask]);
        return view('admin.admin-show')->with('userTask', $userTask);
    }
    /**
     * Show the form for editing the specified task.
     * 
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {

        $task = Task::with('titles')->findOrFail($id);

        if (Auth::user('usertype', 'admin')) {
            return view('admin.admin-edit')->with('task', $task);
        }
    }
    /**
     * Update the specified task in storage.
     * 
     * @param  \App\Http\Requests\CreateTaskRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */

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
            'datetime_field' => $request->datetime_field,
            'attachment' => $validatedData['attachment'] ?? $title->attachment, // Keep existing attachment if not updated
        ]);

        return redirect()->route('admin-home')->with('success', 'Task updated successfully!');
    }
    /**
     * Remove the specified task from storage.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        // Additional authorization check if required
        $task->delete();

        return redirect()->route('admin-home')->with('success', 'Task deleted successfully');
    }

    /**
     * Show the form for assigning a task to a user.
     * 
     * @return \Illuminate\View\View
     */
    public function assignTask()
    {
        $tasks = Task::with('titles')->get();
        $users = User::all(); // Get all users for assignment
        $titles = Titles::all(); // Fetch all titles
        return view('admin.admin-assign', compact('tasks', 'users'));
    }

    /**
     * Assign the specified task to a user.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function assign(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->user_id = $request->input('user_id');
        $task->save();

        return redirect()->route('admin-home')->with('success', 'Task assigned successfully!');
    }

    public function search(Request $request){
        $task=Task::where('task','Like','%'.$request->search.'%')->get();
        return response()->json($task);
    }
}
