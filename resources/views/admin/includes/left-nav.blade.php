<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->
        </div>
        <!-- <div class="pull-left info">
          <p>Admin</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div> -->
      </div>
      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <!-- <input type="text" name="q" class="form-control" placeholder="Search..."> -->
              <!-- <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span> -->
        <!-- </div>
      </form>  -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- <li class="header">MAIN NAVIGATION</li> -->
        <li >
          <a href="{{url('admin/dashboard')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i>
            <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin/adduser')}}"><i class="fa fa-circle-o"></i> Add User </a></li>
            <li><a href="{{url('admin/userlist')}}"><i class="fa fa-circle-o"></i> User List</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i>
            <span>Category</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin/addcategory')}}"><i class="fa fa-circle-o"></i> Add Category</a></li>
            <li><a href="{{url('admin/categorylist')}}"><i class="fa fa-circle-o"></i> Category List</a></li>
          </ul>
        </li>
         <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i>
            <span>Video</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin/addvideo')}}"><i class="fa fa-circle-o"></i> Add Video</a></li>
            <li><a href="{{url('admin/videolist')}}"><i class="fa fa-circle-o"></i> Video List</a></li>
          </ul>
        </li> 

       
       
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i>
            <span>Movies</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin/moviecategory')}}"><i class="fa fa-circle-o"></i> Movie Category</a></li>
            <li><a href="{{url('admin/movies')}}"><i class="fa fa-circle-o"></i>Add Movies</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i>
            <span>Payment Details</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin/paymentdetails')}}"><i class="fa fa-circle-o"></i> Payment History</a></li>
            <li><a href="{{url('admin/subscriptionlist')}}"><i class="fa fa-circle-o"></i>Subscription Details</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i>
            <span>Media Details</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin/addmedia')}}"><i class="fa fa-circle-o"></i> Add Media</a></li>
            <li><a href="{{url('admin/medialist')}}"><i class="fa fa-circle-o"></i>Media Details List</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i>
            <span>Gift Details</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <!-- <li><a href="{{url('admin/addmedia')}}"><i class="fa fa-circle-o"></i> Add Media</a></li> -->
            <li><a href="{{url('admin/giftlist')}}"><i class="fa fa-circle-o"></i>Gift Details List</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>