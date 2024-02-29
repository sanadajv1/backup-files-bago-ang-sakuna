    <!DOCTYPE html>
    <html lang="en">
    <head>
    <base href="/public">
    <link rel="stylesheet" href="assets/css/S-order-tracking.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/typing.css">
    <link rel="stylesheet" href="assets/css/chatbot.css">

    @include('YearnArt.css')


    <style>


    </style>
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
            <img src="assets\image\OrderTrackingSpecific\Downpayment-SOrder.png" alt="">
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
                                        <p class="total-1">TOTAL:</p>
                                        <p class="price-num-1">₱{{ number_format($dpaymentPrice, 2) }}</p>
                                    </div>

                                </div>


                            </div>


                            <div class="line"></div>

                            <div class="lower-part">
                                <div class="main-description">
                                    <div class="paragraph-1">
                                        <br><br>
                                        <b>NOTE!</b>
                                        <br>
                                        Once a down payment has been made for your order, please be aware that cancellations will no longer be possible. The down payment serves as a commitment to proceed with the purchase, and as such, it is non-refundable in the event of a cancellation.
                                        <br>


                                    </div>
                                    <div class="paragraph-2">
                                        <div>
                                            <p>Please follow the procedure below to complete the payment:</p>
                                            <p>1. Open your GCash mobile app.</p>
                                            <p>2. Select 'Send Money' from the main menu.</p>
                                            <p>3. Enter the GCash number: 09482989479</p>
                                            <p>4. The recipient's name should be A*****z M.</p>
                                            <p>5. Enter the amount of the indicated amount showed in this screen.</p>
                                            <p>6. Review the details and confirm the transaction.</p>
                                            <p>7. Take a screenshot of your receipt and send with the it with the order id (Order ID: {{$order->order_id}}) to YearnBot to confirm that you already paid.</p>
                                            <p>8. Wait for your order to be confirmed by Yearn Art.</p>
                                            <p>9. Check your email.</p>
                                            <p>10. Print Receipt to see the breakdown of your orders.</p>
                                        </div>


                                    </div>

                                    <div class="paragraph-3">
                                            <p>You may scan this GCash QR code to pay.</p>
                                            <div class="qrcode">
                                                <img src="assets\image\OrderTrackingSpecific\GcashQR.png" alt="">
                                            </div>

                                        </div>
                                </div>


                                <div class="pos-price">
                                        <p class="total">TOTAL:</p>
                                        <p class="price-num">₱{{ number_format($dpaymentPrice, 2) }}</p>
                                </div>


                                <div class="buttons">
                                    <a href="{{ url('/cancel_order', $order->id) }}" class="custom-button track-order-button">Cancel Order</a>
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

