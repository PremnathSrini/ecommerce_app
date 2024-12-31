@extends('ecommerce.admin.admin_layouts.default')
@section('admin-content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Customers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Customers</li>
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
                      <a href="{{route('admin.customer.create')}}"  class="btn btn-primary"><i class="bi bi-plus-circle-fill text-white"></i> Add new</a>
                  </div>
                </div>
                <div class="card-body">
                  <table id="customer-listing" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th class="col-sm-1">Sl.No</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>DOB</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($customers as $customer)
                      <tr>
                          <td> {{$loop->iteration}} </td>
                          <td> {{$customer->name}} </td>
                          <td> {{$customer->email}} </td>
                          <td> {{$customer->dob}} </td>
                          <td> {{($customer->status ==1) ? 'active' : 'inactive'}} </td>
                          <td class="col-sm-1 text-center">
                              <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{route('admin.customer.view',base64_encode($customer->id))}}" class="fa fa-eye"></a>
                                    {{-- <a class="btn text-primary" href=""><i class="bi bi-pencil-square ml-3"></i></a> --}}
                                    <form action="{{route('admin.customer.delete',base64_encode($customer->id))}}" method="POST" id="deleteForm" onsubmit="return confirm('Are you sure want to delete?')" class="mr-3">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn text-danger" type="submit" id="deleteBtn"><i class="bi bi-trash3-fill"></i></button>
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
        $(document).ready(function(){
            new DataTable('#customer-listing',{
                scrollX: true,
                order: [[0, 'desc']]
            });
        });
    </script>
@endpush
@endsection
