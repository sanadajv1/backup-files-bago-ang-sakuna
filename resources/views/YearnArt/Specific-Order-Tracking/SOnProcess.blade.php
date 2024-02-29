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

<title>Yearn Art | {{ $order->product_name }}</title>
<body>
@include('home.header')
<div class="header">
    <h6 class="orders">Order Information</h6>
    <a href="{{url('/show_orders')}}" class="cart-link">Back to My Orders
        <img src="assets/image/Cart.png" alt="Cart Icon" class="cart-icon"></a>
</div>
<section class="custom-section">
    <div class="order-tracking-status">
        <img src="assets\image\OrderTrackingSpecific\On-Process-SOrder.png" alt="" >
    </div>
            <div class="order-container">
                <!-- Loop through your order data here -->

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
                                    <p class="price-num-1">₱{{ number_format($dpaymentPrice, 2) }}</p>

                                </div>
                                <div class="pos-price">
                                    <p class="total-1">PAID</p>

                                </div>

                            </div>

                        </div>

                        <div class="line"></div>

                        <div class="lower-part">
                            <div class="main-description">
                                <div class="paragraph-1">
                                    Thank you for placing your order with us. We wanted to inform you that the processing time for your product(Order ID: {{$order->order_id}}) will depend on the quantity ordered. For a single product, it will take approximately  {{$order->processing_time}} weeks to complete. <br>
                                    We want to ensure that your crochet masterpiece is crafted with utmost care and attention to detail. The time required for processing multiple products may be longer due to the additional complexity and quantity involved. <br>
                                    Please feel free to take your time and reach out to us if you have any questions or concerns.
                                </div>
                            </div>

                            <div class="pos-price">
                                    <p class="total">TOTAL:</p>
                                    <p class="price-num">₱{{ number_format($order->price/2, 2) }}</p>
                            </div>

                            <div class="buttons">




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

