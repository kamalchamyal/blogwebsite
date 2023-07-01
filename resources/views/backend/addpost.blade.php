@extends('layouts.app')

@section('content')
<link  href="{{url('richtexteditor/rte_theme_default.css')}}" rel="stylesheet" type="text/css">
<script  src="{{url('richtexteditor/rte.js')}}" type="text/javascript"></script>
<script src="{{url('richtexteditor/plugins.js')}}" type="text/javascript" ></script>
<div class="container">
<div class="row">
<div class=" col-md-6 text-dark">
    <h2>Add New Post</h2>
</div>
<div class="text-right col-md-6">
    <a class="btn btn-primary" href="{{route('post.index') }}"> Back</a>
</div>
</div>




@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

     <div class="row">
        <div class="form-group">
            <strong>Category Name:</strong>
            <select name="c_id" class="form-control form-control-lg">
              @foreach($category as $key => $k)
              <option value="{{$k->id}}">{{$k->c_name}}</option>

              @endforeach
          </select>

          </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Title:</strong>
                <input type="text" name="post_title" class="form-control" placeholder="" required >
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                <textarea id="div_editor1" name="post_Description" required></textarea>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Image:</strong>
               <input type="file" name="post_img" class="form-control" placeholder="" required>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Banner Image:</strong>
               <input type="file" name="banner_img" class="form-control" placeholder="" required>
            </div>
        </div>

          </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</div>
</form>
@endsection
@section('extra-footer')

<script>
  var editor1 = new RichTextEditor("#div_editor1");
  //editor1.setHTMLCode("Use inline HTML or setHTMLCode to init the default content.");
</script>
@endsection
