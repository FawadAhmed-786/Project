@extends('front.layout.Layout')
@section('title') menu  @endsection
@section('keyword')   @endsection
@section('description')   @endsection

@section('contant')
<div class="headingmainarea">
	<div class="container">
	    <h2>Our Menu</h2>
	</div>
</div>
<div class="contantmenu">
		<div id="overlay-cart" class="overlay-cart">
    <div class="cv-spinne-cart">
      <span class="spinne-cart"></span>
    </div>
  </div>
	<div class="container">

		@if ($errors->any())
          <div class="alert alert-danger alert-dismissible" role="alert">
            <ul style="margin: 0px;">
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
                @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <span><i class="fa fa-check"></i>{{ session('success') }}</span>
                    </div>
                @endif 
          <span id="form_success"></span>
          <span id="form_error"></span>
             <span id="form_errors"></span>
		 <div class="scrollmenu  hidden-lg hidden-md ">
              <div class="nav-prev arrow fas fa-angle-left" style="display: none;"></div>
              <div class="nav-next arrow fas fa-angle-right" style=""></div>
                <div class="cata-sub-nav">
                  <ul>
                    <li class="nav-item active "><a class=" filter-button" data-filter="all">All</a></li>
                     @foreach($category as $cat)
	 					  <li> <a class="nav-item filter-button" data-filter="{{ $cat->id}}">{{ $cat->title }}({{$cat->listings_count}})</a></li>
	 				@endforeach 
                    
                   
                  </ul>
                </div>      
          </div>
          <div class="col-lg-3 hidden-new hidden-sm hidden-xs categories">
             <h2>Categories</h2>
             <ul>
                <li class="active"><a class="menucatbtn filter-button" data-filter="all">All</a></li>
                @foreach($category as $cat)
	 					  <li> <a class="nav-item filter-button" data-filter="{{ $cat->id}}">{{ $cat->title }}({{$cat->listings_count}})</a></li>
	 				@endforeach 
              </ul>
          </div>
          <div class="col-lg-9 col-md-12 col-sm-12 col-12 meatmainarea">
               <h2>Meat Menu</h2>
            <div class="row">
            @forelse($toplist as $toplists)
	          <div class="col-lg-4 col-md-4 col-sm-6 col-12 meatmain filter {{ $toplists->category_id}}">
	            <form class="menu-add" method="post" id="menu-add-{{$toplists->id}}" >
	              @csrf
	               <div class="meatimage">
	              <div class="meatimg">
	                <img src="{{asset('assets/images/'.$toplists->image)}}" class="img-fluid">
	              </div>
	            </div>
	            <h4>{{$toplists->title}}</h4>
	              <div class="row">
	                <div class="col-lg-7 col-md-6 col-sm-6 col-6">
	                  <div id="price-{{$toplists->id}}">
	                     <h6 id="showprice-{{$toplists->id}}">Rs {{$toplists->price}}/<span style="font-size: 12px;">kg</span></h6>
	                  </div>
	                  <div id="overlay-{{$toplists->id}}" class="overlay" style="margin: 5px 0px 10px 0px;">
	                    <div class="cv-spinne">
	                      <span class="spinne"></span>
	                    </div>
	                  </div> 
	                </div>
	                <div class="col-lg-5 col-md-6 col-sm-6 col-6">
	                  <select id="pickunit-{{$toplists->id}}" name="unit" onchange="showprice('{{$toplists->id}}')">
	                    <option value="1 kg" selected>1 Kg</option>
	                    <option value="half kg">Half Kg</option>
	                    <option value="pao">Pao</option>
	                  </select>
	                </div>
	              </div>  
	              <div class="meatfooter row">
	                <div class="col-lg-7 col-md-6 col-sm-6 col-6">
	                   <div class="num-block skin-2">
	                    <div class="num-in">
	                      <span class="minus dis" id="minus"></span>
	                      <input type="text" class="in-num" name="quantity" id="quantity-{{$toplists->id}}"  value="1" readonly="">
	                      <span class="plus" id="plus"></span>
	                    </div>
	                  </div>
	                </div>
	                <div class="col-lg-5 col-md-6 col-sm-6 col-6 quantity">
	             
	                  <button type="submit" id="add_cartbtn" onclick="event.preventDefault();addcart('{{$toplists->id}}')">Add</button>
	                </div>
	              </div>
	            </form> 
	          </div>
	       
	          @empty
	          <p style="text-align: center;font-size: 16px; color: #ccc;
	          padding: 50px 0px;">Meat No Found</p>
	          @endforelse
            </div>
          </div>
	</div>
</div>
	

@endsection
