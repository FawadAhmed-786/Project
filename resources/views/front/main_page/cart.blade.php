@extends('front.layout.Layout')
@section('title') view cart  @endsection
@section('keyword')   @endsection
@section('description')   @endsection

@section('contant')
<div class="headingmainarea">
	<div class="container">
	    <h2>View Cart</h2>
	</div>
</div>
<div class="contantmenu">
	<div class="container">
		@if(session()->has('error'))
		    <div class="alert alert-danger alert-dismissible" role="alert">
				<span><i class="fa fa-wronge"></i> {{ session('error') }}</span>
		    </div>
		@endif 
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12 col-12 cart">
				   @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <span><i class="fa fa-check"></i> {{ session('success') }}</span>
                    </div>
                @endif 
				 <table id="myTable" class="table " style="width: 100%">
                  <thead>
                    <tr>
                      <th>S.no</th>
                      <th>Title</th>
                      <th>Unit</th>
                      <th>Prices</th>
                      <th>Quantity</th>
                      <th>Sub_Total</th>
                      <th>Clear</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@forelse($data as $index => $datacart)
                  	<tr>
                  		<td>{{$index+1}}</td>
                  		<td>{{$datacart->title}}</td>
                  		<td>{{$datacart->meat_pick_unit}}</td>
                  		<td>{{$datacart->meat_rate}}</td>
                  		<td><div><button class="quantityminus" id="quantityminus" onclick="event.preventDefault();document.getElementById('cartitemminus-{{$datacart->id}}').submit();">-</button><form action="{{url('/cart/food-update-minus', $datacart->id)}}" style="display: none" id="cartitemminus-{{$datacart->id}}" method="POST">@csrf@method('POST')</form><p class="in-num inputfield">{{$datacart->meat_quantity}}</p><button class="quantityplus" id="quantityplus" onclick="event.preventDefault();document.getElementById('cartitemplus-{{$datacart->id}}').submit();">+</button><form action="{{url('/cart/food-update-plus', $datacart->id)}}" style="display: none" id="cartitemplus-{{$datacart->id}}" method="POST">@csrf@method('POST')</form><div class="clearfix"></div></div></td>
                  		<td>{{$datacart->meat_amount}}</td>
                  		<td><a  class="u-link-v5 " data-toggle="modal" data-target="#deletereplyModal-{{$datacart->id}}"><i class="far fa-trash-alt"></i></a><div class="modal fade" id="deletereplyModal-{{$datacart->id}}" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel"
                    data-backdrop="static" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticModalLabel">Delete Item</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h4>Are you sure delete this meat in the cart ?</h4>
                                <p>{{$datacart->title}} {{$datacart->meat_pick_unit}}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" onclick="event.preventDefault();
                                document.getElementById('deletecartitem-{{$datacart->id}}').submit();">Confirm</button>
                                <form action="{{url('/cart/meat-delete', $datacart->id)}}" style="display: none" id="deletecartitem-{{$datacart->id}}" method="POST">
		                            @csrf
		                            @method('DELETE')
		                        </form>
                        
                            </div>
                        </div>
                    </div>
                    </div></td>
                  		
                  	</tr>
                  	@empty
                  	<tr>
                  	    <td colspan="7"><p style="text-align: center;font-size: 16px; color: #ccc; padding: 50px 0px;">Cart Is Empty</p></td>
                  	    </tr>
                  	@endforelse
                  </tbody>
                </table>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-12">
				<div class=" bg-light p-4">
		          <div>Cart Total</div>
		          <hr>
		           <div class="d-flex px-2 justify-content-between">
		            <p>Total Quantity</p>
		            <div class="row">
		              <p id="subTVal">{{$quantity}}</p>
		            </div>
		          </div>
		          <div class="d-flex px-2 justify-content-between">
		            <p>Sub Total</p>
		            <div class="row">
		              <p>Rs.</p>
		              <p id="subTVal">{{$sum}}</p>
		            </div>
		          </div>
		          <div class="d-flex px-2 justify-content-between">
		            <p>Shipping Charges</p>
		            <div class="row">
		              <p>Rs.</p>
		              <p id="shippVal">50</p>
		            </div>
		          </div>
		          <hr>
		          <div class="d-flex px-2 justify-content-between">
		            <p>Grand Total</p>
		            <div class="row">
		              <p>Rs.</p>
		              <p id="totalVal">{{$grandsum}}</p>
		            </div>
		          </div>
		          <hr>
		  
		          <div class="pt-5">
		            <a href="{{ url('/checkout')}}"><button class="btn btn-lg btn-block btn-dark rounded-0">
		              CHECKOUT
		            </button>
		            </a>
		          </div>
		        </div>
			</div>
		</div>
	</div>
</div>
@endsection
