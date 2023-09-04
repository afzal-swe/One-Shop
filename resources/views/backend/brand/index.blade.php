
@extends('backend.layouts.app')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Brands Table</h1>
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
                          <h3 class="card-title">All Brands</h3>
                          <button class="btn btn-info btn-sm" style="float: right" data-toggle="modal" data-target="#modal-default"> + Add Brand</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Brand Image</th>
                                    <th>Brand Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($brand as $key=>$row)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td><img src="{{ asset($row->image) }}" style="height: 40px; width:60px"></td>
                                        <td>{{ $row->name }}</td>
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
                                            <a href="{{ route('brand.edit',$row->id) }}" class="btn btn-info sm" title="Edit Data"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('brand.destroy',$row->id) }}" id="delete" class="btn btn-danger sm delete" title="Delete Data"><i class="fas fa-trash-alt"></i></a>
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

{{-- Category Added Modal --}}
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Insert New Brand</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('brand.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">

                        <div class="form-group">
                            <label for="">Brand Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror " placeholder="Brand Name" value="{{old('name')}}" required>
                            @error('name')
                              <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        
                        <div class="form-group">
                          <label for="exampleInputFile">Brand Logo <span class="text-danger">*</span></label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" name="image"  class="custom-file-input" id="exampleInputFile" required>
                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                              <span class="input-group-text">Upload</span>
                            </div>
                          </div>
                        </div>
   
                        <input type="checkbox" name="status" value="1"><span> Publication</span><br>
                           
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

@endsection