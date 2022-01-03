@extends('back.layout.layout')
@section('title') lists  @endsection
@section('keyword')   @endsection
@section('description')   @endsection
@section('contant')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View Lists</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/admin-area/account')}}">Home</a></li>
              <li class="breadcrumb-item active">Lists</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
   
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Lists</h3>
                <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
              	<div class="btn-group">
                <button class="btn btn-exp btn-sm alldel" ><i class="fa fa-trash-o"></i>Delete Data</button> 
                </div>
                            <span id="form_success"></span>
            <span id="status_message_success"></span>
            <span id="status_message_error"></span>
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <span><i class="fa fa-check"></i> {{ session('success') }}</span>
                </div>
            @endif 
                <table id="myTable" class="table table-bordered" style="width: 100%">
                  <thead>
                    <tr>
                      <th style="width: 10px"> <input type="checkbox" name="title_checkbox" class="checkboxall" ></th>
                      <th>Position</th>
                      <th >Title</th>
                      <th>Image</th>
                      <th>Itemcode</th>
                      <th>Category_Name</th>
                      <th>Price</th>
                      <th>Add_Top_Selling</th>
                      <th>Created_at</th>
                      <th>Updated_at</th>
                      <th style="width: 80px;">Action</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>         
        </div>
      </div>
    </section>
  </div>
   
<script type="text/javascript">
    $(document).ready(function(){

        $('#myTable').DataTable({
           "order": [[ 1, "desc" ]],
                processing: true,
                serverSide: true,
                ajax: {
                   headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/admin-area/lists",
                },
                columns: [
                    {data: 'checkbox',orderable:false,searchable:false},
                    {data: 'position'},
                    {data: 'title',orderable:false},
                    {data: 'image',orderable:false,searchable:false},
                    {data: 'itemcode',orderable:false},
                    {data: 'category_name',orderable:false},
                    {data: 'price',orderable:false,searchable:false},
                    {data: 'add_top_selling',orderable:false,searchable:false},
                    {data: 'created_at',orderable:false,searchable:false},
                    {data: 'updated_at',orderable:false,searchable:false},
                    {data: 'action',orderable:false,searchable:false}
                ]
        });
        
    });

    $(document).on('click', '.alldel', function(){

            var categoryid = [];
            if(confirm("Are you sure you want to Delete this data?"))
            {
                $('.checkboxsingle:checked').each(function(){
                    categoryid.push($(this).val());
                });
                if(categoryid.length > 0)
                {
                    $.ajax({
                        url:"/admin-area/list-all-delete/"+categoryid,
                        method:"get",
                         dataType:"json",
                        data:{id:categoryid},
                        success:function(data)
                        {
                             if(data.success){
                            var successmsg = '';
                            successmsg = '<div class="alert alert-success">' + data.success + '</div>';
                            window.setTimeout(function() {
                                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                                $(this).remove(); 
                                });
                            }, 3000);
                             setTimeout(function(){
                                 
                                    $('#myTable').DataTable().ajax.reload();
                                }, 1000);
                            $('#status_message_success').html(successmsg);   
                            }
                        }
                           
                           
                        
                    });
                }
                else
                {
                    alert("Please select atleast one checkbox");
                }
            }
    });

    $(document).on('change', '.top_status',function(){
           
            var top_id = $(this).attr('rel');
            if($(this).prop("checked")==true){
                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'post',    
                    url :"/admin-area/update-top-list",
                    dataType:"json",
                    data:{special:'1', id:top_id},
                    success:function(data)
                    { 
                        if(data.success){
                        var successmsg = '';
                        successmsg = '<div class="alert alert-success">' + data.success + '</div>';
                        window.setTimeout(function() {
                            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                            $(this).remove(); 
                            });
                        }, 2000);
                        $('#myTable').DataTable().ajax.reload();
                        $('#status_message_success').html(successmsg);   
                        }
                    },
                    error:function(){
                        alert("Error");
                    }
                });
            }else{
                    $.ajax({
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type:"post",   
                        url :"/admin-area/update-top-list",
                        dataType:"json",
                        data:{special:'0',id:top_id},
                        success:function()
                        {
                            var errormsg = '';
                        errormsg = '<div class="alert alert-danger">Top List Successfully Update Disabled</div>';
                       window.setTimeout(function() {
                            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                            $(this).remove(); 
                            });
                        }, 2000);
                       $('#myTable').DataTable().ajax.reload();
                    
                        $('#status_message_error').html(errormsg);   
                            
                        },error:function(){
                            alert("Error");
                        }
                    });
            }
    });  
</script>        
@endsection
