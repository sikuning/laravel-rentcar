@extends('admin.layout')

@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Car Types</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{url('/admin/dashboard')}}">Dashboard</a></li>
                            <li class="active">Car Types</li>
                        </ol>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<!-- Content -->
<div class="content">
    <div class="animated fadeIn"> <!-- Animated -->
        <div class="row"> 
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">All Types List</strong>
                        <a href="{{url('admin/carTypes/create')}}" class="btn btn-secondary btn-sm pull-right">Add New</a>
                    </div>
                    <div class="card-body">
                        <table id="carTypes-list" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>S.NO.</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div> <!-- /.card -->
            </div><!-- / column -->
        </div> <!--  / .row  -->
    </div> <!-- /.animated -->
</div>
<!-- /.content -->
<script src="{{asset('public/admin/assets/js/jquery.min.js')}}"></script>  
<script src="{{asset('public/admin/assets/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('public/admin/assets/js/lib/data-table/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/admin/assets/js/lib/data-table/dataTables.bootstrap.min.js')}}"></script>

@stop