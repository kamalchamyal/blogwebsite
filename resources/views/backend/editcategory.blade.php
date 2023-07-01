@extends('layouts.app')

@section('content')
    <div class="col-md-10 card py-2 mx-auto">

        <div class="row">
            {{-- <div class="col-md-6 text-dark">
                <h2>Edit Category</h2>
            </div>
            <div class="col-md-6 text-right">
                <a class="btn btn-primary" href="{{ route('category.index') }}"> Back</a>
            </div> --}}
            <div class="d-flex bd-highlight">
                <div class=" flex-grow-1 bd-highlight h3">Edit Category</div>
                <div class=" bd-highlight"><a class="btn btn-primary" href="{{ route('category.index') }}"> Back</a></div>

              </div>
        </div>



    @if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <form action="{{ route('category.update',$categorie->id) }}" method="POST">
        @csrf
        @method('PUT')

         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Category Name:</strong>
                    <input type="text" name="c_name" value="{{ $categorie->c_name }}" class="form-control" placeholder="Name" required>
                </div>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Category Status</label>
                <select name="c_status" class="form-control">
                    <option value="1" {{ $categorie->c_status == 1 ? 'selected' : '' }}>Enable</option>
                    <option value="0" {{ $categorie->c_status == 0 ? 'selected' : '' }}>Disable</option>
                </select>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-start">
              <button type="Update" class="btn btn-primary ">Submit</button>
            </div>
        </div>

    </form>
    </div>
@endsection
