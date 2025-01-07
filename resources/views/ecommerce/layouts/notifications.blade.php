<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasNotifications">
    <div class="offcanvas-header justify-content-center">
        <button type="button" class="btn-close wishlist-close-btn" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    @guest
    <div class="offcanvas-body">
        <div class="order-md-last">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary">Your Notifications</span>
            </h4>
        </div>
        <span>Login to view the notifications</span>
        <a class="w-100 btn btn-primary btn-lg" href="{{route('user.login')}}">Login To Continue</a>
    </div>
    @else
    <div class="offcanvas-body">
        <div class="order-md-last">
            <h4 class="d-flex justify-content-between align-items-center">
                <span class="text-primary">Your Notifications</span>
                <a class="btn pt-0 mb-0 text-success mark-as-read-btn" title="Mark as Read">
                    Mark all as Read
                </a>
            </h4>
        </div>
        <ul class="list-group mb-3" id="notifications">
            @foreach($notifications as $notification)
            <li class="list-group-item d-flex justify-content-between lh-sm">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-11">
                            <h6 class="mt-1 text-dark font-weight-bold">
                                {{$notification->data['title'] ?? ''}}
                            </h6>
                        </div>
                    </div>
                    <small class="text-body-secondary">{{$notification->data['description'] ?? ''}}</small>
                </div>
                <a href="{{route('list.order')}}" class="btn pt-0 mt-0 text-success" title="Mark as Read">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    @endguest
</div>
@push("custom-scripts")
    <script>
        $(document).on('click','.mark-as-read-btn',function(){
            window.location.href = window.location.origin + '/user/mark-as-read';
        });
    </script>
@endpush
