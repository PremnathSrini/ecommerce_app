@extends('layouts.app')

@section('content')
    <section
        style="background-image: url('{{ asset('assets/images/banner-1.jpg') }}');background-repeat: no-repeat;background-size: cover;">
        <div class="container-lg">
            <div class="row">
                <div class="col-lg-6 pt-5 mt-5">
                    <h2 class="display-1 ls-1"><span class="fw-bold text-primary">Organic</span> Foods at your <span
                            class="fw-bold">Doorsteps</span></h2>
                    <i>
                        <p class="fs-4">Dignissim massa diam elementum.</p>
                    </i>
                    <div class="d-flex gap-3">
                        <a href="{{ route('login') }}"
                            class="btn btn-primary text-uppercase fs-6 rounded-pill px-4 py-3 mt-3">Start Shopping</a>
                        <a href="{{ route('login') }}"
                            class="btn btn-dark text-uppercase fs-6 rounded-pill px-4 py-3 mt-3">Join
                            Now</a>
                    </div>
                    <div class="row my-5">
                        <div class="col">
                            <div class="row text-dark">
                                <div class="col-auto">
                                    <p class="fs-1 fw-bold lh-sm mb-0">14k+</p>
                                </div>
                                <div class="col">
                                    <p class="text-uppercase lh-sm mb-0">Product Varieties</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row text-dark">
                                <div class="col-auto">
                                    <p class="fs-1 fw-bold lh-sm mb-0">50k+</p>
                                </div>
                                <div class="col">
                                    <p class="text-uppercase lh-sm mb-0">Happy Customers</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row text-dark">
                                <div class="col-auto">
                                    <p class="fs-1 fw-bold lh-sm mb-0">10+</p>
                                </div>
                                <div class="col">
                                    <p class="text-uppercase lh-sm mb-0">Store Locations</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-sm-3 row-cols-lg-3 g-0 justify-content-center">
                <div class="col">
                    <div class="card border-0 bg-primary rounded-0 p-4 text-light">
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <svg width="60" height="60">
                                    <use xlink:href="#fresh"></use>
                                </svg>
                            </div>
                            <div class="col-md-9">
                                <div class="card-body p-0">
                                    <h5 class="text-light">Fresh from farm</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-0 bg-secondary rounded-0 p-4 text-light">
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <svg width="60" height="60">
                                    <use xlink:href="#organic"></use>
                                </svg>
                            </div>
                            <div class="col-md-9">
                                <div class="card-body p-0">
                                    <h5 class="text-light">100% Organic</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-0 bg-danger rounded-0 p-4 text-light">
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <svg width="60" height="60">
                                    <use xlink:href="#delivery"></use>
                                </svg>
                            </div>
                            <div class="col-md-9">
                                <div class="card-body p-0">
                                    <h5 class="text-light">Free delivery</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="py-5 overflow-hidden">
        <div class="container-lg">
            <div class="row">
                <div class="col-md-12">

                    <div class="section-header d-flex flex-wrap justify-content-between mb-5">
                        <h2 class="section-title">Category</h2>

                        <div class="d-flex align-items-center">
                            <a href="#" class="btn btn-primary me-2">View All</a>
                            <div class="swiper-buttons">
                                <button class="swiper-prev category-carousel-prev btn btn-yellow">❮</button>
                                <button class="swiper-next category-carousel-next btn btn-yellow">❯</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="category-carousel swiper">
                        <div class="swiper-wrapper">
                            @php
                                $parent_categories = \App\Models\Category::where('parent_id', 0)->get();
                                $sub_categories = \App\Models\Category::where('parent_id', '!=', 0)->get();
                            @endphp
                            @foreach ($parent_categories as $category)
                                <a href="{{ route('category.show', $category->slug) }}"
                                    class="nav-link swiper-slide text-center">
                                    <img src="{{ asset('images/' . $category->image) }}" class="rounded-circle"
                                        alt="Category Thumbnail" width="190px" height="190px">
                                    <h4 class="fs-6 mt-3 fw-normal category-title">{{ $category->name }}</h4>
                                </a>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="pb-5">
        <div class="container-lg">

            <div class="row">
                <div class="col-md-12">

                    <div class="section-header d-flex flex-wrap justify-content-between my-4">

                        <h2 class="section-title">Best selling products</h2>

                        <div class="d-flex align-items-center">
                            <a href="{{route('best.show')}}" class="btn btn-primary rounded-1 disabled">View All</a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <div
                        class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5">

                        @foreach ($best_selling_products as $product)
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
                                                    <button type="button" class="btn btn-primary rounded-1 p-2 fs-7 add-to-cart-btn"
                                                        data-product-id="{{ $product->id }}">
                                                        <svg
                                                            width="18" height="18">
                                                            <use xlink:href="#cart"></use>
                                                        </svg>Add to Cart
                                                    </button>
                                                </div>
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


    <section id="featured-products" class="products-carousel">
        <div class="container-lg overflow-hidden py-5">
            <div class="row">
                <div class="col-md-12">

                    <div class="section-header d-flex flex-wrap justify-content-between my-4">

                        <h2 class="section-title">Featured products</h2>

                        <div class="d-flex align-items-center">
                            <a href="{{route('featured.show')}}" class="btn btn-primary me-2">View All</a>
                            <div class="swiper-buttons">
                                <button class="swiper-prev products-carousel-prev btn btn-primary">❮</button>
                                <button class="swiper-next products-carousel-next btn btn-primary">❯</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="swiper">
                        <div class="swiper-wrapper">
                            @foreach ($featured_products as $product)
                            <div class="product-item swiper-slide">
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
                                                    <button type="button" class="btn btn-primary rounded-1 p-2 fs-7 add-to-cart-btn"
                                                        data-product-id="{{ $product->id }}">
                                                        <svg
                                                            width="18" height="18">
                                                            <use xlink:href="#cart"></use>
                                                        </svg>Add to Cart
                                                    </button>
                                                </div>
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
                            @endforeach
                        </div>
                    </div>
                    <!-- / products-carousel -->
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-lg">

            <div class="bg-secondary text-light py-5 my-5"
                style="background: url('{{ asset('assets/images/banner-newsletter.jpg') }}') no-repeat; background-size: cover;">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-5 p-3">
                            <div class="section-header">
                                <h2 class="section-title display-5 text-light">Get 25% Discount on your first purchase
                                </h2>
                            </div>
                            <p>Just Sign Up & Register it now to become member.</p>
                        </div>
                        <div class="col-md-5 p-3">
                            <form>
                                <div class="mb-3">
                                    <label for="name" class="form-label d-none">Name</label>
                                    <input type="text" class="form-control form-control-md rounded-0"
                                        name="name" id="name" placeholder="Name">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label d-none">Email</label>
                                    <input type="email" class="form-control form-control-md rounded-0"
                                        name="email" id="email" placeholder="Email Address">
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-dark btn-md rounded-0">Submit</button>
                                </div>
                            </form>

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </section>

    <section id="popular-products" class="products-carousel">
        <div class="container-lg overflow-hidden py-5">
            <div class="row">
                <div class="col-md-12">

                    <div class="section-header d-flex justify-content-between my-4">

                        <h2 class="section-title">Most popular products</h2>

                        <div class="d-flex align-items-center">
                            <a href="{{route('most.show')}}" class="btn btn-primary me-2">View All</a>
                            <div class="swiper-buttons">
                                <button class="swiper-prev products-carousel-prev btn btn-primary">❮</button>
                                <button class="swiper-next products-carousel-next btn btn-primary">❯</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="swiper">
                        <div class="swiper-wrapper">

                            @foreach ($most_popular_products as $product)
                            <div class="product-item swiper-slide">
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
                                                    <button type="button" class="btn btn-primary rounded-1 p-2 fs-7 add-to-cart-btn"
                                                        data-product-id="{{ $product->id }}">
                                                        <svg
                                                            width="18" height="18">
                                                            <use xlink:href="#cart"></use>
                                                        </svg>Add to Cart
                                                    </button>
                                                </div>
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
                            @endforeach

                        </div>
                    </div>
                    <!-- / products-carousel -->

                </div>
            </div>
        </div>
    </section>

    <section id="latest-products" class="products-carousel">
        <div class="container-lg overflow-hidden pb-5">
            <div class="row">
                <div class="col-md-12">

                    <div class="section-header d-flex justify-content-between my-4">

                        <h2 class="section-title">Just arrived</h2>

                        <div class="d-flex align-items-center">
                            <a href="{{route('recent.show')}}" class="btn btn-primary me-2">View All</a>
                            <div class="swiper-buttons">
                                <button class="swiper-prev products-carousel-prev btn btn-primary">❮</button>
                                <button class="swiper-next products-carousel-next btn btn-primary">❯</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="swiper">
                        <div class="swiper-wrapper">

                            @foreach ($recent_products as $product)
                            <div class="product-item swiper-slide">
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
                                                    <button type="button" class="btn btn-primary rounded-1 p-2 fs-7 add-to-cart-btn"
                                                        data-product-id="{{ $product->id }}">
                                                        <svg
                                                            width="18" height="18">
                                                            <use xlink:href="#cart"></use>
                                                        </svg>Add to Cart
                                                    </button>
                                                </div>
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
                            @endforeach
                        </div>
                    </div>
                    <!-- / products-carousel -->

                </div>
            </div>
        </div>
    </section>

    <section id="latest-blog" class="pb-4">
        <div class="container-lg">
            <div class="row">
                <div class="section-header d-flex align-items-center justify-content-between my-4">
                    <h2 class="section-title">Our Recent Blog</h2>
                    <a href="#" class="btn btn-primary">View All</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <article class="post-item card border-0 shadow-sm p-3">
                        <div class="image-holder zoom-effect">
                            <a href="#">
                                <img src="{{ asset('assets/images/post-thumbnail-1.jpg') }}" alt="post"
                                    class="card-img-top">
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="post-meta d-flex text-uppercase gap-3 my-2 align-items-center">
                                <div class="meta-date"><svg width="16" height="16">
                                        <use xlink:href="#calendar"></use>
                                    </svg>22 Aug 2021</div>
                                <div class="meta-categories"><svg width="16" height="16">
                                        <use xlink:href="#category"></use>
                                    </svg>tips & tricks</div>
                            </div>
                            <div class="post-header">
                                <h3 class="post-title">
                                    <a href="#" class="text-decoration-none">Top 10 casual look ideas to dress
                                        up your kids</a>
                                </h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipi elit. Aliquet eleifend viverra enim
                                    tincidunt donec quam. A in arcu, hendrerit neque dolor morbi...</p>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-md-4">
                    <article class="post-item card border-0 shadow-sm p-3">
                        <div class="image-holder zoom-effect">
                            <a href="#">
                                <img src="{{ asset('assets/images/post-thumbnail-2.jpg') }}" alt="post"
                                    class="card-img-top">
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="post-meta d-flex text-uppercase gap-3 my-2 align-items-center">
                                <div class="meta-date"><svg width="16" height="16">
                                        <use xlink:href="#calendar"></use>
                                    </svg>25 Aug 2021</div>
                                <div class="meta-categories"><svg width="16" height="16">
                                        <use xlink:href="#category"></use>
                                    </svg>trending</div>
                            </div>
                            <div class="post-header">
                                <h3 class="post-title">
                                    <a href="#" class="text-decoration-none">Latest trends of wearing street
                                        wears supremely</a>
                                </h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipi elit. Aliquet eleifend viverra enim
                                    tincidunt donec quam. A in arcu, hendrerit neque dolor morbi...</p>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-md-4">
                    <article class="post-item card border-0 shadow-sm p-3">
                        <div class="image-holder zoom-effect">
                            <a href="#">
                                <img src="{{ asset('assets/images/post-thumbnail-1.jpg') }}" alt="post"
                                    class="card-img-top">
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="post-meta d-flex text-uppercase gap-3 my-2 align-items-center">
                                <div class="meta-date"><svg width="16" height="16">
                                        <use xlink:href="#calendar"></use>
                                    </svg>28 Aug 2021</div>
                                <div class="meta-categories"><svg width="16" height="16">
                                        <use xlink:href="#category"></use>
                                    </svg>inspiration</div>
                            </div>
                            <div class="post-header">
                                <h3 class="post-title">
                                    <a href="#" class="text-decoration-none">10 Different Types of comfortable
                                        clothes ideas for women</a>
                                </h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipi elit. Aliquet eleifend viverra enim
                                    tincidunt donec quam. A in arcu, hendrerit neque dolor morbi...</p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-4 my-4">
        <div class="container-lg">

            <div class="bg-warning pt-5 rounded-5">
                <div class="container">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-4">
                            <h2 class="mt-5">Download Organic App</h2>
                            <p>Online Orders made easy, fast and reliable</p>
                            <div class="d-flex gap-2 flex-wrap mb-5">
                                <a href="#" title="App store"><img src="{{asset('assets/images/img-app-store.png')}}"
                                        alt="app-store"></a>
                                <a href="#" title="Google Play"><img src="{{asset('assets/images/img-google-play.png')}}"
                                        alt="google-play"></a>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <img src="{{ asset('assets/images/banner-onlineapp.png') }}" alt="phone"
                                class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="py-4">
        <div class="container-lg">
            <h2 class="my-4">People are also looking for</h2>
            <a href="#" class="btn btn-warning me-2 mb-2">Blue diamon almonds</a>
            <a href="#" class="btn btn-warning me-2 mb-2">Angie’s Boomchickapop Corn</a>
            <a href="#" class="btn btn-warning me-2 mb-2">Salty kettle Corn</a>
            <a href="#" class="btn btn-warning me-2 mb-2">Chobani Greek Yogurt</a>
            <a href="#" class="btn btn-warning me-2 mb-2">Sweet Vanilla Yogurt</a>
            <a href="#" class="btn btn-warning me-2 mb-2">Foster Farms Takeout Crispy wings</a>
            <a href="#" class="btn btn-warning me-2 mb-2">Warrior Blend Organic</a>
            <a href="#" class="btn btn-warning me-2 mb-2">Chao Cheese Creamy</a>
            <a href="#" class="btn btn-warning me-2 mb-2">Chicken meatballs</a>
            <a href="#" class="btn btn-warning me-2 mb-2">Blue diamon almonds</a>
            <a href="#" class="btn btn-warning me-2 mb-2">Angie’s Boomchickapop Corn</a>
            <a href="#" class="btn btn-warning me-2 mb-2">Salty kettle Corn</a>
            <a href="#" class="btn btn-warning me-2 mb-2">Chobani Greek Yogurt</a>
            <a href="#" class="btn btn-warning me-2 mb-2">Sweet Vanilla Yogurt</a>
            <a href="#" class="btn btn-warning me-2 mb-2">Foster Farms Takeout Crispy wings</a>
            <a href="#" class="btn btn-warning me-2 mb-2">Warrior Blend Organic</a>
            <a href="#" class="btn btn-warning me-2 mb-2">Chao Cheese Creamy</a>
            <a href="#" class="btn btn-warning me-2 mb-2">Chicken meatballs</a>
        </div>
    </section>

    <section class="py-5">
        <div class="container-lg">
            <div class="row row-cols-1 row-cols-sm-3 row-cols-lg-5">
                <div class="col">
                    <div class="card mb-3 border border-dark-subtle p-3">
                        <div class="text-dark mb-3">
                            <svg width="32" height="32">
                                <use xlink:href="#package"></use>
                            </svg>
                        </div>
                        <div class="card-body p-0">
                            <h5>Free delivery</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-3 border border-dark-subtle p-3">
                        <div class="text-dark mb-3">
                            <svg width="32" height="32">
                                <use xlink:href="#secure"></use>
                            </svg>
                        </div>
                        <div class="card-body p-0">
                            <h5>100% secure payment</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-3 border border-dark-subtle p-3">
                        <div class="text-dark mb-3">
                            <svg width="32" height="32">
                                <use xlink:href="#quality"></use>
                            </svg>
                        </div>
                        <div class="card-body p-0">
                            <h5>Quality guarantee</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-3 border border-dark-subtle p-3">
                        <div class="text-dark mb-3">
                            <svg width="32" height="32">
                                <use xlink:href="#savings"></use>
                            </svg>
                        </div>
                        <div class="card-body p-0">
                            <h5>guaranteed savings</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-3 border border-dark-subtle p-3">
                        <div class="text-dark mb-3">
                            <svg width="32" height="32">
                                <use xlink:href="#offers"></use>
                            </svg>
                        </div>
                        <div class="card-body p-0">
                            <h5>Daily offers</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
