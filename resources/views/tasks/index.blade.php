@extends('admin_master')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">All Task</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Task</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Task</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{route('tasks.create')}}" class="btn btn-primary add-new mb-2">Add New Task</a><br><br>
                <div class="card w-100">
                  <div class="card-header">
                    <h5>Filter Task</h5>
                  </div>

                  <div class="card-body">
				    <div class="row">				    	
				        
				        <div class="col-md-6">
				            <div class="form-group">
				            	<label for="selected_status">Select Status</label>
				                <select class="form-control select2bs4" id="selected_status">
				                    <option value="" selected disabled>Select Status</option>
				                    <option value="Pending">Pending</option>
				                    <option value="In Progress">In Progress</option>
				                    <option value="Completed">Completed</option>
				                </select>
				            </div>
				        </div>

				        <div class="col-md-6">
				            <div class="form-group">
				               <label for="selected_due_date">Sort By Due Date</label>
				               <input type="date" class="form-control" name="selected_due_date" id="selected_due_date">
				            </div>
				        </div>

				        <div class="col-md-12 d-flex justify-content-center button-product-filters">
				            <button type="button" class="btn btn-primary filter-task">
				                <i class="fa fa-search"></i> SEARCH
				            </button>
				            <button type="button" class="btn btn-danger reset-filter">
				                RESET
				            </button>
				        </div>
				    </div>
				</div>

                <div class="fetch-data table-responsive">
                    <table id="task-table" class="table table-bordered table-striped data-table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="conts"> 
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
  
  <script>
  	$(document).ready(function(){
  		let task_id='';
  		let taskTable = $('#task-table').DataTable({
		        searching: true,
		        processing: true,
		        serverSide: true,
		        ordering: false,
		        responsive: true,
		        stateSave: true,
		        ajax: {
		          url: "{{url('/tasks')}}",
		          data: function (d) {

		                d.status = $('#selected_status').val(),
		                d.due_date = $('#selected_due_date').val(),
		                d.search = $('.dataTables_filter input').val()
	              }
		        },

		        columns: [
		            {data: 'title', name: 'title'},
		            {data: 'due_date', name: 'due_date'},
		            {data: 'status', name: 'status'},
		            {data: 'action', name: 'action', orderable: false, searchable: false},
		        ]
        });

  		$('.filter-task').click(function(e){
	        e.preventDefault();
	        taskTable.draw(); 
	    });


       $(document).on('click', '.delete-task', function(e){

           e.preventDefault();

           task_id = $(this).data('id');
           
           if(confirm('Do you want to delete this?'))
           {
               $.ajax({

                    url: "{{url('/tasks')}}/"+task_id,

                         type:"DELETE",
                         dataType:"json",
                         success:function(data) {

                            toastr.success(data.message);

                            $('.data-table').DataTable().ajax.reload(null, false);

                    },
                                
               });
           }

       });

  	});
  </script>

@endpush