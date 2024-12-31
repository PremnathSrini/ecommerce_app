@extends('layouts.app')
@section('content')

<div class="container my-3">
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <form action="{{route('order.place')}}" method="POST">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                    @php
                        if(Session::has('cart')){
                            $i = Session::get('cart');
                            $totalQuantity = 0;
                            foreach ($i as $item) {
                                $totalQuantity += $item['quantity'];
                            }
                        }
                    @endphp
                    <span class="badge badge-secondary badge-pill">{{$totalQuantity ?? 0}}</span>
                </h4>
                @if (session()->has('cart'))
                <ul class="list-group mb-3 sticky-top">
                    @php $total = 0; @endphp
                    @foreach (session('cart') as $id => $details)
                    @php $total = $total + $details['price'] * $details['quantity']; @endphp
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">{{$details['name']}}</h6>
                            <small class="text-muted">{{$details['description']}}</small>
                        </div>
                        @if ($details['quantity'] > 1)
                            <span class="badge text-success bg-success mb-4 "> {{$details['quantity']}} </span>
                        @endif
                        <span class=" text-muted">${{$details['price'] * $details['quantity']}}</span>
                    </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between text-success">
                        <span>Total</span>
                        <strong>${{$total}}</strong>
                    </li>
                </ul>
                @endif

            </div>
            @php
                    $addresses = App\Models\Address::where('user_id',Auth::id())->get();
            @endphp
            <div class="col-md-8 order-md-1">

                    @csrf
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3>Shipping Address</h3>
                        <a href="{{route('user.address',[Auth::id()])}}" class="btn bg-success">Manage Address</a>
                    </div>
                    <div class="row">
                        <span class="text-info">Primary address is selected for order placement, you can change the address if you wish</span>
                        <select name="address_id" id="address_id" class="form-control">
                            @foreach ($addresses as $address)
                            <option value="{{$address->id}}" {{$address->primary == 1 ? 'selected' : ''}}>
                                {{$address->address_type .'-'.$address->name .'//'}}
                                {{$address->address_1 .'//'. $address->phone_number .'//'. $address->address_2 ?? ''}}
                            </option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                            @error('address_id') {{ $message }}  @enderror
                        </span>
                    </div>
                    <div class="hidden-address my-3 d-none">
                        <div class="card">
                            <div class="card-body">
                                <span class="selected-address">Gonna change</span>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <h4 class="mb-3">Payment</h4>
                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="credit" name="paymentMethod" type="radio" class="custom-control-input"  checked="" value="2">
                            <label class="custom-control-label" for="credit">Credit card</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" value="3">
                            <label class="custom-control-label" for="debit">Debit card</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" value="4">
                            <label class="custom-control-label" for="paypal">PayPal</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="cod" name="paymentMethod" type="radio" class="custom-control-input"  value="1">
                            <label class="custom-control-label" for="cod">Cash on Delivery</label>
                        </div>
                    </div>
                    <div class="togglePayment">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cc-name">Name on card</label>
                                <input type="text" class="form-control" id="cc-name" placeholder="" >
                                <small class="text-muted">Full name as displayed on card</small>
                                <div class="invalid-feedback"> Name on card is required </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cc-number">Credit card number</label>
                                <input type="text" class="form-control" id="cc-number" placeholder="" >
                                <div class="invalid-feedback"> Credit card number is required </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="cc-expiration">Expiration</label>
                                <input type="text" class="form-control" id="cc-expiration" placeholder="" >
                                <div class="invalid-feedback"> Expiration date required </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="cc-cvv">CVV</label>
                                <input type="text" class="form-control" id="cc-cvv" placeholder="" >
                                <div class="invalid-feedback"> Security code required </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Place Order</button>
            </form>
        </div>
    </div>
</div>
@push('custom-scripts')
<script>
    $(document).ready(function(){
        $(document).on('change','#same-address-checkbox',function(){
            $('.billing-address').toggle();
            $('.bill').toggle();
        });
        $(document).on('change','input[name="paymentMethod"]',function(){
            $('.togglePayment').toggle(this.value !== '1');
        });
        $(document).on('change', 'select#address_id', function() {
            const selectedText = $(this).children("option:selected").text();
            const addressLines = selectedText.split('//');

            $('.selected-address').html(''); // Clear the previous content
            addressLines.forEach(line => {
                $('.selected-address').append('<p><b>' + line + '</b></p>');
            });
            $('.hidden-address').removeClass('d-none');
            });
        });
</script>

@endpush
@endsection
{{-- <form class="card p-2">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Promo code">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary">Redeem</button>
                    </div>
                </div>
            </form> --}}
