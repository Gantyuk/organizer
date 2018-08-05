<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\User;
use Form;

class TaskController extends Controller
{
    protected $redirectTo = '/admin/task';

    protected function taskList()
    {
        $tasks_list = [];
        foreach (User::all() as $user) {
            $tasks_list[$user->id] = $user->name;
        }
        return $tasks_list;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.admin.task.tasks', ['tasks' => Task::paginate(10), 'count' => Task::get()->count()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.admin.task.create', ['task' => [], 'tasks_list' => $this->taskList()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'user_id' => 'required',
        ]);
        $img_path = "task/default.jpg";
        $request->file('image') == null ?: $img_path = $request->file('image')->store('task', 'public');

        Task::create([
                'name' => $request['name'],
                'user_id' => $request['user_id'],
                'importance' => $request['importance'],
                'status' => $request['status'],
                'img_path' => $img_path,

            ]
        );

        return redirect()->route('task.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //TODO create show function for task
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('auth.admin.task.edit', [
            'task' => $task,
            'tasks_list' => $this->taskList(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'user_id' => 'required',
        ]);

        $task->name = $request['name'];

        $task->user_id = $request['user_id'];
        $task->importance = $request['importance'];
        $task->status = $request['status'];
        $request->file('image') == null ?: $task->img_path = $request->file('image')->store('task', 'public');
        $task->save();
        return redirect()->route('task.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('task.index');
    }
}
