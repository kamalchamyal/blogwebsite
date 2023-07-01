@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Product</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('form.index') }}"> Back</a>
        </div>
    </div>
</div>



<form action="{{ route('form.store') }}" method="POST">
    @csrf

     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Category Status</label>
            {{-- <input type="number" class="form-control" name="status"  placeholder="Enter Category Status" required> --}}
            <select name="status" class="form-control">
              <option value="1">Enable</option>
              <option value="0">Disable</option>
            </select>

          </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>

</form>

@endsection
