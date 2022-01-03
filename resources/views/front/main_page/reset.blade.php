@extends('front.layout.Layout')
@section('title') reset password  @endsection
@section('keyword')   @endsection
@section('description')   @endsection

@section('contant')
<div class="headingmainarea">
	<div class="container">
	    <h2>Reset Password</h2>
	</div>
</div>
<div class="contrantlogin">
	<div class="container">
		<div class="row">
			<div class="col-lg-offset-3  col-lg-6">
				   <form method="POST" class="shadow-lg form-cont" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group ">
                            <label for="email">{{ __('E-Mail Address') }}</label>

                      
                                <input id="email" type="email" class="form-input @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}"  autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>
                        <div class="form-group ">
                            <label for="password" >{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-input @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
                            <span toggle="#password" class="fa fa-eye field-icon toggle-password"></span>
	                        @error('password')
	                            <span class="invalid-feedback" role="alert">
	                                <strong>{{ $message }}</strong>
	                            </span>
	                        @enderror
                        </div>

                        <div class="form-group ">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-input  @error('password_confirmation') is-invalid @enderror" name="password_confirmation"  autocomplete="new-password">
                             <span toggle="#passwordconfirm" class="fa fa-eye field-icon toggle-confirmpassword"></span>
			                @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          
                        </div>

                        <div class="d-flex flex-row justify-content-end">
			              <button class="form-button" type="submit">Reset Password</button>
			            </div>
                                
                    </form>
				
			</div>
		</div>
	</div>
</div>
@endsection
