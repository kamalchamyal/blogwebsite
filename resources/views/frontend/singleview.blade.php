@extends('layouts.frontend')
@section('mytitle')
 {{ $post->c_name }} || {{ $post->post_title }}





@endsection

@section('content')


<!-- Feature Category Section & sidebar -->
<section id="feature_category_section" class="feature_category_section single-page section_wrapper">
	<div class="container">
        <ol class="breadcrumb" style="padding: 0; background-color:#f2f1f1;">
            <li><a href="{{route('show')}}">Home</a></li>
            <li class="active" style="color:#ea5f00 ">{{$post->c_name}}</li>
            <li><a href="{{URL::to($post->c_name.'/'.$post->slug)}}">{{$post->post_title}}</a></li>

          </ol>
		<div class="row">
		   	 <div class="col-md-9">
				<div class="single_content_layout">
					<div class="item feature_news_item">
						<div class="item_img">
							<img  class="img-responsive" style="width: 100%;" src="{{'../image/'.$post->post_img}}" alt="Chania">
						</div><!--item_img-->
							<div class="item_wrapper">
								<div class="news_item_title">
									<h2><a href="{{URL::to($post->c_name.'/'.$post->slug)}}">{{$post->post_title}}</a></h2>
								</div><!--news_item_title-->
                                <?php
                                $dateString = $post->created_at;
                                $formattedDate = date('dM-Y', strtotime($dateString));
                             ?>
								<div class="item_meta"><a href="#">{{ $formattedDate}},</a> by:<a href="#">{{$post->name}}</a></div>

                                    <span class="rating">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-half-full"></i>
									</span>

									<div class="single_social_icon">
										<a class="icons-sm fb-ic" href="#"><i class="fa fa-facebook"></i><span>Facebook</span></a>
										<!--Twitter-->
										<a class="icons-sm tw-ic" href="#"><i class="fa fa-twitter"></i><span>Twitter</span></a>
										<!--Google +-->
										<a class="icons-sm gplus-ic" href="#"><i class="fa fa-google-plus"></i><span>Google Plus</span></a>
										<!--Linkedin-->
										<a class="icons-sm li-ic" href="#"><i class="fa fa-linkedin"></i><span>Linkedin</span></a>

									</div> <!--social_icon1-->

									<div class="item_content">
                                        <?php
                                        $str = "{$post->post_Description}";

                                              echo $str;
                                        ?>
                                    </div><!--item_content-->
                                    <div class="category_list">
                                        @foreach ($category as $c)
                                        <a href="{{URL::to($c->c_slug)}}">{{$c->c_name}}</a>
                                        @endforeach
                                    </div><!--category_list-->
							</div><!--item_wrapper-->
					</div><!--feature_news_item-->

					<div class="single_related_news">
					 <div class="single_media_title"><h2>Related News</h2></div>
						<div class="media_wrapper">
                            @php
    $relatedPosts = DB::table('posts')
        ->leftJoin('categories', 'posts.c_id', '=', 'categories.id')
        ->select('posts.*', 'categories.c_name')
        ->where('c_status', 1)
        ->where('posts.c_id', $post->c_id)
        ->where('posts.id', '!=', $post->id)
        ->get();



                            @endphp
                              @foreach ($relatedPosts as $r )
							<div class="media">
								<div class="media-left">
									<a href="#"><img class="media-object" src="{{'../image/'.$r->post_img}}" width="80px" height="80px" alt="Generic placeholder image"></a>
								</div><!--media-left-->
								<div class="media-body">
									<h4 class="media-heading"><a href="{{URL::to($r->c_name.'/'.$r->slug)}}">{{$r->post_title}}
									</a></h4>
                                     <?php
                                $dateString = $post->created_at;
                                $formattedDate = date('dM-Y', strtotime($dateString));
                             ?>
								<div class="item_meta"><a href="#">{{ $formattedDate}},</a> by:<a href="#">{{$post->name}}</a></div>


									<div class="media_content">
                                        <p>{{ substr(strip_tags($r->post_Description), 0, 200) . '...' }}</p>

                                    </div><!--media_content-->
								</div><!--media-body-->
							</div><!--media-->
                            @endforeach


						</div><!--media_wrapper-->
					</div><!--single_related_news-->


					<div class="ad">
						<img class="img-responsive" src="{{url('frontend/assets/img/img-single-ad.jpg')}}" alt="Chania">
					</div>

                    <div class="readers_comment">
                        <div class="single_media_title">
                          <h2>Related Comments</h2>
                        </div>





                        {{-- @if(isset($commentData)) --}}
                        @if(isset($commentData) && isset($post) && $commentData['post_id'] == $post->id )

                        <div class="media">
                            <div class="media-left">
                              <a href="#">
                                <img alt="64x64" class="media-object" data-src="assets/img/img-author1.jpg" src="{{url('frontend/assets/img/img-author1.jpg')}}" data-holder-rendered="true">
                              </a>
                            </div>
                            <div class="media-body">
                              <h2 class="media-heading">{{ $commentData['name'] }}</h2>
                              <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">

                                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </symbol>
                              </svg>

                              <div class="alert alert-danger d-flex align-items-center" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="19" height="19" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>

                                 <span class="" style="vertical-align: text-bottom;
                                 margin-left: 7px;"> Your comment is awaiting moderation</span>

                              </div>

                              {{ $commentData['comment'] }}

                              <div class="comment_article_social">
                                <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></a>
                                <a href="#" class="reply_ic_btn" data-comment-id="" data-post-id="">Reply</a>
                              </div>
                            </div>
                        </div>

                    @endif




                        @foreach($comments as $comment)
                          <div class="media">
                            <div class="media-left">
                              <a href="#">
                                <img alt="64x64" class="media-object" data-src="assets/img/img-author1.jpg" src="{{url('frontend/assets/img/img-author1.jpg')}}" data-holder-rendered="true">
                              </a>
                            </div>
                            <div class="media-body">
                              <h2 class="media-heading">{{ $comment->name }}</h2>
                              {{ $comment->comment }}

                              <div class="comment_article_social">
                                <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></a>
                                <a href="#" class="reply_ic_btn" data-comment-id="{{ $comment->id }}" data-post-id="{{ $comment->post_id }}">Reply</a>
                              </div>

                              @if($comment->replies)
                                @foreach($comment->replies as $reply)
                                  <div class="media reply">
                                    <div class="media-left">
                                      <a href="#">
                                        <img alt="64x64" class="media-object" data-src="assets/img/img-author2.jpg" src="{{url('frontend/assets/img/img-author2.jpg')}}" data-holder-rendered="true">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h2 class="media-heading">{{ $reply->name }}</h2>
                                      {{ $reply->comment }}

                                      <div class="comment_article_social">
                                        <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></a>
                                        <a href="#" class="reply_ic_btn" data-comment-id="{{ $comment->id }}" data-post-id="{{ $reply->post_id }}">Reply</a>
                                      </div>
                                    </div>
                                  </div>
                                @endforeach
                              @endif

                              <!-- Reply form -->
                              {{-- <div class="reply-form " data-comment-id="{{ $comment->id }}" data-post-id="{{ $comment->post_id }}" style="display: none;">
                                <form action="{{ route('comments.store') }}" method="POST">
                                  @csrf

                                  <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                <input type="hidden" name="post_id" value="{{ $comment->post_id }}">
                                  <div class="form-group">
                                    <input type="text" class="form-control" name="name" placeholder="Name" required>
                                  </div>
                                  <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                                  </div>
                                  <div class="form-group">
                                    <input type="hidden" class="form-control" value="1" name="Comment_status" placeholder="Comment_status">
                                  </div>
                                  <div class="form-group comment">
                                    <textarea class="form-control" name="comment" placeholder="Comment" required></textarea>
                                  </div>
                                  <button type="submit" class="btn btn-submit red">Submit</button>
                                </form>
                              </div> --}}
                            </div>
                          </div>
                        @endforeach
                      </div><!-- readers_comment -->

                      <div class="add_a_comment">
                        <div class="single_media_title">
                          <h2>Add a Comment</h2>
                        </div>
                        <div class="comment_form">
                          <form action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                              <input type="text" class="form-control" name="name" placeholder="Name" required>
                            </div>
                            <div class="form-group">
                              <input type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                              <input type="hidden" class="form-control" value="0" name="Comment_status" placeholder="Comment_status">
                            </div>
                            <div class="form-group comment">
                              <textarea class="form-control" name="comment" placeholder="Comment" required></textarea>
                            </div>
                            {{-- @php
                                $p=DB::table('posts')->get();
                            @endphp
                            @foreach ( $p as $pa) --}}


                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            {{-- @endforeach --}}
                            <button type="submit" class="btn btn-submit red">Submit</button>
                          </form>
                        </div><!-- comment_form -->
                      </div><!-- add_a_comment -->


                      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                      <script>
                        $(document).ready(function() {
                          // Reply button click event
                          $(document).on('click', '.reply_ic_btn', function(event) {
                            event.preventDefault();

                            // Get the comment ID
                            var commentId = $(this).data('comment-id');

                            // Show/hide the corresponding reply form
                            $('.reply-form[data-comment-id="' + commentId + '"]').toggle();
                          });
                        });
                      </script>





				</div><!--single_content_layout-->
		   	 </div>

			<div class="col-md-3">

				<div class="tab sitebar">
					<ul class="nav nav-tabs">
						<li class="active"><a  href="#1" data-toggle="tab">Latest</a></li>
						<li><a href="#2" data-toggle="tab">Populer</a></li>
					</ul>

					<div class="tab-content">
						<div class="tab-pane active" id="1">
                            @php
                            $recent=DB::table('posts') ->leftjoin('categories', 'posts.c_id', '=', 'categories.id')->where("c_status",1)->orderBy('posts.created_at','desc')->limit(5)->get();
                        @endphp
                         @foreach ($recent as $newallpost )
							<div class="media">
								<div class="media-left">
                                    <a href="#"><img class="media-object" src="{{'../image/'.$newallpost->post_img}}" width="80px " height="80px" alt="Generic placeholder image"></a>								</div><!--media-left-->
								<div class="media-body">
									<h3 class="media-heading"><a href="{{URL::to($newallpost->c_name.'/'.$newallpost->slug)}}">{{$newallpost->post_title}}</a></h3>
									<span class="rating">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-half-full"></i>
									</span>
								</div><!--media-body-->
							</div><!--media-->
                            @endforeach


						</div><!--tab-pane-->

						<div class="tab-pane" id="2">
                            @php
                            $popular=DB::table('posts') ->leftjoin('categories', 'posts.c_id', '=', 'categories.id')->where("c_status",1)->orderBy('posts.view','desc')->limit(5)->get();
                        @endphp
                            @foreach ($popular as $p )
							<div class="media">
								<div class="media-left">
									<a href="#"><img class="media-object" src="{{'../image/'.$p->post_img}}" width="80px" height="80px" alt="Generic placeholder image"></a>
								</div><!--media-left-->
								<div class="media-body">
									<h3 class="media-heading"><a href="{{URL::to($p->c_name.'/'.$p->slug)}}">{{$p->post_title}}</a></h3>
									<span class="rating">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-half-full"></i>
									</span>
								</div><!--media-body-->
							</div><!--media-->
                            @endforeach


						</div><!--tab-pane-->
					</div><!--tab-content-->
				</div><!--tab-->

				{{-- <div class="ad">
					<img class="img-responsive" src="assets/img/img-sitebar.jpg" alt="img" />
					<img class="img-responsive" src="assets/img/img-sitebar.jpg" alt="img" />
					<img class="img-responsive" src="assets/img/img-sitebar.jpg" alt="img" />
					<img class="img-responsive" src="assets/img/img-sitebar.jpg" alt="img" />
				</div><!--ad-->

				<div class="ad">
					<img class="img-responsive" src="assets/img/img-ad.jpg" alt="img" />
				</div>

				<div class="ad">
					<img class="img-responsive" src="assets/img/img-ad2.jpg" alt="img" />
				</div> --}}

				<div class="most_comment">
                    <div class="sidebar_title">
                        <h2>Most Commented</h2>
                    </div>
                    @if ($mostCommentedPost)
                    @foreach ($mostCommentedPost as $mostCommentedPost )


                        <div class="media">
                            <div class="media-left">
                                <a href="#"><img class="media-object" src="{{ '../image/' . $mostCommentedPost->post_img }}"
                                        alt="Generic placeholder image" height="80px " width="80px"></a>
                            </div>
                            <!--media-left-->
                            <div class="media-body">
                                <h3 class="media-heading"><a href="{{URL::to($mostCommentedPost->c_name.'/'.$mostCommentedPost->slug)}}">{{ $mostCommentedPost->post_title }}</a></h3>
                                <div class="comment_box">
                                    <div class="comments_icon">
                                        <i class="fa fa-comments" aria-hidden="true"></i>
                                    </div>
                                    <div class="comments"><a href="{{URL::to($mostCommentedPost->c_name.'/'.$mostCommentedPost->slug)}}">{{ $mostCommentedPost->comment_count }} Comments</a></div>
                                </div>
                                <!--comment_box-->
                            </div>
                            <!--media-body-->
                        </div>
                        @endforeach
                    @else
                        <p>No posts found.</p>
                    @endif
                </div>
			</div>
		</div>
</section><!--feature_category_section-->

@endsection
