<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasCart">
    <div class="offcanvas-header justify-content-center">
        <button type="button" class="btn-close cart-close-btn" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    @guest
    <div class="offcanvas-body">
        <div class="order-md-last">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary">Your cart</span>
            </h4>
        </div>
        <img class="rounded mx-auto d-block" src="{{asset('images/cart/cart.jpg')}}" alt="Cart" width="300px" height="300px">
        <span>Missing Cart Items?</span>
        <a class="w-100 btn btn-primary btn-lg" href="{{route('user.login')}}">Login To Continue</a>
    </div>
        @else
    <div class="offcanvas-body">
        @php
        $totalQuantity = 0;
        if(Session::has('cart')){
            $i=(session('cart'));
            foreach ($i as $item) {
                $totalQuantity += $item['quantity'];
            }
        }
        @endphp

        <div class="order-md-last">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-success">Your cart</span>
                <span class="badge bg-success rounded-pill cart-count">{{$totalQuantity ?? ''}}
                </span>
            </h4>

            <ul class="list-group mb-3 cart-list" id="cart-list">
                @if (session()->has('cart'))
                 @php $total = 0; @endphp
                @foreach (session('cart') as $id => $details)
                 @php $total = $total + $details['price'] * $details['quantity']; @endphp
                <li class="list-group-item d-flex justify-content-between lh-sm cart_item_{{$id}}">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-1">
                                <button class="btn text-danger m-0 p-0 remove-cart-product" data-href="{{route('ajax.cart.remove.product',$id)}}"
                                data-toggle="tooltip" title="Remove Product from Cart">
                                    <i class="bi bi-dash-circle-fill"></i>
                                </button>
                            </div>
                            <div class="col-md-11">
                                <h6 class="mt-1 text-dark font-weight-bold product_name_{{$id}}">
                                    {{$details['name']}}
                                </h6>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">
                                    <button class="btn text-danger remove-cart-quantity" data-href="{{route('ajax.cart.remove.quantity',$id)}}"
                                    data-toggle="tooltip" title="Remove Quantity">
                                        <i class="bi bi-cart-x-fill"></i>
                                    </button>
                                </div>
                                <div class="col-md-7">
                                    <button class="btn text-success add-cart-quantity" data-href="{{route('ajax.cart.add.quantity',$id)}}"
                                    data-toggle="tooltip" title="Add Quantity">
                                        <i class="bi bi-cart-plus-fill"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <small class="text-body-secondary product_description_{{$id}}">{{$details['description']}}</small>
                    </div>
                    <span class="text-body-secondary product_price_{{$id}}">${{$details['price'] * $details['quantity']}}</span>
                    <span class="badge text-success product_quantity_{{$id}}"> {{$details['quantity']}} </span>
                </li>
                @endforeach
                @endif
                <li class="list-group-item d-flex justify-content-between total-list">
                    <span>Total </span>
                    <strong class="total_price">{{$total ?? 0}}</strong>
                </li>
            </ul>

            @if($totalQuantity == 0)
                <a href="{{route('user.index')}}" class="w-100 btn btn-primary btn-lg purchase">Continue to Purchase</a>
                <a href="{{route('checkout')}}" class="w-100 btn btn-success btn-lg d-none checkout">Continue to checkout</a>
            @else
                <a href="{{route('user.index')}}" class="w-100 btn btn-primary btn-lg d-none purchase">Continue to Purchase</a>
                <a href="{{route('checkout')}}" class="w-100 btn btn-success btn-lg checkout">Continue to checkout</a>
            @endif
        </div>

        @endguest
    </div>
</div>
@push("custom-scripts")
    <script>
        // $(document).ready(function(){
            $(document).on('click','.cart-close-btn',function(){
                $('#offcanvasCart').removeClass('show');
            });
            $('.cart-close-btn').trigger('click');


            $(document).on('click','.add-cart-quantity',function(){
                let href = $(this).data('href');
                $.ajax({
                    type: "GET",
                    url: href,
                    success: function (response) {
                        if(response.success){
                            console.log(response);
                            $('.cart-count').text(response.totalQuantity);
                            $('.total_price').text('$' + response.total);
                            $('.product_price_' + response.id).text('$' + response.product_price);
                            $('.product_quantity_'+ response.id).text(response.current_quantity);

                            if(response.totalQuantity != 0){
                                $('.purchase').addClass('d-none');
                                $('.checkout').removeClass('d-none');
                            }else{
                                $('.purchase').removeClass('d-none');
                                $('.checkout').addClass('d-none');
                            }
                        }else{
                            console.log(response);
                        }
                    }
                });
            });
            $(document).on('click','.remove-cart-quantity',function(){
                let href = $(this).data('href');
                $.ajax({
                    type: "GET",
                    url: href,
                    success: function (response) {
                        if(response.success){
                            console.log(response);
                            let totalQuantity = response.totalQuantity;
                            let total = response.total;
                            let product_price = response.product_price;
                            let current_quantity = response.current_quantity;
                            let id = response.id;

                            if (response.current_quantity === 0) {
                                $('.cart_item_' + response.id).remove();
                                $('.cart-count').text(response.totalQuantity);
                                $('.total_price').text('$' + response.total);
                                let button = $(`.add-to-cart-btn[data-product-id="${id}"]`);
                                button.prop('disabled',false);
                                button.html(`<svg width="18" height="18">
                                                            <use xlink:href="#cart"></use>
                                                        </svg>Add to Cart`);

                            } else {
                                $('.cart-count').text(totalQuantity);
                                $('.total_price').text('$' + total);
                                $('.product_price_' + id).text('$' + product_price);
                                $('.product_quantity_'+ id).text(current_quantity);
                            }

                            if(response.totalQuantity != 0){
                                $('.purchase').addClass('d-none');
                                $('.checkout').removeClass('d-none');
                            }else{
                                $('.purchase').removeClass('d-none');
                                $('.checkout').addClass('d-none');
                            }

                        }else{
                            console.log(response);
                        }
                    }
                });
            });
            $(document).on('click','.remove-cart-product',function(){
                let href = $(this).data('href');
                $.ajax({
                    type: "GET",
                    url: href,
                    success: function (response) {
                        if(response.success){
                            console.log(response);
                            let totalQuantity = response.totalQuantity;
                            let total = response.total;
                            let product_price = response.product_price;
                            let current_quantity = response.current_quantity;
                            let id = response.id;

                            if (response.current_quantity === 0) {
                                $('.cart_item_' + response.id).remove();
                                $('.cart-count').text(response.totalQuantity);
                                $('.total_price').text('$' + response.total);
                              let button = $(`.add-to-cart-btn[data-product-id="${id}"]`);
                                button.prop('disabled',false);
                                button.html(`<svg width="18" height="18">
                                                            <use xlink:href="#cart"></use>
                                                        </svg>Add to Cart`);
                            } else {
                                $('.cart-count').text(totalQuantity);
                                $('.total_price').text('$' + total);
                                $('.product_price_' + id).text('$' + product_price);
                                $('.product_quantity_'+ id).text(current_quantity);
                            }


                            if(response.totalQuantity != 0){
                                $('.purchase').addClass('d-none');
                                $('.checkout').removeClass('d-none');
                            }else{
                                $('.purchase').removeClass('d-none');
                                $('.checkout').addClass('d-none');
                            }

                        }else{
                            console.log(response);
                        }
                    }
                });
            });
        // });
    </script>
@endpush

