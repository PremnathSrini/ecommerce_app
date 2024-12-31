@extends('layouts.app')
@section('content')
<?php
    $states = ['Andaman & Nicobar','Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chandigarh',
    'Chhattisgarh','Dadra & Nagar Haveli and Daman & Diu','Delhi','Goa', 'Gujarat', 'Haryana', 'Jammu and Kashmir',
     'Jharkhand', 'Karnataka','Ladakh','Lakshadweep', 'Kerala','Madhya Pradesh', 'Maharashtra', 'Mizoram', 'Nagaland',
      'Odisha','Puducherry','Punjab','Rajasthan','Sikkim', 'Tamil Nadu', 'Telangana', 'Tripura', 'Uttar Pradesh',
       'Uttarakhand', 'West Bengal'
    ];
?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Manage Addresses</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 m-auto">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Address</h3>
                    </div>
                    <form action="{{route('user.update.address',base64_encode($address->id))}}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $address->name }}">
                                    <span class="text-danger">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                                        value="{{ $address->phone_number }}">
                                    <span class="text-danger">
                                        @error('phone_number')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label for="address_1">Address 1</label>
                                    <input type="text" class="form-control" id="address_1" name="address_1"
                                        value="{{ $address->address_1 }}" placeholder="Address (Area and street)">
                                    <span class="text-danger">
                                        @error('address_1')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label for="address_2">Address 2</label>
                                    <input type="text" class="form-control" id="address_2" name="address_2"
                                        value="{{ $address->address_2 }}" placeholder="Optional">
                                    <span class="text-danger">
                                        @error('address_2')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="landmark">Landmark</label>
                                    <input type="text" class="form-control" id="landmark" name="landmark"
                                        value="{{ $address->landmark }}" placeholder="Optional">
                                    <span class="text-danger">
                                        @error('landmark')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <label for="zip_code">Pin code</label>
                                    <input type="text" class="form-control" id="zip_code" name="zip_code"
                                        value="{{ $address->zip_code }}" >
                                    <span class="text-danger">
                                        @error('zip_code')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" id="city" name="city"
                                        value="{{ $address->city }}" placeholder="Optional">
                                    <span class="text-danger">
                                        @error('city')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <label for="state">State</label>
                                    <select name="state" id="state" class="form-control">
                                        <option value="{{$address->state}}">{{$address->state}}</option>
                                        @foreach ($states as $state)
                                        <option value="{{$state}}">{{$state}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('state')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label for="name">Address Type</label><br>
                                    <label for="home">
                                        <input type="radio" name="address_type" id="home" value="home"
                                        {{$address->address_type=='home' ? 'checked': ''}}>Home</label>
                                    <label for="office">
                                        <input type="radio" name="address_type" id="office" value="office"
                                        {{$address->address_type=='office' ? 'checked': ''}}>Office</label>
                                    <span class="text-danger">
                                        @error('address_type')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Update</button>
                                <a class="btn text-primary" href="{{route('user.address')}}">Cancel</a>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
