
@extends('backend.layouts.app')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Campaign Table</h1>
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
</div>

{{-- Category Added Modal --}}
    <div class="modal fade" id="addModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Campaign Update</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="add-form" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">

                        <div class="form-group">
                            <label for="coupon_code">Campaign Title</label>
                            <input type="text" name="title" class="form-control " value="{{ $update->title }}" >
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="type">Start Date</label>
                                    <input type="date" class="form-control" name="start_date" value="{{ $update->start_date }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="type">End Date</label>
                                    <input type="date" class="form-control" name="end_date" value="{{ $update->end_date }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="type">Discount (%)</label>
                                    <input type="text" class="form-control" name="discount" value="{{ $update->discount }}">
                                    <small class="form-text text-danger">Discount percentage are apply for all product selling price</small>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="type">Image</label>
                                    <input type="file" class="form-control" name="image">
                                    <small class="form-text">This is your campaign banner</small>
                                </div>
                            </div>
                        </div>

                        

                        <input type="checkbox" name="status" value="1" value="{{ $update->status }}"><span> Publication</span><br>
                           
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

        // Rorm Submit route system
        $('#add-form').on('submit', function(){
           $('.loader').removeClass('d-none');
           $('.submit_btn').addClass('d-none');
        });

    </script>

@endsection