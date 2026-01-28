@extends('public/layout')

@section('title','Car Rental System')

@section('content')
   <section id="banner">
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
               @php $i=0; @endphp
               @foreach($banner as $slide)
                  @php $active = ($i==0) ? 'active' : ''; @endphp
               <div class="carousel-item {{$active}}" style="background-image: url('public/slides/{{$slide->image}}');">
                  <h1>{{$slide->title}}</h1>
                  <p>{{$slide->desc}}</p>
               </div>
               @php $i++; @endphp
               @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
               <span class="carousel-control-prev-icon" aria-hidden="true"></span>
               <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
               <span class="carousel-control-next-icon" aria-hidden="true"></span>
               <span class="sr-only">Next</span>
            </a>
         </div>
   </section>
   <section id="cars" class="py-5 bg-light">
      <div class="container">
         <div class="row">
            <div class="col-12">
               <h2 class="text-center mb-5 section-head color">Latest Cars</h2>
            </div>
         </div>
      </div>
      <div class="cars-carousel owl-carousel owl-theme">
            @foreach($car_list as $car)
               <div class="car-grid item">
                  <div class="car-image">
                     <img class="card-img-top" src="{{asset('public/carImages/'.$car->car_image)}}" alt="Card image cap">   
                     <div class="price">${{$car->price}} /per day</div>
                  </div>
                  <div class="car-details">
                     <h5 class="card-title">{{$car->car_name}}</h5>
                     <ul class="car-specification">
                        <li>{{$car->type_name}}</li>
                        <li>{{$car->passengers}} Seats</li>
                        <li>{{$car->fuel_name}}</li>
                        <li>{{$car->trans_name}}</li>
                        @if($car->extra_name != '')
                           @php
                           $extras = array_filter(explode(',',$car->extra_name));
                           @endphp
                           @for($i=0;$i<count($extras);$i++)
                           <li>{{$extras[$i]}}</li>
                           @endfor
                        @endif
                     </ul>
                  </div>
               </div>
            @endforeach 
         </div>
   </section>
   <section id="booking" class="py-5">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <h2 class="text-center mb-4 section-head">Search and Hire Cars</h2>
               <form id="booking-form" class="row p-4" action="{{url('/search-cars')}}">
                  <div class="form-group col-lg-3 col-md-6">
                     <label for="">Pick up Date and Time</label>
                     <input id="pickdate" type="text" name="pick_date" class="form-control" autocomplete="off" >
                  </div>
                  <div class="form-group col-lg-3 col-md-6">
                     <label for="">Drop Off Date and Time</label>
                     <input id="returndate" type="text" name="return_date" class="form-control" autocomplete="off" >
                  </div>
                  @if(!empty($locations))
                  <div class="form-group col-lg-3 col-md-6">
                     <label for="">Pick up Location</label>
                     <select class="form-control" name="pick_location" required>
                        <option value="" selected disabled>Select Location</option>
                        @foreach($locations as $list1)
                        <option value="{{$list1->id}}">{{$list1->name}}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="form-group col-lg-3 col-md-6">
                     <label for="">Drop Off Location</label>
                     <select class="form-control" name="return_location" required>
                        <option value="" selected disabled>Select Location</option>
                        @foreach($locations as $list1)
                        <option value="{{$list1->id}}">{{$list1->name}}</option>
                        @endforeach
                     </select>
                     <input type="hidden" class="gts" value="{{url('/search-cars')}}">
                  </div>
                     @endif  
                  <input type="submit" value="Check Availability" class="btn btn-md mx-auto" />
               </form>
            </div>
         </div>
      </div>
   </section>
   <section id="locations" class="py-5 bg-light">
      <div class="container">
         <div class="row">
            <div class="col-12">
               <h2 class="text-center mb-5 section-head color">Locations</h2>
            </div>
         </div>
      </div>
      <div class="location-carousel owl-carousel owl-theme">
            @foreach($locations as $loc)
               <div class="item location-box" style="background-image: url('public/location_thums/{{$loc->thumb}}');">
                  <h5>{{$loc->name}}</h5>
               </div>
            @endforeach 
         </div>
   </section>
@endsection