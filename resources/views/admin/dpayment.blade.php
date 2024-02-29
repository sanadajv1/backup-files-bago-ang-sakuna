<!DOCTYPE html>
<html lang="en">
    <title>Yearn Art | Payment</title>
  <head>
   @include('admin.css')
   <link rel="stylesheet" href="admin/assets/css/admin_dpayment.css">
  </head>
  <body>

    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
        <!-- partial:partials/_navbar.html -->
        @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
          <div class="main-content">
          <div class="content-wrapper">
                <div class="column-1">
                  <h2 class="Head-title">Down Payment</h2>
                </div>
                
                <div class="column-2">
                  <form action="{{url('search')}}" method="get">
                            @csrf

                            <div class="search-bar">
                              <input type="text" name="search" id="" placeholder="Search...">
                            </div>
                            
                  </form>
                </div>
                
            </div>
          </div>
          <div class="column-3">
          <table class="main-table">
                    <tr>
                        <th class="th-deg">Name</th>
                        <th class="th-deg">Product Name</th>
                        <th class="th-deg">Price</th>
                        <th class="th-deg">Quantity</th>
                        <th class="th-deg">Order ID</th>
                        <th class="th-deg">Action</th>
                    </tr>
                    @foreach ($order as $order)

                    @if($order->order_status=='Downpayment')
                    <tr>
                        <td class="th-deg">{{$order->name}}</td>
                        <td class="th-deg">{{$order->product_name}}</td>
                        <td class="th-deg">₱{{ number_format($order->price * $order->quantity, 2) }}</td>
                        <td class="th-deg">{{$order->quantity}}</td>
                        <td class="th-deg">{{$order->order_id}}</td>

                        <td class="th-deg">
                            @if($order->order_status=='On Process')
                            <p>Done</p>
                            @else
                            <a href="{{url('to_onprocess', $order->id)}}" class="btn-confirm" onclick="return confirm('Are you sure this order is already paid??')">Done</a>

                            @endif
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </table>
          </div>
            
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
   @include('admin.script')

    <!-- End custom js for this page -->
  </body>
</html>
