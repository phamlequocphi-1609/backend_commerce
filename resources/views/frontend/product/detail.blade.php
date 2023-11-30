@extends('frontend.layouts.app')
@section('content')
<div class="product-details"><!--product-details-->
	<div class="col-sm-5">
        @php
            $imageProduct = json_decode($productDetail['image']);
        @endphp
		<div class="view-product">
            @if(isset($imageProduct[0]))
                <img src="{{asset('upload/product/' .$imageProduct[0])}}" alt="" />
            @endif
			<a href="{{asset('upload/product/' .$imageProduct[0])}}" rel="prettyPhoto"><h3>ZOOM</h3></a>
		</div>
		<div id="similar-product" class="carousel slide" data-ride="carousel">
								  <!-- Wrapper for slides -->
		    <div class="carousel-inner">
				<div class="item active">
                    @foreach($imageProduct as $img)
						<a href="{{asset('upload/product/'.$img)}}">
                            <img src="{{asset('upload/product/'.$img)}}" alt="" style="width: 65px">
                        </a>
                    @endforeach
				</div>
				<div class="item">
                    @foreach($imageProduct as $img)
						<a href="{{asset('upload/product/'.$img)}}">
                            <img src="{{asset('upload/product/'.$img)}}" alt="" style="width: 65px">
                        </a>
                    @endforeach
				</div>
				<div class="item">
                    @foreach($imageProduct as $img)
						<a href="{{asset('upload/product/'.$img)}}">
                            <img src="{{asset('upload/product/'.$img)}}" alt="" style="width: 65px">
                        </a>
                    @endforeach
				</div>
			</div>
			<!-- Controls -->
			<a class="left item-control" href="#similar-product" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			</a>
			<a class="right item-control" href="#similar-product" data-slide="next">
				<i class="fa fa-angle-right"></i>
			</a>
		</div>
	</div>
	<div class="col-sm-7">
		<div class="product-information"><!--/product-information-->
			<img src="images/product-details/new.jpg" class="newarrival" alt="" />
			<h2>{{$productDetail['name']}}</h2>
			<p>Web ID: {{$productDetail['id']}}</p>
			<!-- <img src="images/product-details/rating.png" alt="" /> -->
            <div class="rate">
                <div class="vote">
                    <div class="star_1 ratings_stars "><input value="1" type="hidden"></div>
                    <div class="star_2 ratings_stars"><input value="2" type="hidden"></div>
                    <div class="star_3 ratings_stars"><input value="3" type="hidden"></div>
                    <div class="star_4 ratings_stars"><input value="4" type="hidden"></div>
                    <div class="star_5 ratings_stars"><input value="5" type="hidden"></div>
                </div>
            </div>
			<span>
				<span>US ${{$productDetail['price']}}</span>
			    <label>Quantity:</label>
			    <input type="text" value="3" />

			</span>
            <button type="button" class="btn btn-fefault cart">
					<i class="fa fa-shopping-cart"></i>
					Add to cart
			</button>
			<p><b>Company:</b> {{$productDetail['company']}}</p>
			<p><b>Condition:</b>
                @if($productDetail['status'] == 0)
                    New
                @else
                    Sale
                @endif
            </p>
			<p><b>Brand:</b>
                @foreach($brand as $value)
                    @if($productDetail['id_brand'] == $value['id'])
                        {{$value['brand']}}
                    @endif
                @endforeach
            </p>
				<a href=""><img src="{{asset('frontend/images/product-details/share.png')}}" class="share img-responsive"  alt="" /></a>
			</div><!--/product-information-->
		</div>
	</div><!--/product-details-->

	<div class="category-tab shop-details-tab"><!--category-tab-->
		<div class="col-sm-12">
			<ul class="nav nav-tabs">
				<li><a href="#details" data-toggle="tab">Details</a></li>
				<li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>
				<!-- <li><a href="#tag" data-toggle="tab">Tag</a></li> -->
				<li class="active"><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
			</ul>
		</div>
		<div class="tab-content">
			<div class="tab-pane fade" id="details" >
                <div class="col-sm-9">
                    <p>{{$productDetail['detail']}}</p>
                </div>
			</div>
			<div class="tab-pane fade" id="companyprofile" >
                 <div class="col-sm-9">
                    <p>{{$productDetail['company']}}</p>
                </div>
			</div>

			<div class="tab-pane fade active in" id="reviews" >
				<div class="col-sm-12">
                    <ul>
                        <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                        <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                        <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                    </ul>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                    <p><b>Write Your Review</b></p>

                    <form action="#">
                        <span>
                            <input type="text" placeholder="Your Name"/>
                            <input type="email" placeholder="Email Address"/>
                        </span>
                        <textarea name="" ></textarea>
                            <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                            <button type="button" class="btn btn-default pull-right">
                                Submit
                            </button>
                    </form>
				</div>
			</div>
		</div>
	</div><!--/category-tab-->
    <div class="recommended_items"><!--recommended_items-->
		<h2 class="title text-center">recommended items</h2>
        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				<div class="item active">
                    @foreach($product as $value)
                        @php
                            $img = json_decode($value['image'])
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
                                        <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
					    </div>
                    @endforeach
				</div>
		        <div class="item">
                    @foreach($product as $value)
                        @php
                        $img = json_decode($value['image'])
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
                                        <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
					    </div>

                    @endforeach
				</div>
			</div>
				<a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
					<i class="fa fa-angle-left"></i>
				</a>
			    <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
					<i class="fa fa-angle-right"></i>
				</a>
		</div>
	</div><!--/recommended_items-->
@endsection
