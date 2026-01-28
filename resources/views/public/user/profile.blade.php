@extends('public/layout')

@section('title','User Login')
	
@section('content')
<section id="page-banner">
      <div class="container">
         <div class="row">
            <div class="col-12">
               <h2 class="text-center section-head">My Profile</h2>
			   <nav aria-label="breadcrumb">
					<ol class="breadcrumb justify-content-center">
						<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">My Profile</li>
					</ol>
				</nav>
            </div>
         </div>
      </div> 
   </section>
<section id="profile-section" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3 bg-light">
                <div class="profile-content">
                    <h5>{{$user_detail->name}}</h5>
                    <span>{{$user_detail->email}}</span>
                    <ul>
                        <li><i>Phone :</i> {{$user_detail->phone}}</li>
                        @if($user_detail->address != '')
                        <li><i>Address :</i> {{$user_detail->address}}</li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <h4>My Recent Bookings</h4>
                
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Car Name</th>
                            <th>Pick Up date</th>
                            <th>Drop Off date</th>
                            <th>Booked On</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($my_bookings) > 0)
                        @foreach($my_bookings as $row)
                        <tr>
                            <td>{{$row->car_name}}</td>
                            <td>{{date('d M, Y',strtotime($row->pick_date))}}</td>
                            <td>{{date('d M, Y',strtotime($row->return_date))}}</td>
                            <td>{{date('d M, Y',strtotime($row->created_at))}}</td>
                            <td>Confirmed</td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="text-center">
                            <td colspan="5">No Bookings Found</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection