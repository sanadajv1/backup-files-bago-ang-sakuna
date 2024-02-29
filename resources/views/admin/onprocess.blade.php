<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
    <link rel="stylesheet" href="admin/assets/css/admin_onprocess.css">
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
                    <p class="Head-title">On process</p>
                    <div class="order-container">
                        <!-- Loop through your order data here -->
                        @php $customerCount = 0 @endphp
                        @foreach ($order as $order)
                            @if ($order->order_status === 'On Process' || $order->order_status === 'To Pay')
                            @php $customerCount++ @endphp
                                <div class="order-item">
                                        <div class="column-1">
                                            <p class="customer-name">{{ $order->name }}</p>
                                            <p class="customer-num">{{ $customerCount }}</p>
                                        </div>
                                        <div class="column-2">
                                            <div>
                                                <img src="{{ asset('product/' . $order->image) }}" class="img-fluid" alt="{{ $order->product_name }}">
                                            </div>
                                            <div class="product-details">
                                                <p class="product-name">{{ $order->product_name }}</p>
                                                <p class="order-info">Quantity: {{ $order->quantity }}</p>

                                                <p class="order-info">Order Status:  @if($order->order_status=='Order Placed')
                                                        Pending
                                                    @else
                                                        {{ $order->order_status }}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <div class="column-3">
                                            <p>Unit Price: ₱{{ number_format($order->price, 2) }}</p>
                                            <p class="order-info">Order Total: <b>₱{{ number_format($order->price * $order->quantity, 2) }}</b></p>
                                        </div>

                                            <!-- Add buttons inside each order -->
                                            <div class="column-4">
                                                @if ($order->order_status === 'On Process')
                                                    <a href="{{ url('to_ship', $order->id) }}" class="btn btn-action btn-low-opacity btn-confirm-payment btn-paid disabled" onclick="confirmOrderPayment({{ $order->id }})">Paid</a>
                                                    <a href="{{url('to_fpay', $order->id)}}" class="btn-done" onclick="return confirm('Are you sure this order is done?')">Done</a>
                                                @endif

                                                @if ($order->order_status === 'To Pay')
                                                <a href="{{url('to_ship', $order->id)}}" class="btn-paid" onclick="return confirm('Are you sure this order can be made?')">Paid</a>
                                                <a href="{{url('to_fpay', $order->id)}}" class="btn btn-action btn-low-opacity btn-done disabled" onclick="return confirm('Are you sure this order can be made?')">Done</a>
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

    <script>
        function markOrderAsDone(orderId) {
            // Add logic to mark the specific order as done
            alert('Order ' + orderId + ' marked as done!');
        }

        function confirmOrderPayment(orderId) {
            // Add logic to confirm payment for the specific order
            alert('Payment confirmed for Order ' + orderId + '!');
        }
    </script>
</body>
</html>
