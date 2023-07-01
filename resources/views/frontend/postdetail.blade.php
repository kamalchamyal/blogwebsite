@extends('layouts.frontend')

@section('content')
	<!-- Feature Category Section & sidebar -->
	<section id="feature_category_section" class="feature_category_section category_page section_wrapper">
        <div class="container">
            <div class="row">
                   <div class="col-md-9">
                    @if (!empty($latestpost[0]))

                       <div class="row">
                        <div class="col-md-12">
                            <div class="feature_news_item category_item">
                                <div class="item">
                                    <div class="item_wrapper">
                                        <div class="item_img">
                                            <img class="" style="width: 100%; height:auto; display:block" src="{{('./image/'. $latestpost[0]->post_img)}}" alt="Chania">
                                        </div><!--item_img-->
                                        <div class="item_title_date">
                                            <div class="news_item_title">
                                                <h1><a href="{{URL::to($latestpost[0]->c_name.'/'.$latestpost[0]->slug)}}">{{$latestpost[0]->post_title}}</a></h1>
                                            </div><!--news_item_title-->
                                            <?php
                                            $dateString = $latestpost[0]->created_at;
                                            $formattedDate = date('dM-Y', strtotime($dateString));
                                         ?>
                                            <div class="item_meta"><a href="#">{{$formattedDate}},</a> by:<a href="#">Jhonson</a></div>
                                        </div><!--item_title_date-->
                                    </div><!--item_wrapper-->
                                    <div class="item_content">
                                    @php
                                          $str = "{$latestpost[0]->post_Description}";
                                          $limitedText = Str::limit($str, 220);
                                          echo $limitedText;
                                    @endphp
                                    </div><!--item_content-->

                                </div><!--item-->

                            </div><!--feature_news_item-->
                        </div><!--col-md-6-->
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            @foreach ($latestpost as $key => $post)
                            @if ($key > 0)
                            <div class="feature_news_item">
                                <div class="item">
                                    <div class="item_wrapper">
                                        <div class="item_img">
                                            <img class="img-responsive" src="{{'./image/'. $post->post_img}}" alt="Chania">
                                        </div> <!--item_img-->
                                        <div class="item_title_date">
                                            <div class="news_item_title">
                                                <h2><a href="single.html">{{$post->post_title}}</a></h2>
                                            </div>
                                            <?php
                                            $dateString = $latestpost[0]->created_at;
                                            $formattedDate = date('dM-Y', strtotime($dateString));
                                         ?>
                                            <div class="item_meta"><a href="#">{{$formattedDate}},</a> by:<a href="#">Jhonson</a></div>
                                        </div><!--item_title_date-->
                                    </div> <!--item_wrapper-->
                                    <div class="item_content">
                                        @php
                                        $str = "{$post->post_Description}";
                                        $limitedText = Str::limit($str, 50);
                                        echo $limitedText;
                                  @endphp
                                    </div>

                                </div><!--item-->
                            </div><!--feature_news_item-->
                            @endif
                            @endforeach

                        </div><!--col-md-6-->
                    </div><!--row-->

                    @else
                    <p>No posts found.</p>
                    @endif

                   </div><!--col-md-9-->

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
                                        <a href="#"><img class="media-object" src="{{'./image/'.$newallpost->post_img}}" width="80px " height="80px" alt="Generic placeholder image"></a>
                                    </div><!--media-left-->
                                    <div class="media-body">
                                        <h4 class="media-heading"><a href="#">{{$newallpost->post_title}}</a></h4>
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
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#"><img class="media-object" src="assets/img/img-list4.jpg" alt="Generic placeholder image"></a>
                                    </div><!--media-left-->
                                    <div class="media-body">
                                        <h3 class="media-heading"><a href="#">Spain going to made class football</a></h3>
                                        <span class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-full"></i>
                                        </span>
                                    </div><!--media-body-->
                                </div><!--media-->

                                <div class="media">
                                    <div class="media-left">
                                        <a href="#"><img class="media-object" src="assets/img/img-list.jpg" alt="Generic placeholder image"></a>
                                    </div><!--media-left-->
                                    <div class="media-body">
                                        <h3 class="media-heading"><a href="#">Spain going to made class football</a></h3>
                                        <span class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-full"></i>
                                        </span>
                                    </div><!--media-body-->
                                </div><!--media-->
                            </div><!--tab-pane-->
                        </div><!--tab-content-->
                    </div><!--tab-->

                    <div class="ad">
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
                    </div>

                    <div class="most_comment">
                        <div class="sidebar_title">
                            <h2>Most Commented</h2>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <a href="#"><img class="media-object" src="assets/img/img-list.jpg" alt="Generic placeholder image"></a>
                            </div><!--media-left-->
                            <div class="media-body">
                                <h3 class="media-heading"><a href="#">Spain going to made class football</a></h3>
                                <div class="comment_box">
                                    <div class="comments_icon"> <i class="fa fa-comments" aria-hidden="true"></i></div>
                                    <div class="comments"><a href="#">9 Comments</a></div>
                                </div><!--comment_box-->
                            </div><!--media-body-->
                        </div><!--media-->
                        <div class="media">
                            <div class="media-left">
                                <a href="#"><img class="media-object" src="assets/img/img-list2.jpg" alt="Generic placeholder image"></a>
                            </div><!--media-left-->
                            <div class="media-body">
                                <h3 class="media-heading"><a href="#">Spain going to made class football</a></h3>
                                <div class="comment_box">
                                    <div class="comments_icon"> <i class="fa fa-comments" aria-hidden="true"></i></div>
                                    <div class="comments"><a href="#">20 Comments</a></div>
                                </div><!--comment_box-->
                            </div><!--media-body-->
                        </div><!--media-->
                        <div class="media">
                            <div class="media-left">
                                <a href="#"><img class="media-object" src="assets/img/img-list3.jpg" alt="Generic placeholder image"></a>
                            </div><!--media-left-->
                            <div class="media-body">
                                <h3 class="media-heading"><a href="#">Spain going to made class football</a></h3>
                                <div class="comment_box">
                                    <div class="comments_icon"> <i class="fa fa-comments" aria-hidden="true"></i></div>
                                    <div class="comments"><a href="#">23 Comments</a></div>
                                </div><!--comment_box-->
                            </div><!--media-body-->
                        </div><!--media-->
                        <div class="media">
                            <div class="media-left">
                                <a href="#"><img class="media-object" src="assets/img/img-list3.jpg" alt="Generic placeholder image"></a>
                            </div><!--media-left-->
                            <div class="media-body">
                                <h3 class="media-heading"><a href="#">Spain going to made class football</a></h3>
                                <div class="comment_box">
                                    <div class="comments_icon"> <i class="fa fa-comments" aria-hidden="true"></i></div>
                                    <div class="comments"><a href="#">44 Comments</a></div>
                                </div><!--comment_box-->
                            </div><!--media-body-->
                        </div><!--media-->
                    </div><!--most_comment-->
                </div>
            </div>
    </section><!--feature_category_section-->


@endsection
