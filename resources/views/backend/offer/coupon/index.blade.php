
@extends('backend.layouts.app')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Coupon Table</h1>
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
                          <h3 class="card-title">Coupon List Here</h3>
                          <button class="btn btn-info btn-sm" style="float: right" data-toggle="modal" data-target="#addModal"> + Add Coupon</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table  class="table table-bordered table-striped table-sm ytable">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Coupon Code</th>
                                    <th>Coupon Date</th>
                                    <th>Coupon Amount</th>
                                    <th>Coupon Type</th>
                                    <th>Coupon Status</th>
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
    <div class="modal fade" id="addModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Create New Coupon</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('coupon.store') }}" method="post" id="add-form">
                    @csrf

                    <div class="card-body">

                        <div class="form-group">
                            <label for="coupon_code">Coupone Code </label>
                            <input type="text" name="coupon_code" class="form-control " placeholder="Coupone Code" value="{{old('coupon_code')}}" required>
                        </div>

                        <div class="form-group">
                            <label for="type">Coupone Type </label>
                            <select name="type" class="form-control" id="" required>
                                <option selected disabled>-- Choose Type --</option>
                                <option value="1">Fixed</option>
                                <option value="2">Percentage</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="coupon_amount">Coupone Amount </label>
                            <input type="text" name="coupon_amount" class="form-control " placeholder="Coupone Amount" value="{{old('coupon_amount')}}" required>
                        </div>

                        <div class="form-group">
                            <label for="valid_date">Valid Date </label>
                            <input type="date" name="valid_date" class="form-control " placeholder="Valid Date" value="{{old('valid_date')}}" required>
                        </div>

                        <input type="checkbox" name="status" value="1"><span> Publication</span><br>
                           
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script type="text/javascript">

        $(function c(){
            var table=$('.ytable').DataTable({
                processing:true,
                serverSide:true,
                ajax:"{{ route('coupon.index') }}",
                columns:[
                    {data:'DT_RowIndex',name:'DT_RowIndex'},
                    {data:'coupon_code',name:'coupon_code'},
                    {data:'valid_date',name:'valid_date'},
                    {data:'coupon_amount',name:'coupon_amount'},
                    {data:'type',name:'type'},
                    {data:'status',name:'status'},
                    {data:'action',name:'action',orderable:true, searchable:true},
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