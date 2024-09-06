<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\Task\TaskInterface;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Validator;

class ApiController extends Controller
{
    protected $task;

    public function __construct(TaskInterface $task)
    {
        $this->task = $task;
    }

    public function storeTask(Request $request)
    {
    	try
    	{   
    	    $validator = Validator::make($request->all(), [
	            'title' => 'required|string|max:50|unique:tasks',
	            'due_date' => 'required|date',
	            'description' => 'nullable',
	            'status' => 'required|in:Pending,In Progress,Completed',
	        ]);

	        if ($validator->fails()) {
	            return response()->json([
	                'status' => false,
	                'message' => 'The given data was invalid',
	                'data' => $validator->errors()
	            ], 422);
	        }

    		$storeTask = $this->task->store($request);
    		return $storeTask;
    	}catch(Exception $e){
            $code = $e->getCode();            
            return response()->json(['message'=>"Something went wrong", 'execption_code'=>$code]);
        }
    }

    public function tasks(Request $request)
    {
    	try
    	{    

    		$query = Task::query();
    		if($request->has('search'))
    		{
    			$search = $request->search;
    			$query->where('tasks.title', 'LIKE', "%$search%");
    		}

    		if($request->has('due_date'))
    		{
    			$query->where('tasks.due_date', '<=', $due_date);
    		}

    		if($request->has('status'))
    		{
    			$query->where('tasks.status', $status);
    		}

    		$tasks = $query->where('user_id',user()->id)->latest()->get();

    		return response()->json(['success'=>count($tasks)>0, 'data'=>$tasks]);

    	}catch(Exception $e){
            $code = $e->getCode();            
            return response()->json(['message'=>"Something went wrong", 'execption_code'=>$code]);
        }
    }

    public function task($id)
    {
    	try
    	{
    		$task = $this->task->fetch()->findorfail($id);
    		return response()->json(['success'=>true, 'task'=>$task]);
    	}catch(Exception $e){
            $code = $e->getCode();            
            return response()->json(['message'=>"Something went wrong", 'execption_code'=>$code]);
        }
    }

    public function taskUpdate(Request $request,$id)
    {
    	try
    	{
    		$validator = Validator::make($request->all(), [
	            'title' => 'required|string|max:50|unique:tasks,title,' . $id,
	            'due_date' => 'required|date',
	            'description' => 'nullable',
	            'status' => 'required|in:Pending,In Progress,Completed',
	         ]);

	        if ($validator->fails()) {
	            return response()->json([
	                'status' => false,
	                'message' => 'The given data was invalid',
	                'data' => $validator->errors()
	            ], 422);
	        }

	        $task = $this->task->fetch()->findorfail($id);

	        $updateTask = $this->task->update($request,$task);
    		return $updateTask;

    	}catch(Exception $e){
            $code = $e->getCode();            
            return response()->json(['message'=>"Something went wrong", 'execption_code'=>$code]);
        }
    }

    public function taskDelete($id)
    {
    	try
    	{
    		$task = $this->task->fetch()->findorfail($id);
    		$deleteTask = $this->task->delete($task);
    		return $deleteTask;
    	}catch(Exception $e){
            $code = $e->getCode();            
            return response()->json(['message'=>"Something went wrong", 'execption_code'=>$code]);
        }
    }
}
