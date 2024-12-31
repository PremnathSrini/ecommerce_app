@extends('layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>My Orders</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">My Orders</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-11 m-auto">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td>#OrderId</td>
                                    <td>Ordered Date</td>
                                    <td>Customer Name</td>
                                    <td>Total</td>
                                    <td>Status</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($orders->isEmpty())
                                    <tr>
                                        <td colspan="6">No orders found.</td>
                                    </tr>
                                @else
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>#{{$order->id}}</td>
                                        <td>{{date('d M Y G:i A',strtotime($order->created_at))}}</td>
                                        <td>{{ Str::ucfirst(Auth::user()->name) }}</td>
                                        <td>${{ number_format($order->total,2) }}</td>
                                        <td>{{$order->status->name??null}}</td>
                                        <td class="text-center">
                                                <a href="{{ route('view.order',[base64_encode($order->id)]) }}" title="View Order">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @if($order->order_status_id <= 5 )
                                                <a class="btn order-cancel-button" title="Cancel Order" data-order_id={{$order->id}}>
                                                    <i class="fa fa-close text-danger"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog"
        aria-labelledby="cancelModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelModalLabel">Reason for Cancellation</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="cancelForm" action="{{ route('cancel.order') }}" method="POST">
                    <input type="hidden" name="cancel_order_id" value="" class="hidden_cancel_order_id">
                    <div class="modal-body">
                            @csrf
                            <textarea name="reason" class="form-control" placeholder="Please provide a reason for cancellation"></textarea>
                            @error('reason') <span class="text-danger"> {{$message}} </span> @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Cancel Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</section>
@push("custom-scripts")
<script>
    $(document).on('click','.order-cancel-button',function(){
        const orderId = $(this).data('order_id');
        $('.hidden_cancel_order_id').val(orderId);
        $('#cancelModal').modal('show');
    });
</script>

@endpush
@endsection
