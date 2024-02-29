<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Yearn Art | Order</title>
   @include('admin.css')
   <link rel="stylesheet" href="admin/assets/css/admin_ordertracking.css">

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
                  <h2 class="Head-title">Order Tracking</h2>
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
                <div class="column-3">
                  <table class="main-table">
                      <tr>
                          <th class="th-deg">No.</th>
                          <th class="th-deg">Name</th>
                          <th class="th-deg">Email</th>
                          <th class="th-deg">Phone</th>


                          <th class="th-deg">Product Name</th>
                          <th class="th-deg">Price</th>
                          <th class="th-deg">Quantity</th>
                          <th class="th-deg">Processing Time</th>
                          <th class="th-deg">Primary Color</th>
                          <th class="th-deg">Secondary Color</th>
                          <th class="th-deg">Size</th>


                          <th class="th-deg">Order ID</th>
                          <th class="th-deg">Order Status</th>
                      </tr>
                      @php
                      $count = 1;
                      @endphp

                      @foreach ($order as $order)
                      <tr>
                          <td class="th-deg">{{ $count++ }}</td>
                          <td class="th-deg">{{$order->name}}</td>
                          <td class="th-deg">{{$order->email}}</td>
                          <td class="th-deg">{{$order->phone}}</td>


                          <td class="th-deg">{{$order->product_name}}</td>
                          <td class="th-deg">₱{{ number_format($order->price * $order->quantity, 2) }}</td>
                          <td class="th-deg">{{$order->quantity}}</td>
                          <td class="th-deg">{{$order->processing_time}}</td>
                          <td class="th-deg">
                            <div class="color-style" style="background-color: {{$order->primaryclr}}"></div>
                          </td>
                          <td class="th-deg">
                            <div class="color-style" style="background-color: {{$order->secondaryclr}}"></div>
                          </td>
                          <td class="th-deg">{{$order->size}}</td>
                          <td class="th-deg">{{$order->order_id}}</td>
                          <td class="th-deg">
                              @if($order->order_status=='Order Placed')
                              <p>Pending</p>
                              @else
                              {{$order->order_status}}
                              @endif
                            </td>
                      </tr>
                      @endforeach
                  </table>
                </div>
            </div>
            
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
   @include('admin.script')

    <!-- End custom js for this page -->
  </body>
</html>
