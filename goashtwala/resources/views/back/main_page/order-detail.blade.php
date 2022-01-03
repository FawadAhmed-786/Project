@extends('back.layout.layout')
@section('title') orders detail @endsection
@section('keyword')   @endsection
@section('description')   @endsection
@section('contant')
<div id="overlay-cart" class="overlay-cart">
    <div class="cv-spinne-cart">
      <span class="spinne-cart"></span>
    </div>
  </div>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View Order Detail</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/admin-area/account')}}">Home</a></li>
              <li class="breadcrumb-item active">Order Detail</li>
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
                <h3 class="card-title">Order Detail</h3>
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
              <div class="card-body">
              	        <span id="form_success"></span>
          <span id="form_error"></span>
             <span id="form_errors"></span>
              	<div class="row">
              		<div class="col-lg-6 col-md-6 col-sm-12 col-12">
              			<h6><strong>Order Number </strong> : {{$order->order_number}}</h6>
              			<h6><strong>Name :</strong> {{$order->name}}</h6>
              			<h6><strong>Email : </strong>{{$order->email}}</h6>
              			<h6><strong>Phone :</strong> {{$order->phone}}</h6>
              			<h6><strong>Country :</strong> {{$order->country}}</h6>
              			<h6><strong>City :</strong> {{$order->city}}</h6>
              			<h6><strong>Address : </strong>{{$order->address}}</h6>
              		</div>
              		<div class="col-lg-6 col-md-6 col-sm-12 col-12"> 
              		    
              			<h6><strong>order_status :</strong>
              				<input type="hidden" id="getid" value="{{$order->id}}">
              				<br>
              				<br>
              				<form class="form_send" method="post">
              					<select name="orderstatus" class="form-control" id="orderstatus" > @if(empty($order->order_status))
	                                <option selected disabled>Select Order Status</option>
	                                                     
	                                @elseif($order->order_status=="Pending")
	                                <option value="{{$order->order_status}}" @if(!empty($order->order_status) && $order->order_status=="Pending") selected @endif>Pending</option>
	                                <option value="OnTheWay">On The Way</option> 
	                                <option value="Paid">Paid</option> 
	                                <option value="OrderCancel">Order Cancel</option> 

	                                @elseif($order->order_status=="OnTheWay")
	                                <option value="Pending">Pending</option>
	                                <option value="{{$order->order_status}}" @if(!empty($order->order_status) && $order->order_status=="OnTheWay") selected @endif>On The Way</option>
	                                <option value="Paid">Paid</option> 
	                                <option value="OrderCancel">Order Cancel</option>  
	                                @elseif($order->order_status=="Paid")
	                                <option value="Pending">Pending</option>
	                                <option value="OnTheWay">On The Way</option>
	                                <option value="{{$order->order_status}}" @if(!empty($order->order_status) && $order->order_status=="Paid") selected @endif>Paid</option>
	                                <option value="OrderCancel">Order Cancel</option>   
	                                @elseif($order->order_status=="OrderCancel")
	                                <option value="Pending">Pending</option>
	                                <option value="OnTheWay">On The Way</option>
	                                <option value="Paid">Paid</option> 
	                                <option value="{{$order->order_status}}" @if(!empty($order->order_status) && $order->order_status=="OrderCancel") selected @endif>Order Cancel</option>
	                                @endif
	                            </select>
              				</form>
              				<br>
              				
                        </h6>
              			<h6><strong>delivery_charges :</strong> {{$order->delivery_charges}}</h6>
              			<h6><strong>payment_method :</strong> {{$order->payment_method}}</h6>
              			<h6><strong>order_requirement :</strong> {{$order->order_requirement}}</h6>
              		</div>
              	</div>
              	<div style="overflow-x:auto;"> <!--Table-->
                    <table class="table table-hover table-fixed">
                        <thead>
                            <tr>
                                <th>S.#</th>
                                <th>Title</th>
                                <th class="thnew">Qty</th>
                                <th class="thnew">Rate</th>
                                <th class="thnew">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach ($ordersdetail as $key => $cart)
		                        @foreach($cart->order_meats as $index => $order_meat)
		                        <tr>
		                            <td>{{$index+1}}</td>
		                            <td>{{$order_meat->meat_title}}</td>
		                            <td class="thnew">{{$order_meat->meat_qty}}</td>
		                            <td class="thnew">{{$order_meat->meat_rate}}</td>
		                            <td class="thnew">{{$order_meat->meat_amount}}</td>
		                        </tr>
		                        @endforeach
	                        @endforeach
	                        <tr>
	                            <td><h6><strong>Items : </strong>{{$order->order_food_items}}</h6></td>
	                            <th></th>
	                            <td  class="thnew"><h6>{{$order->order_meat_total_qty}}</h6></td>
	                            <th></th>
	                            <th></th>
	                        </tr>
                        </tbody>                           
                    </table>
                </div>
                <h5 class="billtitle"><strong class="bill">Sub Amount : </strong><p class="thnew">Rs.{{$order->sub_amount}}</p></h5>
                <div class="clearfix"></div>
                <h5 class="billtitle"><strong class="bill">Delivery Charges : </strong><p class="thnew">Rs.{{$order->delivery_charges}}</p></h5>
                <div class="clearfix"></div>
                <h5 class="billtitle"><strong class="bill">Payable Amount : </strong><p class="thnew">Rs.{{$order->payable_amount}}</p></h5>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>         
        </div>
      </div>
    </section>
  </div>
<script type="text/javascript">
	   $("#orderstatus").change(function(e){
            e.preventDefault();        
            var info = $("#orderstatus").val();
            var id = $("#getid").val();
             $('#form_error').html('');$('#form_errors').html('');$('#form_success').html('');
            var url = "/admin-area/order-status";
            $.ajax({
                url:url,
                method:"POST",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {info:info, id:id},
                dataType:"json",
                beforeSend: function(){
                // Show image container
                $("#overlay-cart").show();
               },
                success:function(data)
                {
                    var errormsg = '', errorcount = '', successmsg = '';                  
                    if(data.errors)
                    {
                   
                        errormsg = '<div class="alert alert-danger">';
                        for(var count = 0; count < data.errors.length; count++)
                        {
                            errormsg += '<p>' + data.errors[count] + '</p>';
                            window.setTimeout(function() {
                                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                                $(this).remove(); 
                                });
                            }, 10000);
                        }
                        errormsg += '</div>';

                    }
                    if(data.errorcount)
                    {
                        errorcount = '<div class="alert alert-danger">'+ data.errorcount +  '</div>';
                           window.setTimeout(function() {
                                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                                $(this).remove(); 
                                });
                            }, 10000);

                    }
                    $('#form_errors').html(errorcount);
                    $('#form_error').html(errormsg);
                    if(data.success)
                    {
                        successmsg = '<div class="alert alert-success">' + data.success + '</div>';
                        window.setTimeout(function() {
                            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                            $(this).remove(); 
                            });
                        }, 10000);
                    }
                    $('#form_success').html(successmsg);
                },complete:function(data){
              // Hide image container
              $("#overlay-cart").hide();
             }
            });
      });
</script>     
@endsection
