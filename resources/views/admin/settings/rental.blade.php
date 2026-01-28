@extends('admin.layout')

@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Rental Settings</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{url('/admin/dashboard')}}">Dashboard</a></li>
                            <li class="active">Rental Settings</li>
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
            <div class="offset-sm-1 col-xs-12 col-sm-10">
                <div class="card">
                    <div class="card-header">
                        <strong>Edit Rental Settings</strong>
                    </div>
                    <div class="card-body card-block">
                        <form id="updateRentalSetting" action="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            @foreach($data as $item)
                            <div class="form-group">
                                <label class=" form-control-label">Deposit Payment:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">%</span>
                                    </div>
                                    <input class="form-control" name="deposit_pay" value="{{$item->deposit_payment}}" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" form-control-label">Tax Payment:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">%</span>
                                    </div>
                                    <input class="form-control" name="tax_pay" value="{{$item->tax_payment}}" >
                                </div>
                            </div>
                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-primary btn-md">Update</button>
                            </div>
                            @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div> <!--  / .row  -->
    </div> <!-- /.animated -->
</div>
<!-- /.content -->
<script src="{{asset('public/admin/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('public/admin/assets/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('public/admin/assets/js/lib/data-table/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/admin/assets/js/lib/data-table/dataTables.bootstrap.min.js')}}"></script>

@stop