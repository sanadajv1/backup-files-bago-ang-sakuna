            <DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">

                <link rel="stylesheet" href="assets/css/receipt.css">
                <title>Sales Invoice</title>
            </head>
            <body>


                <!-- <div class="logo-container">
                    <img src="logo\YearnArt.png">
                </div> -->

                <!-- Palagyan ng TIN Number -->

                <table class="invoice-info-container">
                    <tr>
                    <td rowspan="2" class="client-name">
                        {{ $order->name }} <!--Get Data-->
                    </td>
                    <td>
                        Yearn Art
                    </td>
                    </tr>
                    <tr>
                    <td>
                        48 Lot 8, Marang St, Amparo Subd.
                    </td>
                    </tr>
                    <tr>
                        <td>
                            Invoice Date: <strong>May 24th, 2024</strong>
                        </td>
                        <td>
                            Brgy 179, Caloocan City, MM
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Order ID: <strong> {{ $order->order_id }}</strong>
                        </td>

                        <td>
                            yearnart21@gmail.com
                        </td>
                    </tr>
                    <tr>
                        <td  style="color: green;">
                            Downpayment (PAID)
                        </td>

                        <td>

                        </td>
                    </tr>
                    <tr>
                        <td style="color: green">
                            Fullpayment ( PAID )
                        </td>

                        <td>

                        </td>
                    </tr>
                </table>

                @php
                $vatPercentage = 12;
                $unitprice = ($order->price);
                $unitpriceVatAmount =($order->price  * $vatPercentage) / 100;
                $unitPriceVat = ($unitprice - $unitpriceVatAmount);

                $subtotalprice = ($unitPriceVat * $order->quantity);

                $grandVATamount = ($unitpriceVatAmount * $order->quantity ) ;


                $grandAmount = ($subtotalprice +  $grandVATamount   );


                $dateString = ($order->completed_at);
                $formattedDate = date("F jS, Y", strtotime($dateString));

                @endphp

                <table class="line-items-container">
                    <thead>
                    <tr>

                        <th class="heading-description">Description</th>
                        <th class="heading-price">Qty</th>
                        <th class="heading-price">Price/Unit</th>
                        <th class="heading-price"> Vat (12%)</th>


                        <th class="heading-price">SUBTOTAL</th>






                    </tr>
                    </thead>
                    <tbody>
                    <tr>

                        <td> {{ $order->product_name }}</td>
                        <td class="right"> {{ $order->quantity }}</td>


                        <td class="right">₱{{ number_format($unitPriceVat  , 2) }}</td>
                        <td class="right">₱{{ number_format($unitpriceVatAmount  , 2) }}</td>


                        <td class="right" style="color: green;">₱{{ number_format($subtotalprice  , 2) }}</td>






                    </tr>
                    </tbody>
                </table>



                <table class="line-items-container has-bottom-border">
                    <thead>
                    <tr>
                        <th>Payment Info</th>
                        <th>Date</th>
                        <th class="heading-price">VAT ({{ $vatPercentage }}%)</th>
                        <th class="heading-price">Subtotal ({{ $vatPercentage }}% Vatable)</th>

                        <th>Total Due</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="payment-info">
                        <div>
                            Customer ID: <strong> {{ $order->user_id }}</strong>
                        </div>
                        </td>
                        <td class="large">{{($formattedDate)}}</td>
                        <td class="right"> {{$peso . number_format($grandVATamount, 2) }}</td>
                        <td class="right"> {{ $peso . number_format($subtotalprice, 2) }}</td>

                        <td class="large total">₱{{ number_format($grandAmount, 2) }}</td>

                    </tr>
                    <tr>

                        <td></td>
                    </tr>
                    </tbody>
                </table>

            </body>
            </html>
