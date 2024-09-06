<?php
 namespace App\Repositories\Task;

 interface TaskInterface
 {
 	public function fetch();
 	public function store($request);
 	public function update($request,$task);
 	public function delete($task);
 }