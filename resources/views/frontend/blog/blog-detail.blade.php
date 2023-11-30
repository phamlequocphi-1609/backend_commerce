@extends('frontend.layouts.app')
@section('content')
    <div class="blog-post-area">
		<h2 class="title text-center">Latest From our Blog</h2>
        <div class="single-blog-post">
			<h3>{{$blogId->title}}</h3>
            <div class="post-meta">
                <ul>
                    <li><i class="fa fa-user"></i>{{$blogId->id}}</li>
                    <li><i class="fa fa-clock-o"></i>{{date('h:i a', strtotime($blogId->updated_at))}}</li>
                    <li><i class="fa fa-calendar"></i>{{date('M d, Y', strtotime($blogId->updated_at))}}</li>
                </ul>
            </div>
                <a href=""><img src="{{asset('upload/blog/'.$blogId->image )}}" alt=""></a>
                <p>{{$blogId->content}}</p>
            <div class="pager-area">
                <ul class="pager pull-right">
                    @if($blogPrevious)
                        <li>
                            <a href="{{route('blog.detail', ['id'=>$blogPrevious])}}">Pre</a>
                        </li>
                    @endif
                    @if($blogNext)
                        <li>
                            <a href="{{route('blog.detail', ['id'=>$blogNext])}}">Next</a>
                        </li>
                    @endif
                </ul>
            </div>
		</div>
	</div><!--/blog-post-area-->
	<div class="rating-area">
		<ul class="ratings">
			<li class="rate-this">Rate this item:</li>
			<li>
                <div class="rate">
                    <div class="vote">
                        <input class="blograte" value="{{$comment['id']}}" type="hidden">
                        <div class="star_1 ratings_stars "><input value="1" type="hidden"></div>
                        <div class="star_2 ratings_stars"><input value="2" type="hidden"></div>
                        <div class="star_3 ratings_stars"><input value="3" type="hidden"></div>
                        <div class="star_4 ratings_stars"><input value="4" type="hidden"></div>
                        <div class="star_5 ratings_stars"><input value="5" type="hidden"></div>

                        <span class="rate-np">{{round($rateAvg)}}</span>

                    </div>
                </div>
			</li>
		</ul>
		<ul class="tag">
			<li>TAG:</li>
			<li><a class="color" href="">Pink <span>/</span></a></li>
			<li><a class="color" href="">T-Shirt <span>/</span></a></li>
			<li><a class="color" href="">Girls</a></li>
		</ul>
	</div><!--/rating-area-->

	<div class="socials-share">
			<a href=""><img src="images/blog/socials.png" alt=""></a>
	</div><!--/socials-share-->

					<!-- <div class="media commnets">
						<a class="pull-left" href="#">
							<img class="media-object" src="images/blog/man-one.jpg" alt="">
						</a>
						<div class="media-body">
							<h4 class="media-heading">Annie Davis</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
							<div class="blog-socials">
								<ul>
									<li><a href=""><i class="fa fa-facebook"></i></a></li>
									<li><a href=""><i class="fa fa-twitter"></i></a></li>
									<li><a href=""><i class="fa fa-dribbble"></i></a></li>
									<li><a href=""><i class="fa fa-google-plus"></i></a></li>
								</ul>
								<a class="btn btn-primary" href="">Other Posts</a>
							</div>
						</div>
	                </div> --><!--Comments-->

	<div class="response-area">
        <h2>{{count($comment['comment'])}} RESPONSES</h2>
		<ul class="media-list">
			@foreach($comment['comment'] as $value)
                @if($value['level'] == 0)
                <li class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" style="width: 100px" src="{{asset('upload/member/'.$value['avatar_user'])}}" alt="">
                    </a>
                    <div class="media-body">
                        <ul class="sinlge-post-meta">
                            <li><i class="fa fa-user"></i>{{$value['name_user']}}</li>
                            <li><i class="fa fa-clock-o"></i>{{date('h:i a', strtotime($value['created_at']))}}</li>
                            <li><i class="fa fa-calendar"></i>{{date('M d, Y', strtotime($value['created_at']))}}</li>
                        </ul>
                        <p>{{$value['comment']}}</p>
                        <a class="btn btn-primary comment__reply" href="#cmt" data-id="{{$value['id']}}"><i class="fa fa-reply"></i>Replay</a>
                    </div>
                </li>
                @else
                <li class="media second-media">
					<a class="pull-left" href="#">
						<img class="media-object" style="width: 100px" src="{{asset('upload/member/'.$value['avatar_user'])}}" alt="">
					</a>
                    <div class="media-body">
                        <ul class="sinlge-post-meta">
                            <li><i class="fa fa-user"></i>{{$value['name_user']}}</li>
                            <li><i class="fa fa-clock-o"></i>{{date('h:i a', strtotime($value['created_at']))}}</li>
                            <li><i class="fa fa-calendar"></i>{{date('M d, Y', strtotime($value['created_at']))}}</li>
                        </ul>
                        <p>{{$value['comment']}}</p>
                        <a class="btn btn-primary comment__reply" href="#cmt" data-id="{{$value['id']}}"><i class="fa fa-reply"></i>Replay</a>
                    </div>
			    </li>
                @endif
            @endforeach
		</ul>
	</div>
	<div class="replay-box">
		<div class="row">
			<div class="col-sm-12">
				<h2>Leave a replay</h2>
                <p class="error"></p>
			    <form  method="post" action="{{url('/member/blog/detail/'.$blogId->id)}}" class="text-area" id="form-cmt">
                    @csrf
					<div class="blank-arrow">
						<label id="cmt">Your Name</label>
					</div>
					<span>*</span>
                    <input type="hidden" name="level" value="" id="comment-level"/>
					<textarea  name="comment" rows="11" class="messCmt"></textarea>
					<button  type="submit" class="btn btn-primary" >post comment</button>
				</form>
			</div>
		</div>
	</div><!--/Repaly Box-->
@endsection
