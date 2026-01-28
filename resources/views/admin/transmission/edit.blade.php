@extends('admin.layout')

@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>PayMethod</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{url('/admin/dashboard')}}">Dashboard</a></li>
                            <li><a href="{{url('/admin/transmission')}}">Transmission</a></li>
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
                        <strong>Edit Transmission Item</strong>
                    </div>
                    <div class="card-body card-block">
                        <form id="updateTransmission">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            @foreach($transmission as $row)
                            <input type="hidden"  name="id" value="{{$row->id}}">
                            <div class="form-group">
                                <label class=" form-control-label">Name:</label>
                                <input type="text" class="form-control" name="name" value="{{$row->name}}">
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