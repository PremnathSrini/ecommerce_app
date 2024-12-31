@extends('ecommerce.admin.admin_layouts.default')
@section('admin-content')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Products</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
            <li class="breadcrumb-item active">Products</li>
        </ol>
        </div>
    </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
    <div class="row">
        <div class="col-12">

        <div class="card">
            <div class="card-header">
            <div class="col-md-10">
                <h3 class="card-title"></h3>
            </div>
            <div class="col-md-2 float-right">
                <a href="{{route('admin.products.create')}}"  class="btn btn-primary"><i class="bi bi-plus-circle-fill text-white"></i> Add new</a>
            </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="category-listing" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>Sl.No</th>
                <th>Image</th>
                <th>Product name</th>
                <th>Category</th>
                <th>Product Slug</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($products as $item)
                <tr>
                    <td> {{$loop->iteration}} </td>
                    <td>
                        <img src="{{URL::asset('images/products/'.$item->image)}}" width="60px" alt="{{$item->image}}">
                    </td>
                    <td> {{$item->product_name}} </td>
                    <td>{{$item->parent_category}}</td>
                    <td>{{$item->product_slug}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->price}}</td>
                    <td col-md-1 text-center>
                        <div class="row">
                            <div class="col-md-3 pr-1">
                                <a class="btn text-primary" href="{{route('admin.products.edit',$item->id)}}"><i class="bi bi-pencil-square pl-1"></i></a>
                            </div>
                            <div class="col-md-3 pl-1">
                                <form action="{{route('admin.products.destroy',$item->id)}}" method="POST" id="deleteForm" onsubmit="return confirm('Are you sure want to delete?')">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn text-danger" type="submit" id="deleteBtn"><i class="bi bi-trash3-fill pl-1"></i></button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
                </tfoot>
            </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

</section>
    @push('custom-scripts')
    <script>
        $('#category-listing').DataTable({
            order: [[0, 'desc']]
        });
    </script>
@endpush
@endsection
