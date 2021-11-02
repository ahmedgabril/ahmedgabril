  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/index3.html" class="brand-link">
      <img src="/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">المنى للشحن الدولى</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="pb-3 mt-3 mb-3 user-panel d-flex">
        <div class="image">
          <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">ahmed gabril</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!--<div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>-->

      <!-- Sidebar Menu -->
      <nav class="mt-2" style="padding-bottom: 60px">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="/2020" class="nav-link {{ request()->is("/2020") ? 'active' :'' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                الصفحه الرئيسه
              </p>
            </a>
     
          </li>
          <!--
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Widgets
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>-->
      
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                الفروع
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route("bransh") }}" class="nav-link {{ request()->is("/2020/bransh") ? 'active' :'' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>اداره الفروع</p>
                </a>
              </li>
           
        
        
            </ul>
          </li>


          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
              المخازن 
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/2020/stores" class="nav-link {{ request()->is("/2020/stores") ? 'active' :'' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>اداره المخازن</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/icons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>تقارير</p>
                </a>
              </li>
          
      
   
            </ul>
          </li>
      
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
              العملاء 
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('customer') }}" class="nav-link {{ request()->is('customer')? 'active':'' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>اداره العملاء</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('customer') }}" class="nav-link {{ request()->is('customer')? 'active':'' }}">

                  <i class="far fa-circle nav-icon"></i>
                  <p>تقارير</p>
                </a>
              </li>
          
      
   
            </ul>
          </li>
               <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
            الرحلاات  
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('genry') }}" class="nav-link {{ request()->is('genry')? 'active':'' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>اداره الرحلاات</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('genry') }}" class="nav-link {{ request()->is('genry')? 'active':'' }}">

                  <i class="far fa-circle nav-icon"></i>
                  <p>تقارير</p>
                </a>
              </li>
          
      
   
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
              فواتير الشحن  
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('sheepment')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>انشاء فاتوره</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/icons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>استعراض فاتوره</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/icons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> تقارير</p>
                </a>
              </li>
          
      
   
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-save"></i>
   
          
              <p>
              الخزنه 
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route("drow")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>اداره الخزنه</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/icons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>تقارير</p>
                </a>
              </li>
          
      
   
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class=" nav-icon fas fa-file-invoice-dollar"></i>
              <p>
              المصروفات 
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('expens')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>اداره المصروفات</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/icons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>تقارير</p>
                </a>
              </li>
          
      
   
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
            الموظفين & والصلاحيات 
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/UI/general.html" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>اداره المستخدمين </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/icons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>الصلاحيات </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/icons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>التقارير </p>
                </a>
              </li>
          
      
   
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class=" nav-icon fas fa-bullhorn"></i>
              <p>
             الاعلاانات
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('adds') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>اضافه اعلان </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('video') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>اضافه فيديو</p>
                </a>
              </li>
          
      
   
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-cogs nav-icon"></i>
              <p>
              الاعددات 
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/UI/general.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>اداره البرنامج</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/icons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>تقارير</p>
                </a>
              </li>
          
      
   
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>