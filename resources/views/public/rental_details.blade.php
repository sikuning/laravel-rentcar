@extends('public/layout')

@section('title','Available Car Listing')


@php
  $date1 = date_create($_GET['pick_date']);
  $date2 = date_create($_GET['return_date']);
  $diff = date_diff($date1,$date2);
  $d = $diff->format('%d');
  if($d > 0){
    $duration = $d.' days';
  }else{
    $duration = '1 days';
    $d = 1;
  }
  $required = 0;
@endphp

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
               <div class="card mb-3">
                  <div class="card-header">
                     <h5 class="pull-left">Car Details</h5>
                     <a class="pull-right btn btn-sm" href="{{url('/search-cars?pick_date='.$_GET['pick_date'].'&return_date='.$_GET['return_date'].'&pick_location='.$_GET['pick_location'].'&return_location='.$_GET['return_location'])}}">Change</a>
                  </div>
                  <div class="card car-grid mb-4">
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
                  
               </div>
                @foreach($rent_details as $rent_detail)
               <div class="card mb-3">
                  <h5 class="card-header">Rental Details</h5>
                  <div class="card-body">
                     <table class="table table-bordered">
                     
                     <tr>
                        <td>Price Per Day</td>
                        <td>{{$siteInfo->cur_format}} {{number_format($car->price,2)}}</td>
                     </tr>
                     <tr>
                        <td>Car Rental Fee</td>
                        @php
                          $rent_fee = ($car->price*$d);
                        @endphp
                        <td>{{$siteInfo->cur_format}} {{number_format(($rent_fee),2)}}</td>
                     </tr>
                     
                     <tr>
                        <td>Tax ({{$rent_detail->tax_payment}}%)</td>
                        @php
                          $tax = $rent_detail->tax_payment/100*$rent_fee;
                        @endphp
                        <td>{{$siteInfo->cur_format}} {{number_format($tax,2)}}</td>
                     </tr>
                     <tr>
                        <td><b>Total Amount</b></td>
                        @php
                          $total = $rent_fee + $tax;
                        @endphp
                        <td><b>{{$siteInfo->cur_format}} {{number_format($total,2)}}</b></td>
                     </tr>
                     <tr>
                        <td>Required Deposit ({{$rent_detail->deposit_payment}}%)</td>
                        @php
                          $required = ceil($total*$rent_detail->deposit_payment/100);
                        @endphp
                        <td>{{$siteInfo->cur_format}} {{number_format($required,2)}}</td>
                     </tr>
                  </table>
                  </div>
               </div>
               @endforeach
               <form id="rental-info" action="submit-booking" method="POST">
                  @csrf
                  
                  <div class="card">
                  <h5 class="card-header">Rental Terms</h5>
                  <div class="card-body">
                        <div class="form-group">
                           <input type="checkbox" name="rental_terms" required>
                           <label for="">I have read and agree to the rental terms.</label>
                        </div>
                        <input type="hidden" name="pick_up" value="{{$_GET['pick_date']}}|{{$_GET['pick_location']}}">
                        <input type="hidden" name="drop_of" value="{{$_GET['return_date']}}|{{$_GET['return_location']}}">
                        <input type="hidden" name="car_id" value="{{$_GET['car']}}">
                        <input type="hidden" name="amount" value="{{number_format($required,2)}}">
                        <input type="hidden" name="total_amount" value="{{number_format($total,2)}}">
                        <input type="hidden" name="email_unique" value="0">
                     <input type="button" class="btn btn-success confirm-booking" value="Confirm Booking" />
                  </div>
                  </div>
               </form>
              
            </div>
            <div class="col-md-4">
               <div class="card mb-3">
                  <div class="card-header">
                     <h5 class="pull-left">Booking Deatils</h5>
                     <a class="pull-right btn btn-sm" href="{{url('/#booking')}}">Change</a>
                  </div>
                  <table class="card-body table clearfix m-0">
                     <tr>
                        <td>Pick Date :</td>
                        <td>{{date('d M, Y',strtotime($_GET['pick_date']))}}</td>
                     </tr>
                     <tr>
                        <td>Return Date :</td>
                        <td>{{date('d M, Y',strtotime($_GET['return_date']))}}</td>
                     </tr>
                     <tr>
                        
                        <td>Duration :</td>
                        <td>{{$duration}}</td>
                     </tr>
                  </table>
               </div>
               
            </div>
         </div>
   </article>
   
@endsection

@section('pageJsScripts')
   <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
      $.ajaxSetup({
         headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      }); 
      


      // $('body').on('click', '.buy_now', function(e){
      $('.confirm-booking').click(function(e){
         e.preventDefault();
            if($('input[name=rental_terms]').is(':checked')){

               var totalAmount = $('input[name=amount]').val();
               var product_id =  $('input[name=car_id]').val();
               var options = {
                  "key": "rzp_test_ThbsT8W3BYk7Nb",
                  "amount": (totalAmount*100), // 2000 paise = INR 20
                  "currency":{{$siteInfo->cur_format}},
                  "name": "Kapil Rain",
                  "description": "Payment",
                  "image": "//www.tutsmake.com/wp-content/uploads/2018/12/cropped-favicon-1024-1-180x180.png",
                  "handler": function (response){
                     console.log(response);
                     var form = $('#rental-info');
                     // var formdata = new FormData($('#rental-info'));
                     form.append('<input type="hidden" name="payment_id" value="'+response.razorpay_payment_id+'">');
                     form.submit();
                  // window.location.href = SITEURL +'/'+ 'paysuccess?payment_id='+response.razorpay_payment_id+'&product_id='+product_id+'&amount='+totalAmount;
                  },
                  "prefill": {
                  "contact": '9988665544',
                  "email":   'tutsmake@gmail.com',
                  },
                  "theme": {
                  "color": "#528FF0"
                  }
               };
               var rzp1 = new Razorpay(options);
               rzp1.open();

            }else{
               alert('Please Check the Rental terms Checkbox');
            }
            // e.preventDefault();

         
      });

      // $('#rental-info').submit(function(e){
         
      // });
      /*document.getElementsClass('buy_plan1').onclick = function(e){
      rzp1.open();
      e.preventDefault();
      }*/
      </script>
      @endsection