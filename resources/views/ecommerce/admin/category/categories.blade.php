@extends('ecommerce.admin.admin_layouts.default')
@section('admin-content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Categories</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Categories</li>
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
                            <a href="{{ route('admin.category.create') }}" class="btn btn-primary"><i
                                    class="bi bi-plus-circle-fill text-white"></i> Add new</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="category-listing" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl.No</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Parent Category</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $item)
                                    <tr>
                                        <td> {{ $loop->index + 1 }} </td>
                                        <td class=" col-md-2 text-center"><img width="100px" class=""
                                                src="{{ URL::asset('images/' . $item->image) }}"></td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->parent_name }}</td>
                                        <td>{{ ($item->status == 1) ? 'Active' : 'Inactive'}}</td>
                                        <td class="col-md-1 text-center">
                                            <div class="d-flex justify-content-around align-items-center">
                                                <a class="btn text-primary"
                                                    href="{{ route('admin.category.edit', [$item->id]) }}"><i
                                                        class="bi bi-pencil-square pl-1"></i>
                                                </a>

                                                <form action="{{ route('admin.category.destroy', [$item->id]) }}"
                                                    method="POST" id="deleteForm"
                                                    onsubmit="return confirm('Are you sure want to delete?')">
                                                    @csrf
                                                    @php
                                                        $disabled="";
                                                        $message="Delete Category";
                                                        if(in_array($item->id,$category_ids)){
                                                            $disabled='disabled=disabled';
                                                            $message="Cannot delete this category, it is associated with a product";
                                                        }
                                                    @endphp
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button class="btn text-delete text-danger" type="submit" data-id={{$item->id}} data-toggle="tooltip"
                                                        title="{{ $message }}" {{ $disabled }}><i
                                                            class="bi bi-trash3-fill pl-1"></i></button>
                                                </form>
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
</section>

    @push('custom-scripts')
        <script>
            $('#category-listing').DataTable({
                order: [[0, 'desc']]
            });
        </script>
    @endpush
@endsection
