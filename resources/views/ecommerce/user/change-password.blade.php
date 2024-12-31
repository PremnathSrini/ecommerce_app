@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class=" col-md-5 col-xl-3  px-0">
            <div class="d-flex flex-column align-items-center align-items-sm-start text-white min-vh-100">
                <nav id="sidebarMenu" class="collapse d-lg-block sidebar bg-white">
                    <div class="position-sticky">
                      <div class="list-group list-group-flush mx-3 mt-4">
                        <a
                          href="{{route('user.profile')}}"
                          class="list-group-item list-group-item-action py-2 ripple active"
                          aria-current="true">
                          <i class="bi bi-person-circle fa-fw me-3"></i><span>Hello <strong>{{$user->name}}</strong></span>
                        </a>
                        <a href="{{route('user.address')}}" class="list-group-item list-group-item-action py-2 ripple ">
                          <i class="fas fa-chart-area fa-fw me-3"></i><span>Manage Addresses</span>
                        </a>
                        <a href="{{route('user.password.get')}}" class="list-group-item list-group-item-action py-2 ripple"
                          ><i class="fas fa-lock fa-fw me-3"></i><span>Password</span></a
                        >
                        <a href="#" class="list-group-item list-group-item-action py-2 ripple"
                          ><i class="fas fa-chart-line fa-fw me-3"></i><span>Analytics</span></a
                        >
                        <a href="#" class="list-group-item list-group-item-action py-2 ripple">
                          <i class="fas fa-chart-pie fa-fw me-3"></i><span>SEO</span>
                        </a>
                        <a href="{{route('list.order')}}" class="list-group-item list-group-item-action py-2 ripple"
                          ><i class="fas fa-chart-bar fa-fw me-3"></i><span>Orders</span></a
                        >
                        <a href="#" class="list-group-item list-group-item-action py-2 ripple"
                          ><i class="fas fa-globe fa-fw me-3"></i><span>International</span></a
                        >
                        <a href="#" class="list-group-item list-group-item-action py-2 ripple"
                          ><i class="fas fa-building fa-fw me-3"></i><span>Partners</span></a
                        >
                        <a href="#" class="list-group-item list-group-item-action py-2 ripple"
                          ><i class="fas fa-calendar fa-fw me-3"></i><span>Calendar</span></a
                        >
                        <a href="{{route('user.delete')}}" class="list-group-item list-group-item-action py-2 ripple"
                          ><i class="bi bi-person-dash fa-fw me-3"></i><span>Delete Account</span></a
                        >
                        <form method="POST" action="{{route('logout')}}" class="list-group-item list-group-item-action py-2 ripple">
                            <i class="bi bi-box-arrow-left fa-fw text-danger me-3"></i>
                            @csrf
                            <a href="{{route('logout')}}" class="text-danger" onclick="event.preventDefault();
                                                this.closest('form').submit();">Log out</a>
                        </form>
                      </div>
                    </div>
                  </nav>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row my-5 ">
                <div class="col-md-8">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Change Password</h3>
                        </div>
                        <form action="{{route('user.password.post',$user->id)}}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-md-8">
                                        <label for="current_password">Current Password</label>
                                        <input type="password" class="form-control" id="current_password" name="current_password"
                                            value="{{ old('current_password') }}">
                                        <span class="text-danger">
                                            @error('current_password')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-8">
                                        <label for="password">New Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            value="{{ old('password') }}">
                                        <span class="text-danger">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="password_confirmation">Confirm Password</label>
                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                                                value="{{ old('password_confirmation') }}">
                                            <span class="text-danger">
                                                @error('password_confirmation')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <a href="{{ route('user.index') }}" class="btn text-red">Cancel</a>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
