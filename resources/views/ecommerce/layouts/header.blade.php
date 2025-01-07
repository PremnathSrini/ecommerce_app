<header>
    <div class="container-fluid">
        <div class="row py-3 border-bottom">

            <div
                class="col-sm-4 col-lg-2 text-center text-sm-start d-flex gap-3 justify-content-center justify-content-md-start">
                <div class="d-flex align-items-center my-3 my-sm-0">
                    <a href="{{ route('home.index') }}">
                        <img src="{{ asset('assets/images/logo.svg') }}" alt="logo" class="img-fluid">
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                    aria-controls="offcanvasNavbar">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#menu"></use>
                    </svg>
                </button>
            </div>

            <div class="col-sm-6 offset-sm-2 offset-md-0 col-lg-4">
                <div class="search-bar row bg-light p-2 rounded-4">
                    <div class="col-md-4 d-none d-md-block">
                        <select class="form-select border-0 bg-transparent">
                            <option>All Categories</option>
                            <option>Groceries</option>
                            <option>Drinks</option>
                            <option>Chocolates</option>
                        </select>
                    </div>
                    <div class="col-11 col-md-7">
                        <form id="search-form"  class="text-center" action="{{ route('home.index') }}" method="post">
                            <input type="text" class="form-control border-0 bg-transparent"
                                placeholder="Search for more than 20,000 products">
                        </form>
                    </div>
                    <div class="col-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <ul
                    class="navbar-nav list-unstyled d-flex flex-row gap-3 gap-lg-5 justify-content-center flex-wrap align-items-center mb-0 fw-bold text-uppercase text-dark">
                    <li class="nav-item active">
                        <a href="{{ route('home.index') }}" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle pe-3" role="button" id="pages" data-bs-toggle="dropdown"
                            aria-expanded="false">Pages</a>
                        <ul class="dropdown-menu border-0 p-3 rounded-0 shadow" aria-labelledby="pages">
                            <li><a href="{{ route('home.index') }}" class="dropdown-item">About Us </a></li>
                            <li><a href="{{ route('home.index') }}" class="dropdown-item">Shop </a></li>
                            <li><a href="{{ route('home.index') }}" class="dropdown-item">Single Product </a></li>
                            <li><a href="{{ route('home.index') }}" class="dropdown-item">Cart </a></li>
                            <li><a href="{{ route('home.index') }}" class="dropdown-item">Checkout </a></li>
                            <li><a href="{{ route('home.index') }}" class="dropdown-item">Blog </a></li>
                            <li><a href="{{ route('home.index') }}" class="dropdown-item">Single Post </a></li>
                            <li><a href="{{ route('home.index') }}" class="dropdown-item">Styles </a></li>
                            <li><a href="{{ route('home.index') }}" class="dropdown-item">Contact </a></li>
                            <li><a href="{{ route('home.index') }}" class="dropdown-item">Thank You </a></li>
                            <li><a href="{{ route('home.index') }}" class="dropdown-item">My Account </a></li>
                            <li><a href="{{ route('home.index') }}" class="dropdown-item">404 Error </a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div
                class="col-sm-8 col-lg-2 d-flex gap-5 align-items-center justify-content-center justify-content-sm-end">
                <ul class="d-flex justify-content-end list-unstyled m-0">
                    @guest
                        <li>
                            <a href="{{route('user.login')}}" class="p-2 text-dark mx-1">
                                <svg width="24" height="24">
                                    <use xlink:href="#user"></use>
                                </svg>
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ Auth::user()->role_id === 0 ? route('user.index') : redirect()->route('user.login')->with('auth-error','Wrong Credentials') }}"
                                class="p-2 mx-1 text-dark ml-5">
                                <svg width="24" height="24">
                                    <use xlink:href="#user"></use>
                                </svg>
                                <a class="nav-link dropdown-toggle pe-3" role="button" id="name-dropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }}</a>
                                <ul class="dropdown-menu border-0 p-3 rounded-0 shadow" aria-labelledby="pages"><li><a href="{{ route('user.profile') }}" class="dropdown-item">My Account </a></li>
                                    <li>
                                        <form action="{{route('logout')}}" method="POST">
                                            @csrf
                                            <a href="{{route('logout')}}" class="dropdown-item" onclick="event.preventDefault();
                                                this.closest('form').submit();">Log out</a>
                                        </form>
                                    </li>
                                </ul>
                            </a>
                        </li>
                    @endguest
                    <li>
                        <a href="#" class="p-2 mx-1 text-dark" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasWishlist" aria-controls="offcanvasWishlist">
                            <svg width="24" height="24">
                                <use xlink:href="#wishlist"></use>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="p-2 mx-1 text-dark" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                            <svg width="24" height="24">
                                <use xlink:href="#shopping-bag"></use>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="p-2 mx-1 text-dark" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasNotifications" aria-controls="offcanvasNotifications">
                            <i class="bi bi-bell h4 pt-2"></i>
                            <span class="position-absolute top-0 end-0 mt-2 me-2 badge rounded-pill bg-danger">
                                {{$count_of_unreadNotification ?? ''}}
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
