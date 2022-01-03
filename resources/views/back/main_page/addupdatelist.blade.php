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
                <form @if(empty($listdata['id'])) action="{{ url('/admin-area/add-list') }}" @else action="{{ url('/admin-area/update-list/' .$listdata['id']) }}" @endif id="add-update-list" name="add-update-list" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label>Image: *</label>

                    <div class="input-group">
                       <input id="image" type="file" class=" rounded-0 form-control @error('image') is-invalid @enderror"  name="image"   autocomplete="image" style="font-size: 12px;">

                        @error('image')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <!-- /.input group -->
                    @if(!empty($listdata['image']))
                      <div style="padding: 10px 0px;">
                        <img src="{{ asset('assets/images/'.$listdata['image'])  }}" width="90" class="img-thumbnail" >
                      </div>
                    @endif
                  </div>
                  <div class="form-group">
                    <label>Title: *</label>

                    <div class="input-group">
                       <input id="title" type="text" class=" rounded-0 form-control @error('title') is-invalid @enderror"  name="title"   autocomplete="title" autofocus @if(!empty($listdata['title'])) value="{{$listdata['title']}}" @else value="{{old('title')}}" @endif >

                        @error('title')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <!-- /.input group -->
                  </div>
                  <div class="form-group">
                    <label>Price: *</label>
                    <div class="input-group">
                       <input id="price" type="text" class=" rounded-0 form-control @error('price') is-invalid @enderror"  name="price"   autocomplete="price" autofocus @if(!empty($listdata['price'])) value="{{$listdata['price']}}" @else value="{{old('price')}}" @endif >

                        @error('price')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <!-- /.input group -->
                  </div>
                  <div class="form-group">
                    <label>Select Category: *</label>
                    <div class="input-group">
                        <select class="form-control rounded-0 @error('category_id') is-invalid @enderror" name="category_id" id="category_id" @if(!empty($listdata['category_id'])) value="{{$listdata['category_id']}}" @else value="{{old('category_id')}}" @endif >
                          <option selected disabled>Select Category</option>
                          @foreach($categories as $cat)
                            <option value="{{$cat->id}}" @if(!empty($listdata['category_id']) && $listdata['category_id']==$cat->id) selected @endif >{{$cat->title}}</option>
                          @endforeach
                    </select>
                    @error('category_id')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <!-- /.input group -->
                  </div>
                  
                  <input type="submit" name="action_button" id="submitbtn" @if(empty($listdata['id'])) value="Add list" @else value="Edit list " @endif  class="btn btn-exp ">
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
