@extends('admin.layout')

@section('content')

<div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Locations</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="{{url('/admin/dashboard')}}">Dashboard</a></li>
                                    <li><a href="{{url('/admin/locations')}}">Locations</a></li>
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
                    <div class="offset-sm-1 col-xs-12 col-sm-10">
                        <div class="card">
                            <div class="card-header">
                                <strong>Add New Location</strong> 
                            </div>
                            <div class="card-body card-block">
                                <form id="addLocations" class="row" method="POST">
                                    <input type="hidden" class="url" value="{{url('/admin/locations')}}">
                                    {{ csrf_field() }}
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label">Name:</label>
                                        <input type="text" class="form-control" name="name" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label">Email:</label>
                                        <input type="email" class="form-control" name="email" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label">Phone:</label>
                                        <input type="number" class="form-control" name="phone" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label">Address:</label>
                                        <input type="text" class="form-control" name="address" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label">City:</label>
                                        <input type="text" class="form-control" name="city" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label">Zipcode:</label>
                                        <input type="number" class="form-control" name="zipcode" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label">State:</label>
                                        <input type="text" class="form-control" name="state" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label">Country:</label>
                                        <input type="text" class="form-control" name="country" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label">Latitude:</label>
                                        <input type="text" class="form-control" name="latitude" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label">Longitude:</label>
                                        <input type="text" class="form-control" name="longitude" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label">Image:</label>
                                        <input type="file" class="form-control" name="thumb" />
                                    </div> 
                                    <div class="form-actions form-group col-12">
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