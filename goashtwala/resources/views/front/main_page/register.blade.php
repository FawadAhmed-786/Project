@extends('front.layout.Layout')
@section('title') register  @endsection
@section('keyword')   @endsection
@section('description')   @endsection

@section('contant')
<div class="headingmainarea">
	<div class="container">
	    <h2>Register User</h2>
	</div>
</div>
<div class="contantregister">
	<div class="container">
		<div class="row">
			<div class="col-lg-offset-3 col-lg-6">
				<form class="shadow-lg form-cont" method="post" action="{{ route('register') }}">
					@csrf
			        <fieldset>
			          <label class="form-label" for="name">Name:</label>
			          <input id="name" type="text" class="form-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

			          <label class="form-label" for="mail">Email:</label>
			     
			          <input id="email" type="email" class="form-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

			          <label class="form-label" for="password">Password:</label>
			          <input id="password" type="password" class="form-input @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
                      <span toggle="#password" class="fa fa-eye field-icon toggle-password"></span>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

			          <label class="form-label" for="cpassword">Confirm Password:</label>
			           <input id="passwordconfirm" type="password" class="form-input  @error('password_confirmation') is-invalid @enderror" name="password_confirmation"  autocomplete="new-password">
			            <span toggle="#passwordconfirm" class="fa fa-eye field-icon toggle-confirmpassword"></span>
			            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

			        </fieldset>
			        <div class="d-flex flex-row justify-content-end">
			          <button class="form-button" type="submit">Sign Up</button>
			        </div>
			        <label class="form-text">Already have an account, <a class="form-link"  href="{{url('/login')}}">Login here</a></label>
			    </form>
			</div>
		</div>
	</div>
</div>
@endsection
