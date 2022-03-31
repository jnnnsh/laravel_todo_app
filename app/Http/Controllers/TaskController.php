<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $tasks = Task::latest()->paginate(10);

        //return view(compact(create()));
        return view('tasks.index',compact('tasks'))->with('i',(request()->input('page',1)-1)*10);


        // $tasks = Task::all();
        // return view('tasks.index',compact('tasks'));
    
        //FOR API
        //return Task::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        //
        //return view('tasks.create');
        

        //FOR API
        $tasks = new Task();

        $tasks->taskName = $request->input('taskName');
        $tasks->save();
        return response()->json($tasks);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        // $request->validate(['taskName' => 'required',]);
        // Task::create($request->all());
        // return redirect()->route('tasks.index')->with('success','Task added successfully.');

        //FOR API
        // return Task::create($request->all());
        $res = DB::insert('insert into todolists (taskName) values (?)', [$request->taskName]);
        if($res == 1){
            return "saved";
        }
        else{
            return "error";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //

        return view('tasks.show',compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //

        return view('tasks.edit',compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //

        $request->validate([

        ]);

        $task->update($request->all());
        return redirect()->route('tasks.index')->with('success','Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //


        //FOR API
        $res = Task::destroy($id);
        
        if($res == 1){
            return "deleted";
        }
        else{
            return "error";
        }
        //return Task::destroy($id);
        //return redirect()->route('tasks.index')->with('success','Task deleted successfully.');
    }
}
