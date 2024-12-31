<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar">

    <div class="offcanvas-header justify-content-between">
        <h4 class="fw-normal text-uppercase fs-6">Menu</h4>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">

        <ul class="navbar-nav justify-content-end menu-list list-unstyled d-flex gap-md-3 mb-3">
            @php
                $parent_categories = \App\Models\Category::where('parent_id',0)->get();
                $sub_categories = \App\Models\Category::where('parent_id','!=',0)->get();
            @endphp
        @foreach ($parent_categories as $category)
            @if(!$category->subCategories->isEmpty())
                <li class="nav-item border-dashed">
                    <button
                        class="btn btn-toggle dropdown-toggle position-relative w-100 d-flex justify-content-between align-items-center text-dark p-2"
                        data-bs-toggle="collapse" data-bs-target="#{{$category->id}}-collapse" aria-expanded="false">
                        <div class="d-flex gap-3">
                                <i class="bi bi-boxes"></i>
                            <span>{{$category->name}}</span>
                        </div>
                    </button>
                    <div class="collapse" id="{{$category->id}}-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal ps-5 pb-1">
                        @foreach ($sub_categories as $item)
                            @if ($item->parent_id == $category->id)
                                    <li class="border-bottom py-2"><a href="{{route('category.sub.show',[$category->slug,$item->slug])}}" class="dropdown-item">{{$item->name}}</a></li>
                            @endif
                        @endforeach
                        </ul>
                    </div>
                </li>
                @else
                <li class="nav-item border-dashed active">
                    <a href="{{route('category.parent.show',$category->slug)}}" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box2" viewBox="0 0 16 16">
                            <path d="M2.95.4a1 1 0 0 1 .8-.4h8.5a1 1 0 0 1 .8.4l2.85 3.8a.5.5 0 0 1 .1.3V15a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4.5a.5.5 0 0 1 .1-.3zM7.5 1H3.75L1.5 4h6zm1 0v3h6l-2.25-3zM15 5H1v10h14z"/>
                          </svg>
                        <span>{{$category->name}}</span>
                    </a>
                </li>
                @endif
            @endforeach
        </ul>

        {{-- <ul class="navbar-nav justify-content-end menu-list list-unstyled d-flex gap-md-3 mb-0">
            <li class="nav-item border-dashed active">
                <a href="index.html" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#fruits"></use>
                    </svg>
                    <span>Fruits and vegetables</span>
                </a>
            </li>
            <li class="nav-item border-dashed">
                <a href="index.html" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#dairy"></use>
                    </svg>
                    <span>Dairy and Eggs</span>
                </a>
            </li>
            <li class="nav-item border-dashed">
                <a href="index.html" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#meat"></use>
                    </svg>
                    <span>Meat and Poultry</span>
                </a>
            </li>
            <li class="nav-item border-dashed">
                <a href="index.html" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#seafood"></use>
                    </svg>
                    <span>Seafood</span>
                </a>
            </li>
            <li class="nav-item border-dashed">
                <a href="index.html" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#bakery"></use>
                    </svg>
                    <span>Bakery and Bread</span>
                </a>
            </li>
            <li class="nav-item border-dashed">
                <a href="index.html" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#canned"></use>
                    </svg>
                    <span>Canned Goods</span>
                </a>
            </li>
            <li class="nav-item border-dashed">
                <a href="index.html" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#frozen"></use>
                    </svg>
                    <span>Frozen Foods</span>
                </a>
            </li>
            <li class="nav-item border-dashed">
                <a href="index.html" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#pasta"></use>
                    </svg>
                    <span>Pasta and Rice</span>
                </a>
            </li>
            <li class="nav-item border-dashed">
                <a href="index.html" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#breakfast"></use>
                    </svg>
                    <span>Breakfast Foods</span>
                </a>
            </li>
            <li class="nav-item border-dashed">
                <a href="index.html" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#snacks"></use>
                    </svg>
                    <span>Snacks and Chips</span>
                </a>
            </li>
            <li class="nav-item border-dashed">
                <button
                    class="btn btn-toggle dropdown-toggle position-relative w-100 d-flex justify-content-between align-items-center text-dark p-2"
                    data-bs-toggle="collapse" data-bs-target="#beverages-collapse" aria-expanded="false">
                    <div class="d-flex gap-3">
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <use xlink:href="#beverages"></use>
                        </svg>
                        <span>Beverages</span>
                    </div>
                </button>
                <div class="collapse" id="beverages-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal ps-5 pb-1">
                        <li class="border-bottom py-2"><a href="index.html" class="dropdown-item">Water</a></li>
                        <li class="border-bottom py-2"><a href="index.html" class="dropdown-item">Juice</a></li>
                        <li class="border-bottom py-2"><a href="index.html" class="dropdown-item">Soda</a></li>
                        <li class="border-bottom py-2"><a href="index.html" class="dropdown-item">Tea</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item border-dashed">
                <a href="index.html" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#spices"></use>
                    </svg>
                    <span>Spices and Seasonings</span>
                </a>
            </li>
            <li class="nav-item border-dashed">
                <a href="index.html" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#baby"></use>
                    </svg>
                    <span>Baby Food and Formula</span>
                </a>
            </li>
            <li class="nav-item border-dashed">
                <a href="index.html" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#health"></use>
                    </svg>
                    <span>Health and Wellness</span>
                </a>
            </li>
            <li class="nav-item border-dashed">
                <a href="index.html" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#household"></use>
                    </svg>
                    <span>Household Supplies</span>
                </a>
            </li>
            <li class="nav-item border-dashed">
                <a href="index.html" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#personal"></use>
                    </svg>
                    <span>Personal Care</span>
                </a>
            </li>
            <li class="nav-item border-dashed">
                <a href="index.html" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#pet"></use>
                    </svg>
                    <span>Pet Food and Supplies</span>
                </a>
            </li>
        </ul> --}}

    </div>

</div>
