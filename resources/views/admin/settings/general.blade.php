@extends('admin.layout')

@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>General Settings</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{url('/admin/dashboard')}}">Dashboard</a></li>
                            <li class="active">General Settings</li>
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
                <form class="card" id="updateSetting" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    @foreach($data as $item)
                    <div class="card-header">
                        <strong>Update General Settings</strong>
                    </div>
                    <div class="card-body card-block">
                        <div class="form-group">
                            <label class=" form-control-label">Site Name:</label>
                            <input class="form-control" name="site_name" value="{{$item->site_name}}">
                        </div>
                        <div class="form-group">
                            <label> Site Logo</label>
                            <input type="hidden" name="old_img" value="{{$item->site_logo}}">
                            <input type="file"  class="form-control mb-2" name="img" onChange="readURL(this);" >
                            <img src="{{asset('public/siteImages/'.$item->site_logo)}}" id="image" alt="" width="100px" height="">
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">Site Title:</label>
                            <input class="form-control" name="site_title" value="{{$item->site_title}}">
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">Site Description:</label>
                            <textarea name="site_desc" class="form-control">{{$item->site_desc}}</textarea>
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
                        <div class="form-group">
                            <label class=" form-control-label">Currency Format:</label>
                            <input class="form-control" name="cur_format" value="{{$item->cur_format}}">
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">Theme Color:</label>
                            <input type="color" class="form-control" name="theme_color" value="{{$item->theme_color}}">
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
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }
</script>
@stop