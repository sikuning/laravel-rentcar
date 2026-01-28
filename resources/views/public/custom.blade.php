@extends('public/layout')

@section('title','User Login')
	
@section('content')
	<section id="page-banner">
      <div class="container">
         <div class="row">
            <div class="col-12">
               <h2 class="text-center section-head">{{$page_detail->title}}</h2>
			   <nav aria-label="breadcrumb">
					<ol class="breadcrumb justify-content-center">
						<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">{{$page_detail->title}}</li>
					</ol>
				</nav>
            </div>
         </div>
      </div> 
   </section>
	<article id="content" class="container">
   		<div class="row">
   			<div class="col-12">
			   {!!htmlspecialchars_decode($page_detail->desc)!!}
   			</div>
   		</div>
   </article>
@endsection