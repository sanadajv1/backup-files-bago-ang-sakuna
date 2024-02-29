<nav class="sidebar sidebar-offcanvas" id="sidebar">

        <ul class="nav">
          <li class="nav-item profile">

          </li>
          <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('/admin_dashboard') }}">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>

          <li class="nav-item menu-items">
            <a class="nav-link" href="{{url('view_category')}}">
              <span class="menu-icon">
                <i class="mdi mdi-playlist-play"></i>
              </span>
              <span class="menu-title">Category</span>
            </a>
          </li>

          <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#ui-products" aria-expanded="false" aria-controls="ui-products">
                <span class="menu-icon">
                    <i class="mdi mdi-laptop"></i>
                </span>
                <span class="menu-title">Products</span>
                <i class="menu-arrow"></i>
            </a>
            <div id="ui-products" >
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/view_product')}}">Add Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/show_product')}}">Show Products</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#ui-orders" aria-expanded="false" aria-controls="ui-orders">
                <span class="menu-icon">
                    <i class="mdi mdi-laptop"></i>
                </span>
                <span class="menu-title">Orders</span>
                <i class="menu-arrow"></i>
            </a>
            <div id="ui-orders">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('order')}}">Order Tracking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/customer_list')}}">Customer List</a> <!-- Changed URL for payment -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/pending')}}">Pending Orders</a> <!-- Changed URL for payment -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/dpayment')}}">Downpayment</a> <!-- Changed URL for payment -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/onprocess')}}">On Process</a> <!-- Changed URL for payment -->
                    </li>
                </ul>
            </div>
        </li>


        </ul>
      </nav>
