@extends('public/layout')

@section('title','User Login')
	
@section('content')
	<section id="page-banner">
      <div class="container">
         <div class="row">
            <div class="col-12">
               <h2 class="text-center section-head">User Login</h2>
			   <nav aria-label="breadcrumb">
					<ol class="breadcrumb justify-content-center">
						<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Login</li>
					</ol>
				</nav>
            </div>
         </div>
      </div> 
   </section>
	<article id="content" class="container">
   		<div class="row">
   			<div class="col-4 offset-4">
   				<form class="form-horizontal" id="login" action="{{url('/login')}}" method="POST">
   					@csrf
					<div class="form-icon">
						<i class="fa fa-user-circle"></i>
					</div>
					<div class="form-group">
						<span class="input-icon"><i class="fa fa-envelope"></i></span>
						<input type="email" name="useremail" class="form-control" placeholder="Email address">
					</div>
					<div class="form-group">
						<span class="input-icon"><i class="fa fa-lock"></i></span>
						<input type="password" name="password" class="form-control" placeholder="Password">
					</div>
					<button class="btn signin" type="submit">Log In</button>
					@if(Session::has('error'))
					<p class="alert alert-danger">{{Session::get('error')}}</p>
					@endif
			    </form>
   			</div>
   		</div>
   </article>
@endsection