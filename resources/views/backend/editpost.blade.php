@extends('layouts.app')

@section('content')




<link  href="{{url('richtexteditor/rte_theme_default.css')}}" rel="stylesheet" type="text/css">
<script  src="{{url('richtexteditor/rte.js')}}" type="text/javascript"></script>
<script src="{{url('richtexteditor/plugins.js')}}" type="text/javascript" ></script>






            <!-- Default Card Example -->
            <div class="card mb-4">
              <div class="card-header">
                <h1>Update Post </h1>
              </div>
              <div class="card-body">
                {{-- <form method="POST" action="{{ route('post.update',$posts->id) }}"  enctype="multipart/form-data">
                  @csrf --}}
                  <form action="{{ route('post.update',$posts->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')


{{--
                  <div class="form-group">
  <label for="exampleInputPassword1">Post category</label>
  <input type="text" class="form-control"  placeholder="Enter Post Category " name="c_id" value="{{ $posts->c_id}}">
</div> --}}
<div class="form-group">
  <label for="exampleInputEmail1">Category Name</label>
  <select name="c_id" class="form-control form-control-lg">
    @foreach($categorie as $key => $v)
    <option value="{{$v->id}}">{{$v->c_name}}</option>

    @endforeach
</select>

</div>
<div class="form-group">
  <label for="exampleInputPassword1">Post Title</label>
  <input type="text" class="form-control"  placeholder="Enter Post title " name="post_title" value="{{ $posts->post_title}}">
</div>
<div class="form-group">

<div class="centered ">
<label for="exampleInputPassword1">Post Description</label>

  <textarea id="div_editor1" name="post_Description" value="{{ $posts->post_Description}}">{{ $posts->post_Description}}</textarea>



</div>
</div>

<div class="form-group">
 @if ("image/{{ $posts->post_img }}")
      <img src="{{'/image/'.$posts->post_img }}" height="100px" width="150px">
  @else
          <p>No image found</p>
  @endif
  <label for="exampleInputPassword1"><mark>Post image</mark></label>

  <input type="file" class="form-control" name="post_img" value="">


</div>

<div class="form-group">
    @if ("image/{{ $posts->banner_img }}")
         <img src="{{'/banner/'.$posts->banner_img }}" height="100px" width="150px">
     @else
             <p>No image found</p>
     @endif
     <label for="exampleInputPassword1"><mark>Banner image</mark></label>

     <input type="file" class="form-control" name="banner_img" value="">


   </div>



<button type="submit" class="btn btn-success btn-block"><i class="fas fa-check"></i>Update Post </button>
</form>



    </div>
</div>






            @endsection
@section('extra-footer')
<script>
  var editor1 = new RichTextEditor("#div_editor1");
  //editor1.setHTMLCode("Use inline HTML or setHTMLCode to init the default content.");
</script>


@endsection
