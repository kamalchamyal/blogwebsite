@extends('layouts.frontend')
@section('mytitle')
   Contact Us
@endsection
<style>
    label{
        margin-bottom: 0px !important;
    font-weight: 500 !important;
    color: #e6561c !important;
    }

    .custom-box {
  border: 1px solid #ddd;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  padding-top: 1.75rem;
  padding-bottom: 1.75rem;
  padding-left: 1.75rem;
  margin-bottom: 0.5rem;
}
.custom-box p:first-child {
    color: #1c1816;
    font-weight: 500;
}

@media (max-width: 1100px) {
  /* CSS styles to apply for screens smaller than 500px */
  .container{
    margin-left: auto !important;
  }
}

div:where(.swal2-container).swal2-center>.swal2-popup{
    grid-row: 1 !important;
}

  #swal2-html-container{

    font-size: 16px;
  }
    </style>

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="container">
<ol class="breadcrumb" style="padding: 0; background-color:#f2f1f1;">
    <li><a href="{{route('show')}}">Home</a></li>
    <li class="active" style="color:#ea5f00 ">Contact Us</li>

  </ol>
</div>
<div class="container " style="background-color: white;margin-top: 10px;margin-bottom: 10px; margin-left: 102px; ">
    <h3 class="text-center" style="    font-size: 28px;
    ">
        Contact us
    </h3>
    <div class="row m-0">
        <div class="col-md-5 " >
        <div class="col-md-12" style="border: 1px solid #dee2e6!important; border-radius: 8px;box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);padding-top: 1rem;
        padding-bottom: 1rem;">

<form id="contactus" method="POST" action="{{ route('Contactus.store') }}">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" class="form-control" style="border-bottom-color:#ffd580 !important;" id="exampleInputEmail1" name="name" aria-describedby="emailHelp" placeholder="Enter name">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" style="border-bottom-color:#ffd580 !important;" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Phone No.</label>
        <input type="tel" class="form-control"  style="border-bottom-color:#ffd580 !important;" name="phone" id="exampleInputPassword1" placeholder="ex:8006902778">
    </div>
    <div class="form-group">
        <label for="my-textarea">Message</label>
        <textarea id="my-textarea" class="form-control" style="border-bottom-color:#ffd580 !important;" name="message" rows="3"></textarea>
    </div>
    <button type="button" onclick="submitForm()" class="btn btn" style="background-color: #e6561c; color: white">Submit</button>
</form>
        </div>
    </div>
        <div class="col-md-7">
                <div class="custom-box">
                  <div class="row">
                    <div class="col-md-4">
                      <img src="https://www.dealsncoupons.in/public/assets/images/contact/customer-service.png" alt="" style="width: 30%">
                    </div>
                    <div class="col-md-8">
                      <p>Email Address</p>
                      <p>Email:kamal@impianglobalmedia.com</p>
                    </div>
                  </div>
                </div>



                <div class="custom-box">
                  <div class="row">
                    <div class="col-md-4">
                      <img src="https://www.dealsncoupons.in/public/assets/images/contact/job-search.png" alt="" style="width: 30%">
                    </div>
                    <div class="col-md-8">
                      <p>Location</p>
                      <p>Haldwani Uttarakhand</p>
                    </div>
                  </div>
                </div>

                <div class="custom-box">
                  <div class="row">
                    <div class="col-md-4">
                      <img src="https://www.dealsncoupons.in/public/assets/images/contact/info.png" alt="" style="width: 30%">
                    </div>
                    <div class="col-md-8">
                      <p>Any General Query</p>
                      <p>Email:kamal@impianglobalmedia.com</p>
                    </div>
                  </div>
                </div>


        </div>
    </div>
</div>
<script>
    function submitForm(){
        event.preventDefault();
        var form = $('#contactus');
        var formdata = form.serialize();
        var url = form.attr('action');

        $.ajax({
            type: 'POST',
            url: url,
            data: formdata,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    // SweetAlert2 success message with custom styles
                    $('#contactus')[0].reset();
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        width: 450,
                        text: 'Your form has been submitted!',
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    // Handle validation errors or other errors
                    if (response.errors) {
                        var errorMessages = '';
                        for (var key in response.errors) {
                            errorMessages += response.errors[key][0] + '<br>';
                        }
                        Swal.fire({
                            icon: 'error',
                            width: 400,
                            title: 'Validation Errors',
                            html: errorMessages,
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            width: 400,
                            title: 'Error',
                            text: response.message || 'Error occurred during form submission.',
                        });
                    }
                }
            },
            error: function(xhr, status, error) {
                // SweetAlert2 error message for AJAX failure with 422 status code
                if (xhr.status === 422) {
                    var response = xhr.responseJSON;
                    if (response.errors) {
                        var errorMessages = '';
                        for (var key in response.errors) {
                            errorMessages +='<span style="color: red;">'+'*'+ response.errors[key][0] + '<br>';
                        }
                        Swal.fire({
                            icon: 'error',
                            width: 400,
                            title: 'Validation Errors',
                            html: errorMessages,
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            width: 400,
                            title: 'Error',
                            text: response.message || 'Error occurred during form submission.',
                        });
                    }
                } else {
                    // Other error handling for non-422 status codes
                    Swal.fire({
                        icon: 'error',
                        width: 400,
                        title: 'Error',
                        text: 'Error occurred during form submission.',
                    });
                }
            }
        });
    }
    </script>



@endsection
