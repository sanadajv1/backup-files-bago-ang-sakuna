<!DOCTYPE html>
<html lang="en">
  <head>
   @include('admin.css')
   <link rel="stylesheet" href="admin/assets/css/admin_show-products.css">
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
                <h2 class="Head-title">All Products</h2>
                <div class="main-table">
                    <table>
                        <tr>
                            <th class="th_deg">Product Name</th>
                            <th class="th_deg">Category</th>
                            <th class="th_deg">Product Description</th>
                            <th class="th_deg">Price</th>
                            <th class="th_deg">Processing Time</th>
                            <th class="th_deg">Product Image</th>
                            <th class="th_deg">Delete</th>
                            <th class="th_deg">Edit</th>
                        </tr>
                        @foreach($product as $product)
                        <tr>
                            <!-- need to add size -->
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->category}}</td>
                            <td>{{$product->product_description}}</td>
                            <td>₱{{number_format ($product->small_price, 2) }}</td>
                            <td>{{$product->processing_time}}</td>
                            <td>
                                <div class="img-size">
                                    <img class="img_size"src="/product/{{$product->image}}" >
                                </div>
                            </td>
                            <td>
                                <a onclick="return confirm('Are you sure to delete this?')" class="btn btn-danger" href="{{url('delete_product',$product->id)}}">Delete</a>
                            </td>
                            <td>
                                <a class="btn btn-success" href="{{url('update_product',$product->id)}}">Edit</a>
                            </td>
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
