@extends('back.layout.layout')
@section('title') customer  @endsection
@section('keyword')   @endsection
@section('description')   @endsection
@section('contant')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View Customers</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/admin-area/account')}}">Home</a></li>
              <li class="breadcrumb-item active">Customers</li>
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
          	<span id="form_success"></span>
            <span id="status_message_success"></span>
             @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <span><i class="fa fa-wronge"></i>{{ session('error') }}</span>
                </div>
                @endif 
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Customers</h3>
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
                <table id="myTable" class="table table-bordered" style="width: 100%">
                  <thead>
                    <tr>
                      <th style="width: 10px"> <input type="checkbox" name="tag_checkbox" class="checkboxall" ></th>
                      <th>Position</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Phone</th>
                      <th>Country</th>
                      <th>City</th>
                      <th>Address</th>
                      <th>Created_at</th>
                      <th>Updated_at</th>
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
                    url: "/admin-area/customers",
                },
                columns: [
                    {data: 'checkbox',orderable: false,searchable: false},
                    {data: 'position'},
                    {data: 'name',orderable: false}, 
                    {data: 'email',orderable: false}, 
                    {data: 'role',orderable: false},
                    {data: 'phone',orderable: false}, 
                    {data: 'country',orderable: false}, 
                    {data: 'city',orderable: false}, 
                    {data: 'address',orderable: false},  
                    {data: 'created_at',orderable: false,searchable: false},
                    {data: 'updated_at',orderable: false,searchable: false},
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
                        url:"/admin-area/customer-all-delete/"+categoryid,
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
</script>        
@endsection
