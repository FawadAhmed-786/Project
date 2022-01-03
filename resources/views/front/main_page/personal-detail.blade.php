@extends('front.layout.Layout')
@section('title') personal detail  @endsection
@section('keyword')   @endsection
@section('description')   @endsection

@section('contant')

<div class="headingmainarea">
	<div class="container">
	    <h2>@can('isAdmin') Admin Personal Detail
        @endcan @can('isUser')User Personal Detail @endcan </h2>
	</div>
</div>
<div class="container">

	 <div class="row justify-content-center" style="margin: 50px 0px;">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-header"><p></p>
                {{ __('Personal Detail') }}                 
              </div>
              
                   <div class="card-body chanegpassword">

                   <div class="row">
                       <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6">
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <span><i class="fa fa-check"></i> {{ session('success') }}   </span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                         @if(session()->has('error'))
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <span><i class="fa fa-wronge"></i>{{ session('error') }}</span>
                                    </div>
                                @endif 
                       <form action="{{ url('/user-area/personal-detail') }}" method="post">
                        @csrf
                        <label class="form-label" for="name">Name:</label>
			          <input id="name" type="text" class="form-input @error('name') is-invalid @enderror" name="name" value="@if(!empty(Auth::user()->name)){{Auth::user()->name}}@else{{ old('name') }}@endif"  autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

			          <label class="form-label" for="mail">Email:</label>
			     
			          <input id="email" type="email" class="form-input @error('email') is-invalid @enderror" name="email" value="@if(!empty(Auth::user()->email)){{Auth::user()->email}}@else{{ old('email') }}@endif"  autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    
                    <label class="form-label" for="phone">Phone:</label>
			          <input id="phone" type="text" class="form-input @error('phone') is-invalid @enderror" name="phone" value="@if(!empty(Auth::user()->phone)){{Auth::user()->phone}}@else{{ old('phone') }}@endif"  autocomplete="phone" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

			          <label class="form-label" for="city">City:</label>
			     
			          <input id="city" type="city" class="form-input @error('city') is-invalid @enderror" name="city" value="@if(!empty(Auth::user()->city)){{Auth::user()->city}}@else{{ old('city') }}@endif"  autocomplete="city">

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                      <label class="form-label" for="city">Address:</label>
			          <textarea class="form-input  @error('address') is-invalid @enderror" autocomplete="address" name="address">@if(!empty(Auth::user()->address)){{Auth::user()->address}}@else{{Request::old('address')}}@endif</textarea>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                     
                        <div class="d-flex flex-row justify-content-end">
                      <button class="form-button" type="submit">Save</button>
                    </div>
                    </form>
                       </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

