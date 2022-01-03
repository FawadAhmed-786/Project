@extends('back.layout.layout')
@section('title') orders  @endsection
@section('keyword')   @endsection
@section('description')   @endsection
@section('contant')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View Orders</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/admin-area/account')}}">Home</a></li>
              <li class="breadcrumb-item active">Orders</li>
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
                <h3 class="card-title">Orders</h3>
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
           
           
                <table id="myTable" class="table table-bordered" style="width: 100%">
                  <thead>
                    <tr>
                      <th style="width: 10px"> <input type="checkbox" name="title_checkbox" class="checkboxall" ></th>
                      <th>Order#</th>
                      <th>Customer_Name</th>
                      <th>Phone</th>
                      <th>Order_status</th>
                      <th>Items</th>
                      <th>Qty</th>
                      <th>Sub_amount</th>
                      <th>Delivery_charges</th>
                      <th>Payable_amount</th>                     
                      <th>Order_Date</th>
                      <th>Order_Time</th>
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
                    url: "/admin-area/orders",
                },
                columns: [
                    {data: 'checkbox',orderable:false,searchable:false},
                    {data: 'oorder_number'},
                    {data: 'oname',orderable:false},
                    {data: 'ophone',orderable:false,},
                    {data: 'oorder_status',orderable:false,searchable:false},
                    {data: 'oorder_meat_items',orderable:false,searchable:false},
                    {data: 'oorder_meat_total_qty',orderable:false,searchable:false},
                    {data: 'osub_amount',orderable:false,searchable:false},
                    {data: 'odelivery_charges',orderable:false,searchable:false},
                    {data: 'opayable_amount',orderable:false,searchable:false},
                    {data: 'odate',orderable:false},
                    {data: 'otime',orderable:false},
                    {data: 'action',orderable:false,searchable:false}
                ]
        });
        
    });
    

    $(document).on('click', '.alldel', function(){

            var orderid = [];
            if(confirm("Are you sure you want to Delete this data?"))
            {
                $('.checkboxsingle:checked').each(function(){
                    orderid.push($(this).val());
                });
                if(categoryid.length > 0)
                {
                    $.ajax({
                        url:"/admin-area/order-all-delete/"+orderid,
                        method:"get",
                         dataType:"json",
                        data:{id:orderid},
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
