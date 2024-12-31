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
                        <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Orders</a></li>
                    <li class="breadcrumb-item active">Order#{{$order_id}}</li>
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
                        <div class="row">
                            <div class="col">
                                <table class="table table-bordered">
                                    @foreach ($orders as $order)
                                    <tbody>
                                        <tr>
                                            <td class="text-dark"><strong>Order ID</strong></td>
                                            <td><strong># {{$order_id}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-dark">Order Status</td>
                                            <td> <strong> {{$order->status->name}} </strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td class="text-dark font-weight-bold">Shipping Method</td>
                                            <td># {{$order_id}} </td>
                                        </tr>
                                        <tr>
                                            <td class="text-dark font-weight-bold">Payment Method</td>
                                            <td> {{($order->payment_method)==1 ? "COD" : '' }} </td>
                                        </tr>
                                        <tr>
                                            <td class="text-dark font-weight-bold">Date Added</td>
                                            <td> {{date('d/m/Y',strtotime($order->created_at))}} </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td class="text-dark font-weight-bold">Shipping Address</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="">
                                                <p class="m-0 p-0">{{$order->address->name .' - '. $order->address->phone_number}}</p>
                                                <p class="m-0 p-0">{{$order->address->address_1}}</p>
                                                <p class="m-0 p-0">{{$order->address->city .' - '. $order->address->zip_code}}</p>
                                                <p class="m-0 p-0">{{$order->address->state}}</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endforeach
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td class="text-dark font-weight-bold">Product Name</td>
                                            <td class="text-dark font-weight-bold">Quantity</td>
                                            <td class="text-dark font-weight-bold">Price</td>
                                            <td class="text-dark font-weight-bold">Total</td>
                                            {{-- <td class="text-dark font-weight-bold">Actions</td> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderDescriptions as $orderDescription)
                                        <tr>
                                            <td class="text-info">
                                                {{$orderDescription->products->product_name}}
                                            </td>
                                            <td> {{$orderDescription->quantity}} </td>
                                            <td>₹ {{number_format($orderDescription->products->price,2)}} </td>
                                            <td>₹ {{number_format(($orderDescription->quantity * $orderDescription->products->price),2)}} </td>
                                            {{-- <td class="d-flex justify-content-around align-items-center">
                                                <a href="" class="btn bg-info" title="Reorder Add Product to Cart"><i class="bi bi-cart-fill text-white"></i></a>
                                                <a href="" class="btn bg-danger" title="Return Product"><i class="bi bi-arrow-return-left text-white"></i></a>
                                            </td> --}}
                                        </tr>
                                    </tbody>
                                    @endforeach
                                    <tfoot>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td class="text-dark font-weight-bold">
                                                Sub-Total
                                            </td>
                                            <td>₹ {{ number_format($order->sub_total, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td class="text-dark font-weight-bold">
                                                Flat Shipping Rate
                                            </td>
                                            <td>₹ 75.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td class="text-dark font-weight-bold">
                                                Total
                                            </td>
                                            <td>₹ {{ number_format($order->total + 75.00,2) }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <h2 class="text-dark my-2">Order History</h2>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td class="text-dark font-weight-bold">Date Added</td>
                                    <td class="text-dark font-weight-bold">Comment</td>
                                    <td class="text-dark font-weight-bold">Status</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td>{{date('d/m/Y',strtotime($order->updated_at))}}</td>
                                    <td> {{$orderCancelReason->reason ?? ''}}</td>
                                    <td>{{$order->status->name}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
