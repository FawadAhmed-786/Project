@extends('front.layout.Layout')
@section('title') login  @endsection
@section('keyword')   @endsection
@section('description')   @endsection

@section('contant')
<div class="headingmainarea">
	<div class="container">
	    <h2>Login User</h2>
	</div>
</div>
<div class="contrantlogin">
	<div class="container">
		<div class="row">
			<div class="col-lg-offset-3  col-lg-6">
				<form class="shadow-lg form-cont" method="post" action="{{ route('login') }}">
					@csrf
			        <h1 class="login-title display-4">Login</h1>
			        <hr />

			        <fieldset>
			          <label class="form-label" for="mail">Email</label>
			          <input type="email" id="mail" class="form-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus >
			           @error('email')
                            <span class="invalid-feedback" role="alert">
                               <strong>{{ $message }}</strong>
                            </span>
                        @enderror

			          <label class="form-label"  for="password">Password</label>
			          <input id="password" type="password" class="form-input @error('password') is-invalid @enderror" name="password"  autocomplete="current-password">
                         <span toggle="#password" class="fa fa-eye field-icon toggle-password"></span>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
			    
			           @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="btn btn-link form-link">
                            {{ __('Forgot Your Password?') }}
                        </a>
                        @endif
			        </fieldset>
			        <div class="d-flex flex-row justify-content-end">
			        <button class="form-button" type="submit">Login</button>
			      </div>

			        <label  class="form-text"
			          >Don't have an account, <a class="form-link"  href="{{url('/register')}}">Join us</a>
			          </label>
			      </form>
			</div>
		</div>
	</div>
</div>
@endsection
