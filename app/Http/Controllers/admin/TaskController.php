<?php

namespace App\Http\Controllers\Admin;

use App\Task;
use Illuminate\Http\Request;
use App\User;
use Form;
use App\Http\Controllers\Controller;

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
        return view('auth.admin.task.tasks');
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
        return view('auth.admin.task.show', ['task' => $task]);
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

    public function executedAll()
    {
        foreach (Task::all() as $task) {
            $task->status = 'Executed';
            $task->save();
        }
        return back();
    }

    public function executed(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');
            foreach (Task::where('id', $id)->get() as $task) {
                $task->status = 'Executed';
                $task->save();
            }
            echo json_encode([
                'success' => 'success'
            ]);

        }
    }

    public function filtration(Request $request)
    {
        if ($request->ajax()) {
            $name = $request->get('name');
            $user = $request->get('user');
            $importance = $request->get('importance');
            $status = $request->get('status');
            $output = '';

            if ($name != '') {
                if ($importance != '') {
                    if ($user != '') {
                        if ($status != '') {
                            $data = Task::where('name', 'like', '%' . $name . '%')
                                ->where('importance', '' . $importance . '')
                                ->where('status', '' . $status . '')
                                ->WhereHas('user', function ($q) use ($user) {
                                    $q->where('name', 'like', '%' . $user . '%');
                                })
                                ->orderBy('created_at')
                                ->get();

                        } else {
                            $data = Task::where('name', 'like', '%' . $name . '%')
                                ->where('importance', '' . $importance . '')
                                ->WhereHas('user', function ($q) use ($user) {
                                    $q->where('name', 'like', '%' . $user . '%');
                                })
                                ->orderBy('created_at')
                                ->get();
                        }
                    } elseif ($status != '') {
                        $data = Task::where('name', 'like', '%' . $name . '%')
                            ->where('importance', '' . $importance . '')
                            ->where('status', '' . $status . '')
                            ->orderBy('created_at')
                            ->get();
                    } else {
                        $data = Task::where('name', 'like', '%' . $name . '%')
                            ->where('importance', '' . $importance . '')
                            ->orderBy('created_at')
                            ->get();
                    }
                } elseif ($user != '') {
                    if ($status != '') {
                        $data = Task::where('name', 'like', '%' . $name . '%')
                            ->where('status', '' . $status . '')
                            ->WhereHas('user', function ($q) use ($user) {
                                $q->where('name', 'like', '%' . $user . '%');
                            })
                            ->orderBy('created_at')
                            ->get();

                    } else {
                        $data = Task::where('name', 'like', '%' . $name . '%')
                            ->WhereHas('user', function ($q) use ($user) {
                                $q->where('name', 'like', '%' . $user . '%');
                            })
                            ->orderBy('created_at')
                            ->get();
                    }
                } elseif ($status != '') {
                    $data = Task::where('name', 'like', '%' . $name . '%')
                        ->where('status', '' . $status . '')
                        ->orderBy('created_at')
                        ->get();
                } else {
                    $data = Task::where('name', 'like', '%' . $name . '%')
                        ->orderBy('created_at')
                        ->get();
                }
            } elseif ($importance != '') {
                if ($user != '') {
                    if ($status != '') {
                        $data = Task::where('importance', '' . $importance . '')
                            ->where('status', '' . $status . '')
                            ->WhereHas('user', function ($q) use ($user) {
                                $q->where('name', 'like', '%' . $user . '%');
                            })
                            ->orderBy('created_at')
                            ->get();

                    } else {
                        $data = Task::where('importance', '' . $importance . '')
                            ->WhereHas('user', function ($q) use ($user) {
                                $q->where('name', 'like', '%' . $user . '%');
                            })
                            ->orderBy('created_at')
                            ->get();
                    }
                } elseif ($status != '') {
                    $data = Task::where('importance', '' . $importance . '')
                        ->where('status', '' . $status . '')
                        ->orderBy('created_at')
                        ->get();
                } else {
                    $data = Task::where('importance', '' . $importance . '')
                        ->orderBy('created_at')
                        ->get();
                }
            } elseif ($user != '') {
                if ($status != '') {
                    $data = Task::where('status', '' . $status . '')
                        ->WhereHas('user', function ($q) use ($user) {
                            $q->where('name', 'like', '%' . $user . '%');
                        })
                        ->orderBy('created_at')
                        ->get();

                } else {
                    $data = Task::WhereHas('user', function ($q) use ($user) {
                        $q->where('name', 'like', '%' . $user . '%');
                    })
                        ->orderBy('created_at')
                        ->get();
                }
            } elseif ($status != '') {
                $data = Task::where('status', '' . $status . '')
                    ->orderBy('created_at')
                    ->get();
            } else {
                $data = Task::orderBy('created_at')
                    ->get();
            }
            $total_row = $data->count();
            if ($total_row > 0) {
                foreach ($data as $task) {
                    $output .= '
        <tr>
                     <td>
                        <a href="' . route('task.show', $task) . '" >' . $task->name . '</a>
                     </td>
                     <td>
                           <a href="' . route('user.show', $task->user) . '" >' . $task->user->name . '</a>
                     </td>
                     <td>' . $task->importance . '</td>
                     <td>' . $task->status . '</td>
                     <td>' . $task->created_at . '</td>
                     <td>
                    <form onsubmit="execut (event,' . $task->id . ')" id="executed_task" action="" method="get" style="display: inline-block">
                        <button  type="submit"  class="btn"><i class="fa fa-check"></i></button>
                    </form>
                     <form onsubmit="if(confirm(\'Delete?\')){return true}else{ return false}"
                           action="' . route('task.destroy', $task) . '" method="post" style="display: inline-block">
                         ' . method_field('DELETE') . '
                         ' . csrf_field() . '

                         <a href="' . route('task.edit', $task) . '" method="post">
                             <i class="fa fa-edit"></i>
                         </a>
                         <button type="submit" class="btn"><i class="fa fa-trash-o"></i></button>
                     </form>
                          
                     </td>
                 </tr>
         ';
                }
            } else {
                $output = '
        <tr>
                     <td colspan="6" class="text-center"><h2>No Task</h2></td>
                 </tr>
        ';
            }
            $data = array(
                'table_data' => $output,
                'total_data' => $total_row
            );

            echo json_encode($data);
        }
    }

}
