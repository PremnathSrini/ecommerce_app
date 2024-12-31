<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendor.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/style.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="{{ asset('assets/css/css2.css') }}" rel="stylesheet">
    <link href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    {{-- <link rel="stylesheet" href="{{ asset('admin_assets/plugins/fontawesome-free/css/all.min.css') }}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

    @include('ecommerce.layouts.svg')

    <div class="preloader-wrapper">
        <div class="preloader">
        </div>
    </div>

    @include('ecommerce.layouts.wishlist')

    @include('ecommerce.layouts.cart')

    @include('ecommerce.layouts.navbar')

    @include('ecommerce.layouts.header')

    @yield('content')

    @include('ecommerce.layouts.footer')
    <script src="{{ asset('assets/js/jquery-1.11.0.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('admin_assets/js/toastr.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/adminlte.js') }}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function(){
            let productQuantity = 0;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('input','.quantity',function(){
                const quantityValue = $(this).val();

                if (!isNaN(quantityValue) && quantityValue > 0) {
                    productQuantity = quantityValue;
                } else {
                    alert('Please enter a valid quantity.');
                    $(this).val(1);
                }
            });
            $(document).on('click','.add-to-cart-btn',function(e){
                e.preventDefault();
                let authStatus  = $('#auth-status').val();
                if (authStatus === 'false') {
                    window.location.href = "{{ route('user.login') }}";
                }
                else
                {
                    const productId = $(this).data('product-id');
                    const remove_product_url = window.location.origin + '/user/remove/cart-product/' + productId ;
                    const add_quantity_url = window.location.origin + '/user/add/cart-quantity/' + productId ;
                    const remove_quantity_url = window.location.origin + '/user/remove/cart-quantity/' + productId ;
                    $.ajax({
                        url: '/user/add/cart',
                        method: 'POST',
                        data: {
                            product_id: productId,
                            quantity: productQuantity,
                            remove_product_url: remove_product_url,
                            add_quantity_url: add_quantity_url,
                            remove_quantity_url: remove_quantity_url,
                        },
                        success: function(response){
                            if(response.success){
                                console.log(response.total);
                                console.log(response.totalQuantity);
                                console.log(response.cart);
                                $('.total-list').before(response.cart);
                                $('#offcanvasCart').addClass('show');
                                $('.cart-count').text(response.totalQuantity);
                                $('.total_price').text('$' + response.total);
                                if(response.totalQuantity != 0){
                                    $('.purchase').addClass('d-none');
                                    $('.checkout').removeClass('d-none');
                                }else{
                                    $('.purchase').removeClass('d-none');
                                    $('.checkout').addClass('d-none');
                                    $(this).attr('disabled','disabled');
                                }
                            }else{
                                $('.cart-count').text(response.totalQuantity);
                                $('.total_price').text('$' + response.total);
                                $('.product_price_' + response.id).text('$' + response.product_price);
                                $('.product_quantity_'+ response.id).text(response.current_quantity);
                                $('#offcanvasCart').addClass('show');
                                if(response.totalQuantity != 0){
                                    $('.purchase').addClass('d-none');
                                    $('.checkout').removeClass('d-none');
                                }else{
                                    $('.purchase').removeClass('d-none');
                                    $('.checkout').addClass('d-none');
                                }
                            }
                        },
                        error: function(error){
                            console.log(error);
                        }
                    });
                    $(this).attr('disabled','disabled');
                    $(this).text("Added to Cart");
                }
            });
            $(document).on('click','.add-to-wishlist-btn',function(){
                let authStatus = $('#auth-status').val();
                if (authStatus === 'false') {
                    window.location.href = "{{ route('user.login') }}";
                }
                else{
                    const productId = $(this).data('product-id');
                    $.ajax({
                        url: '/user/add/wishlist',
                        method: 'POST',
                        data: {
                            product_id: productId,
                        },
                        success: function(response){
                            if(response.success){
                                console.log(response.wishlist);
                                $('.offcanvas-body #wishlist').append(response.wishlist);
                                $('#offcanvasWishlist').addClass('show');
                            }else{
                                $('#offcanvasWishlist').addClass('show');
                                $('.list_item_'+ response.id).remove();
                                $('.add-to-wishlist-btn').removeClass('bg-danger');
                            }
                        },
                        error: function(error){
                            console.log(error);
                        },
                    });
                    $(this).addClass('bg-danger');
                }
            });
        });
    </script>
    @if (Session::has('message'))
    <script>
        $(document).ready(function() {
            toastr.success("{{ Session::get('message') }}");
        });
    </script>
    @endif
    @stack('custom-scripts')
</body>

</html>
