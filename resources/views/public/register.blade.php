@extends('public/layout')

@section('title','User Login')
	
@section('content')
<section id="page-banner">
      <div class="container">
         <div class="row">
            <div class="col-12">
               <h2 class="text-center section-head">Sign Up</h2>
			   <nav aria-label="breadcrumb">
					<ol class="breadcrumb justify-content-center">
						<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Sign Up</li>
					</ol>
				</nav>
            </div>
         </div>
      </div> 
   </section>
	<article id="content" class="container">
   		<div class="row">
   			<div class="col-4 offset-4">
   				<form class="form-horizontal" id="joinUs" action="{{url('/signup')}}" method="POST">
   					@csrf
					   <div class="form-icon">
							<i class="fa fa-user-circle"></i>
						</div>
						@if($errors->any())
						<p class="alert alert-danger">{{ implode('', $errors->all(':message')) }}</span>
						@endif
   					<div class="form-group">
					   <span class="input-icon"><i class="fa fa-user"></i></span>
			      		<input type="text" class="form-control" name="name" placeholder="Your Full Name" >
   					</div>
   					<div class="form-group">
					   <span class="input-icon"><i class="fa fa-envelope"></i></span>
			      		<input type="email" class="form-control" name="email" placeholder="Email address" >
   					</div>
   					<div class="form-group">
					   <span class="input-icon"><i class="fa fa-phone"></i></span>
			      		<input type="number" class="form-control" name="phone" placeholder="Mobile Number" >
   					</div>
   					<div class="form-group">
					   <span class="input-icon"><i class="fa fa-lock"></i></span>
			      		<input type="password" id="password" class="form-control" name="password" placeholder="Password" >
   					</div>
   					<div class="form-group">
					   <span class="input-icon"><i class="fa fa-lock"></i></span>
			      		<input type="password" class="form-control" name="con_password" placeholder="Confirm Password" >
   					</div>   
					   <div class="form-group">
					   <span class="input-icon"><i class="fa fa-map-marker"></i></span>
			      		<input type="text" class="form-control" name="address" placeholder="Address" >
   					</div>						      
					<div class="form-group">
					   <span class="input-icon"><i class="fa fa-map-marker"></i></span>
			      		<input type="text" class="form-control" name="city" placeholder="City" >
   					</div>						      
			      	<button class="btn btn-lg btn-block" type="submit">Sign Up</button>
				  	@if(Session::has('error'))
					<p class="alert alert-danger">{{Session::get('error')}}</p>
					@endif
			    </form>
   			</div>
   		</div>
   </article>
@endsection