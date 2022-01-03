@extends('back.layout.layout')
@section('title') category  @endsection
@section('keyword')   @endsection
@section('description')   @endsection
@section('contant')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Change Password</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/admin-area/account')}}">Home</a></li>
              <li class="breadcrumb-item active">Change Password</li>
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
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <span><i class="fa fa-check"></i> {{ session('success') }}</span>
                </div>
            @endif 
                              
            
            <div class="card">
            	
              <div class="card-header">
                <h3 class="card-title">Change Password</h3>
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
                       <form action="{{ url('/admin-area/personal-detail') }}" method="post">
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
    </section>
  </div>
   
      
@endsection
