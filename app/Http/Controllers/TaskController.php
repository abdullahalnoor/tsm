<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Repositories\Task\TaskInterface;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use DataTables;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $task;

    public function __construct(TaskInterface $task)
    {
        $this->task = $task;
        $this->middleware('auth_check');
    }

    public function index(Request $request)
    {
        if($request->ajax()){

           $tasks = $this->task->fetch()->where('user_id',user()->id)->latest();

                return Datatables::of($tasks)
                    ->addIndexColumn()    

                    ->addColumn('due_date', function($row){
                        $due_date = date("d F Y", strtotime($row->due_date));  
                        return $due_date;                         
                    }) 

                    ->addColumn('status', function($row){
                        $color = $row->status == 'Pending' ? 'danger' : ($row->status == 'In Progress' ? 'primary' : 'success');
                        $status = "<span class='badge badge-".$color." p-2'>{$row->status}</span>";
                        return $status;                        
                    })                             

                    ->addColumn('action', function($row){
                                                    
                        $btn = "";
                        $btn .= '&nbsp;';
                        $btn .= ' <a href="'.route('tasks.show',$row->id).'" class="btn btn-primary btn-sm action-button edit-task" data-id="'.$row->id.'"><i class="fa fa-edit"></i></a>';

                        $btn .= '&nbsp;';


                        $btn .= ' <a href="#" class="btn btn-danger btn-sm delete-task action-button" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>'; 
    
                      
    
                        return $btn;

                    })->filter(function ($instance) use ($request) {

                        if ($request->get('search') != "") {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                $w->orWhere('tasks.title', 'LIKE', "%$search%");
                            });
                        }

                        if ($request->get('due_date') != "") {
                             $instance->where(function($w) use($request){
                                $due_date = $request->get('due_date');
                                $w->orWhere('tasks.due_date', '<=', $due_date);
                            });
                        }

                        if ($request->get('status') != "") {
                             $instance->where(function($w) use($request){
                                $status = $request->get('status');
                                $w->orWhere('tasks.status', $status);
                            });
                        }

                            
                    })
                    ->rawColumns(['action','due_date','status'])
                    ->make(true);
        }
        return view('tasks.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        $store = $this->task->store($request);
         
        $notification=array(
                     'messege'=>$store['message'],
                     'alert-type'=>$store['alert_type'],
                    );

        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.edit', compact('task'));
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $update = $this->task->update($request,$task);
         
        $notification=array(
                     'messege'=>$update['message'],
                     'alert-type'=>$update['alert_type'],
                    );

        return redirect('/tasks')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $delete = $this->task->delete($task);
        return $delete;
    }
}
