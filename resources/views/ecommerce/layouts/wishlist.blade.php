<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasWishlist">
    <div class="offcanvas-header justify-content-center">
        <button type="button" class="btn-close wishlist-close-btn" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    @guest
    <div class="offcanvas-body">
        <div class="order-md-last">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary">Your Wishlist</span>
            </h4>
        </div>
        <img class="rounded mx-auto d-block" src="{{asset('images/wishlist/wishlist.png')}}" alt="Cart" width="300px" height="300px">
        <span>Empty wishlist Items?</span>
        <a class="w-100 btn btn-primary btn-lg" href="{{route('user.login')}}">Login To Continue</a>
    </div>
    @else
    <div class="offcanvas-body">
        <div class="order-md-last">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary">Your Wishlist</span>
            </h4>
        </div>
        <ul class="list-group mb-3" id="wishlist">
            @if(Session::has('wishlist'))
            @foreach (session('wishlist') as $id => $details)
            <li class="list-group-item d-flex justify-content-between lh-sm list_item_{{$id}}">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-1">
                            <button class="btn text-danger m-0 p-0 remove-wishlist-product" data-href="{{route('ajax.wishlist.remove',$id)}}"
                            data-toggle="tooltip" title="Remove Product from Cart">
                                <i class="bi bi-dash-circle-fill"></i>
                            </button>
                        </div>
                        <div class="col-md-11">
                            <h6 class="mt-1 text-dark font-weight-bold">
                                {{$details['name']}}
                            </h6>
                        </div>
                    </div>
                    <small class="text-body-secondary">{{$details['description']}}</small>
                </div>
                <span class="text-body-secondary">{{$details['price']}}</span>
                <a data-product-id="{{$id}}" class="btn pt-0 mt-0 text-success add-to-cart-btn" title="Add to Cart">
                    <i class="bi bi-cart-check h4"></i>
                </a>
            </li>
            @endforeach
            @endif
        </ul>
    @endguest
    </div>
</div>
@push("custom-scripts")
    <script>
        $(document).on('click','.wishlist-close-btn',function(){
            $('#offcanvasWishlist').removeClass('show');
        });

        $(document).on('click','.remove-wishlist-product',function(){
            let href = $(this).data('href');
            $.ajax({
                type: "GET",
                url: href,
                success: function (response) {
                    console.log(response);
                    $('.list_item_'+ response.id).remove();
                    $('.add-to-wishlist-btn').removeClass('bg-danger');
                }
            });
        });
    </script>

@endpush
