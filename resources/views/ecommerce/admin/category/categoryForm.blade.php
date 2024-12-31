@extends('ecommerce.admin.admin_layouts.default')
@section('admin-content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Category Form</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('admin.category.index')}}">Categories</a></li>
                    <li class="breadcrumb-item active">Category Form</li>
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
                        <h3 class="card-title">Create Category</h3>
                    </div>
                    <form action="{{route('admin.category.store')}}" method="POST" id="regForm"
                                enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="category_name">Category</label><span class="text-danger">*</span>
                                    <input type="text" class="form-control" id="name" name="name" oninput="generateSlug()"
                                        placeholder="Enter Category" value="{{old('name')}}">
                                    <span class="text-danger" id="name_error">
                                        @error('name') {{ $message }}  @enderror
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <label for="parent_id">Parent Category</label><br>
                                        <select name="parent_id" id="parent_id" class="form-control">
                                            <option value="0">Please Select</option>
                                            @foreach ($categories as $category)
                                            @if($category->parent_id==0)
                                            <option value="{{$category->id}}" {{old('parent_id')==$category->id ? 'selected' : ''}} > {{ $category->name}} </option>
                                            @endif
                                            @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="image">File input</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="image">Choose File</label>
                                                <input type="file" class="custom-file-input"
                                                    id="image" name="image" value="{{old('image')}}" accept="image/*" >
                                            </div>
                                        </div>
                                        <span class="text-danger" id="image_error">
                                            @error('image') {{ $message }}  @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="slug">Search Engine slug</label><span class="text-danger">*</span>
                                    <input type="text" class="form-control" id="slug" name="slug">
                                    <span class="text-danger" id="slug_error">
                                        @error('slug') {{ $message }}  @enderror
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <label for="status">Status</label><span class="text-danger">*</span><br>
                                        <label class="" for="active"><input type="radio" name="status" id="active" value="1" {{old('status')===1 ? 'checked' : ''}}> Active</label>
                                        <label class="pl-3" for="inactive"><input type="radio" name="status" id="inactive" value="0" {{old('status')===0 ? 'checked' : ''}}> Inactive</label>
                                        <span class="text-danger" id="active_error">
                                            @error('status') {{ $message }}  @enderror
                                        </span>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" >Submit</button>
                            <a href="{{route('admin.category.index')}}" class="btn btn-warning">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@push('custom-scripts')
    <script>
        $(document).ready(function() {
            $('#name').on('input', function() {
                const name = $(this).val().trim();
                const slug = name.toLowerCase().replace(/[^a-z0-9-]/g, '-').replace(/-+/g, '-');
                $('#slug').val(slug);
            });

            $('#regForm').validate({
                rules: {
                    name: {
                        required: true
                    },
                    slug: {
                        required: true,
                        remote: {
                            url: '/admin/check-slug-availability',
                            _token: "{{ csrf_token() }}",
                            type: 'POST',
                            data: {
                                slug: () => $('#slug').val()
                            }
                        }
                    },
                    image: {
                        extension: "jpeg|jpg|png"
                    },
                    status: {
                        required: true
                    },
                },
                messages: {
                    name: {
                        required: "Please enter a valid name"
                    },
                    slug: {
                        required: "Please enter a valid slug",
                        remote: "This slug is already in use. Please choose another."
                    },
                    image: {
                        extension: "Please upload a valid image file (jpg, jpeg, png)"
                    },
                    status: {
                        required: "Please select a status"
                    },
                },
                errorPlacement: function(error, element) {
                    let errorId = element.attr('id') + '_error';
                    $('#' + errorId).text(error.text());
                },
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endpush
@endsection
