@extends('layouts.app')
@section('content')

<div class="col-md-11 mx-auto card" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
  <div class="d-flex bd-highlight">
    <div class="py-2 flex-grow-1 h3 bd-highlight" style="color: #333;">Profile Details</div>
    <div class="p-2 bd-highlight">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Edit
        </button>
    </div>
  </div>

  <div class="mb-3">
    <label for="username" class="form-label" style="font-weight: bold;">Username:</label>
    <span id="username" style="color: #666;">{{ $user->name }}</span>
  </div>

  <div class="mb-3">
    <label for="email" class="form-label" style="font-weight: bold;">Email:</label>
    <span id="email" style="color: #666;">{{ $user->email }}</span>
  </div>

  <div class="mb-3">
    <label for="password" class="form-label" style="font-weight: bold;">Password:</label>
    <span id="password" style="color: #666;">*********</span>
  </div>

</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editProfileForm" action="{{ route('edit.profile', ['id' => $user->id]) }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" placeholder="Enter your new username">
              <div class="invalid-feedback text-start mt-2" style="color: #F00;font: 13px Arial, Helvetica, sans-serif;    padding: 9px 0px;"></div>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}" placeholder="Enter your new email address">
              <div class="invalid-feedback text-start mt-2" style="color: #F00;font: 13px Arial, Helvetica, sans-serif;    padding: 9px 0px;"></div>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Enter your new password" required>
              <div class="invalid-feedback text-start mt-2" style="color: #F00;font: 13px Arial, Helvetica, sans-serif;    padding: 9px 0px;"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="submitForm()">Submit</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </form>

      </div>
    </div>
  </div>
</div>

<script>
    function submitForm() {
  event.preventDefault();

  var form = $('#editProfileForm');
  var formData = form.serialize();
  var url=form.attr('action')

  $.ajax({
    url: url,
    type: 'POST',
    data: formData,
    dataType: 'json',
    success: function(response) {
        if (response == true) {
                    alert('profile updated');
                    var name = $('input[name="name"]').val();
    var email = $('input[name="email"]').val();
    $('#username').text(name);
    $('#email').text(email);
                    $('#exampleModal').modal('hide');
                    $('input').removeClass('is-invalid');
                }else{
                    alert('profile not updated')
                }
    },
    error: function(response) {
    var errors = response.responseJSON.errors;





    if (errors.hasOwnProperty('password')) {
        $('input[name="password"]').addClass('is-invalid');
        $('input[name="password"]').siblings('.invalid-feedback').text('*'+ errors.password[0]);
    } else {
        $('input[name="password"]').removeClass('is-invalid');
        $('input[name="password"]').siblings('.invalid-feedback').text('');
    }
    if (errors.hasOwnProperty('email')) {
        $('input[name="email"]').addClass('is-invalid');
        $('input[name="email"]').siblings('.invalid-feedback').text(errors.email[0]);
    } else {
        $('input[name="email"]').removeClass('is-invalid');
        $('input[name="email"]').siblings('.invalid-feedback').text('');
    }

    if (errors.hasOwnProperty('name')) {
        $('input[name="name"]').addClass('is-invalid');
        $('input[name="name"]').siblings('.invalid-feedback').text(errors.name[0]);
    } else {
        $('input[name="name"]').removeClass('is-invalid');
        $('input[name="name"]').siblings('.invalid-feedback').text('');
    }
}
  });
}

    </script>


@endsection
