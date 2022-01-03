@extends('front.layout.Layout')
@section('title') change password  @endsection
@section('keyword')   @endsection
@section('description')   @endsection

@section('contant')

<div class="headingmainarea">
	<div class="container">
	    <h2>@can('isAdmin') Admin Change Password
        @endcan @can('isUser')User Change Password @endcan</h2>
	</div>
</div>
<div class="container">

	 <div class="row justify-content-center" style="margin: 50px 0px;">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-header"><p></p>
                {{ __('Change Password') }}                 
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
                        <form action="{{ url('/user-area/change-password') }}" method="post">
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

