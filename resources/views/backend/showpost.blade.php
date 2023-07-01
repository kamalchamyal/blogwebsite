@extends('layouts.app')

@section('content')






<div class="container">
<h1>View Post </h1><hr>



    <!-- Jumbotron -->
    <div id="intro" class="p-5 text-center bg-light">

      <h1 class="mb-0 h4">Post Category id -  <mark>{{ $post->c_id}} </mark></h1><hr>
      <h1 class="mb-0 h4">Post Title - <mark>{{ $post->post_title}}</mark></h1><hr>
    </div>



      <!--Grid row-->
      <div class="row">

        <div class="border-bottom mb-4 col-md-6">
            <h3>Post Image</h3>
               @if ("image/{{ $post->post_img }}")
               <img src="{{'/image/'.$post->post_img }}" height="200px" width="200px" class="img-fluid shadow-2-strong rounded-5 mb-4">
             <p>{{$post->created_at}}</p>
           @else
                   <p>No image found</p>
           @endif


             </div>
             <div class="border-bottom mb-4 col-md-6">
                <h3>Banner Image</h3>
                @if ("banner/{{ $post->banner_img }}")
                <img src="{{'/banner/'.$post->banner_img}}" height="200px" width="400px" alt="No Banner image ">
            @else
                    <p>No banner image found</p>
            @endif
              </div>
      </div>
     <h1 class="h1"> <?php

      $str="{$post->post_Description}";

      echo $str;
      ?></h1>

</div>

          <!--Section: Post data-mdb-->










@endsection
