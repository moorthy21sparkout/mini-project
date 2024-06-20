<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Models\Task;
use App\Models\Titles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get tasks for the authenticated user
        $tasks = Task::where('user_id', Auth::id())->get();

        // Get titles based on tasks (assuming task_id is a foreign key in the Titles model)
        $titles = Titles::whereIn('task_id', $tasks->pluck('id'))->get();

        // Pass the tasks and titles to the view
        return view('layouts.user')->with(['tasks' => $tasks, 'titles' => $titles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('user.create-task');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
                'attachment' => $request->attachment,
            ]);


            return redirect()->route('user_task.index')->with('success', 'Task created successfully!');
        } catch (\Exception $e) {
            // Log the error or handle it based on your application's needs
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $userTask=Titles::where('user_id', Auth::id())->get();
        // return view('user.show')->with('userTask',$userTask);
        $userTasks = Task::where('id', $id)->with('titles')->get();
        return view('user.show')->with('userTasks', $userTasks);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $task = Task::with('titles')->findOrFail($id);
        if ($task->user_id != Auth::id()) {
            return redirect()->route('user_task.index')->withErrors(['error' => 'You are not authorized to edit this task']);
        }

        return view('user.edit')->with('task', $task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateTaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        if ($task->user_id != Auth::id()) {
            return redirect()->route('user_task.index')->withErrors(['error' => 'You are not authorized to update this task']);
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

        return redirect()->route('user_task.index')->with('success', 'Task updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $task = Task::findOrFail($id);
        if ($task->user_id != Auth::id()) {
            return redirect()->route('user_task.index')->withErrors(['error' => 'You are not authorized to delete this task']);
        }

        // Delete the titles associated with the task
        Titles::where('task_id', $task->id)->delete();
        // Delete the task
        $task->delete();

        return redirect()->route('user_task.index')->with('success', 'Task deleted successfully!');
    }
}
