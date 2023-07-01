@extends('layouts.app')

@section('content')
<div class="col-md-11 card py-2 mx-auto ">
    <div class="row mb-4">
        {{-- <div class="col-md-6 ">
            <h4>Category</h4>
        </div>
        <div class="col-md-6 text-right">
            <a class="btn btn-primary" href="{{ route('category.create') }}"> Add Category</a>
        </div> --}}
        <div class="d-flex bd-highlight">
            <div class=" flex-grow-1 bd-highlight h3">Category</div>
            <div class=" bd-highlight">
                <a class="btn btn-primary" href="{{ route('category.create') }}"> Add Category</a>
            </div>

          </div>
    </div>







    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <form action="{{ route('category.index') }}" method="GET" role="search">

        <div class="input-group col-md-6 mb-2">
            <span class="input-group-btn mr-2 ">
                <button class="btn btn-info" type="submit" title="Search projects">
                    <span class="fas fa-search"></span>
                </button>
            </span>
            <input type="text" class="form-control mr-2" name="term" placeholder="Search Category" id="term">
            <a href="{{ route('category.index') }}" class=" ">
                <span class="input-group-btn">
                    <button class="btn btn-danger" type="button" title="Refresh page">
                        <span class="fas fa-sync-alt"></span>
                    </button>
                </span>
            </a>
        </div>
    </form>

    <table class="table table-hover ">
        <tr>
            <th>id</th>
            <th>Category Name</th>
            <th>Category Slug</th>
            <th>Status</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($categories as $c)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $c->c_name }}</td>
            <td>{{ $c->c_slug }}</td>

            <td>
                @if ($c->c_status == 1)
                    <button class="status-toggle-button btn btn-success" onclick="statusChange(this)" data-category-id="{{ $c->id }}" data-status="1">Active</button>
                @else
                    <button class="status-toggle-button btn btn-danger" onclick="statusChange(this)" data-category-id="{{ $c->id }}" data-status="0">Inactive</button>
                @endif
            </td>




            <td>

                <form action="{{ route('category.destroy',$c->id) }}" method="POST">



                    <a class="btn btn-primary" href="{{ route('category.edit',$c->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>

            </td>
        </tr>
        @endforeach
    </table>
</div>
<script>
    function statusChange(button) {
        var categoryId = $(button).data('category-id');
        var url = "{{ route('category.toggleStatus', ':id') }}".replace(':id', categoryId);

        $.ajax({
            type: 'POST',
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status === 1) {
                    $(button).text('Active');
                    $(button).removeClass('btn-danger').addClass('btn-success');
                } else {
                    $(button).text('Inactive');
                    $(button).removeClass('btn-success').addClass('btn-danger');
                }
            },
            error: function(xhr) {
            }
        });
    }
    </script>


       {!! $categories->links() !!}


@endsection
