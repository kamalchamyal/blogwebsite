@extends('layouts.frontend')
@section('content')
 <!-- Feature Carousel Section -->
 <section id="feature_news_section" class="feature_news_section section_wrapper">
	<div class="container">
	    <div class="row">
	    	<div class="col-md-6">
	    		<div class="feature_news_carousel">
					<div id="featured-news-carousal" class="carousel slide" data-ride="carousel">
					    <!-- Wrapper for slides -->
						<div class="carousel-inner" role="listbox">
                            @php
                            $posts = App\Models\Post::where("c_status",1)->leftJoin("users", "users.id", "=", "posts.added_by")->leftJoin("categories", "posts.c_id", "=", "categories.id")->get(); // Fetch the posts from the database, assuming you have a 'posts' table and 'Post' model
                        @endphp
                        @foreach ($posts as $key=> $banner)
                        @if($banner->post_img)
                            <div class="item{{ $key === 0 ? ' active' : '' }} feature_news_item">
								<div class="item_wrapper">
									<div class="item_img">
										<img class="img-responsive" style="width: 100%;height:360px; display:block" src="{{url('image/'.$banner->post_img)}}"  alt="Chania" >
									</div> <!--item_img-->
									<div class="item_title_date">
										<div class="news_item_title">
                                        {{-- @php
                                            dd($banner)
                                        @endphp --}}
											<h2><a href="{{URL::to($banner->c_name.'/'.$banner->slug)}}">{{$banner->post_title}}</a></h2>
										</div>
                                        <?php
                                        $dateString = $banner->created_at;
                                        $formattedDate = date('dM-Y', strtotime($dateString));
                                     ?>
										<div class="item_meta"><a href="#"> {{$formattedDate}} ,</a> by:<a href="#">{{$banner->name}}</a></div>
									</div> <!--item_title_date-->
								</div>	<!--item_wrapper-->
							    <div class="item_content " >
                                      <?php
                                    $str = "{$banner->post_Description}";
                                        $limitedText = Str::limit($str, 100);
                                          echo $limitedText;
                                    ?></div>

							</div><!--feature_news_item-->
                            @endif
                            @endforeach

					  		<!-- Left and right controls -->
							<div class="control-wrapper">
								<a class="left carousel-control" href="#featured-news-carousal" role="button" data-slide="prev">
									<i class="fa fa-chevron-left" aria-hidden="true"></i>
								</a>
								<a class="right carousel-control" href="#featured-news-carousal" role="button" data-slide="next">
									<i class="fa fa-chevron-right" aria-hidden="true"></i>
								</a>
							</div>
						</div><!--carousel-inner-->
	    			</div><!--carousel-->
	    		</div><!--feature_news_carousel-->
	    	</div><!--col-md-6-->

            <div class="col-md-6">
	    		<div class="feature_news_static">
		    		<div class="row">
                        @php
                        $posts = App\Models\Post::where("c_status", 1)
->leftJoin("users", "users.id", "=", "posts.added_by")
->leftJoin("categories", "posts.c_id", "=", "categories.id")
->inRandomOrder()  // Add this line to randomize the order
->limit(2)         // Add this line to limit the results to 2 posts
->get();

                    @endphp
                        @foreach ($posts as $post)
						<div class="col-md-6">




							<div class="feature_news_item">

	                			<div class="item active">
									<div class="item_wrapper">
										<div class="item_img">
											<img class="img-res" style="width: 100%;height:360px; display:block" src="{{url('image/'.$post->post_img)}}" alt="Chania">
										</div> <!--item_img-->
										<div class="item_title_date">
											<div class="news_item_title">
												<h2><a href="{{URL::to($post->c_name.'/'.$post->slug)}}">    {{ \Illuminate\Support\Str::words($post->post_title, 5, '...') }}
                                                </a></h2>
											</div>
                                            <?php
                                            $dateString = $post->created_at;
                                            $formattedDate = date('dM-Y', strtotime($dateString));
                                         ?>
                                            <div class="item_meta"><a href="#">{{$formattedDate}}</a> by:<a href="#">{{$post->name}}</a></div>
										</div><!--item_title_date-->
									</div> <!--item_wrapper-->
								    <div class="item_content">
                                        <?php
                                        $str = "{$post->post_Description}";
                                            $limitedText = Str::limit($str, 50);
                                              echo $limitedText;
                                        ?>
								    </div>

								</div><!--item-->

	            			</div><!--feature_news_item-->

						</div>
                        @endforeach

					</div><!--row-->
	    		</div><!--feature_news_static-->
	    	</div><!--col-md-6-->
	    </div><!--row-->
	</div><!--container-->
</section><!--feature_news_section-->



<!-- Feature Category Section & sidebar -->
<section id="feature_category_section" class="feature_category_section section_wrapper">
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                @foreach ($latestPosts as $c)
                <div class="category_layout">

                    <div class="item_caregory red">
                        <h2><a href="category.html">{{$c->c_name}}</a></h2>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="item feature_news_item">
                                <div class="item_wrapper">
                                    <div class="item_img">
                                        <img class="img-responsive" style="height: 360px" src="{{url('image/'.$c->post_img)}}" alt="Chania">
                                    </div>
                                    <!--item_img-->
                                    <div class="item_title_date">
                                        <div class="news_item_title">
                                            <h2><a href="{{URL::to($c->c_name.'/'.$c->slug)}}">{{$c->post_title}}</a></h2>

                                        </div>
                                        <!--news_item_title-->
                                        <?php
                                           $dateString = $c->created_at;
                                           $formattedDate = date('dM-Y', strtotime($dateString));
                                        ?>
                                        <div class="item_meta"><a href="#">{{$formattedDate }},</a> by:<a
                                                href="#">{{$c->name}}</a>
                                        </div>
                                    </div>
                                    <!--item_title_date-->
                                </div>
                                <!--item_wrapper-->
                                <div class="item_content">
                                    <?php
                                        $str = "{$c->post_Description}";
                                            $limitedText = Str::limit($str, 100);
                                              echo $limitedText;
                                        ?>
                                </div>
                                <!--item_content-->
                            </div>
                            <!--feature_news_item-->
                        </div>
                        <!--col-md-7-->

                        <div class="col-md-5">
                            @php
                           $relatedPosts = DB::table('posts')
        ->join('categories', 'posts.c_id', '=', 'categories.id') // Join the categories table
        ->where('posts.c_id', $c->id) // Filter posts by the current category ID
        ->where('posts.id', '!=', $c->id) // Exclude the latest post from the related posts
        ->orderBy('posts.created_at', 'DESC')
        ->get();

                            @endphp


                            <div class="media_wrapper">

                                @foreach ($relatedPosts as $relatedPost)
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#"><img class="media-object"
                                                src="{{url('image/'.$relatedPost->post_img)}}"
                                                alt="Generic placeholder image" height="80px" width="80px"></a>
                                    </div>
                                    <!--media-left-->
                                    <div class="media-body">
                                        <h3 class="media-heading"><a href="{{URL::to( $relatedPost->c_name .'/'. $relatedPost->slug)}}">{{$relatedPost->post_title}}
                                            </a></h3>


                                            <p>{{ substr(strip_tags($relatedPost->post_Description), 0, 50) . '.' }}</p>

                                    </div>
                                    <!--media-body-->
                                </div>

                                @endforeach

                                <!--media-->
                            </div>
                            <!--media_wrapper-->

                        </div>
                        <!--col-md-5-->
                    </div>
                    <!--row-->
                </div>
                <!--category_layout-->




                @endforeach

            </div>
            <!--col-md-9-->


            <div class="col-md-3">

                <div class="tab sitebar">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#1" data-toggle="tab">Latest</a></li>
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
                                    <a href="#"><img class="media-object"
                                            src="{{url('image/'.$newallpost->post_img)}}"
                                            alt="Generic placeholder image" height="80px" width="80px"></a>
                                </div>
                                <!--media-left-->
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="{{URL::to($newallpost->c_name.'/'.$newallpost->slug)}}">{{$newallpost->post_title}}</a></h4>
                                    <span class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-full"></i>
                                    </span>
                                </div>
                                <!--media-body-->
                            </div>
                            @endforeach
                            <!--media-->
                        </div>
                        <!--tab-pane-->

                        <div class="tab-pane" id="2">
                            @php
                            $popular=DB::table('posts') ->leftjoin('categories', 'posts.c_id', '=', 'categories.id')->where("c_status",1)->orderBy('posts.view','desc')->limit(5)->get();
                        @endphp
                            @foreach ($popular as $p )
							<div class="media">
								<div class="media-left">
									<a href="#"><img class="media-object" src="{{'image/'.$p->post_img}}" width="80px" height="80px" alt="Generic placeholder image"></a>
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
                    </div>
                    <!--tab-content-->
                </div>
                <!--tab-->

                {{-- <div class="ad">
                    <img class="img-responsive" src="assets/img/img-sitebar.jpg" alt="img" />
                    <img class="img-responsive" src="assets/img/img-sitebar.jpg" alt="img" />
                    <img class="img-responsive" src="assets/img/img-sitebar.jpg" alt="img" />
                    <img class="img-responsive" src="assets/img/img-sitebar.jpg" alt="img" />
                </div>
                <!--ad-->

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
                                <a href="#"><img class="media-object" src="{{ 'image/' . $mostCommentedPost->post_img }}"
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

                <!--most_comment-->
            </div>

        </div>
</section>
<!--feature_category_section-->



@endsection
