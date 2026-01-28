@extends('public/layout')

@section('title','Available Car Listing')

@section('content')
   <section id="page-banner">
      <div class="container">
         <div class="row">
            <div class="col-12">
               <h2 class="text-center section-head">Available Cars</h2>
			   <nav aria-label="breadcrumb">
					<ol class="breadcrumb justify-content-center">
						<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Available Cars</li>
					</ol>
				</nav>
            </div>
         </div>
      </div> 
   </section>
   <article id="content" class="container">
   		<div class="row">
   			<div class="col-md-8 order-2 order-md-1">
               <div class="card">
                  <div class="card-header">
                     <h5>Available Cars</h5>
                  </div>
               </div>
   				<div class="car-listing">
                  @foreach($car_list as $list)
                  @php $disable = in_array($list->car_id,$booked) ? 'disable' : ''; @endphp
                  <div class="car-info {{$disable}}">
                     <div class="car-content">
                        <h4>{{$list->car_name}}</h4>
                        <h6>{{$list->type_name}}</h6>
                        <ul class="car-specification">
                          <li>{{$list->passengers}} Seats</li>
                          <li>{{$list->bags}} Luggage</li>
                          <li>{{$list->trans_name}}</li>
                          <li>{{$list->fuel_name}}</li>
                          @if($list->extra_name != '')
                           @php
                           $extras = array_filter(explode(',',$list->extra_name));
                           @endphp
                           @for($i=0;$i<count($extras);$i++)
                           <li>{{$extras[$i]}}</li>
                           @endfor
                        @endif
                        </ul>
                        <div class="price"><span>Price:</span> <b>{{$list->price}}</b> <small>( per day )</small></div>
                        @if(!in_array($list->car_id,$booked))
                           
                        @else
                        <small class="alert alert-danger">This Car is Not available</small>
                        @endif
                     </div>
                     <div class="car-image">
                        <img src="{{asset('public/carImages/'.$list->car_image)}}" alt="">
                     </div>
                  </div>
                  @endforeach
               </div>
               <ul class='pagination justify-content-center'>
                    <li>{{$car_list->appends(request()->query())->links()}}</li>
                </ul>
   			</div>
   			<div class="col-md-4 order-1 order-md-2">
               <div class="card">
                  <div class="card-header">
                     <h5 class="pull-left">Booking Deatils</h5>
                  </div>
                  <div class="card-body">
                     <form action="{{url('/search-cars')}}">
                     <div class="form-group">
                        <label for="">Pick up Date and Time</label>
                        <input id="pickdate" type="text" name="pick_date" class="form-control" autocomplete="off" >
                     </div>
                     <div class="form-group">
                        <label for="">Drop Off Date and Time</label>
                        <input id="returndate" type="text" name="return_date" class="form-control" autocomplete="off" >
                     </div>
                     @if(!empty($locations))
                     <div class="form-group">
                        <label for="">Pick up Location</label>
                        <select class="form-control" name="pick_location" required>
                           <option value="" selected disabled>Select Location</option>
                           @foreach($locations as $list1)
                           <option value="{{$list1->id}}">{{$list1->name}}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group">
                        <label for="">Drop Off Location</label>
                        <select class="form-control" name="return_location" required>
                           <option value="" selected disabled>Select Location</option>
                           @foreach($locations as $list1)
                           <option value="{{$list1->id}}">{{$list1->name}}</option>
                           @endforeach
                        </select>
                     </div>
                        @endif  
                     <input type="submit" value="Check Availability" class="btn btn-md btn-block" />
                     </form>
                  </div>
               </div>
   			</div>
   		</div>
   </article>

@endsection