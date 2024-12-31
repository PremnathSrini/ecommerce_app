@extends('ecommerce.admin.admin_layouts.default')
@section('admin-content')

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
                    <h1>Add Customer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.customer.index') }}">Customers</a></li>
                        <li class="breadcrumb-item active">Add Customer</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{route('admin.customer.store')}}" method="POST" id="regForm">
                            @csrf
                            <div class="card-body">
                                <legend>Profile Information</legend>
                                <div class="row mb-2">
                                    <div class="col">
                                        <label for="customer_name">Name</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control" id="customer_name" name="customer_name"
                                            placeholder="Enter Name" value="{{old('name')}}" autocomplete="name">
                                        <span class="text-danger" id="customer_name_error">
                                            @error('name') {{ $message }}  @enderror
                                        </span>
                                    </div>
                                    <div class="col">
                                        <label for="email">Email</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control" id="email" name="email"
                                            placeholder="Enter email address" value="{{old('email')}}" autocomplete="email">
                                        <span class="text-danger" id="email_error">
                                            @error('email') {{ $message }}  @enderror
                                        </span>
                                    </div>
                                    <div class="col">
                                        <label for="dob">DOB</label><span class="text-danger">*</span>
                                        <input type="date" class="form-control" id="dob" name="dob"
                                            value="{{old('dob')}}" max="<?php echo date('Y-m-d'); ?>">
                                        <span class="text-danger" id="dob_error">
                                            @error('dob')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="password">Password</label><span class="text-danger">*</span>
                                        <input type="password" class="form-control" id="password" name="password"
                                            value="{{ old('password') }}" autocomplete="new-password">
                                        <span class="text-danger" id="password_error">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col">
                                        <label for="password_confirmation">Confirm Password</label><span class="text-danger">*</span>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                                            value="{{ old('password_confirmation') }}" autocomplete="new-password">
                                        <span class="text-danger" id="password_confirmation_error">
                                            @error('password_confirmation')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                        </div>
                                </div>

                                <legend class="mx-3">Address details</legend>
                                <div class="mx-3">
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="name">Name</label><span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ old('name') }}" placeholder="Name">
                                            <span class="text-danger" id="name_error">
                                                @error('name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col">
                                            <label for="phone_number">Phone Number</label><span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="phone_number" name="phone_number"
                                                value="{{ old('phone_number') }}" placeholder="Phone number">
                                            <span class="text-danger" id="phone_number_error">
                                                @error('phone_number')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-12">
                                            <label for="address_1">Address 1</label><span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="address_1" name="address_1"
                                                value="{{ old('address_1') }}" placeholder="Address (Area and street)">
                                            <span class="text-danger" id="address_1_error">
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
                                                value="{{ old('address_2') }}" placeholder="Optional">
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
                                                value="{{ old('landmark') }}" placeholder="Optional">
                                            <span class="text-danger">
                                                @error('landmark')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="zip_code">Pin code</label><span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="zip_code" name="zip_code"
                                                value="{{ old('zip_code') }}" placeholder="zip_code">
                                            <span class="text-danger" id="zip_code_error">
                                                @error('zip_code')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <label for="city">City</label><span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="city" name="city"
                                                value="{{ old('city') }}" placeholder="City">
                                            <span class="text-danger" id="city_error">
                                                @error('city')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="state">State</label><span class="text-danger">*</span>
                                            <select name="state" id="state" class="form-control">
                                                <option value="{{old('state')}}">Select State</option>
                                                @foreach ($states as $state)
                                                <option value="{{$state}}" {{old('state')== $state ? 'selected' : ''}} >{{$state}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger" id="state_error">
                                                @error('state')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-12">
                                            <label for="name">Address Type</label><span class="text-danger">*</span><br>
                                            <label for="home">
                                                <input type="radio" name="address_type" id="home" value="home"
                                                {{old('address_type')=='home' ? 'checked': ''}}>Home</label>
                                            <label for="office">
                                                <input type="radio" name="address_type" id="office" value="office"
                                                {{old('address_type')=='office' ? 'checked': ''}}>Office</label>
                                        </div>
                                        <span class="text-danger" id="home_error">
                                            @error('address_type')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" >Submit</button>
                                <a href="{{route("admin.customer.index")}}" class="btn btn-danger">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('custom-scripts')
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#regForm').validate({
                rules:{
                    customer_name:{
                        required:true
                    },
                    email:{
                        required:true,
                        email: true
                        remote:{
                            url: "/admin/check-email-availability",
                            type: "POST",
                            data:{
                                email: function(){
                                    return $('#email').val();
                                },
                                _token: "{{ csrf_token() }}"
                            },
                            dataType: "json",
                            success: function(response) {
                                if (!response.success) {
                                    console.log(response.message);
                                    return response.message;
                                }else{
                                    console.log(1);

                                }
                            }
                        }
                    },
                    dob:{
                        required: true
                    },
                    password:{
                        required: true,
                        minlength: 6
                    },
                    password_confirmation:{
                        required: true,
                        equalTo: "#password"
                    },
                    name:{
                        required: true
                    },
                    phone_number:{
                        required: true,
                        minlength: 10,
                        remote:{
                            url: "/admin/check-PhoneNumber",
                            type: "POST",
                            data: {
                                phone_number: function(){
                                    return $('#phone_number').val();
                                },
                                _token: "{{ csrf_token() }}"
                            },
                            dataType: "json",
                            success: function(response) {
                                if (!response.success) {
                                    console.log(response.message);
                                    return response.message;
                                }else{
                                    console.log(1);
                                }
                            }
                        }
                    },
                    address_1:{
                        required: true
                    },
                    zip_code:{
                        required: true
                    },
                    city:{
                        required: true
                    },
                    state:{
                        required: true
                    },
                    address_type:{
                        required: true
                    },
                },
                messages:{
                    customer_name:{
                        required: "Please enter a valid name for Customer"
                    },
                    email:{
                        required:"Please enter a valid email address",
                        remote:"Email already Exists"
                    },
                    dob:{
                        required: "It is a required field"
                    },
                    password:{
                        required: "It is a required field",
                        minlength: "Password should contains atleast 6 characters"
                    },
                    password_confirmation:{
                        required: "It is a required field",
                        equalTo: "Password doesn't matched with the provided password"
                    },
                    name:{
                        required: "It is a required field"
                    },
                    phone_number:{
                        required: "It is a required field",
                        minlength: "It should contains 10 numbers",
                        maxlength: "It should contains 10 numbers",
                        remote: "Phone number already exists"
                    },
                    address_1:{
                        required: "It is a required field"
                    },
                    zip_code:{
                        required: "It is a required field"
                    },
                    city:{
                        required: "It is a required field"
                    },
                    state:{
                        required: "It is a required field"
                    },
                    address_type:{
                        required: "It is a required field"
                    },
                },
                errorPlacement: function(error,element){
                    var errorId = element.attr('id') + '_error';
                    $('#' + errorId).text(error.text());
                },
                highlight: function(error,element){
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(error,element){
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
    @endpush
@endsection
