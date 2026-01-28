@extends('admin.layout')

@section('content')
<!-- @php
print_r($carTypes);
@endphp -->
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
                                    <li><a href="{{url('/admin/carTypes')}}">Car Types</a></li>
                                    <li class="active">Edit</li>
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
                                <strong>Edit Type</strong> 
                            </div>
                            <div class="card-body card-block">
                                <form id="updateCarTypes" action="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    @foreach($carTypes as $row)
                                    <div class="form-group">
                                        <label class=" form-control-label">Name:</label>
                                        <input class="form-control" name="name" value="{{ $row->name}}" >
                                        <input type="hidden" name="id" value="{{ $row->id}}" >
                                    </div> 
                                    <div class="form-group">
                                        <label class=" form-control-label">Description:</label>
                                        <textarea class="form-control" name="desc" cols="30" rows="5">{{$row->description}}</textarea>
                                    </div>
                                    <div class="form-actions form-group">
                                        <button type="submit" class="btn btn-primary btn-md">Update</button>
                                    </div>
                                    @endforeach
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