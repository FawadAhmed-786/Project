@extends('front.layout.Layout')
@section('title') checkout  @endsection
@section('keyword')   @endsection
@section('description')   @endsection

@section('contant')
<div class="headingmainarea">
	<div class="container">
	    <h2>Order Now</h2>
	</div>
</div>
<div class="contantmenu">
	<div class="container">
	   <form method="post" action="{{ url('/checkout') }}" id="checkout_form">
		@csrf		
      
	       <div class="col-lg-7 col-md-7 col-sm-12 col-12">
		      	@if ($errors->any())
			        <div class="alert alert-danger alert-dismissible" role="alert">
						<ul>
						    @foreach ($errors->all() as $error)
						        <li>{{ $error }}</li>
						    @endforeach
						</ul>
					</div>   
				@endif
		        @if(session()->has('error'))
			        <div class="alert alert-danger alert-dismissible" role="alert">
				        <span><i class="fa fa-wronge"></i>{{ session('error') }}</span>
					</div>
			    @endif

		        <div>
		          <h4 style="margin-top: 5px;">BILLING & SHIPPING</h4>
		        </div>
		        <hr class="mb-3" />
		        <label class="form-label" for="name">Name:</label>
			    <input id="name" type="text" class="form-input @error('name') is-invalid @enderror" name="name" @if(Auth::user()) value="{{Auth::user()->name}}" @else value="{{old('name')}}" @endif  autocomplete="name" placeholder="Enter the Name"  autofocus>

		        @error('name')
		            <span class="invalid-feedback" role="alert">
		                <strong>{{ $message }}</strong>
		            </span>
		        @enderror

				<label class="form-label" for="mail">Email:</label>
					     
				<input id="email" type="email" class="form-input @error('email') is-invalid @enderror" name="email" @if(Auth::user()) value="{{Auth::user()->email}}" @else value="{{old('email')}}" @endif   autocomplete="email">

		       @error('email')
		            <span class="invalid-feedback" role="alert">
		                <strong>{{ $message }}</strong>
		            </span>
		        @enderror

		        <label class="form-label" for="phone">Phone:</label>
					     
				<input id="phone" type="text" class="form-input @error('phone') is-invalid @enderror" name="phone"  @if(!empty($user['phone'])) value="{{Auth::user()->phone}}" @else value="{{old('phone')}}" @endif  autocomplete="phone">

		       @error('phone')
		            <span class="invalid-feedback" role="alert">
		                <strong>{{ $message }}</strong>
		            </span>
		        @enderror

		        <label class="form-label" for="city">City:</label>
					     
				<input id="city" type="text" class="form-input @error('city') is-invalid @enderror" name="city" @if(!empty($user['city'])) value="{{Auth::user()->city}}" @else value="{{old('city')}}" @endif autocomplete="city">

		       @error('city')
		            <span class="invalid-feedback" role="alert">
		                <strong>{{ $message }}</strong>
		            </span>
		        @enderror

		        <label class="form-label" for="address">Address:</label>
					     
				<input id="address" type="text" class="form-input @error('address') is-invalid @enderror" name="address"@if(!empty($user['address'])) value="{{Auth::user()->address}}" @else value="{{old('address')}}" @endif   autocomplete="address">

		       @error('address')
		            <span class="invalid-feedback" role="alert">
		                <strong>{{ $message }}</strong>
		            </span>
		        @enderror

		        <label class="form-label" for="address">Order User Requirement :</label>
					     
				<textarea class="form-input @error('requirement') is-invalid @enderror" name="requirement" autocomplete="">{{Request::old('requirement')}}</textarea>

		       @error('requirement')
		            <span class="invalid-feedback" role="alert">
		                <strong>{{ $message }}</strong>
		            </span>
		        @enderror


	      
	      </div>

	      <!-- ORDER SIDE -->
	      <div class="col-lg-5 col-md-5 col-sm-12 col-12 border-left">
	        <div>
	          <p class="text-center">YOUR ORDER ({{$count}})</p>
	        </div>
	        <hr />
	        <div class="cont">
	          <!-- HEADING ITEM -->
	          <div class="row m-0">
	            <div class="col-9">
	              <p class="m-0 font-weight-bold">PRODUCT</p>
	            </div>
	            <div class="col-1">
	              <p class="m-0 font-weight-bold">SUBTOTAL</p>
	            </div>
	          </div>
	          <hr class="py-0" />
	          <!-- ITEM -->
	          @forelse($data as $cart)
	            <div class="row m-0">
	            <div class="col-9">
	              <p class="m-0 text-black-50">{{$cart->title}} × {{$cart->meat_pick_unit}} ({{$cart->meat_quantity}})</p>
	            </div>

	            <div class="col-1 text-black-50">
	              <div class="d-flex">
	                <p>Rs.</p>
	                <p id="subTVal">{{$cart->meat_amount}}</p>
	              </div>
	            </div>
	          </div>

	          <hr>
	          @empty
	          <p>Cart is Empty</p>
	          @endforelse
	        
	           <div class="row m-0">
	            <div class="col-9">
	              <p class="m-0 text-black-50">Total Quantity</p>
	            </div>

	            <div class="col-1 text-black-50">
	              <div class="d-flex">
	        
	                <p id="subTVal">{{$quantity}}</p>
	              </div>
	            </div>
	          </div>
	        
	          <hr class="border bg-info" />

	          <!-- SUBTOTAL -->
	          <div class="row m-0 font-weight-light">
	            <div class="col-9">
	              <span>Sub Total</span>
	            </div>

	            <div class="col-1">
	              <div class="d-flex">
	                <span>Rs.</span>
	                <span id="subTVal">{{$sum}}</span>
	              </div>
	            </div>
	          </div>
	          <hr />
	          <div class="row m-0 font-weight-light">
	            <div class="col-9">
	              <span>Delivery Charges</span>
	            </div>

	            <div class="col-1">
	              <div class="d-flex">
	                <span>Rs.</span>
	                <span id="subTVal">50</span>
	              </div>
	            </div>
	          </div>
	             <hr />
	          <!-- TOTAL -->
	          <div class="row m-0 font-weight-light">
	            <div class="col-9">
	              <span>Grand Total</span>
	            </div>

	            <div class="col-1">
	              <div class="d-flex">
	                <span>Rs.</span>
	                <span id="subTVal">{{$grandsum}}</span>
	              </div>
	            </div>
	          </div>
	          <hr />
	        </div>

	        <div class="d-flex flex-column justify-content-center align-items-center">
	        <a data-toggle="modal" data-target="#ORDERCONFIRM"  style="background-color: brown; text-align: center; color: #fff; border: none" class="btn btn-dark btn-lg rounded-0 btn-block">ORDER CONFIRM</a>
	        <div class="modal fade" id="ORDERCONFIRM" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel"
	                    data-backdrop="static" aria-hidden="true" style="display: none;">
	                    <div class="modal-dialog modal-md" role="document">
	                        <div class="modal-content">
	                            <div class="modal-header">
	                                <h5 class="modal-title" id="staticModalLabel">Place Order</h5>
	                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                                    <span aria-hidden="true">×</span>
	                                </button>
	                            </div>
	                            <div class="modal-body"><h4>Are you sure order the meats ?</h4></div>
	                            <div class="modal-footer">
	                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
	                                <button type="submit" class="btn btn-danger">Order Place</button>
	                            </div>
	                        </div>
	                    </div>
	                    </div>
	      
	          <span class="font-italic font-weight-light">*CASH ON DELIVERY</span>
	        </div>
	      </div>
        </form>
	</div>
</div>

@endsection
