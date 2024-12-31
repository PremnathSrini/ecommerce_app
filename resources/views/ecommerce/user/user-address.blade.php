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
            <div class="row my-5">
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Manage Addresses</h3>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <a class="form-control text-blue text-bold" href="{{route('user.add.address')}}">+ Add address</a>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    @foreach ($addresses as $address)
                                    <div class="card">
                                        <div class="card-body">
                                            <span class="text-uppercase">
                                                <mark>{{$address->address_type}}</mark>
                                                @if($address->primary == 1)
                                                    <span class="text-success">Primary</span>
                                                @else
                                                    <a class="btn text-primary set-as-primary-btn float-right" data-id="{{$address->id}}">set as primary</a>
                                                @endif
                                                <a href="{{route('user.edit.address',base64_encode($address->id))}}" class="btn text-primary float-right">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <div class="float-right">
                                                    {{html()->form('DELETE',route('user.delete.address',base64_encode($address->id)))->open()}}
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
        </div>
    </div>
</div>
@push("custom-scripts")
    <script>
        $(document).on('click','.set-as-primary-btn',function(){
            const addressId = $(this).data('id');
            $.ajax({
                type: "PUT",
                url: "{{url('/user/address/as-primary')}}"+ '/'+ addressId,
                data: {
                    _token: "{{ csrf_token() }}",
                    address_id: addressId,
                },
                success: function (response) {
                    location.reload();
                },
                error:function(error){
                    console.log(error);
                }
            });
        });
    </script>

@endpush
@endsection
