@extends('public/layout')

@section('title','Change Password')
	
@section('content')
<section id="page-banner">
      <div class="container">
         <div class="row">
            <div class="col-12">
               <h2 class="text-center section-head">Change Password</h2>
			   <nav aria-label="breadcrumb">
					<ol class="breadcrumb justify-content-center">
						<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Change Password</li>
					</ol>
				</nav>
            </div>
         </div>
      </div> 
   </section>
	<article id="content" class="container">
   		<div class="row">
   			<div class="col-4 offset-4">
   				<form class="form-horizontal" id="login" action="{{url('/change-password')}}" method="POST">
   					@csrf
					<div class="form-icon">
						<i class="fa fa-user-circle"></i>
					</div>
					@if(Session::has('error'))
					<p>{!!Session::get('error')!!}</p>
					@endif
					<div class="form-group">
						<span class="input-icon"><i class="fa fa-lock"></i></span>
						<input type="password" name="old" class="form-control" placeholder="Old Password">
					</div>
					<div class="form-group">
						<span class="input-icon"><i class="fa fa-lock"></i></span>
						<input type="password" name="new" class="form-control" placeholder="New Password">
					</div>
					<button class="btn signin" type="submit">change</button>
					
			    </form>
   			</div>
   		</div>
   </article>
@endsection