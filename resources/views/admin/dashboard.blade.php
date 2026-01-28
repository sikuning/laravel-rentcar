@extends('admin.layout')

@section('content')

<!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-1">
                                        <i class="pe-7s-car"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count">{{$inventory}}</span></div>
                                            <div class="stat-heading">Cars</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-4">
                                        <i class="pe-7s-users"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count">{{$users}}</span></div>
                                            <div class="stat-heading">Users</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-4">
                                        <i class="pe-7s-cash"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count">{{$bookings}}</span></div>
                                            <div class="stat-heading">Bookings</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Widgets -->
                
                <div class="clearfix"></div>
                <div class="orders">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="box-title">Latest Bookings</h4>
                                </div>
                                <div class="card-body--">
                                    <div class="table-stats order-table ov-h">
                                        <table class="table ">
                                            <thead>
                                                <tr>
                                                    <th>User</th>
                                                    <th>Car Name</th>
                                                    <th>Pick Up Date</th>
                                                    <th>Drop Off Date</th>
                                                    <th>Booked On</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($booking as $list)
                                                <tr>
                                                    <td>{{$list->user_name}}</td>
                                                    <td>{{$list->car_name}}</td>
                                                    <td>{{date('d M, Y',strtotime($list->pick_date))}}</td>
                                                    <td>{{date('d M, Y',strtotime($list->return_date))}}</td>
                                                    <td>{{date('d M, Y',strtotime($list->created_at))}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div> 
                                </div>
                            </div> 
                        </div> 
                    </div>
                </div> 
            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->


@stop