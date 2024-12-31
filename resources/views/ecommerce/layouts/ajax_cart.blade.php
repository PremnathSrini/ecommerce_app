<li class="list-group-item d-flex justify-content-between lh-sm cart_item_{{$id}}">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-1">
                <button class="btn text-danger m-0 p-0 remove-cart-product"
                        data-href="{{$remove_product_url}}"
                        data-toggle="tooltip" title="Remove Product from Cart">
                    <i class="bi bi-dash-circle-fill"></i>
                </button>
            </div>
            <div class="col-md-11">
                <h6 class="mt-1 text-dark font-weight-bold product_name_{{$id}}">
                    {{$name}}
                </h6>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <button class="btn text-danger remove-cart-quantity"
                            data-href="{{$remove_quantity_url}}"
                            data-toggle="tooltip" title="Remove Quantity">
                        <i class="bi bi-cart-x-fill"></i>
                    </button>
                </div>
                <div class="col-md-7">
                    <button class="btn text-success add-cart-quantity"
                            data-href="{{$add_quantity_url}}"
                            data-toggle="tooltip" title="Add Quantity">
                        <i class="bi bi-cart-plus-fill"></i>
                    </button>
                </div>
            </div>
        </div>
        <small class="text-body-secondary product_description_{{$id}}">{{$description}}</small>
    </div>
    <span class="text-body-secondary product_price_{{$id}}">${{$product_price * $current_quantity}}</span>
    <span class="badge text-success product_quantity_{{$id}}"> {{$current_quantity}} </span>
</li>
