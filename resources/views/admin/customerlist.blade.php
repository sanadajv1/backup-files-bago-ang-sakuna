<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
    <link rel="stylesheet" href="admin/assets/css/admin_cutomerlist.css">
    <title>Yearn Art | Show Product</title>
</head>
<style type="text/css">
</style>
<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        <!-- partial:partials/_navbar.html -->
        @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="main-content content-wrapper">
                @if(session()->has('message'))
                <div class='alert alert-success'>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{session()->get('message')}}
                </div>
                @endif
                <h2 class="Head-title">Customer Lists</h2>
                <div class="main-table">
                    <table>
                        <tr>
                            <th class="th_deg"></th>
                            <th class="th_deg">Name</th>
                            <th class="th_deg">Email</th>
                            <th class="th_deg">Phone Number</th>
                            <th class="th_deg">No. Of Purchases</th>
                        </tr>
                        @php
                            $index = 0;
                            $customers = [];
                        @endphp
                        @foreach($order->groupBy('user_id') as $customerId => $customerOrders)
                        @php
                            $index++;
                        @endphp
                        @php
                            $recentOrders = $customerOrders->filter(function ($order) {
                                // Assuming 'created_at' is the order date field
                                return $order->order_status === 'Order Completed' &&
                                now()->diffInDays($order->created_at) <= 30;
                            });
                        @endphp
                        @if ($recentOrders->isNotEmpty())
                        @php
                            $customerData = [
                                'index' => $index,
                                'name' => $recentOrders->first()->name,
                                'email' => $recentOrders->first()->email,
                                'phone' => $recentOrders->first()->phone,
                                'purchase_count' => $recentOrders->count(),
                            ];
                            array_push($customers, $customerData);
                        @endphp
                        @endif
                        @endforeach
                        @php
                            // Sort customers by purchase count in descending order
                            usort($customers, function ($a, $b) {
                                return $b['purchase_count'] - $a['purchase_count'];
                            });
                        @endphp
                        @foreach($customers as $customer)
                        <tr>
                            <td class="th_deg">{{ $customer['index'] }}</td>
                            <td class="th_deg">{{ $customer['name'] }}</td>
                            <td class="th_deg">{{ $customer['email'] }}</td>
                            <td class="th_deg">{{ $customer['phone'] }}</td>
                            <td class="th_deg">{{ $customer['purchase_count'] }}</td>
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
