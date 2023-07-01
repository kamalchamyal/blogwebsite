@extends('layouts.app')

@section('content')
<div class="col-md-10 mx-auto p-4 rounded-0 card">
<div class="row">
{{-- <div class=" col-md-6 text-dark">
    <h2>Add New Category</h2>
</div>
<div class="text-right col-md-6">
    <a class="btn btn-primary" href="{{route('category.index') }}"> Back</a>
</div> --}}
<div class="d-flex bd-highlight">
    <div class=" flex-grow-1 bd-highlight h3">Add New Category</div>
    <div class=" bd-highlight">
        <a class="btn btn-primary" href="{{route('category.index') }}"> Back</a>
    </div>

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

<form action="{{ route('category.store') }}" method="POST">
    @csrf

     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label>Category Name:</label>
                <input type="text" name="c_name" class="form-control" placeholder="" required >
            </div>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Category Status</label>
            {{-- <input type="number" class="form-control" name="status"  placeholder="Enter Category Status" required> --}}
            <select name="c_status" class="form-control">
              <option value="1">Enable</option>
              <option value="0">Disable</option>
            </select>
          </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</div>
</form>
@endsection
