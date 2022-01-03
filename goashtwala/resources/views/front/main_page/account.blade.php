@extends('front.layout.Layout')
@section('title') account  @endsection
@section('keyword')   @endsection
@section('description')   @endsection

@section('contant')

<div class="headingmainarea">
	<div class="container">
	    <h2>User Account </h2>
	</div>
</div>
<div class="container">

    
	 <div class="row justify-content-center" style="margin: 50px 0px;">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-header"><p></p>
                {{ __('Dashboard') }}                 
              </div>
              
                <div class="card-body">
                    <div class="userdetail">
                    	<h3>{{Auth::user()->name}}</h3>
                    	<hr>
                    	<h4>Email : {{Auth::user()->email}}</h4>
                    	<h4>Phone : @if(empty(Auth::user()->phone)) Null @else {{Auth::user()->phone}}@endif</h4>
                    	<h4>Country : @if(empty(Auth::user()->country)) Null @else {{Auth::user()->country}}@endif</h4>
                    	<h4>City : @if(empty(Auth::user()->city)) Null @else {{Auth::user()->city}}@endif</h4>
                    	<h4>Address : @if(empty(Auth::user()->address)) Null @else {{Auth::user()->address}}@endif</h4>
                    	<hr>
                    	<a href="{{ url('/user-area/personal-detail')}}">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

