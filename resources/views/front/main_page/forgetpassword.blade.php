@extends('front.layout.Layout')
@section('title') forget password  @endsection
@section('keyword')   @endsection
@section('description')   @endsection

@section('contant')
<div class="headingmainarea">
	<div class="container">
	    <h2>Forget Password</h2>
	</div>
</div>
<div class="contrantlogin">
	<div class="container">
	
		<div class="row">
			<div class="col-lg-offset-3  col-lg-6">
					@if ($errors->any())
                   <div class="alert alert-danger alert-dismissible" role="alert">
                        <ul>
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
                 <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
			   <form class="shadow-lg form-cont" method="post" action="{{ route('password.email') }}" id="forgetpassword_form">
						@csrf  
                       <label class="form-label" for="mail">Email</label>
				          <input type="email" id="mail" class="form-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus >
				           @error('email')
	                            <span class="invalid-feedback" role="alert">
	                               <strong>{{ $message }}</strong>
	                            </span>
	                        @enderror
					    
                          
                           <div class="d-flex flex-row justify-content-end">
			        <button class="form-button" type="submit">Send Email</button>
			      </div>
					    
					</form>
			</div>
		</div>
	</div>
</div>
@endsection
