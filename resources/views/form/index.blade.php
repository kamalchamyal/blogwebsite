@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 CRUD Example from scratch - ItSolutionStuff.com</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('form.create') }}"> Create New Product</a>
            </div>
        </div>
    </div>


<div>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Status</th>

            <th width="280px">Action</th>
        </tr>
        @foreach ($form as $form)
        <tr>
            <td>{{$form->id}}</td>
            <td>{{ $form->name }}</td>
            <td>
                <?php if($form->status == '1'){ ?>

                    <a href="{{url('/status-update',$form->id)}}" class="btn btn-info">Enable</a>

                  <?php }else{ ?>

                    <a href="{{url('/status-update',$form->id)}}" class="btn btn-danger">Disable</a>

                  <?php } ?>


        </td>
            <td>
                <form action="{{ route('form.destroy',$form->id) }}" method="POST">


                    <a class="btn btn-info" href="{{ route('form.show',$form->id) }}">Show</a>

                    <a class="btn btn-primary" href="{{ route('form.edit',$form->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>


</div>
@endsection
