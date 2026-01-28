@extends('admin.layout')

@section('content')

<div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Car Inventory</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="{{url('/admin/dashboard')}}">Dashboard</a></li>
                                    <li><a href="{{url('/admin/carInventory')}}">Car Inventory</a></li>
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
                                <strong>Add New Car</strong> 
                            </div>
                            <div class="card-body card-block">
                                @if($carTypes->isEmpty())
                                    <div class="alert alert-danger">Car Types is Required</div>
                                @endif
                                @if($fuelTypes->isEmpty())
                                    <div class="alert alert-danger">Fuel Types is Required</div>
                                @endif
                                @if($transmission->isEmpty())
                                    <div class="alert alert-danger">Transmission List is Required</div>
                                @endif
                                <form class="row" id="add_car"  method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label">Car Name:</label>
                                        <input class="form-control" name="car_name" required/>
                                    </div> 
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label class=" form-control-label">Car Type:</label>
                                        <select class="form-control" name="car_type" required>
                                            <option value="" selected disabled>Select Car Type</option>
                                            @if(!empty($carTypes))
                                                @foreach($carTypes as $types)
                                                    <option value="{{$types->id}}">{{$types->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label class=" form-control-label">Fuel Type:</label>
                                        <select class="form-control" name="fuel_type" required>
                                            <option value="" selected disabled>Select Fuel Type</option>
                                            @if(!empty($fuelTypes))
                                                @foreach($fuelTypes as $types)
                                                    <option value="{{$types->id}}">{{$types->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label">Current Mileage:</label>
                                        <input type="number" class="form-control" name="mileage" required />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label">Model Year:</label>
                                        <input class="form-control" name="model_year" required/>
                                    </div>
                                    
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label class=" form-control-label">Transmission:</label>
                                        <select name="transmission" class="form-control" required>
                                            <option value="" selected disabled>Choose</option>
                                            @if(!empty($transmission))
                                                @foreach($transmission as $types)
                                                    <option value="{{$types->id}}">{{$types->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label">No. of Passengers:</label>
                                        <input type="number" class="form-control" name="passengers" required/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label">No. of Doors:</label>
                                        <input type="number" class="form-control" name="doors" required/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label">Pieces of Bags:</label>
                                        <input type="number" class="form-control" name="bags" required/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label">Price: <small>( per day )</small></label>
                                        <input type="number" class="form-control" name="price" required/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label"> Image:</label>
                                        <input type="file" name="img" onChange="readURL(this);">
                                        <img id="image" src="{{asset('public/admin/images/default.png')}}" alt="Car Image" class="rounded float-right" width="100px" height="100px">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label"> Description:</label>
                                        <textarea name="descr" class="form-control"></textarea>
                                    </div>
                                    @if(count($extras) > 0)
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label"> Extras: <small>( Optional )</small></label>
                                        <select name="extras[]" class="form-control standardSelect" multiple>
                                        @foreach($extras as $extra)
                                            <option value="{{$extra->id}}">{{$extra->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    @endif
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