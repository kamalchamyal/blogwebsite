@extends('layouts.app')
<style>
@media screen and (max-width: 781px) {
    #reply-table {

        display: block;
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;

    }
  }
  </style>
@section('content')
<div class="col-md-11 mx-auto card">
    <div class="my-3 row">
        <div class="col">
            <h3 class=""> Comment</h3>
        </div>
        <div class="col text-right">
            <button type="button" class="btn btn-warning position-relative">
                Pending
                <span id="comment-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $count }}
                    <span class="visually-hidden">unread messages</span>
                </span>
            </button>
        </div>
    </div>
    <table class="table table-bordered table-responsive mb-4">
        <thead>
            <tr>
                <th scope="col">comment_id</th>
                <th scope="col">user name</th>
                <th scope="col">Post title</th>
                <th scope="col">Comment</th>
                <th scope="col">Reply</th>
                <th scope="col">Status</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comments as  $c)
            <tr>
                <th scope="row">{{$c->id }}</th>
                <th scope="row">{{$c->name }}</th>
                <td>{{$c->post_title}}</td>
                <td>{{$c->comment}}</td>
                <td>
                    <a name="" id="" class="btn btn-primary" href="#" role="button" data-bs-toggle="modal" data-bs-target="#replyModal{{$c->id}}">Reply</a>
                </td>
                <td>
                    @if ($c->Comment_status == 1)
                    <button class="status-toggle-button btn btn-success" onclick="statusChange(this)" data-comment-id="{{ $c->id }}" data-status="1">Approved</button>
                    @else
                    <button class="status-toggle-button btn btn-danger" onclick="statusChange(this)" data-comment-id="{{ $c->id }}" data-status="0">Unapproved</button>
                    @endif
                </td>
                <td>
                    <form action="{{ route('comments.destroy',$c->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment and its replies?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn btn-lg overflow-hidden" style="box-shadow: none;border:0">
                            <i class="fas fa-trash text-danger"></i>
                        </button>
                    </form>
                </td>
            </tr>
            <div class="modal fade" id="replyModal{{$c->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="">
                                <h5 class="modal-title" id="exampleModalLabel">Reply</h5>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="mr-2">
                            <p class="error-messages text-danger mx-3"></p>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('comments.replystore') }}" method="POST" id="myForm{{$c->id}}">
                                @csrf
                                <input type="hidden" name="parent_id" value="{{ $c->id }}">
                                <input type="hidden" name="post_id" value="{{ $c->post_id }}">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="name" value="Admin" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="email" value="kamal.kamals97@gmail.com" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" value="1" name="Comment_status" placeholder="Comment_status">
                                </div>
                                <div class="form-group comment">
                                    <textarea class="form-control" name="comment" placeholder="Comment"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="submitMe('{{$c->id}}')">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
    {!! $comments->links() !!}
</div>

<div class="col-md-11 mx-auto card mt-3">
    <div class="my-3 row">
        <div class="col">
            <h3 class="">Reply</h3>
        </div>
        <div class="col text-right">
            <button id="delete-selected-replies" class="btn btn-danger">Delete</button>
        </div>
    </div>


    <table class="table table-bordered mb-4" id="reply-table">
        <thead>
            <tr>
                <th scope="col">Comment_ID</th>
                <th scope="col">Post Title</th>
                <th scope="col">Name</th>
                <th scope="col">Comment</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comments as $c)
                @foreach ($c->replies as $reply)
                    <tr>
                        <th scope="row">{{ $c->id }}</th>
                        <td>{{ $c->post_title }}</td>
                        <td>{{ $reply->name }}</td>
                        <td>{{ $reply->comment }}</td>
                        <td>
                            <input type="checkbox" class="reply-checkbox" value="{{ $reply->id }}">
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>



    </div>
    <script>
        $(document).ready(function() {
            $('#delete-selected-replies').click(function() {
                var selectedReplies = $('.reply-checkbox:checked');

                if (selectedReplies.length > 0) {
                    if (confirm('Are you sure you want to delete the selected replies?')) {
                        var replyIds = [];

                        selectedReplies.each(function() {
                            replyIds.push($(this).val());
                        });

                        $.ajax({
                            url: '{{ route("delete.selected.replies") }}',
                            type: 'DELETE',
                            data: {
                                replyIds: replyIds
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                alert('Selected replies deleted successfully');

                                // Remove deleted rows from the table
                                selectedReplies.closest('tr').remove();
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                alert('An error occurred while deleting the replies');
                            }
                        });
                    }
                } else {
                    alert('No replies selected');
                }
            });
        });
    </script>


    <script>
        function updateReplyTable() {
            $.ajax({
                type: 'GET',
                url: "{{ route('replies.index') }}",
                success: function(response) {
                    // Clear the existing table rows
                    $('#reply-table tbody').empty();

                    // Loop through the response data and add new rows to the table
                    for (var i = 0; i < response.length; i++) {
                        var reply = response[i];
                        var newRow = '<tr>' +
                            '<th scope="row">' + reply.parent_id + '</th>' +
                            '<td>' + reply.post_title + '</td>' +
                            '<td>' + reply.name + '</td>' +
                            '<td>' + reply.comment + '</td>' +
                            '<td>' +
    '<input type="checkbox" class="reply-checkbox" value="' + reply.id + '">' +
    '</td>' +
                            '</tr>';

                        $('#reply-table tbody').append(newRow);
                    }
                },
                error: function(xhr) {
                    console.log(xhr);
                }
            });
        }
    </script>

<script>
    function submitMe(commentId) {
        var form = document.getElementById('myForm' + commentId);
        var formData = new FormData(form);

        $.ajax({
            url: form.getAttribute('action'),
            type: form.getAttribute('method'),
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response == true) {
                    alert('Success');
                    $('.modal').modal('hide');
                    updateReplyTable();
                }
            },
            error: function(response) {
                var errors = response.responseJSON.errors;
                var errorMessages = '';

                for (var key in errors) {
                    if (errors.hasOwnProperty(key)) {
                        errorMessages += '*' + errors[key] + '<br>';
                    }
                }

                $('.error-messages').html(errorMessages);
            }
        });
    }
</script>


<script>
    function statusChange(button) {
        var commentId = $(button).data('comment-id');
        var url = "{{ route('comments.toggle-status', ':id') }}".replace(':id', commentId);

        $.ajax({
            type: 'POST',
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status === 1) {
                    $(button).text('Approved');
                    $(button).removeClass('btn-danger').addClass('btn-success');
                } else {
                    $(button).text('Unapproved');
                    $(button).removeClass('btn-success').addClass('btn-danger');
                }
                // window.location.href = "{{ url('comments') }}";
                updateCommentCount();
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
    }
    function updateCommentCount() {
        $.ajax({
            type: 'GET',
            url: "{{ route('comments.count') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Update the comment count element on the view
                $('#comment-count').text(response.count);
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
    }

</script>


@endsection
