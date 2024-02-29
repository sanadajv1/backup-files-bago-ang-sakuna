<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Yearn Art | Payment</title>

   @include('admin.css')
   <link rel="stylesheet" href="admin/assets/css/admin_pending.css">


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
        <section class="custom-section">
                <div class="">
                    <p class="Head-title">Pending Orders</p>
                    <div class="order-container">
                    @php $customerCount = 0 @endphp
                    @foreach ($order as $order)

                      @if($order->order_status=='Order Placed')
                      @php $customerCount++ @endphp
                    <div class="order-item">
                        <div class="column-1">
                          <p class="customer-name">{{ $order->name }}</p>
                          <p class="customer-num">{{ $customerCount }}</p>
                        </div>
                        <div class="column-2">
                          <div>

                          </div>
                          <div class="product-details">
                            <div>
                                <img src="{{ asset('product/' . $order->image) }}" class="img-fluid" alt="{{ $order->product_name }}">
                            </div>
                            <p class="product-name">{{$order->product_name}}</p>
                            <p class="order-info">Quantity: {{$order->quantity}}</p>
                          </div>
                        </div>
                        <div class="column-3">
                          <p class="order-info">Order  Total: <b>₱{{ number_format($order->price * $order->quantity, 2) }}</b></p>
                        </div>
                        <div class="column-4">
                            @if($order->order_status == 'On Process')
                            <p>Confirmed</p>
                                @elseif($customerCount > 1)
                                    <button class="btn btn-success" disabled>Confirm</button>
                                @else
                                    <a href="{{ url('to_dpay', $order->id) }}" class="btn btn-success" onclick="return confirm('Are you sure this order can be made?')">Confirm</a>
                                @endif
                        </div>

                    </div>
                      @endif
                    @endforeach
                    </div>
                </div>
        </section>
    </div>
</div>

    <!-- container-scroller -->
    <!-- plugins:js -->
   @include('admin.script')

    <!-- End custom js for this page -->
  </body>
</html>
