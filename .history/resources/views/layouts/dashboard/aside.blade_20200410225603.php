
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('adminLte/dist/img/logo.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar" style="direction:rtl;">
    <div style="direction: rtl;">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-between">
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
         <div class="image">
          <img src="{{asset('adminLte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
      </div>

        <!-- Sidebar Menu -->
       
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link active">
                <i class="nav-icon fa fa-dashboard"></i>
                <p>
                  صفحات شروع
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link active">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>صفحه فعال</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>صفحه غیر فعال</p>
                  </a>
                </li>
              </ul>
               <li class="nav-item">
               <a href="{{route('dashboard.index')}}"class="nav-link">
               <i class="nav-icon fa fa-dashboard"></i>
               <p> @lang('site.dashboard')</p></a>
               </li>
               @if (auth()->user()->hasPermission('read_users'))
               <li class="nav-item">
               <a href="{{route('dashboard.user.index')}}"class="nav-link">
                <i class="nav-icon fa fa-user"></i>
                <p> @lang('site.users')</p></a>
                </li>
                @if (auth()->user()->hasPermission('read_categories'))
               <li class="nav-item">
               <a href="{{route('dashboard.category.index')}}"class="nav-link">
                <i class="nav-icon fa fa-user"></i>
                <p> @lang('site.categories')</p></a>
                </li>
                @endif
                @if (auth()->user()->hasPermission('read_products'))
               <li class="nav-item">
               <a href="{{route('dashboard.product.index')}}"class="nav-link">
                <i class="nav-icon fa fa-user"></i>
                <p> @lang('site.categories')</p></a>
                </li>
                @endif
               
                @endif
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-th"></i>
                <p>
                  لینک ساده
                  <span class="right badge badge-danger">جدید</span>
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
    </div>
    <!-- /.sidebar -->

    <!-- /.sidebar -->
  </aside>
