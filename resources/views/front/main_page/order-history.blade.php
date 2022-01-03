@extends('front.layout.Layout')
@section('title') order history  @endsection
@section('keyword')   @endsection
@section('description')   @endsection

@section('contant')
    @if(session()->has('success'))
    <div class="alert alert-success new1" role="alert">
        <h4 class="alert-heading" style="float: left;">Thank You Buy Food!</h4>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" style="color: #fff;position: absolute;top: 5px;right: 10px;font-size: 20px;">&times;</span>
        </button>
        <div class="clearfix"></div>
        <p>{{ session('success') }}</p>
        <p>Please Wait Delivery Time 45 min</p>
        <hr>
        <p class="mb-0">Your Order Number is {{Session::get('order_number')}}. Total Payable Amount is Rs.{{ Session::get('payable_amount')}}</p>
    </div>    
    @endif
<div class="headingmainarea">
	<div class="container">
	    <h2>Order History </h2>
	</div>
</div>
<div class="container">

	 <div class="row justify-content-center" style="margin: 50px 0px;">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-header"><p></p>
                {{ __('Order History') }}                 
              </div>
              
                <div class="card-body card-body-order">
                    <h3>Your Order List</h3>
                    <div class="table-responsive text-nowrap emptyordertable">
                        @if(count($order) > 0)
                        <table class="table table-striped">

                          <!--Table head-->
                          <thead>
                            <tr>
                              <th>S.#</th>
                              <th>Order #</th>
                              <th>Name</th>
                              <th>Payable Amount</th>
                              <th>Order Status</th>
                              <th>Date</th>
                              <th>Time</th>
                               <th>Action</th>
                            </tr>
                          </thead>
                          <!--Table head-->

                          <!--Table body-->
                          <tbody>
                            @foreach ($order as $index => $orders)
                              <tr>
                                <td >{{$index+1}}</td>
                                <th scope="row">{{$orders->order_number}}</th>
                                <td>{{$orders->name}}</td>
                                <td>{{$orders->payable_amount}}</td>
                                @if($orders->order_status == "Pending")
                                  <td style="color: red;     font-weight: 600;">{{$orders->order_status}}</td>
                                @elseif($orders->order_status == "OnTheWay")
                                  <td style="color: #0089ff;     font-weight: 600;">On The Way</td>
                                @elseif($orders->order_status == "Paid")
                                  <td style="color: #00ff2b;     font-weight: 600;">{{$orders->order_status}}</td> 
                                @elseif($orders->order_status == "OrderCancel")
                                  <td style="color: red;     font-weight: 600;">OrderCancel</td>   
                                @endif  
                                 <td>{{ Carbon\Carbon::parse($orders->created_at)->isoFormat('ddd DD-M-Y') }}</td> 
                                 <td>{{ Carbon\Carbon::parse($orders->created_at)->isoFormat('H:mm:ss') }}</td> 
                                <td> <a class="action" data-toggle="modal" data-target="#{{ $orders->id }}">Detail</a>
                                    <!-- Modal -->
                                    
                                    <div class="modal fade addcartmodal" id="{{ $orders->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Order # : {{$orders->order_number}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                           
                                          <div class="modal-body"> 
                                            <div class="modalhelp-content">
                                              <div class="paddingtopmodalcontant">   
                                              <h6><strong>Email : </strong>{{$orders->email}}</h6>
                                              <h6><strong>Country : </strong>{{$orders->country}}</h6>
                                              <h6><strong>City : </strong>{{$orders->city}}</h6>
                                              <h6><strong>Address : </strong>{{$orders->address}}</h6>
                                              <h6><strong>Payment Method : </strong>{{$orders->payment_method}}</h6>
                                              <h6><strong>Order Requirement : </strong>{{$orders->order_requirement}}</h6>
                                             
                                        <div style="overflow-x:auto;"> <!--Table-->
                                                <table class="table table-hover table-fixed">

                                                  <!--Table head-->
                                                  <thead>
                                                    <tr>
                                                      <th>S.#</th>
                                                      <th>Title</th>
                                                      <th class="thnew">Qty</th>
                                                      <th class="thnew">Rate</th>
                                                      <th class="thnew">Amount</th>
                                                    </tr>
                                                  </thead>
                                                  <!--Table head-->

                                                  <!--Table body-->

                                                  <tbody>
                                                   
                                                    @foreach($orders->order_meats as $index => $order_meat)
                                                     
                                                     
                                                    <tr>
                                                      <td>{{$index+1}}</td>
                                                      <td>{{$order_meat->meat_title}}</td>
                                                      <td class="thnew">{{$order_meat->meat_qty}}</td>
                                                      <td class="thnew">{{$order_meat->meat_rate}}</td>
                                                      <td class="thnew">{{$order_meat->meat_amount}}</td>
                                                    </tr>
                                                   
                                                   @endforeach
                                                    <tr>
                                                      <td><h6><strong>Items : </strong>{{$orders->order_food_items}}</h6></td>
                                                      <th></th>
                                                      <td  class="thnew"><h6>{{$orders->order_meat_total_qty}}</h6></td>
                                                        <th></th>
                                                          <th></th>
                                                    </tr>
                                                  </tbody>
                                                  
                                                </table></div>
                                             

                                                <h5 class="billtitle"><strong class="bill">Sub Amount : </strong><p class="thnew">Rs.{{$orders->sub_amount}}</p></h5>
                                                <div class="clearfix"></div>
                                                <h5 class="billtitle"><strong class="bill">Delivery Charges : </strong><p class="thnew">Rs.{{$orders->delivery_charges}}</p></h5>
                                                <div class="clearfix"></div>
                                                 <h5 class="billtitle"><strong class="bill">Payable Amount : </strong><p class="thnew">Rs.{{$orders->payable_amount}}</p></h5>
                                                 <div class="clearfix"></div>
                                            </div>
                                          </div> 
                                        </div>
                                      </div>
                                    </div></td>
                                </tr>
                            @endforeach
                            
                          </tbody>
                          <!--Table body-->
                        </table>
                        <div class="paginate">
                            {{$order->links()}}
                        </div>
                        
                        @else
                        <div class="emptyorder">
                          <div style="text-align: center;padding-top: 20px;">
                                        
                               <p style="padding-top: 20px;font-size: 20px;}"> {{ __('Your Order Table Empty!') }}</p>

                                      </div>
                           
                        </div>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

