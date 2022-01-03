@extends('front.layout.Layout')
@section('title') heathy meat  @endsection
@section('keyword')   @endsection
@section('description')   @endsection

@section('contant')
 
 <!-- MAIN BODY CONTENT STARTS FROM HERE ////////////////////////////////////////////////////// -->
      <!-- Slider -->
  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-generic" data-slide-to="1"></li>
      <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="assets/images/1.jpg" alt="Los Angeles" width="1100" height="500">
      </div>

      <div class="item">
        <img src="assets/images/2.jpg" alt="Los Angeles" width="1100" height="500">
      </div>

     
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>

    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  </div>
      <!-- Contact via whatsapp -->
      <div class="contant1">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-12 newsline">
              <div class="row">
                  <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-4 newslineheading">
               News Alert : 
              </div>
              <div class="col-xl-9 col-lg-9 col-md-8 col-sm-8 col-8 newslinecontant">
              <marquee onmouseover="stop()" onmouseout="start()">Congratulations! We Are Deliver Meat Online (Goshtwala.pk) Online Meat Order | Healthy & Fresh Meat Order Now! </marquee>
              </div>
              </div>
             
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12 whatsapparea">

                    <a href="//api.whatsapp.com/send?phone=923303640396&text=" title="Share on whatsapp" target="_blank"> 
                      Order Now On Whatsapp !
                 <i class="fab fa-whatsapp-square"></i>

                </a>
            </div>
          </div>
        </div>
      </div>

      <div class="contant2">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <h1>Home delivery in 50rs only!</h1>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.sint occaecat cupidatat</p>
              <a href="#">Order Now</a>
            </div>
          </div>
        </div>
      </div>

    <div class="contant3">
        <div class="container">
          <h1>Quality Service</h1>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
              <i class="fas fa-drumstick-bite"></i>
              <h4> Fresh cut meat</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut aliqua.</p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
              <i class="fas fa-percent"></i>
              <h4>100% Halal</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut aliqua.</p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
              <i class="fas fa-weight-hanging"></i>
              <h4>Weighted Perfectly!</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut aliqua.</p>
            </div>
          </div>
        </div>
    </div>

    <div class="contant4">
        <div id="overlay-cart" class="overlay-cart">
    <div class="cv-spinne-cart">
      <span class="spinne-cart"></span>
    </div>
  </div>
      <div class="container">

        <h1>Our Top Selling Meat</h1>
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
        <div class="row">
      
          @forelse($toplist as $toplists)
          <div class="col-lg-3 col-md-4 col-sm-6 col-12 meatmain">
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
          padding: 50px 0px;">Top Selling No Found</p>
          @endforelse
        </div>
      </div>
    </div>
@endsection
