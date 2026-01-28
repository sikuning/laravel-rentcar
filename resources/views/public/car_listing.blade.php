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
   			
   			<div class="col-md-8">
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
                           @if(session()->has('uid'))
                           @php $pickdate = date('Y/m/d h:i') @endphp    
                           @if(isset($_GET['pick_date']) && $_GET['pick_date'] != '')
                           @php $pickdate = $_GET['pick_date'] @endphp    
                           @endif
                           @php $returndate = date('Y/m/d h:i',strtotime('+1day')) @endphp    
                           @if(isset($_GET['return_date']) && $_GET['return_date'] != '')
                           @php $returndate = $_GET['return_date'] @endphp    
                           @endif
                              <a href="{{url('/rental-details?pick_date='.$pickdate.'&return_date='.$returndate.'&pick_location='.$_GET['pick_location'].'&return_location='.$_GET['return_location'].'&car='.$list->car_slug)}}" class="btn btn-success">Continue</a>
                           @else
                              <a href="{{url('/login')}}" class="btn btn-success">Continue</a>
                           @endif
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
   			<div class="col-md-4">
               <div class="card">
                  <div class="card-header">
                     <h5 class="pull-left">Booking Deatils</h5>
                     <a class="pull-right btn btn-sm" href="{{url('/#booking')}}">Change</a>
                  </div>
                  <table class="card-body table clearfix m-0">
                     <tr>
                        <td>Pick Date :</td>
                        @php $pickdate = date('Y/m/d h:i') @endphp    
                        @if(isset($_GET['pick_date']) && $_GET['pick_date'] != '')
                        @php $pickdate = $_GET['pick_date'] @endphp    
                        @endif
                        <td>{{date('d M, Y H:i A',strtotime($pickdate))}}</td>
                     </tr>
                     <tr>
                        <td>Return Date :</td>
                        @php $returndate = date('Y/m/d h:i',strtotime('+1day')) @endphp    
                        @if(isset($_GET['return_date']) && $_GET['return_date'] != '')
                        @php $returndate = $_GET['return_date'] @endphp    
                        @endif
                        <td>{{date('d M, Y H:i A',strtotime($returndate))}}</td>
                     </tr>
                     <tr>
                        @php
                           $date1 = date_create($pickdate);
                           $date2 = date_create($returndate);
                           $diff = date_diff($date1,$date2);
                           $d = $diff->format('%d');
                           if($d > 0){
                              $days = $d.' days';
                           }else{
                              $days = '1 days';
                           }
                           $h = $diff->format('%h');
                           if($h > 0){
                              $hours = $h.' hours';
                           }else{
                              $hours = '';
                           }
                           $duration = $days.' '.$hours;
                        @endphp
                        <td>Duration :</td>
                        <td>{{$duration}}</td>
                     </tr>
                  </table>
               </div>
   			</div>
   		</div>
   </article>

@endsection