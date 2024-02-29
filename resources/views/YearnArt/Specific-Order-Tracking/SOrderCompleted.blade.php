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
            <img src="assets\image\OrderTrackingSpecific\Order-Completed-SOrder.png" alt="" >
        </div>
                <div class="order-container">


                        <div class="order-item">
                            <div class="upper-part">
                                <div class="img-fluid">
                                    <img src="product/{{ $order->image }}" alt="{{ $order->product_name }}">
                                </div>

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
                                        <p class="total-1">Fullpayment: </p>
                                        <p class="price-num-1">Paid</p>
                                    </div>
                                </div>

                            </div>

                            <div class="line"></div>

                            <div class="lower-part">
                                <div  class="main-description">
                                    <div class="paragraph-1">
                                    <p>
                                        Thank you for choosing Yearn Art! We take pride in the quality and craftsmanship of our crochet masterpieces, and we want to ensure your complete satisfaction with your purchase.
                                        <br><br>
                                        We understand that sometimes adjustments or repairs may be necessary to meet your specific requirements. Therefore, we offer a return policy for adjustments and repairs within 10 days from the date of delivery.
                                        <br><br>
                                        <b>NOTE!</b>
                                        <br>
                                        While we can accommodate adjustments and repairs, refunds are not available for our products. If you find that your product requires any modifications or repairs, please reach out to our customer service team within the specified timeframe. We will guide you through the return process and provide instructions on how to send the item back to us.
                                    </p>
                                    </div>

                                    @php
                                    $currentTimestamp = strtotime('now');
                                    $receivedTimestamp = strtotime($order->completed_at);
                                    $formattedreceivedTimestamp = date('Y-m-d', $receivedTimestamp);

                                    // Add 10 days to received timestamp
                                    $tenDaysAgoTimestamp = strtotime('+10 days', $receivedTimestamp);
                                    $formattedTenDaysAgo = date('Y-m-d', $tenDaysAgoTimestamp);

                                @endphp
                               <div class="paragraph-4">
                                <p>Specific timeframe of returning for return/resizing:</p>
                                <p>{{ $formattedreceivedTimestamp }} - {{ $formattedTenDaysAgo }}</p>
                                </div>
                                </div>

                                <div class="pos-price">
                                        <p class="total">TOTAL:</p>
                                        <p class="price-num">₱{{ number_format($order->price/2, 2) }}</p>
                                </div>



                                <!-- Assuming $order->order_received_at contains varchar timestamp -->

                                <div class="buttons">
                                @if ($currentTimestamp > $tenDaysAgoTimestamp  )
                                <a href="#" class="custom-button track-order-button disabled-link" >Return for Resizing/Repair</a>
                                <button class="custom-button">Contact Yearn Art</button>

                                @else
                                <a href="{{ url('receive_order', $order->id) }}" class="custom-button track-order-button" >Return for Resizing/Repair</a>
                                <button class="custom-button">Contact Yearn Art</button>
                                @endif
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

