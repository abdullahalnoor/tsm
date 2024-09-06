<?php
 namespace App\Repositories\Task;
 use App\Models\Task;

 class TaskRepository implements TaskInterface
 {
 	public function fetch()
 	{
 		try
 		{
 			$tasks = Task::select('*');
 			return $tasks;
 		}catch(Exception $e){
            $code = $e->getCode();            
            return response()->json(['message'=>"Something went wrong", 'execption_code'=>$code]);
        }
 	}

 	public function store($request)
 	{
 		try
 		{
 			$task = Task::create([
 				'user_id' => user()->id,
 				'title' => $request->title,
 				'due_date' => $request->due_date,
 				'description' => $request->description,
 				'status' => $request->status,
 			]);

 			return array('success'=>true, 'task_id'=>intval($task->id), 'alert_type'=>'success', 'message'=>'Successfully a task has been added');

 		}catch(Exception $e){
            $code = $e->getCode();            
            return response()->json(['message'=>"Something went wrong", 'execption_code'=>$code]);
        }
 	}

 	public function update($request,$task)
 	{
 		try
 		{
 			$task->title = $request->title;
            $task->due_date = $request->due_date;
            $task->description = $request->description;
            $task->status = $request->status;
            $task->update();
 			return array('success'=>true, 'task_id'=>intval($task->id), 'alert_type'=>'success', 'message'=>'Successfully the task has been updated');

 		}catch(Exception $e){
            $code = $e->getCode();            
            return response()->json(['message'=>"Something went wrong", 'execption_code'=>$code]);
        }
 	}

 	public function delete($task)
 	{
 		try
 		{
 			$task->delete();
 			return array('success'=>true, 'message'=>'Successfully the task has been deleted');
 			
 		}catch(Exception $e){
            $code = $e->getCode();            
            return response()->json(['message'=>"Something went wrong", 'execption_code'=>$code]);
        }
 	}
 }