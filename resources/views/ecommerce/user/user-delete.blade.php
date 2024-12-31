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
                          href="{{route('user.profile',$user->id)}}"
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

        {{-- <div class="container-fluid">
            <div class="row my-5 ">
                <div class="col-md-8">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Profile Information</h3>
                        </div>
                        <form action="{{ route('user.profile.update', $user->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <label for="name">Username</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $user->name }}">
                                        <span class="text-danger">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="dob">DOB</label>
                                        <input type="date" class="form-control" id="dob" name="dob"
                                            value="{{ $user->dob }}" max="<?php echo date('Y-m-d'); ?>">
                                        <span class="text-danger">
                                            @error('dob')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email" name="email"
                                                value="{{ $user->email }}">
                                            <span class="text-danger">
                                                @error('email')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <a href="{{ route('user.index') }}" class="btn text-red">Back</a>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <div class="container-fluid">
            <div class="row my-5">
                <div class="col-md-7">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Manage Addresses</h3>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <a class="form-control text-blue text-bold" href="{{route('user.add.address',$user->id)}}">+ Add address</a>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    @foreach ($addresses as $address)
                                    <div class="card">
                                        <div class="card-body">
                                            <span class="text-uppercase">
                                                <mark>{{$address->address_type}}</mark>
                                                <a href="{{route('user.edit.address',$address->user_id)}}" class="btn text-primary float-right">
                                                    <i class="bi bi-pencil"></i></a>
                                                    <div class="float-right">
                                                        {{html()->form('DELETE',route('user.delete.address',$address->id))->open()}}
                                                            {{ html()->button('<i class="bi bi-trash3-fill"></i>')->class('btn text-danger')->type('submit')
                                                            ->attribute('onclick','return confirm("Are you sure want to delete?")') }}
                                                        {{html()->form()->close()}}
                                                    </div>
                                            </span>
                                        <p class="text-bold">
                                            <span>{{$address->name}}</span>
                                            <span>{{$address->phone_number}}</span><br>
                                            <span>Address 1: <br>{{$address->address_1 .','. $address->city }} </span><br>
                                            <span>{{$address->state .'-'. $address->zip_code }} <br></span>
                                            @if ($address->address_2 != '')
                                            <span>Address 2: <br>{{$address->address_2 .','. $address->city }} </span><br>
                                            <span>{{$address->state .'-'. $address->zip_code }} </span>
                                            @endif
                                        </p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="container-fluid">
            <div class="row my-5">
                <div class="col-md-8">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Delete Account</h3>
                        </div>

                        <form action="{{ route('user.account.destroy', $user->id) }}" method="POST" id="delete-user-form">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <label for="delete-account">Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.</label>
                                        <button id="delete-button" type="submit" class="btn btn-danger">Delete Account</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @push('custom-scripts')
        <script>
            $(document).ready(function() {
                $('#delete-button').click(function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Confirm'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Enter "CONFIRM" to proceed',
                                input: 'text',
                                inputAttributes: {
                                    autocapitalize: 'off'
                                },
                                showCancelButton: true,
                                confirmButtonText: 'Submit',
                                cancelButtonText: 'Cancel'
                            }).then((result) => {
                                if (result.value === 'CONFIRM') {
                                    $('#delete-user-form').submit();
                                }
                                else{
                                    Swal.fire('Error', 'Form submission failed. Please try again. The CONFIRM should be in capital', 'error');
                                }
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
