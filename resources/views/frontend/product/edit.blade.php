@extends('frontend.layouts.app')
@section('content')
<section>
    <div class="signup-form">

        <h2>Edit product !</h2>
        <form method="post" action="" enctype="multipart/form-data">
            @csrf
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
            <input type="text" placeholder="Name" name="name" value="{{$productEdit->name}}"/>
            <input type="text" placeholder="Price" name="price" value="{{$productEdit->price}}"/>
            <select id="" name="id_category">
                <option value="">Please choose category</option>
                @foreach($category as $value)
                    <option value="{{$value['id']}}"
                        {{$productEdit->id_category == $value['id'] ? "selected" : ''}}
                    >{{$value['category']}}</option>
                @endforeach
            </select>
            <select  id="" name="id_brand">
                <option value="">Please choose brand</option>
                @foreach($brand as $value)
                    <option value="{{$value['id']}}"
                        {{$productEdit->id_brand == $value['id'] ? "selected" : ''}}
                    >{{$value['brand']}}</option>
                @endforeach
            </select>
            <select name="status" id = "id_sale">
                @if($productEdit->status == 1)
                    <option value="1" selected>Sale</option>
                    <option value="0">New</option>
                @else
                    <option value="1">Sale</option>
                    <option value="0" selected>New</option>
                @endif
            </select>
            <div style="display: flex; align-items: center" id="saleShow">
                <input type="text" name="sale"value = "{{$productEdit->sale}}" style="width: 200px; margin-right: 20px"> %
            </div>
            <input type="text" placeholder="Company profile" name="company" value="{{$productEdit->company}}"/>
            <input type="file" name="image[]" multiple>
                @php
                    $imgProduct = json_decode($productEdit->image, true);
                @endphp
                <div style="display: flex; align-items: center; justify-content: space-center; margin-bottom: 20px">
                    @foreach($imgProduct as $img)
                        <img src="{{asset('upload/product/'.$img)}}" alt="" style="width: 200px">
                        <input type="checkbox" name="delete_img[]" value="{{$img}}"/>
                    @endforeach
                </div>
            <textarea name="detail" id="" cols="30" rows="10" placeholder="Detail" >{{$productEdit->detail}}</textarea>
            <button  style="margin-bottom: 30px; margin-top: 30px;" type="submit" class="btn btn-default">Edit</button>
       </form>
    </div>
</section>
@endsection


<!-- in_array -->
