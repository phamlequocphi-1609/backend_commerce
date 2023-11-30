@extends('frontend.layouts.app')
@section('content')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Features Items</h2>
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
                        <button  class="btn btn-default add-to-cart" id="{{$value['id']}}"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>${{$value['price']}}</h2>
                            <p>{{$value['name']}}</p>
                            <button  class="btn btn-default add-to-cart" id="{{$value['id']}}"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                        </div>
                    </div>
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                    <li><a href="{{route('productDetail', ['id' => $value['id']])}}"><i class="fa fa-plus-square"></i>Product Detail</a></li>
                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div><!--features_items--> 
@endsection