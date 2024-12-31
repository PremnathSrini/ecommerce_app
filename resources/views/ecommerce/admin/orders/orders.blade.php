@extends('ecommerce.admin.admin_layouts.default')
@section('admin-content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Orders</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Orders</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    @error('cancellationReason')
    @push("custom-scripts")
        <script>
            $(document).ready(function(){
                toastr.error("{{$message}}");
            });
        </script>
        @endpush
    @enderror
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">

              <div class="card">
                <div class="card-body">
                  <table id="customer-listing" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th class="col-sm-1">Order Id</th>
                      <th>Ordered Date</th>
                      <th>Customer Name</th>
                      <th>Total</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($orders as $order)
                      <tr>
                          <td> #{{$order->id}} </td>
                          <td> {{date('d M Y H:i A',strtotime($order->created_at))}} </td>
                          <td> {{ucfirst($order->user->name)}} </td>
                          <td> {{$order->total}} </td>
                          <td>
                            <form id="orderStatusForm{{$order->id}}" action="{{route('admin.orders.change-status',base64_encode($order->id))}}" method="POST">
                                @csrf
                                <select name="orderStatus" id="orderStatus{{$order->id}}"
                                    data-order_id="{{ $order->id }}" data-status="{{$order->status->id}}"
                                    class="orderStatus form-control @if(in_array($order->status->id,[2,5]))
                                                bg-success
                                            @elseif (in_array($order->status->id,[6,7]))
                                                bg-danger
                                            @else
                                                bg-primary
                                            @endif">
                                    @foreach ($orderStatuses as $name => $id)
                                    <option value="{{$id}}"
                                        {{($order->status->id == $id) ? 'selected="selected"' : ''}}>
                                        {{$name}}
                                    </option>
                                    @endforeach
                                </select>
                                @error('orderStatus') <span class="text-danger" id="orderStatus_error"> {{$message}} </span> @enderror
                            </form>
                          </td>
                          <td class="col-sm-1 text-center">
                              <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{route('admin.orders.view',base64_encode($order->id))}}" class="fa fa-eye"></a>
                                    {{-- <a class="btn text-success change-status-button" title="Change Status" data-toggle="modal" data-target="#orderStatusModal{{$order->id}}">
                                        {{$order->status->name}}
                                    </a> --}}
                              </div>
                          </td>
                      </tr>
                    @endforeach
                    </tfoot>
                </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="orderStatusModal" tabindex="-1" role="dialog"
            aria-labelledby="orderStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderStatusModalLabel">Change Order Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="cancelOrderForm" action="{{route('admin.orders.cancel.order')}}" method="POST">
                        @csrf
                        <div class="cancellationReason mt-2">
                            <textarea class="form-control" name="cancellationReason"
                                id="cancellationReason" placeholder="Reason for Cancellation"></textarea>
                        </div>
                        <input type="hidden" name="order_id" value="" class="order_id_hidden">
                        @error('cancellationReason') <span class="text-danger" id="cancellationReason_error"> {{$message}} </span> @enderror
                </div>
                <div class="modal-footer">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Change Status</button>
                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
      </section>
@push('custom-scripts')
    <script>
        $(document).ready(function(){
            new DataTable('#customer-listing',{
                scrollX: true,
                order: [[0, 'desc']]
            });

            $(document).on('change','.orderStatus',function(e){
                e.preventDefault();

                if(!confirm('Are you sure you want to update status')){
                    $(this).val($(this).data('status'));
                    return false;
                }

                const orderId = $(this).data('order_id');
                $('.order_id_hidden').val(orderId);
                if($(this).val() === '6'){
                    $('#orderStatusModal').modal('show');
                    $(this).val($(this).data('status'));
                } else {
                    $('#orderStatusModal').modal('hide');
                    const orderStatus = $(this).val();
                    let href = window.location.origin + '/admin/orders/'+ orderId +'/change-status/';
                    console.log(href);
                    $.ajax({
                        type: "POST",
                        url: href,
                        data: {
                            _token: "{{ csrf_token() }}",
                            'orderStatus': orderStatus
                        },
                        success: function (response) {
                            if(response.success){
                                toastr.success('Order Status Updated');
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error("Error:", error);
                            $(this).val($(this).data('status'));
                            alert("Failed to update order status. Please try again.");
                        }
                    });
                }
            });
        });

    </script>
@endpush
@endsection
