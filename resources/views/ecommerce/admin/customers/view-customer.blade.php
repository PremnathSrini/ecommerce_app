@extends('ecommerce.admin.admin_layouts.default')
@section('admin-content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Customer Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.customer.index') }}">Customers</a></li>
                        <li class="breadcrumb-item active">Customer Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-11 m-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <table class="table table-bordered">
                                    @foreach ($customers as $customer)
                                    <tbody>
                                        <tr>
                                            <td class="text-dark"><strong>Customer Name</strong></td>
                                            <td><strong> {{ucfirst($customer->name)}} </strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-dark">Customer Email</td>
                                            <td> <strong> {{$customer->email}} </strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td class="text-dark font-weight-bold">Phone Number</td>
                                            <td>{{$customer->addresses[0]->phone_number}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-dark font-weight-bold">Date of Birth</td>
                                            <td> {{$customer->dob}} </td>
                                        </tr>
                                        <tr>
                                            <td class="text-dark font-weight-bold">Status</td>
                                            @if($customer->status == 1)
                                                <td class="text-success">Active</td>
                                            @else
                                                <td class="text-danger">Inactive</td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td class="text-dark font-weight-bold">Addresses</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customer->addresses as $address)
                                        <tr>
                                            <td class="">
                                                <p class="m-0 p-0">{{ucfirst($address->address_type)}}</p>
                                                <p class="m-0 p-0">{{$address->name .' - '. $address->phone_number}}</p>
                                                <p class="m-0 p-0">{{$address->address_1}}</p>
                                                <p class="m-0 p-0">{{$address->city .' - '. $address->zip_code}}</p>
                                                <p class="m-0 p-0">{{$address->state}}</p>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
