@extends('frontend.layouts.app')
@section('content')
<style>
    .select__form{
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        margin-bottom: 30px;
    }
    .select__form input{
        background: #F0F0E9;
        border: medium none;
        color: #696763;
        display: block;
        font-family: 'Roboto', sans-serif;
        font-size: 14px;
        font-weight: 300;
        height: 40px;
        margin-bottom: 10px;
        outline: medium none;
        padding-left: 10px;
        padding-right: 8px;
        width: 150px;
    }
    .select__form select{
        width: 150px;
        height: 40px;
        
    }
    .select__form button{
        background: #FE980F;
        border: medium none;
        border-radius: 0;
        color: #FFFFFF;
        display: block;
        font-family: 'Roboto', sans-serif;
        padding: 6px 25px;
        height: 40px;
    }
</style>
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Features Items</h2>
    <form action="" class="select__form"  method="GET">
        <input type="text" placeholder="Name" name="name">
        <select name="price" id="">
            <option value="">Choose price</option>
            <option value="30000-700000">30000-700000</option>
            <option value="500000-1000000">500000-1000000</option>
            <option value="1200000-10000000">1200000-10000000</option>
            <option value="12000000-40000000">12000000-40000000</option>
            <option value="40000000-400000000">40000000-400000000</option>
        </select>
        <select name="id_category" id="">
            <option value="">Category</option>
            @foreach($category as $value)
                  <option value="{{$value['id']}}">{{$value['category']}}</option>
            @endforeach     
        </select>
        <select name="id_brand" id="">
            <option value="">Brand</option>
            @foreach($brand as $value)
                <option value="{{$value['id']}}">{{$value['brand']}}</option>
            @endforeach
        </select>
        <select name="status" id="">
            <option value="">Status</option>
            <option value="0">New</option>
            <option value="1">Sale</option>
        </select>
        <button type="submit" class="btn btn-default">Search</button>
    </form>
    @foreach($product as $value)
        @php 
            $img = json_decode($value['image']);
        @endphp
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        @if(isset($img[0]))
                              <img src="{{asset('upload/product/'.$img[0])}}" alt="" />
                        @endif 
                        <h2>${{$value['price']}}</h2>
                        <p>{{$value['name']}}</p>
                        <a href="#" class="btn btn-default add-to-cart" ><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>${{$value['price']}}</h2>
                            <p>{{$value['name']}}</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                        <li><a href=""><i class="fa fa-plus-square"></i>Product detail</a></li>
                    </ul>
                </div>
            </div>
        </div>
    @endforeach


    {{-- <ul class="pagination">
        <li class="active"><a href="">1</a></li>
        <li><a href="">2</a></li>
        <li><a href="">3</a></li>
        <li><a href="">&raquo;</a></li>
    </ul> --}}
</div><!--features_items-->

@endsection