@extends('ecommerce.admin.admin_layouts.default')
@section('admin-content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Category Edit</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('admin.category.index')}}">Categories</a></li>
                    <li class="breadcrumb-item active">Category Edit</li>
                </ol>
            </div>
        </div>
    </div>
</section>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Category</h3>
                    </div>

                    <form action="{{route('admin.category.update',$category->id)}}" method="POST" id="regForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="category_name">Category</label><span class="text-danger">*</span>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter Category" value="{{$category->name}}">
                                    <span class="text-danger" id="name_error">
                                        @error('name') {{ $message }}  @enderror
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <label for="parent_id">Parent Category</label><br>
                                        <select name="parent_id" id="parent_id" class="form-control">
                                            <option value="{{$category->id}}"> {{$category->name}} </option>
                                            @foreach ($categories as $item)
                                            @if($item->parent_id==0)
                                            <option value="{{$item->id}}"> {{ $item->name}} </option>
                                            @endif
                                            @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="image">File input</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="image">Choose File</label>
                                                <input type="file" class="custom-file-input"
                                                    id="image" name="image" value="{{$category->image}}" accept="image/*">
                                            </div>
                                        </div>
                                        <span class="text-danger" id="image_error">
                                            @error('image') {{ $message }}  @enderror
                                        </span>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="slug">Search Engine slug</label><span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="slug" name="slug" value="{{$category->slug}}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="status">Status</label><span class="text-danger">*</span><br>
                                                <label class="text-align-center" for="active"><input type="radio" name="status" id="active" value="1" {{$category->status ===1 ? 'checked' : ''}}> Active</label>
                                                <label class="pl-3" for="inactive"><input type="radio" name="status" id="inactive" value="0" {{$category->status ===0 ? 'checked' : ''}}> Inactive</label>
                                                <span class="text-danger" id="active_error">
                                                    @error('status') {{ $message }}  @enderror
                                                </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    @if ($category->image)
                                    <div class="file-info">
                                        <label>Preview:<br>
                                            <img src="{{asset('images/'.$category->image)}}" width="150px" height="150px"  class="rounded float-start"></img> </label>
                                        <p class="text-info">You can upload a new file or leave it as is.</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{route('admin.category.index')}}" class="btn btn-danger">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@push("custom-scripts")
    <script>
        $(document).ready(function(){
            $('#name').on('input',function(){
                var name = $(this).val();
                var slug = name.toLowerCase().trim().replace(/[^\w\s-]/g, '')
                            .replace(/\s+/g, '-').replace(/-+/g, '-');
                $('#slug').val(slug);
            });
            $('#regForm').validate({
                rules:{
                    name:{
                        required:true
                    },
                    slug: {
                        required: true,
                        remote: {
                            url: '/admin/check-slug-availability',
                            type: 'POST',
                            data: {
                                slug: function() {
                                    return $('#slug').val();
                                }
                            }
                        }
                    },
                    image:{
                        required:false,
                        extension: "jpeg|jpg|png"
                    },
                    status:{
                        required:true
                    }
                },
                messages:{
                    name:{
                        required: "Please enter a valid name"
                    },
                    slug: {
                        required: "Please enter a valid slug",
                        remote: "This slug is already taken"
                    },
                    image: {
                        extension: "Please upload a valid image file (jpg, jpeg, png)"
                    },
                    status: {
                        required: "Please select a status"
                    }
                },
                errorPlacement:function(error,element){
                    let errorId = element.attr('id') + '_error';
                    $('#' + errorId).text(error.text());
                },
                highlight: function(error,element){
                    $(element).addClass("is-invalid");
                },
                unhighlight: function(error,element){
                    $(element).removeClass("is-invalid");
                },
            });
        });
    </script>
@endpush
@endsection
