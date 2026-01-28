@extends('admin.layout')

@section('content')

<div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Extras</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="{{url('/admin/dashboard')}}">Dashboard</a></li>
                                    <li><a href="{{url('/admin/extras')}}">Extras</a></li>
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
                    <div class="offset-sm-3 col-xs-6 col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <strong>Add New Extra Item</strong> 
                            </div>
                            <div class="card-body card-block">
                                <form id="extraCreate_form" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label class=" form-control-label">Name:</label>
                                        <input type="text" class="form-control" name="name" />
                                    </div> 
                                    <div class="form-group">
                                        <label class=" form-control-label">Price:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                {{$cur_format[0]}}
                                            </div>
                                            <input type="number" class="form-control" name="price">
                                        </div>
                                    </div>
                                    <div class="form-actions form-group">
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