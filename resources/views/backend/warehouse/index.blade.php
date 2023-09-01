
@extends('backend.layouts.app')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ware House Table</h1>
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
                          <h3 class="card-title">Warehouse List</h3>
                          <button class="btn btn-info btn-sm" style="float: right" data-toggle="modal" data-target="#modal-default"> + Add Warehouse</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="table" class="table table-bordered table-striped table-sm ytable">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Warehouse  Name</th>
                                    <th>Warehouse  Address</th>
                                    <th>Warehouse Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                          </table>
                        </div>
                        <!-- /.card-body -->
                      </div>
                </div>
            </div>
        </div>
    </section>

{{-- Category Added Modal --}}
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Ware House</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('warehouse.store') }}" method="post" id="add-form">
                    @csrf

                    <div class="card-body">

                        <div class="form-group">
                            <label for="">Warehouse Name </label>
                            <input type="text" name="warhouse_name" class="form-control @error('warhouse_name') is-invalid @enderror " placeholder="Warehouse Name" value="{{old('warhouse_name')}}">
                            @error('warhouse_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Warehouse Address </label>
                            <input type="text" name="warhouse_address" class="form-control @error('warhouse_address') is-invalid @enderror " placeholder="Warehouse Address" value="{{old('warhouse_address')}}">
                            @error('warhouse_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Warehouse Phone </label>
                            <input type="text" name="warhouse_phone" class="form-control @error('warhouse_phone') is-invalid @enderror " placeholder="Warehouse Number" value="{{old('warhouse_phone')}}">
                            @error('warhouse_phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                           
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"><span class="d-none loader" ><i class="fas fa-spinner"></i>Loading..</span><span class="submit_btn">Submit</span></button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">

        $(function c(){
            var table=$('.ytable').DataTable({
                processing:true,
                serverSide:true,
                ajax:"{{ route('warehouse.index') }}",
                columns:[
                    {data:'DT_RowIndex',name:'DT_RowIndex'},
                    {data:'warhouse_name',name:'warhouse_name'},
                    {data:'warhouse_address',name:'warhouse_address'},
                    {data:'warhouse_phone',name:'warhouse_phone'},
                ]
            });
        });

        // Rorm Submit route system
        $('#add-form').on('submit', function(){
           $('.loader').removeClass('d-none');
           $('.submit_btn').addClass('d-none');
        });

    </script>


@endsection