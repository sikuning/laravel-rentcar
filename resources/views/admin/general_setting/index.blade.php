@extends('admin.layout')

@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>General Setting</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{url('/admin/dashboard')}}">Dashboard</a></li>
                            <li class="active">General Setting</li>
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
            <div class="offset-sm-3 col-xs-6 col-sm-6">
                <form class="card" id="updateSetting" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    @foreach($data as $item)
                    <div class="card-header">
                        <strong>Edit General Setting Details</strong>
                    </div>
                    <div class="card-body card-block">
                        <input type="hidden" class=" url" name="id" value="{{url('admin/generalSetting/'.$item->id)}}">
                        <input type="hidden" class="rdt-url" value="{{url('admin/generalSetting/')}}" >
                        <div class="form-group">
                            <label class=" form-control-label">Site Title:</label>
                            <input class="form-control" name="site_title" value="{{$item->site_title}}">
                        </div>
                        <div class="form-group">
                            <label> Image</label>
                            <input type="hidden" name="old_img" value="{{$item->site_logo}}">
                            <img src="{{asset('public/siteImages/'.$item->site_logo)}}" alt="" width="100px" height="100px">
                            <input type="file"  class="form-control" name="img" >
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">Contact Email:</label>
                            <input class="form-control" name="cont_email" value="{{$item->contact_email}}">
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">Contact Phone Number:</label>
                            <input class="form-control" name="cont_phone" value="{{$item->contact_phone}}">
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">Contact Address:</label>
                            <input class="form-control" name="cont_address" value="{{$item->contact_address}}">
                        </div>
                        <div class="form-actions form-group">
                            <button type="submit" class="btn btn-success btn-md">Update</button>
                        </div>
                    </div>
                    @endforeach
                </form>
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