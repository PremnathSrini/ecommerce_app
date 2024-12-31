@extends('layouts.app')
@section('content')
<div class="bg-image"
        style="background-image: url('{{asset('images/login.jpg')}}'); width: 100%; height: 100%">
    <div class="register-box m-auto py-5">
        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Register a new account</p>

                <form action="{{ route('user.auth.register') }}" method="POST" id="userReg-form">
                    @csrf
                    @error('name')
                    <span class="text-danger">{{$message}} </span>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Full name"
                        name="name" id="name" @error('name') is-invalid @enderror value="{{old('name')}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    @error('email')
                    <span class="text-danger">{{$message}} </span>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Email"
                        name="email" id="email" @error('email') is-invalid @enderror value="{{old('email')}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @error('dob')
                    <span class="text-danger">{{$message}} </span>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="date" class="form-control fas" placeholder="DOB" max="<?php echo date('Y-m-d'); ?>"
                            name="dob" id="dob" @error('dob') is-invalid @enderror value="{{old('dob')}}">
                    </div>
                    @error('password')
                    <span class="text-danger">{{$message}} </span>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" value="{{old('password')}}"
                        name="password" id="password" @error('password') is-invalid @enderror>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                    <span class="text-danger">{{$message}} </span>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Retype password" value="{{old('password-confirmation')}}"
                        name="password_confirmation" id="password_confirmation" @error('password_confirmation') is-invalid @enderror>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8 pt-2">
                            <a href="{{ route('user.login') }}" class="text-center">I already have a account</a>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" id="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    </div>
    {{-- @push('custom-scripts')
        <script>
            $(document).ready(function() {
                $('#submit').on('click', function(e) {
                    $('#userReg-form').validate({
                        rules: {
                            name: {
                                required: true,
                            },
                        },
                        messages: {
                            name: {
                                required: "Please enter your name.",
                            },
                        },
                        errorPlacement: function(error, element) {
                            // Add Bootstrap classes to the error message
                            error.addClass(
                                'text-danger small'
                            ); // Bootstrap text-danger for red color and small for smaller text
                            error.insertBefore(
                                element); // Place the error message before the input field
                        },
                        highlight: function(element) {
                            $(element).addClass('is-invalid');
                        },
                        unhighlight: function(element) {
                            $(element).removeClass('is-invalid');
                            element.next('span').html(''); // Clear the error message when valid
                        },
                        submitHandler: function(form) {
                            form.submit();
                        }
                    });
                });
                $('#submit').on('click', function(e) {
                    e.preventDefault();
                    $('#userReg-form').submit();
                });
            });
        </script>
    @endpush --}}
@endsection
