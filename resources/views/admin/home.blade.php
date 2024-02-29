    <!DOCTYPE html>
    <html lang="en">
    <head>
        @include('admin.css')
        <link rel="stylesheet" href="admin/assets/css/admin_home.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Yearn Art | Home</title>
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
            <div class="content-wrapper">
                <h2 class="title-header">Quantity Sold</h2>
                <label for="yearDropdown" class="year">Year:</label>
                <select class="year-option" name="selected_year" id="yearDropdown" onchange="handleYearChange()">
                    <?php
                    $currentYear = date("Y");
                    $years = range($currentYear - 2, $currentYear + 2);

                    // Loop to create options
                    foreach ($years as $year) {
                        // Set the default selected year to the current year
                        $selected = ($year == $currentYear) ? 'selected' : '';

                        echo '<option value="' . $year . '" ' . $selected . '>' . $year . '</option>';
                    }
                    ?>
                </select>

                <div id="loadingIndicator" style="display: none;">

                </div>


                <!-- Add the dropdown for year selection -->
                <div class="quantity-table">
                    <div class="quantity">
                        <canvas id="verticalChart"></canvas>
                        <p class="quantity-sold">Quantity sold: <b id="quantity-sold-value">{{ $totalQuantity }}</b></p>
                    </div>
                </div>

                <h2 class="title-header">Best Selling Category</h2>

                <div class="quantity-table">
                    <div class="quantity">
                        <canvas id="horizontalChart"></canvas>
                    </div>
                </div>
                <h2 class="title-header">Sales Order Transaction Confirmation</h2>

                <div class="table-1212">
                <table class="main-table">

                    <tr>

                        <th class="th-deg">Name</th>

                        <th class="th-deg">Product Name</th>

                        <th class="th-deg">Price</th>

                        <th class="th-deg">Quantity</th>

                        <th class="th-deg">Order ID</th>

                        <th class="th-deg">Action</th>

                    </tr>

                    @foreach ($order as $order)



                    @if($order->order_status=='Order Received')

                    <tr>

                        <td class="th-deg">{{$order->name}}</td>

                        <td class="th-deg">{{$order->product_name}}</td>

                        <td class="th-deg">₱{{ number_format($order->price * $order->quantity, 2) }}</td>

                        <td class="th-deg">{{$order->quantity}}</td>

                        <td class="th-deg">{{$order->order_id}}</td>


                        <td class="th-deg">

                            @if($order->order_status=='On Process')

                            <p>Done</p>

                            @else

                            <a href="{{url('to_order_completed', $order->id)}}" class="btn-confirm" onclick="return confirm('Are you sure this order is already paid??')">Done</a>


                            @endif

                        </td>

                    </tr>

                    @endif

                    @endforeach

</table>
                </div>
                <script>
                    function fetchDataAndRenderCharts(year) {
                        // Vertical Bar Chart
                        const verticalChartData = fetch('/get_data?selected_year=' + year)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                console.log('Vertical Chart Data:', data); // Log data for debugging
                                updateChart('verticalChart', 'bar', 'Quantity Sold', data.labels, data.data);
                            });

                        // Horizontal Bar Chart
                        const horizontalChartData = fetch('/get_data_category?selected_year=' + year)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                console.log('Horizontal Chart Data:', data); // Log data for debugging
                                const labels = Object.keys(data.data); // Use categories as labels
                                updateChart('horizontalChart', 'horizontalBar', 'Best Selling Category', labels, Object.values(data.data));
                            });

                        // Return a promise that resolves when both charts are updated
                        return Promise.all([verticalChartData, horizontalChartData]);
                    }

                    function updateChart(chartId, chartType, label, labels, data) {
                        // Existing chart update logic
                        var chart = new Chart(document.getElementById(chartId).getContext('2d'), {
                            type: chartType,
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: label,
                                    data: data,
                                    backgroundColor: 'rgba(125, 84, 82, .50)',

                                }]
                            },
                            options: {
                                scales: {
                                    x: {
                                        beginAtZero: true,
                                    },
                                    y: {
                                        beginAtZero: true,
                                        min: 0,
                                    }
                                }
                            }
                        });
                    }

                    function handleYearChange() {
                        // Show loading indicator
                        document.getElementById('loadingIndicator').style.display = 'block';

                        // Get the selected year value
                        let selectedYear = document.getElementById('yearDropdown').value;

                        // Fetch and render charts for the selected year
                        fetchDataAndRenderCharts(selectedYear)
                            .then(() => {
                                // Hide loading indicator when data is loaded
                                document.getElementById('loadingIndicator').style.display = 'none';
                            })
                            .catch((error) => {
                                console.error('Error fetching data:', error);
                                // Handle errors and hide loading indicator
                                document.getElementById('loadingIndicator').style.display = 'none';
                            });
                    }

                    document.addEventListener('DOMContentLoaded', function () {
                        let selectedYear = '<?php echo date("Y"); ?>';

                        // Function to update charts manually when the button is clicked
                        function updateChartsManually() {
                            // Destroy existing charts
                            if (window.verticalChart) {
                                window.verticalChart.destroy();
                            }
                            if (window.horizontalChart) {
                                window.horizontalChart.destroy();
                            }

                            // Fetch and render new charts
                            fetchDataAndRenderCharts(selectedYear);
                        }

                        // Initial fetch and render
                        fetchDataAndRenderCharts(selectedYear);
                    });



                </script>
            </div>
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('admin.script')
        <!-- End custom js for this page -->
    </body>
    </html>
