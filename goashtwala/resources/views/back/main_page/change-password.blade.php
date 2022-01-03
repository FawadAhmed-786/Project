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
                        <form action="{{ url('/admin-area/change-password') }}" method="post">
                        @csrf
                        <label class="form-label" for="current-password">Current Password:</label>
                        <input id="password" type="password" class="form-input @error('current-password') is-invalid @enderror" name="current-password"  autocomplete="current-password">
                          <span toggle="#password" class="fa fa-eye field-icon toggle-password"></span>
                          @error('current-password')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror

                        <label class="form-label" for="password">New Password:</label>
                        <input id="newpassword" type="password" class="form-input @error('password') is-invalid @enderror" name="password"  autocomplete="password">
                         <span toggle="#newpassword" class="fa fa-eye field-icon toggle-userpassword"></span>
                          @error('password')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror

                        <label class="form-label" for="cpassword">New Confirm Password:</label>
                         <input id="passwordconfirm" type="password" class="form-input  @error('password_confirmation') is-invalid @enderror" name="password_confirmation"  autocomplete="password_confirmation"> 
                              <span toggle="#passwordconfirm" class="fa fa-eye field-icon toggle-confirmpassword"></span>
                          @error('password_confirmation')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                            <div class="d-flex flex-row justify-content-end">
                        <button class="form-button" type="submit">Change Password</button>
                    
                    </form>
         
              </div>
            </div>
          </div>         
        </div>
      </div>
    </section>
  </div>
   
      
@endsection
