<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    protected $tasks;
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');
        $this->tasks = $tasks;
    }

    public function index(Request $request)
    {
        return view('tasks.index',[
            'tasks'=>$this->tasks->forUser($request->user())
        ]);
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>"required|max:191",
        ]);
        $request->user()->tasks()->create([
            'name'=>$request->name
        ]);
        return redirect('tasks');
    }
    public function edit($id)
    {
        
        $task = Task::whereId($id)->first();
        return view('tasks.edit')->with('task',$task);
    }
    public function update(Request $request, $id)
    {
        
        $task=Task::find($id)->update($request->all());
        return redirect('tasks')->with('success','update oke :D');
    }
    public function destroy($id)
    {
        $task = Task::destroy($id);
        return redirect('tasks')->with('success','delete oke :D');
    }
    public function search(Request $request)
    {
        $dataSearch = $request->all();
        $task = Task::where('name','LIKE','%'.$dataSearch['search'].'%')
        ->get();
        return view('tasks.index')->with('tasks',$task);
    }
}
