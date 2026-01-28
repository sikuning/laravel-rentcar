@extends('public/layout')

@section('title','Payment Successfull')

@section('content')
<section id="page-banner">
      <div class="container">
         <div class="row">
            <div class="col-12">
               <h2 class="text-center section-head">Booking Successfull</h2>
			   <nav aria-label="breadcrumb">
					<ol class="breadcrumb justify-content-center">
						<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Successfull</li>
					</ol>
				</nav>
            </div>
         </div>
      </div> 
   </section>
   <article id="content" class="container">
         <div class="row">
            <div class="col-md-12 text-center">
				<a href="{{url('/user/my-profile')}}" class="btn">My Bookings</a>
            </div>
            
            
         </div>
   </article>
   
@endsection