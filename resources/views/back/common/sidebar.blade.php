  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a class="nav-link show-menu" data-widget="pushmenu" href="#" role="button"><i class="fas fa-times-circle"></i></a>
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link" style="font-size: 32px;text-align: center;text-transform: uppercase;"> 
      <span class="brand-text font-weight-light">Goashtwala</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image" style="font-size: 35px;color: #d6d7d8;">
          <i class="fa fa-user-circle"></i>
        </div>
        <div class="info" style="padding-top: 14px;">
          <a href="#" class="d-block" style="text-transform: capitalize;">{{Auth::user()->name}}</a>
        </div>
      </div>

     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item ">
            <a href="{{url('/admin-area/account')}}" class="nav-link {{'admin-area/account' == request()->path() ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link {{'admin-area/categories' == request()->path() ? 'active' : ''}} {{'admin-area/add-category' == request()->path() ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Categories
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/admin-area/categories')}}" class="nav-link {{'admin-area/categories' == request()->path() ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/admin-area/add-category')}}" class="nav-link {{'admin-area/add-category' == request()->path() ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Category</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link {{'admin-area/lists' == request()->path() ? 'active' : ''}} {{'admin-area/add-list' == request()->path() ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Lists
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/admin-area/lists')}}" class="nav-link {{'admin-area/lists' == request()->path() ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Listing</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/admin-area/add-list')}}" class="nav-link {{'admin-area/add-list' == request()->path() ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Listing</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{'admin-area/orders' == request()->path() ? 'active' : ''}}" >
            <a href="#" class="nav-link">
              <i class="nav-icon  fas fa-cart-plus"></i>
              <p>
                Orders
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/admin-area/orders') }}" class="nav-link {{'admin-area/orders' == request()->path() ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Order</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{'admin-area/customers' == request()->path() ? 'active' : ''}}" >
            <a href="#" class="nav-link {{'admin-area/customers' == request()->path() ? 'active' : ''}}">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Customers
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/admin-area/customers') }}" class="nav-link {{'admin-area/customers' == request()->path() ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Customers</p>
                </a>
              </li>
             
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                Setting
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/admin-area/personal-detail')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Personal Detail</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/admin-area/change-password')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
              <li class="nav-item">
               <a  onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();"  class="nav-link" style="cursor: pointer;"><i class="far fa-circle nav-icon"></i><p>Logout</p></a><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
              </li>
              
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>