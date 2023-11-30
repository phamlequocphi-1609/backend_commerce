@extends('frontend.layouts.app')
@section('content')
<section id="form" style="margin-top: 0px"><!--form-->
        <div class="align-self-center">
            <h4 class="page-title">Register</h4>
            @if(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h4><i class="icon fa fa-check"></i>Thông báo !</h4>
                    {{session('success')}}
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                    <h4><i class="icon fa fa-check"></i>Thông báo !</h4>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
		<div class="">
            <form method="post" class="form-horizontal form-material" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="col-md-12">Full Name</label>
                    <div class="col-md-12">
                         <input type="text" placeholder="Enter name" class="form-control form-control-line" name="name" value="{{old('name')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="example-email" class="col-md-12">Email</label>
                    <div class="col-md-12">
                        <input type="email" placeholder="Enter email" class="form-control form-control-line" name="email" id="email" value="{{old('email')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Password</label>
                    <div class="col-md-12">
                        <input type="password" placeholder="Enter password" name="password" class="form-control form-control-line" value="{{old('password')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Phone No</label>
                    <div class="col-md-12">
                        <input type="text" placeholder="Enter phone" name="phone" class="form-control form-control-line" value="{{old('phone')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Address</label>
                    <div class="col-md-12">
                        <input type="text" placeholder="Enter address" name="address" class="form-control form-control-line" value="{{old('address')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Upload avatar</label>
                    <div class="col-md-12">
                        <input type="file" class="form-control" name="avatar" value="{{old('avatar')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-12">Select Country</label>
                    <div class="col-sm-12">
                        <select class="form-control form-control-line" name="id_country">
                            @foreach($getCountry as $value)
                                <option value="{{$value['id']}}">{{$value['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success">Register</button>
                    </div>
                </div>
                 </form>
		</div>
	</section><!--/form-->
@endsection
