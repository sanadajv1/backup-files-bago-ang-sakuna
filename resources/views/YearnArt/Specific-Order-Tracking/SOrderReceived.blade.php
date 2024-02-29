<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    <link rel="stylesheet" href="assets/css/S-order-tracking.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/typing.css">
    <link rel="stylesheet" href="assets/css/chatbot.css">

    @include('YearnArt.css')
</head>

<title>Yearn Art | Order Received</title>
<body>
@include('home.header')
<div class="header">
    <h6 class="orders">Order Information</h6>
    <a href="{{url('/show_orders')}}" class="cart-link">Back to My Orders
        <img src="assets/image/Cart.png" alt="Cart Icon" class="cart-icon"></a>
</div>
<section class="custom-section">
    <div class="order-tracking-status">
        <img src="assets\image\OrderTrackingSpecific\Order-Received-SOrder.png" alt="" >
    </div>
            <div class="order-container">


                    <div class="order-item">
                        <div class="upper-part">
                            <div class="img-fluid">
                                <img src="product/{{ $order->image }}" alt="{{ $order->product_name }}">
                            </div>

                            @php

                            $unitprice = ($order->price);
                            $totalPrice = ($unitprice * $order->quantity);
                            $dpaymentPrice = ($totalPrice/2);
                            $fpaymentPrice = ($totalPrice/2);
                            @endphp
                            <div class="order-details">
                                <p class="order-info">Order ID: {{$order->order_id}}</p>
                                <p class="product-names">{{ $order->product_name }}</p>
                                <p class="order-info">Category: {{ $order->category }}</p>
                                <p class="order-info">Variation: x{{ $order->quantity }} | {{$order->size}}</p>
                                <p class="order-info">Order Created: {{ $order->created_at }}</p>
                            </div>

                            <div class="order-stats">
                                <p>
                                    {{$order->order_status}}
                                </p>
                                <div class="pos-price">
                                    <p class="total-1">Downpayment: </p>
                                    <p class="price-num-1">Paid</p>
                                </div>
                                <div class="pos-price">
                                    <p class="total-1">Fullpayment: </p>
                                    <p class="price-num-1">Paid</p>
                                </div>
                            </div>

                        </div>

                        <div class="line"></div>

                        <div class="lower-part">
                            <div class="main-description">
                                <p>
                                    We would like to inform you that your  {{ $order->product_name }} is now shipping!
                                </p>
                            </div>

                            <div class="pos-price">
                                    <p class="total">TOTAL:</p>
                                    <p class="price-num">₱{{ number_format($totalPrice  , 2) }}</p>
                            </div>

                            <div class="buttons">

                                <a href="{{ url('receive_order', $order->id) }}" class="custom-button track-order-button disabled-link">Order Received</a>



                                <button class="custom-button">Contact Yearn Art</button>

                            </div>
                        </div>
                    </div>





            </div>

    </section>


<script src="assets/javascript/home.js"></script>
@include ('YearnArt.chatbot')
@include ('YearnArt.script')
</body>
</html>

