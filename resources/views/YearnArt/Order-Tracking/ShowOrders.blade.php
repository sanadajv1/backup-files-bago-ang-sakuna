<!DOCTYPE html>
<html lang="en">
<head>
@include('YearnArt.css')
<link rel="stylesheet" href="assets/">
<link rel="stylesheet" href="assets/css/order_tracking.css">
<link rel="stylesheet" href="assets/css/navbar.css">
<link rel="stylesheet" href="assets/css/chatbot.css">
</head>

<title>Yearn Art | All Orders</title>
<body>
@include('home.header')
<div class="header">
    <h6 class="orders">My Orders</h6>
    <a href="{{url('/show_cart')}}" class="cart-link">My Cart
        <img src="assets/image/Cart.png" alt="Cart Icon" class="cart-icon"></a>
</div>

<section class="custom-section">
@include('YearnArt.status_links', ['selectedStatus' => 'All'])
        <div class="order-container">
            <!-- Loop through your order data here -->
            @foreach ($order as $order)
                <div class="order-item">
                    <div class="upper-part">
                        <div class="img-fluid">
                            <img src="product/{{ $order->image }}" alt="{{ $order->product_name }}">
                        </div>

                        <div class="order-details">

                            <p class="product-names">{{ $order->product_name }}</p>
                            <p class="order-info">Variation: x{{ $order->quantity }}</p>
                            <p class="order-info">Order ID: {{ $order->order_id }}</p>
                        </div>

                        <div class="order-stats">
                            <p>@if($order->order_status=='Order Placed')
                                Pending
                                @else
                                {{$order->order_status}}
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="line"></div>

                    <div class="lower-part">
                        <div class="pos-price">
                            <div class="pos-unit-price">
                                <p class="total-1">Unit Price:</p>
                                <p class="price-num-1">₱{{ number_format($order->price, 2) }}</p>
                            </div>
                            <div class="pos-total-price">
                                <p class="total">TOTAL:</p>
                                <p class="price-num">₱{{ number_format($order->price * $order->quantity, 2) }}</p>
                            </div>
                                
                        </div>

                        <div class="buttons">
                            <a href="{{ url('/track_Sorder', $order->id) }}" class="custom-button track-order-button">Track Order</a>
                            <button class="custom-button">Contact Yearn Art</button>
                        </div>
                    </div>
                </div>


            @endforeach

            <!-- Your existing receipt footer -->
            <!-- ... -->
        </div>

</section>



<script src="assets/javascript/home.js"></script>
@include ('YearnArt.chatbot')
@include ('YearnArt.script')
</body>
</html>

