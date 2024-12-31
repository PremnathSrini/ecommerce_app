@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="position-relative">
                    <img src="{{ asset('images/featured/featured.jpeg' ) }}" class="img-fluid" alt="Featured Products"
                        style="height: 150px; width: 100%;">
                    <div class="position-absolute bottom-0 start-0 text-white p-3">
                        <h1><i>Featured Products</i></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="pb-5">
        <div class="container-lg">



            <div class="row">
                <div class="col-md-12">

                    <div
                        class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5">
                        @foreach ($featured_products as $product)
                        <div class="col">
                            <div class="product-item">
                                <figure>
                                    <a href="index.html" title="Product Title">
                                        <img src="{{ asset('images/products/'.$product->image) }}"
                                            alt="Product Thumbnail" class="tab-image">
                                    </a>
                                </figure>
                                <div class="d-flex flex-column text-center">
                                    <h3 class="fs-6 fw-normal">{{$product->product_name}}</h3>
                                    <div>
                                        <span class="rating">
                                            <svg width="18" height="18" class="text-warning">
                                                <use xlink:href="#star-full"></use>
                                            </svg>
                                            <svg width="18" height="18" class="text-warning">
                                                <use xlink:href="#star-full"></use>
                                            </svg>
                                            <svg width="18" height="18" class="text-warning">
                                                <use xlink:href="#star-full"></use>
                                            </svg>
                                            <svg width="18" height="18" class="text-warning">
                                                <use xlink:href="#star-full"></use>
                                            </svg>
                                            <svg width="18" height="18" class="text-warning">
                                                <use xlink:href="#star-half"></use>
                                            </svg>
                                        </span>
                                        <span>{{$product->quantity}}</span>
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        <del>${{$product->price + ($product->price * 10/100)}}</del>
                                        <span class="text-dark fw-semibold">${{$product->price}}</span>
                                        <span
                                            class="badge border border-dark-subtle rounded-0 fw-normal px-1 fs-7 lh-1 text-body-tertiary">10%
                                            OFF</span>
                                    </div>
                                    <div class="button-area p-3 pt-0">
                                        <div class="row g-1 mt-2">
                                            <div class="col-3"><input type="number" name="quantity"
                                                    class="form-control border-dark-subtle input-number quantity"
                                                    value="1"></div>
                                            <div class="col-7">
                                                <a href="#" class="btn btn-primary rounded-1 p-2 fs-7 add-to-cart-btn" data-product-id="{{ $product->id }}">
                                                    <input type="hidden" id="auth-status" name="_method" value="{{ Auth::check() ? 'true' : 'false'}}">
                                                    <svg
                                                        width="18" height="18">
                                                        <use xlink:href="#cart"></use>
                                                    </svg> Add to Cart</a></div>
                                            <div class="col-2">
                                                <button data-product-id="{{$product->id}}"
                                                    class="btn btn-outline-dark rounded-1 p-2 fs-6 add-to-wishlist-btn">
                                                    <svg
                                                        width="18" height="18">
                                                        <use xlink:href="#heart"></use>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
