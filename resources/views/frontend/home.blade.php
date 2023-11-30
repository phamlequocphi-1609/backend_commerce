@extends('frontend.layouts.app')
@section('content')
<div class="features_items remove"><!--features_items-->
	<h2 class="title text-center">Features Items</h2>
        @foreach($product as $value)
            @php
                $imgProduct = json_decode($value['image']);
            @endphp
            <div class="col-sm-4 body">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            @if(isset($imgProduct[0]))
                                <img src="{{asset('upload/product/' .$imgProduct[0])}}" alt="" />
                            @endif
							<h2>${{$value['price']}}</h2>
                            <p>{{$value['name']}}</p>
                            <button  class="btn btn-default add-to-cart" id="{{$value['id']}}"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                        </div>
                        <div class="product-overlay">
                        	<div class="overlay-content">
                                <h2>${{$value['price']}}</h2>
                               	<p>{{$value['name']}}</p>
                                <button class="btn btn-default add-to-cart" id="{{$value['id']}}"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </div>
                        </div>
                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                            <li><a href="{{route('productDetail', ['id' => $value['id']])}}"><i class="fa fa-plus-square"></i>Product detail</a></li>
                        </ul>
                    </div>
             	</div>
             </div>
        @endforeach
</div><!--features_items-->
<div class="category-tab"><!--category-tab-->
	<div class="col-sm-12">
		<ul class="nav nav-tabs">
			
			@foreach($category as $key=>$value)
				<li class="{{ $key == 0 ? 'active' : '' }}">
					<a href="#{{$value['category']}}" data-toggle="tab">{{$value['category']}}</a>
				</li>
			@endforeach
			
		</ul>
	</div>
	<div class="tab-content">
		@foreach($category as $key => $value)
			<div class="tab-pane fade {{$key == 0 ? 'active in' : ''}}" id="{{$value['category']}}">
				@foreach($productAll as $productValue)
					@if($productValue['id_category'] == $value['id'])
						@php
							$imgProduct = json_decode($productValue['image']);
						@endphp
						<div class="col-sm-4 body">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										@if(isset($imgProduct[0]))
											<img src="{{asset('upload/product/' .$imgProduct[0])}}" alt="" />
										@endif
										<h2>${{$productValue['price']}}</h2>
										<p>{{$productValue['name']}}</p>
										<button class="btn btn-default add-to-cart" id="{{$productValue['id']}}"><i class="fa fa-shopping-cart"></i>Add to cart</button>
									</div>
									<div class="product-overlay">
										<div class="overlay-content">
											<h2>${{$productValue['price']}}</h2>
											<p>{{$productValue['name']}}</p>
											<button class="btn btn-default add-to-cart" id="{{$productValue['id']}}"><i class="fa fa-shopping-cart"></i>Add to cart</button>
										</div>
									</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href="{{route('productDetail', ['id' => $productValue['id']])}}"><i class="fa fa-plus-square"></i>Product detail</a></li>
									</ul>
								</div>
							</div>
						</div>
					@endif
				@endforeach
			</div>
		@endforeach
	</div>
	
</div><!--/category-tab-->
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>

						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend1.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>

											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend2.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>

											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend3.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>

											</div>
										</div>
									</div>
								</div>


								<div class="item">
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend1.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>

											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend2.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>

											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend3.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>

											</div>
										</div>
									</div>
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
