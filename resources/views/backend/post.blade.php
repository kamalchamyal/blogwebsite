@extends('layouts.app')

@section('content')


<div class="col-11 mx-auto card py-3 ">
    <div class="row mb-4">
        <div class="col-md-6 ">
            <h4>Post</h4>
        </div>
        <div class="col-md-6 text-right">
            <a class="btn btn-primary" href="{{ route('post.create') }}"> Add Post</a>
        </div>
    </div>







    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <form action="{{ route('post.index') }}" method="GET" role="search">

        <div class="input-group col-md-6 mb-2">
            <span class="input-group-btn mr-2 ">
                <button class="btn btn-info" type="submit" title="Search projects">
                    <span class="fas fa-search"></span>
                </button>
            </span>
            <input type="text" class="form-control mr-2" name="term" placeholder="Search Category" id="term">
            <a href="{{ route('post.index') }}" class=" ">
                <span class="input-group-btn">
                    <button class="btn btn-danger" type="button" title="Refresh page">
                        <span class="fas fa-sync-alt"></span>
                    </button>
                </span>
            </a>
        </div>
    </form>

    <table class="table table-bordered table-responsive">
        <tr>
            <th>id</th>
            <th>category name</th>
            <th>title</th>
            <th>Image</th>
            <th>banner</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($post as $p)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $p->c_name }}</td>
            <td >{{ $p->post_title }}</td>

                {{-- @php



                $str="{$p->post_Description}";
                echo "$str" ;
                @endphp --}}

            <td><a href="{{asset('image/'. $p->post_img)}}" target="_blank"><img src="{{asset('image/'. $p->post_img)}}" alt="post img" width="50px" height="50px"></a>
            </td>
            <td><a href="{{asset('banner/'. $p->banner_img)}}" target="_blank"><img src="{{asset('banner/'. $p->banner_img)}}" alt="No banner img" width="50px" height="50px"></a>

                       </td>
            <td>
{{-- @if (isset(Auth::user()->id) && Auth::user()->id == $c->user_id) --}}
                <form action="{{ route('post.destroy',$p->id) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('post.show',$p->id) }}">Show</a>

                    <a class="btn btn-primary" href="{{ route('post.edit',$p->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
{{-- @endif --}}
            </td>
        </tr>
        @endforeach
    </table>
    {!! $post->links() !!}
</div>


@endsection
