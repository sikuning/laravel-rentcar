@extends('public/layout')

@section('title','Joined Successfully')
	
@section('content')
<section id="page-banner">
      <div class="container">
         <div class="row">
            <div class="col-12">
               <h2 class="text-center section-head">Thanks for Joining Us</h2>
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
   			<div class="col-md-12 text-center">
   				<h2 class="page-heading text-center mb-5">Thanks for Joining Us</h2>
   				<span>For Login <a href="{{url('/login')}}" class="btn">Click Here</a></span>
   			</div>
   		</div>
   </article>
@endsection