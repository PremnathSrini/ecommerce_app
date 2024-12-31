@extends('layouts.app')
@section('content')
    <div class="bg-image"
        style="background-image: url('{{asset('images/login.jpg')}}'); width: 100%; height: 100%">
    <div class="login-box m-auto py-5">
        <div class="card">
            <div class="card-body login-card-body bg-light text-white">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="{{ route('user.auth.login') }}" method="post">
                    @csrf
                    {{-- @if (Session::has('auth-error'))
                    {{   Auth::logout();  }}
                    @endif --}}

                    @if (Session::has('error'))
                        <span class="text-danger">{{ Session::get('error') }}</span>
                    @endif
                    <span class="text-danger">@error('email'){{$message}}@enderror</span>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" id="email" value="{{old('email')}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger">@error('password'){{$message}}@enderror</span>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password" value="{{old('password')}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mb-1">
                    <a href="{{route('forget.password.get')}}">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="{{ route('user.register') }}" class="text-center">Register if new user</a>
                </p>
            </div>
        </div>
        </div>
    </div>
@endsection
