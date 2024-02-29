<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
   @include('admin.css')

   <link rel="stylesheet" href="admin/assets/css/admin_products.css">
   <title>Yearn Art | Products</title>


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
                @if(session()->has('message'))

                    <div class='alert alert-success'>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        {{session()->get('message')}}
                    </div>

                @endif

                <form action="{{url('/update_product_confirm', $product->id)}}" method="POST" enctype="multipart/form-data">
                <div class="div-main">
                    @csrf
                    <div class="child1">
                        <div class="product-photo" >
                                <input type="file" name="image" id="fileInput" required="" style="display: none;">
                                <label for="fileInput" class="file-label" style="cursor: pointer;">
                                <div class="plus-icon">+</div>
                                Add Photo
                                </label>
                        </div>
                        <div class="imagePreview">

                            <div id="imagePreview" class="image-preview"></div>

                                <button id="removeButton" class="rm-btn">×</button>

                        </div>
                    </div>
                    @csrf
                    <div class="child2">
                            <div class="product-name">
                                <input type="text" name="product_name" value="{{$product->product_name}}" placeholder="Product Name" id="" required="" autocomplete="off">
                            </div>

                    

                            <div class="product-type">
                                <select name="category" id="" required="" >
                                <option value="{{$product->category}}" selected="">{{$product->category}}</option>
                                @foreach($category as $category)
                                <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                                @endforeach

                            </select>
                            </div>

                            <div class="product-description">
                                <input type="text" name="product_description" value="{{$product->product_description}}" placeholder="Product Description" id="" required="" autocomplete="off">
                            </div>

                            {{-- <div class="size-inputs">
                                <label for="size">Sizes:</label>

                                $sizeNames = ['Extra Small', 'Small', 'Medium', 'Large', 'Extra Large', '2 Extra Large', '3 Extra Large', '4 Extra Large', '5 Extra Large'];
                                for ($i = 0; $i < 9; $i++):

                            </div> --}}
                            <div class="size-inputs">
                                <label for="size">Sizes:</label>

                                <div class="size-input">
                                    <input type="text" name="extra_small" value="Extra Small" readonly>
                                    <input type="number" name="extra_small_price" value="{{$product->extra_small_price}}" placeholder="Extra Small Price" autocomplete="off">
                                </div>
                                <div class="size-input">
                                    <input type="text" name="small" value="Small" readonly required>
                                    <input type="number" name="small_price" value="{{$product->small_price}}" placeholder="Small Price" required autocomplete="off">
                                </div>
                                <div class="size-input">
                                    <input type="text" name="medium" value="Medium" readonly required>
                                    <input type="number" name="medium_price" value="{{$product->medium_price}}" placeholder="Medium Price" required autocomplete="off">
                                </div>
                                <div class="size-input">
                                    <input type="text" name="large" value="Large" readonly required>
                                    <input type="number" name="large_price" value="{{$product->large_price}}" placeholder="Large Price" required autocomplete="off">
                                </div>
                                <div class="size-input">
                                    <input type="text" name="extra_large" value="Extra Large" readonly>
                                    <input type="number" name="i_extra_large_price" value="{{$product->i_extra_large_price}}" placeholder="Extra Large Price" autocomplete="off">
                                </div>
                                <div class="size-input">
                                    <input type="text" name="2_extra_large" value="2 Extra Large" readonly>
                                    <input type="number" name="ii_extra_large_price" value="{{$product->ii_extra_large_price}}" placeholder="2 Extra Large Price" autocomplete="off">
                                </div>
                                <div class="size-input">
                                    <input type="text" name="3_extra_large" value="3 Extra Large" readonly>
                                    <input type="number" name="iii_extra_large_price" value="{{$product->iii_extra_large_price}}" placeholder="3 Extra Large Price" autocomplete="off">
                                </div>
                                <div class="size-input">
                                    <input type="text" name="4_extra_large" value="4 Extra Large" readonly>
                                    <input type="number" name="iiii_extra_large_price" value="{{$product->iiii_extra_large_price}}" placeholder="4 Extra Large Price" autocomplete="off">
                                </div>
                                <div class="size-input">
                                    <input type="text" name="5_extra_large" value="5 Extra Large" readonly>
                                    <input type="number" name="iiiii_extra_large_price"  placeholder="5 Extra Large Price"  value="{{$product->iiiii_extra_large_price}}">
                                </div>
                            </div>

                            <div class="process-time">
                                <input class="text_color" type="number" name="processing_time" value="{{$product->processing_time}}" placeholder="Processing Time"id="" required="" autocomplete="off">
                            </div>
                    </div>
                </div>

                <div class="btn-submit">
                    <input type="submit" value="Update Product" class="btn btn-primary">
                </div>
                </form>
            </div>
        </div>

        <script>
            const fileInput = document.getElementById('fileInput');
            const imagePreview = document.getElementById('imagePreview');
            const removeButton = document.getElementById('removeButton');
            const removeDiv = document.querySelector('.remove-btn');

            // Hide the remove button initially
            removeButton.style.display = 'none';

            const imageData = localStorage.getItem('imageData');
            if (imageData) {
                imagePreview.innerHTML = imageData; // Display the image data
                removeButton.style.display = 'block'; // Show the remove button
            }

            fileInput.addEventListener('change', function() {
                const file = this.files[0]; // Get the selected file
                if (file) {
                    const reader = new FileReader(); // Initialize FileReader object
                    reader.onload = function(event) {
                        const imageUrl = event.target.result; // Get the data URL
                        imagePreview.innerHTML = `<img src="${imageUrl}" alt="Chosen Photo" style="max-width: 100%;">`; // Display the image
                        removeButton.style.display = 'block'; // Show the remove button

                        localStorage.setItem('imageData', imagePreview.innerHTML);
                    };
                    reader.readAsDataURL(file); // Read the file as a data URL
                } else {
                    imagePreview.innerHTML = ''; // Clear the image preview if no file is selected
                    removeButton.style.display = 'none'; // Hide the remove button
                    localStorage.removeItem('imageData');
                }
            });

            // Add event listener to the remove button
            removeButton.addEventListener('click', function() {
                imagePreview.innerHTML = ''; // Clear the image preview
                fileInput.value = ''; // Clear the file input value
                this.style.display = 'none'; // Hide the remove button

                localStorage.removeItem('imageData');
            });


        </script>

    <!-- container-scroller -->
    <!-- plugins:js -->
   @include('admin.script')
    <!-- End custom js for this page -->


  </body>
</html>
