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
                    {{$name}}
                </h6>
            </div>
        </div>
        <small class="text-body-secondary">{{$description}}</small>
    </div>
    <span class="text-body-secondary">${{$price}}</span>
    <a data-product-id="{{$id}}" class="btn pt-0 mt-0 text-success add-to-cart-btn" title="Add to Cart">
        <i class="bi bi-cart-check h4"></i>
    </a>
</li>
