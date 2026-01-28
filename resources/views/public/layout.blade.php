<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="csrf-token" content="{{csrf_token()}}">
   <title>@yield('title')</title>
   <link rel="stylesheet" href="{{asset('public/public/css/bootstrap.min.css')}}">
   <link rel="stylesheet" href="{{asset('public/public/css/font-awesome.min.css')}}">
   <link rel="stylesheet" href="{{asset('public/public/css/jquery.datetimepicker.css')}}" />
   <link rel="stylesheet" href="{{asset('public/public/css/owl.carousel.min.css')}}" />
   <link rel="stylesheet" href="{{asset('public/public/css/owl.theme.default.min.css')}}" />
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500&family=Poppins:wght@200;300;400;500;600&display=swap" rel="stylesheet">
   <!-- <link rel="stylesheet" href="{{asset('public/public/css/bootstrap-datetimepicker-standalone.min.css')}}"  /> -->
      <style> :root{ --main-color: {{$siteInfo->theme_color}}; } </style>
   <link rel="stylesheet" href="{{asset('public/public/css/style.css')}}">
</head>
<body>
   <div id="wrapper">
      <header id="header" class="py-2 position-relative">
         <div class="container">
            <div class="row">
               <div class="col-12">
               <nav class="navbar navbar-expand-lg navbar-light">
                  <a class="navbar-brand" href="{{url('/')}}">
                  @if($siteInfo->site_logo != '')
                  <img src="{{asset('public/siteImages/'.$siteInfo->site_logo)}}" alt="{{$siteInfo->site_name}}">
                  @else
                  {{$siteInfo->site_name}}
                  @endif
               </a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                  </button>

                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                           <a class="nav-link" href="{{url('/')}}">Home</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="{{url('/search-cars')}}">Cars</a>
                        </li>
                        @if(!$pages->isEmpty())
                           @foreach($pages as $page)
                           <li class="nav-item">
                              <a class="nav-link" href="{{url('/'.$page->slug)}}">{{$page->title}}</a>
                           </li>
                           @endforeach
                        @endif
                        @if(!session()->has('uid'))
                           <li class="nav-item">
                              <a class="nav-link" href="{{url('/login')}}">Login</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="{{url('/signup')}}">Signup</a>
                           </li>
                        @else
                           <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 {{session()->get('uname')}}
                              </a>
                              <div class="dropdown-menu p-0" aria-labelledby="userDropdown">
                                 <a class="dropdown-item py-2" href="{{url('/user/my-profile')}}">My Profile</a>
                                 <a class="dropdown-item py-2" href="{{url('/change-password')}}">Change Password</a>
                                 <a class="dropdown-item py-2" href="{{url('/logout')}}">Logout</a>
                              </div>
                           </li>
                        @endif
                     </ul>
                  </div>
                  </nav>
               </div>
            </div>
         </div>
      </header>
      @section('content')
      @show
      <footer id="footer" class="pt-4 pb-3">
         <div class="container">
            <div class="row">
               <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                  <div class="footer-widget">
                     <h3>{{$siteInfo->site_name}}</h3>
                     <p>{{$siteInfo->site_desc}}</p>
                  </div>
               </div>
               <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                  <div class="footer-widget">
                     <h4>Links</h4>
                     <ul>
                        <li><a href="{{url('/')}}">Home</a></li>
                        @if(!$pages->isEmpty())
                           @foreach($pages as $page)
                           <li>
                              <a href="{{url('/'.$page->slug)}}">{{$page->title}}</a>
                           </li>
                           @endforeach
                        @endif
                     </ul>
                  </div>
               </div>
               <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                  <div class="footer-widget">
                     <h4>Contact US</h4>
                     <ul>
                        <li><i class="fa fa-map-marker"></i> :  {{$siteInfo->contact_address}}</li>
                        <li><i class="fa fa-phone"></i> : {{$siteInfo->contact_phone}}</li>
                        <li><i class="fa fa-envelope"></i> : {{$siteInfo->contact_email}}</li>
                     </ul>
                  </div>
               </div>
               <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                  <ul class="social-links float-lg-right">
                     @foreach($social as $list)
                        @if($list->name == 'facebook' && $list->status == '1')
                           <li><a href="{{$list->value}}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        @endif
                        @if($list->name == 'instagram' && $list->status == '1')
                           <li><a href="{{$list->value}}" target="_blank"><i class="fa fa-instagram"></i></a></li>
                        @endif
                        @if($list->name == 'twitter' && $list->status == '1')
                           <li><a href="{{$list->value}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        @endif
                     @endforeach
                  </ul>
               </div>
            </div>
         </div>
         <div class="container-fluid">
            <div class="row">
               <div class="col-12 text-center">
                  <span class="copyright">Copyright © <a href="https://github.com/sikuning" target="_blank">Sikuning</a>  @php echo date('Y'); @endphp. All rights reserved.</span>
               </div>
            </div>
         </div>
      </footer>
   </div>
   <input type="hidden" id="url" value="{{url('/')}}">
   <script type="text/javascript" src="{{asset('public/public/js/jquery.min.js')}}"></script>
   <script src="{{asset('public/admin/assets/js/jquery.validate.min.js')}}"></script>
   <script src="{{asset('public/public/js/bootstrap.min.js')}}"></script>
   <script src="{{asset('public/public/js/jquery.datetimepicker.full.min.js')}}"></script>
   <script src="{{asset('public/public/js/main.js')}}"></script>
   <script src="{{asset('public/public/js/owl.carousel.min.js')}}"></script>
   <script>
      $(document).ready(function(){

         $('#pickdate').datetimepicker({ minDate: 0 });
         $('#returndate').datetimepicker({ minDate: "+1" });

         $("#booking-form").validate({
            rules: {
                  pick_date: { required: true },
                  pick_time: { required: true },
                  pick_location: { required: true },
                  return_location: { required: true },
            },
            messages: {
                  pick_date: { required: 'Select Pick Up Date' },
                  pick_time: { required: 'Select Pick Up Time' },
                  pick_location: { required: 'Select Pick Up Location' },
                  return_location: { required: 'Select Return Location' },
            },
            submitHandler: function(form) {
               form.submit();
            }
         });
         $('.cars-carousel').owlCarousel({
               loop:false,
               margin:20,
               nav:false,
               responsive:{
                  0:{
                        items:1
                  },
                  600:{
                        items:2
                  },
                  1000:{
                        items:3
                  }
               }
            })
         $('.location-carousel').owlCarousel({
               loop:false,
               margin:20,
               nav:false,
               responsive:{
                  0:{
                        items:1
                  },
                  600:{
                        items:2
                  },
                  1000:{
                        items:4
                  }
               }
            })
      });
   </script>
   @yield('pageJsScripts')
</body>
</html>
