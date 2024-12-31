@extends('ecommerce.admin.admin_layouts.default')
@section('admin-content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.products.index') }}">Products</a></li>
                        <li class="breadcrumb-item active">Product Form</li>
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
                            <h3 class="card-title">Create Product</h3>
                        </div>
                        {{ html()->form('POST', route('admin.products.store'))->acceptsFiles()->open() }}
                        <div class="card-body">

                            <div class="row mb-2">
                                <div class="col-md-6">
                                    {{ html()->label('Product name')->class('form-label') }}
                                    {{html()->span('*')->class('text-danger')}}
                                    {{ html()->text('product_name', old('product_name'))->class('form-control')->placeholder('Enter the product name') }}
                                    @error('product_name')
                                        {{ html()->span($message)->class('text-danger') }}
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {{ html()->label('Category') }}{{html()->span('*')->class('text-danger')}}
                                        {{ html()->select('category_id',$categories,old('category_id'))->class('form-control')->placeholder('Select the category') }}
                                    @error('category_id')
                                        {{ html()->span($message)->class('text-danger') }}
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{ html()->label('File Input') }}
                                        <div class="input-group">
                                            <div class="custom-file">
                                                {{-- <label class="custom-file-label" for="image">Choose File</label> --}}
                                                {{ html()->label('Choose File')->class('custom-file-label') }}
                                                {{-- <input type="file" class="custom-file-input"
                                                            id="image" name="image" value="{{old('image')}}" accept="image/*"> --}}
                                                {{ html()->file('image')->class('custom-file-input')->attribute('accept', 'image/*') }}
                                                @if (old('image'))
                                                    <p>Image:{{ old('image') }}</p>
                                                @endif
                                                @error('image')
                                                    {{ html()->span($message)->class('text-danger') }}
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-6">
                                    {{ html()->label('Quantity') }}
                                    {{html()->span('*')->class('text-danger')}}
                                    {{ html()->text('quantity', old('quantity'))->class('form-control') }}
                                    @error('quantity')
                                        {{ html()->span($message)->class('text-danger') }}
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {{ html()->label('Price')->class('form-label') }}
                                    {{html()->span('*')->class('text-danger')}}
                                    {{ html()->text('price', old('price'))->class('form-control') }}
                                    @error('price')
                                        {{ html()->span($message)->class('text-danger') }}
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                    <div class="col-md-6">
                                        {{ html()->label('Search Engine Slug')->class('form-label') }}
                                        {{html()->span('*')->class('text-danger')}}
                                        {{ html()->text('product_slug', old('product_slug'))->class('form-control') }}
                                        @error('product_slug')
                                        {{ html()->span($message)->class('text-danger') }}
                                        @enderror

                                        {{html()->label('Is a Featured Product')->class('form-label')}}
                                        {{html()->span('*')->class('text-danger')}}
                                        <div class="form-check">
                                            <label class="form-check-label" for="is_featured_yes">
                                                <input type="radio" id="is_featured_yes" name="is_featured" value="1" {{ old('is_featured') == 1 ? 'checked' : '' }}>
                                            Yes</label>
                                            <label class="form-check-label pl-3" for="is_featured_no">
                                                <input type="radio" id="is_featured_no" name="is_featured" value="0" {{ old('is_featured') == 0 ? 'checked' : '' }}>
                                            No</label>
                                        </div>
                                        @error('is_featured')
                                            {{ html()->span($message)->class('text-danger') }}
                                        @enderror
                                    </div>
                                <div class="col-md-6">
                                    {{ html()->label('Description') }}
                                    {{html()->span('*')->class('text-danger')}}
                                    {{ html()->textArea('description')->class('form-control') }}
                                    @error('description')
                                        {{ html()->span($message)->class('text-danger') }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer card-white">
                            {{ html()->button('Submit')->class('btn btn-success') }}

                            {{ html()->a(route('admin.products.index'), 'Back')->class('btn btn-danger') }}
                        </div>
                        {{ html()->form()->close() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('custom-scripts')
        <script>
            $(document).ready(function() {
                $('#product_name').on('input', function() {
                    var name = $(this).val();
                    var slug = name.toLowerCase().trim().replace(/[^\w\s-]/g, '')
                        .replace(/\s+/g, '-').replace(/-+/g, '-');
                    $('#product_slug').val(slug);
                });

            });
        </script>
    @endpush
@endsection
