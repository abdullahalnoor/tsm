@extends('admin_master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Task</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{URL::to('/tasks')}}">All Task
                                </a></li>
                        <li class="breadcrumb-item active">Add Task</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Add Task</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{route('tasks.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="title">Title <span class="required">*</span></label>
                                <input type="text" name="title" class="form-control" id="title"
                                    placeholder="Title" required="" value="{{old('title')}}">
                                @error('title')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> 

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="due_date">Due Date <span class="required">*</span></label>
                                <input type="date" name="due_date" class="form-control" id="due_date"
                                    placeholder="Category Name" required="" value="{{old('due_date')}}">
                                @error('due_date')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status">Select Status <span class="required">*</span></label>
                                <select class="form-control select2bs4" name="status" id="status" required="">
                                    <option value="" selected="" disabled="">Select Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Completed">Completed</option>
                                </select>
                                @error('status')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                           <div class="form-group">
                           	  <label for="description">Description</label>
                           	  <textarea name="description" id="description">{!!old('description')!!}</textarea>
                           	  @error('div')
                                <span class="alert alert-danger">{{ $message }}</span>
                              @enderror
                           </div>
                        </div>

                        
                        <div class="form-group w-100 px-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </form>
        </div>
    </section>
</div>
@endsection