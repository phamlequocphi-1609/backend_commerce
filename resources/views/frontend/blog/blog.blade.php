@extends('frontend.layouts.app')
@section('content')
        <div class="blog-post-area">
			<h2 class="title text-center">Latest From our Blog</h2>
                @foreach($blogPaginate as $value)
                    <div class="single-blog-post">
						<h3>{{$value['title']}}</h3>
						<div class="post-meta">
							<ul>
								<li><i class="fa fa-user"></i>{{$value['id']}}</li>
								<li><i class="fa fa-clock-o"></i>{{date('h:i a', strtotime($value['updated_at']))}}</li>
								<li><i class="fa fa-calendar"></i>{{date('M d, Y', strtotime($value['updated_at']))}}</li>
							</ul>
							<span>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star-half-o"></i>
							</span>
						</div>
							<a href="">
								<img src="{{asset('upload/blog/'.$value['image'])}}" alt="">
							</a>
							<p>{{$value['description']}}</p>
							<a  class="btn btn-primary" href="{{route('blog.detail', ['id' => $value['id']])}}">Read More</a>
					</div>
                @endforeach
                <div class="pagination-area">
					<!-- <ul class="pagination">
						<li><a href="" class="active">1</a></li>
						<li><a href="">2</a></li>
						<li><a href="">3</a></li>
						<li><a href=""><i class="fa fa-angle-double-right"></i></a></li>
					</ul> -->
                    {{$blogPaginate->links('pagination::bootstrap-4')}}
				</div>
	    </div>
@endsection
