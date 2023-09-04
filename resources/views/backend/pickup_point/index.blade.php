
@extends('backend.layouts.app')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pickup Point Table (Yajra, Ajax)</h1>
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
                          <h3 class="card-title">Pickup Point List Here</h3>
                          <button class="btn btn-info btn-sm" style="float: right" data-toggle="modal" data-target="#addModal"> + Add Pickup Point</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table  class="table table-bordered table-striped table-sm ytable">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Pickup Point Name</th>
                                    <th>Pickup Point Address</th>
                                    <th>Pickup Point Phone-1</th>
                                    <th>Pickup Point Phone-2</th>
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
  </div>

{{-- Category Added Modal --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Pickup Point</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
                <form action="{{ route('pickup_point.store') }}" method="post" id="add_form">
                    @csrf

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="pickup_point_name">Pickup Point Name <samp class="text-danger" >*</samp> </label>
                            <input type="text" name="pickup_point_name" class="form-control " placeholder="Pickup Point Name" value="{{old('pickup_point_name')}}" required>
                        </div>

                        <div class="form-group">
                            <label for="pickup_point_address">Pickup Point Address <samp class="text-danger" >*</samp> </label>
                            <input type="text" name="pickup_point_address" class="form-control " placeholder="Pickup Point Address" value="{{old('pickup_point_address')}}" required>
                        </div>

                        <div class="form-group">
                            <label for="pickup_point_phone">Pickup Point Number <samp class="text-danger" >*</samp> </label>
                            <input type="text" name="pickup_point_phone" class="form-control " placeholder="Pickup Point Phone-1" value="{{old('pickup_point_phone')}}" required>
                        </div>

                        <div class="form-group">
                            <label for="pickup_point_phone_two">Pickup Point Number <samp class="text-danger" >*</samp> </label>
                            <input type="text" name="pickup_point_phone_two" class="form-control " placeholder="Pickup Point Phone-2" value="{{old('pickup_point_phone_two')}}">
                        </div>

                        

                        <input type="checkbox" name="status" value="1"><span> Publication</span><br>
                           
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"><span class="loading d-none" ><i class="fas fa-spinner"></i>Loading...</span><span class="submit_btn">Submit</span></button>
                        </div>
                    </div>
                </form>
           
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script type="text/javascript">

        // View all Data
        $(function c(){
            var table=$('.ytable').DataTable({
                processing:true,
                serverSide:true,
                ajax:"{{ route('pickup_point.index') }}",
                columns:[
                    {data:'DT_RowIndex',name:'DT_RowIndex'},
                    {data:'pickup_point_name',name:'pickup_point_name'},
                    {data:'pickup_point_address',name:'pickup_point_address'},
                    {data:'pickup_point_phone',name:'pickup_point_phone'},
                    {data:'pickup_point_phone_two',name:'pickup_point_phone_two'},
                    {data:'action',name:'action',orderable:true, searchable:true},
                ]
            });
        });

        // Store pickup point ajax call
        $('#add_form').submit(function(e){
            e.preventDefault();
            $('.loading').removeClass('d-none');
            var url = $(this).attr('action');
            var request =$(this).serialize();
            $.ajax({
                url:url,
                type:'post',
                async:false,
                data:request,
                success:function(data){
                    toastr.success(data);
                    $('#add_form')[0].reset();
                    $('.loading').addClass('d-none');
                    $('#addModal').modal('hide');
                    table.ajax.reload();
                }
            });
        });

        // Rorm Submit route system
        // $('#add-form').on('submit', function(){
        //    $('.loader').removeClass('d-none');
        //    $('.submit_btn').addClass('d-none');
        // });

    </script>

@endsection