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
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Edit Car Inventory</strong> 
                            </div>
                            <div class="card-body card-block">
                            @if(isset($carInventory))
                                <form class="row" id="update_car"  method="POST" enctype="multipart/form-data">
                                    @csrf
                                    {{ method_field('PATCH') }}
                                    @csrf
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label">Car Name:</label>
                                        <input class="form-control" name="car_name" value="{{$carInventory->car_name}}" required/>
                                        <input type="hidden" name="id" value="{{$carInventory->car_id}}"/>
                                    </div> 
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label class=" form-control-label">Car Type:</label>
                                        <select class="form-control" name="car_type" required>
                                            <option value="" selected disabled>Select Car Type</option>
                                            @if(!empty($carTypes))
                                                @foreach($carTypes as $types)
                                                    @php $selected = '';  @endphp
                                                    @if($types->id == $carInventory->car_type)
                                                    @php $selected = 'selected';  @endphp
                                                    @endif
                                                    <option value="{{$types->id}}" {{$selected}}>{{$types->name}}</option>
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
                                                    @php $selected = '';  @endphp
                                                    @if($types->id == $carInventory->fuel_type)
                                                    @php $selected = 'selected';  @endphp
                                                    @endif
                                                    <option value="{{$types->id}}" {{$selected}}>{{$types->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label">Current Mileage:</label>
                                        <input type="number" class="form-control" name="mileage" value="{{$carInventory->mileage}}" required />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label">Model Year:</label>
                                        <input class="form-control" name="model_year" value="{{$carInventory->model_year}}" required/>
                                    </div>
                                    
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label class=" form-control-label">Transmission:</label>
                                        <select name="transmission" class="form-control" required>
                                            <option value="" selected disabled>Choose</option>
                                            @if(!empty($transmission))
                                                @foreach($transmission as $types)
                                                    @php $selected = '';  @endphp
                                                    @if($types->id == $carInventory->transmission)
                                                    @php $selected = 'selected';  @endphp
                                                    @endif
                                                    <option value="{{$types->id}}" {{$selected}}>{{$types->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label">No. of Passengers:</label>
                                        <input type="number" class="form-control" name="passengers" value="{{$carInventory->passengers}}" required/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label">No. of Doors:</label>
                                        <input type="number" class="form-control" name="doors" value="{{$carInventory->doors}}" required/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label">Pieces of Bags:</label>
                                        <input type="number" class="form-control" name="bags" value="{{$carInventory->bags}}" required/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label">Price: <small>( per day )</small></label>
                                        <input type="number" class="form-control" name="price" value="{{$carInventory->price}}" required/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label"> Image:</label>
                                        <input type="file" name="img" onChange="readURL(this);">
                                        <input type="text" hidden name="old_img" value="{{$carInventory->car_image}}">
                                        @if($carInventory->car_image != '')
                                        <img id="image" src="{{asset('public/carImages/'.$carInventory->car_image)}}" alt="Car Image" class="rounded float-right" width="100px" height="100px">
                                        @else
                                        <img id="image" src="{{asset('public/admin/images/default.png')}}" alt="Car Image" class="rounded float-right" width="100px" height="100px">
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label"> Description:</label>
                                        <textarea name="descr" class="form-control">{{$carInventory->car_descr}}</textarea>
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label"> Extras: <small>( Optional )</small></label>
                                        @php $ex = array_filter(explode(',',$carInventory->extras)); @endphp
                                        <select name="extras[]" class="form-control standardSelect" multiple="multiple">
                                        @foreach($extras as $extra)
                                        @if(in_array($extra->id,$ex))
                                            <option value="{{$extra->id}}" selected>{{$extra->name}}</option>
                                        @else
                                            <option value="{{$extra->id}}">{{$extra->name}}</option>
                                        @endif
                                            
                                        @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label class=" form-control-label"> Status:</label>
                                        <select name="status" class="form-control">
                                            <option value="1" @php echo ($carInventory->status == '1') ? 'selected' : '';  @endphp >Show</option>
                                            <option value="0" @php echo ($carInventory->status == '0') ? 'selected' : '';  @endphp >Hide</option>
                                        </select>
                                    </div>
                                    <div class="form-actions form-group col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md">Update</button>
                                    </div>
                                </form>
                            @endif
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