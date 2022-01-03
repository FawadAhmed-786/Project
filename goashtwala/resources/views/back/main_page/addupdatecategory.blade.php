@extends('back.layout.layout')
@section('title') {{$title}}  @endsection
@section('keyword')   @endsection
@section('description')   @endsection
@section('contant')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{$title}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/admin-area/account')}}">Home</a></li>
              <li class="breadcrumb-item active">{{$title}}</li>
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
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
              <div class="card-body">
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
                <form @if(empty($categorydata['id'])) action="{{ url('/admin-area/add-category') }}" @else action="{{ url('/admin-area/update-category/' .$categorydata['id']) }}" @endif id="add-update-category" name="add-update-category" method="post">
                  @csrf
                   <div class="form-group">
                    <label>Title: *</label>

                    <div class="input-group">
                       <input id="title" type="text" class=" rounded-0 form-control @error('title') is-invalid @enderror"  name="title"   autocomplete="title" autofocus @if(!empty($categorydata['title'])) value="{{$categorydata['title']}}" @else value="{{old('title')}}" @endif >

                        @error('title')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <!-- /.input group -->
                  </div>
                   <input type="submit" name="action_button" id="submitbtn" @if(empty($categorydata['id'])) value="Add Category" @else value="Edit Category " @endif  class="btn btn-exp ">
                </form> 
              </div>    
              </div>
            </div>
          </div>         
        </div>
      </div>
    </section>
  </div>       
@endsection
