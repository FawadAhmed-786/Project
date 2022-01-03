 <!-- NAVBAR RESP -->
      <a  id="return-to-top"><i class="fas fa-arrow-up"></i></a>
      <div class="wrapper d-flex align-items-stretch mobilesidebararea" id="xin "  style="  z-index: 999;position: fixed; height: 100%;">
        <nav id="sidebar">
        
         
          @can('isUser')
           <p class="headsidebar">Current User</p>
          <div class=""><ul class="list-unstyled" style="margin-bottom: 15px;">
                <li><p style="padding: 10px 0;text-transform: uppercase; cursor: pointer;   border-bottom: 1px solid rgba(255, 255, 255, 0.1);">{{Auth::user()->name}}  </p></li></ul>
          </div>
          <p class="headsidebar">User Area</p>
          <div class="">
              <ul class="list-unstyled components">
                <li><a href="{{ url('/user-area/account')}}">Dashboard</a></li>
                <li><a href="{{ url('/user-area/order-history')}}">Order History</a></li>
                <li><a href="{{ url('/user-area/personal-detail')}}">Personal Detail</a></li>
                <li><a href="{{ url('/user-area/change-password')}}">Change Password</a></li>
                <li><a onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i>  {{ __('Logout') }}</a><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                </li>
              </ul>
          </div>
          @endcan
          @canany('isAdmin')
           <p class="headsidebar">Current User</p>
          <div class=""><ul class="list-unstyled" style="margin-bottom: 15px;">
                <li><p style="padding: 10px 0;text-transform: uppercase; cursor: pointer;   border-bottom: 1px solid rgba(255, 255, 255, 0.1);"> {{Auth::user()->name}}</p></li></ul>
          </div>
          <p class="headsidebar">Admin Area</p>
          <div class="">
              <ul class="list-unstyled components">
                 <li><a href="{{url('/admin-area/dashboard')}}">Dashboard</a></li>
                 <li><a href="{{ url('/admin-area/personal-detail')}}">Personal Detail</a></li>
                 <li><a href="{{ url('/admin-area/change-password')}}">Change Password</a></li>
                  <li><a  onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i>  {{ __('Logout') }}</a><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                </li>

              </ul>
          </div>
          @endcanany
          @guest
          <p class="headsidebar">User Area</p>
          <div class="">
            <ul class="list-unstyled mb-5">
                <li>
                    <a href=" {{ url('/register') }} " class="{{ 'register' == request()->path() ? 'active' : '' }}">{{__('Sign Up')}}</a>
                </li>

                <li>
                    <a href="{{ url('/login') }} " class="{{ 'login' == request()->path() ? 'active' : '' }}">{{__('Sign In')}}</a>
                </li>
            </ul>
          </div>
          @endguest
          <p class="headsidebar">Usefull Link</p>
          <div class="">
            <ul class="list-unstyled mb-5">
              <li><a href="{{ url('/') }}" class="{{'127.0.0.1:8000' == request()->path() ? 'active' : ''}}">HOME</a></li>
                  <li><a href="{{url('/menu') }}" class="{{'menu' == request()->path() ? 'active' : ''}}">MENU</a></li>
                  <li><a href="{{ url('/about') }}" class="{{'about' == request()->path() ? 'active' : ''}}">ABOUT</a></li>
                  <li><a href="{{ url('/contact') }}" class="{{'contact' == request()->path() ? 'active' : ''}}">CONTACT</a></li>
            </ul>
          </div>
        </nav>
        <div id="side-overlay"></div> 
      </div>
      <!-- Nav Bar -->
      <div class="mini-header-top">
          <div class="container">
            <div class="row">
              <div class="col-md-6 col-sm-6 infoiconarea">
                <ul class="infoicon">
                  <li><a href="mail:a@gmail.com"><span class="fas fa-envelope"></span>a@gmail.com</a></li>
                  <li><a href="tel:03355678932"><span class="fas fa-phone-alt"></span>03355678932</a></li>
                </ul>
              </div>
              <div class="col-md-6 col-sm-6 socialiconarea">
                <ul class="socialicon">
                    <li><a href=""  target="_blank" tooltip="Facebook" flow="down"><i class="fab fa-facebook"></i></a></li>

                    <li><a href=""  target="_blank" tooltip="Twitter" flow="down"><i class="fab fa-twitter"></i></a></li>

                    <li><a href=""  target="_blank" tooltip="Linkedin" flow="down"><i class="fab fa-linkedin"></i></a></li>

                    <li><a href="" target="_blank" tooltip="Instagram" flow="down"><i class="fab fa-instagram"></i></a></li>

                    <li><a href=""  target="_blank" tooltip="Google-plus" flow="down"><i class="fab fa-google-plus"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
      </div>
      
      <div class="header-navbar">
        <div class="navbar-maincont container">
          <div class="row">
            <!-- Navbar Left -->
            <div class="col-lg-2 col-md-3 col-sm-4 col-4 logomain">
              <div class="mobilelogo">
                <a href="{{ url('/') }}"><img src="{{ asset('assets/images/main-logo.png')}}" alt="goashtwala" title="Goashtwala.pk"></a>
              </div>
              <div class="desktoplogo">
                 <a href="{{ url('/') }}"><img src="{{ asset('assets/images/main-logo.png')}}" alt="goashtwala" title="Goashtwala.pk" class="img-fluid"></a>
              </div>
              
            </div>
            <!-- Navbar Center -->
            <div class="col-lg-8 col-md-6 col-sm-4 col-5 navbarcenter">
              <div class="desktopnavbar">
                <ul>
                  <li><a href="{{ url('/') }}" class="{{'127.0.0.1:8000' == request()->path() ? 'active' : ''}}">HOME</a></li>
                  <li><a href="{{url('/menu') }}" class="{{'menu' == request()->path() ? 'active' : ''}}">MENU</a></li>
                  <li><a href="{{ url('/about') }}" class="{{'about' == request()->path() ? 'active' : ''}}">ABOUT</a></li>
                  <li><a href="{{ url('/contact') }}" class="{{'contact' == request()->path() ? 'active' : ''}}">CONTACT</a></li>
                </ul>
              </div>
              <div class="mobilenavbar">
                <button class="navbar-toggler " id="sidebarCollapse">
                  <span class="fas fa-bars"></span>
                </button>
              </div>
            </div>
<!-- <div class="mobileuser">
                <ul>
                   <li class="inline"><a href="pages/cart.html"><i class="fa fa-shopping-cart b-count"><span id="getmobile"></span></i></a></li>
                </ul>
              </div>
              <div class="desktopuser">  
                <ul>
                  <li class="inline"><a href="pages/cart.html"><i class="fa fa-shopping-cart b-count"><span id="get"></span></i></a></li> -->
            <!-- Navbar Right -->
            <div class="col-lg-2 col-md-3 col-sm-4 col-3 navbarright">
              <div class="mobileuser">
                <ul>
                  <li class="inline"><a href="{{url('/view-cart')}}"><i id="getmobile" data-count=""  class="fa fa-shopping-cart b-count {{ 'view-cart' == request()->path() ? 'act' : '' }}"></i></a></li>
                </ul>
              </div>
              <div class="desktopuser">  
                <ul>
                  <li class="inline"><a href="{{url('/view-cart')}}" ><i id="get" data-count="" class="fa fa-shopping-cart b-count {{ 'view-cart' == request()->path() ? 'act' : '' }}"></i></a></li>
                  <li class="dropdown inline"><a class="signupbtn dropdown-toggle" data-toggle="dropdown"><i class="fas fa-user-circle"></i></a>
                    <ul class="dropdown-menu">
                      @guest
                      <li><a href="{{ url('/register') }}">Sign Up</a></li>
                      <li><a href="{{ url('/login') }}">Sing In</a></li>
                      @endguest
                      @can('isUser')
                      <li style="text-align: center;text-transform: uppercase;">{{Auth::user()->name}}</li>
                      <li><a href="{{ url('/user-area/account')}}">Dashboard</a></li>
                      <li><a href="{{ url('/user-area/order-history')}}">Order History</a></li>
                      @endcan
                      @can('isAdmin')
                      <li style="text-align: center;text-transform: uppercase;">{{Auth::user()->name}}</li>
                      <li><a href="{{ url('/admin-area/account')}}">Dashboard</a></li>
                      @endcan
                      @can('isAllowUserAdmin')
                      <li><a href="@can('isAdmin') {{ url('/admin-area/personal-detail')}} @endcan @can('isUser') {{ url('/user-area/personal-detail')}} @endcan">Personal Detail</a></li>
                      <li><a href="@can('isAdmin') {{ url('/admin-area/change-password')}} @endcan @can('isUser') {{ url('/user-area/change-password')}} @endcan">Change Password</a></li>
                      <li><a  onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i>  {{ __('Logout') }}</a><form id="logout-f" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                      </li>
                      @endcan
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>