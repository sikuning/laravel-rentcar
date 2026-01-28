@extends('admin.layout')

@section('content')

<div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Banner Slides</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="{{url('/admin/dashboard')}}">Dashboard</a></li>
                                    <li><a href="{{url('/admin/banner-slider')}}">Banner Slides</a></li>
                                    <li class="active">Create</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Add New Slide</strong> 
                            </div>
                            <div class="card-body card-block">
                                <form class="row" id="add_slide"  method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label">Title:</label>
                                        <input class="form-control" name="title" required/>
                                    </div> 
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label"> Description:</label>
                                        <textarea name="desc" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label"> Image:</label>
                                        <input type="file" name="img" onChange="readURL(this);">
                                        <img id="image" src="{{asset('public/admin/images/default.png')}}" alt="Car Image" class="rounded float-right" width="100px" height="100px">
                                    </div>
                                    <div class="form-actions form-group col-md-6">
                                        <button type="submit" class="btn btn-primary btn-md">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Widgets -->
            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
@stop