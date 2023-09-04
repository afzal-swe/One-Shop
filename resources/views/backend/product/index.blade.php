
@extends('backend.layouts.app')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product Table</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">All Products</h3>
                          <a href="{{ route('product.create') }}" class="btn btn-info btn-sm" style="float: right" data-target="#modal-default"> + Add Product</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Product Image</th>
                                    <th>Product Brand</th>
                                    <th>Product Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($product as $key=>$row)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td><img src="{{ asset($row->images) }}" style="height: 40px; width:60px"></td>
                                        <td>{{ $row->product_title }}</td>
                                        <td>{{ $row->brand->name }}</td>
                                        <td>
                                            @if ($row->status == '1')
                                            <span class="btn btn-success">Active</span>
                                            @else
                                            <span class="btn btn-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td >
                                            @if ($row->status == '1')
                                                <a href="#"><i class="fa-solid fa-toggle-on fa-xl" title="Unactive"></i></a>
                                            @else
                                                <a href="#"><i class="fa-solid fa-toggle-on"></i></a>
                                                {{-- <a href="#"><i class="fa-solid fa-toggle-off fa-xl" title="Active"></i></a> --}}
                                            @endif
                                            <a href="#" class="btn btn-info sm" title="Edit Data"><i class="fas fa-edit"></i></a>
                                            <a href="#" id="delete" class="btn btn-danger sm delete" title="Delete Data"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                          </table>
                        </div>
                        <!-- /.card-body -->
                      </div>
                </div>
            </div>
        </div>
    </section>
  </div>

@endsection