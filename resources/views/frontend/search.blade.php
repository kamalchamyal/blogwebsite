@extends('layouts.frontend')
@section('content')
<div class="container">
<div class="row">
    @if ($posts->count() > 0)
    @foreach ($posts as $post)
    <div class="col-md-6 " style="margin-bottom: 5px">


        <div class="feature_news_item">
            <div class="item">
                <div class="item_wrapper">
                    <div class="item_img">
                        <img class=" " src="{{'./image/'. $post->post_img}}" alt="Chania" height="400px"  style="width: 100%">
                    </div> <!--item_img-->
                    <div class="item_title_date">
                        <div class="news_item_title">
                            <h2><a href="{{URL::to($post->c_name.'/'.$post->slug)}}">{{$post->post_title}}</a></h2>
                        </div>
                        <?php
                        $dateString = $post->created_at;
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



    </div><!--col-md-6-->
    @endforeach
    @else
    <p>No results found.</p>
@endif

</div><!--row-->
</div>
@endsection
