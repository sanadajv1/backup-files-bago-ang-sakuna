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

                        <div class="child1">
                            <div class="product-photo" >
                                    <input type="file" name="image" id="fileInput"  style="display: none;">
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

                        <div class="child2">
                                <div class="product-name">
                                    <input type="text" name="product_name" value="{{$product->product_name}}" placeholder="Product Name" id="" required="" autocomplete="off">
                                </div>

                            @csrf

                                <div class="product-type">
                                    <select name="category" id="" required="" >
                                    <option value="{{$product->category}}" selected="">{{$product->category}}</option>
                                    @foreach($category as $category)
                                    <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                                    @endforeach

                                </select>
                                </div>

                                <div class="product-description">
                                    <input type="text" value="{{$product->product_description}}"  name="product_description" placeholder="Product Description"id="" required="" autocomplete="off">
                                </div>



                                <div class="process-time">
                                    <input class="text_color"  value="{{$product->processing_time}}" id="integerInput" type="number" name="processing_time" placeholder="Processing Time (weeks)" id="" required="" autocomplete="off">
                                </div>

                                <label for="size">Sizes:</label>
                                <div class="size-inputs">
                                    <div class="size-input">
                                        <div class="size-label">
                                            Small:
                                        </div>
                                        <input type="text" value="{{$product->small_size}}"  name="small_size" placeholder="Size" required autocomplete="off">
                                        <input type="number" value="{{$product->small_price}}"  id="smallIntegerInput" name="small_price" placeholder="Price" required autocomplete="off">
                                    </div>
                                    <div class="size-input">
                                        <div class="size-label">
                                            Medium:
                                        </div>
                                        <input type="text"  value="{{$product->medium_size}}" name="medium_size" placeholder="Size" name="medium_size" required autocomplete="off">
                                        <input type="number"  value="{{$product->medium_price}}" id="mediumIntegerInput" name="medium_price" placeholder="Price" required autocomplete="off">
                                    </div>
                                    <div class="size-input">
                                        <div class="size-label">
                                            Large:
                                        </div>
                                        <input type="text" value="{{$product->large_size}}" name="large_size" placeholder="Size" required autocomplete="off">
                                        <input type="number" value="{{$product->large_size}}" id="largeIntegerInput" name="large_price" placeholder="Price" required autocomplete="off">
                                    </div>
                                </div>



                        </div>
                    </div>

                    <div class="btn-submit">
                        <button type="submit">+</button>
                    </div>
                    </form>
                </div>
            </div>


    <script>
        const fileInput = document.getElementById('fileInput');
        const imagePreview = document.getElementById('imagePreview');
        const removeButton = document.getElementById('removeButton');
        const removeDiv = document.querySelector('.remove-btn');
        const productImageURL = 'product/{{ $product->image }}'; // Assuming $product->image contains the image URL

        // Hide the remove button initially
        removeButton.style.display = 'none';

        const imageData = localStorage.getItem('imageData');
        if (imageData) {
            imagePreview.innerHTML = imageData; // Display the image data
            removeButton.style.display = 'block'; // Show the remove button
        } else if (productImageURL) {
            imagePreview.innerHTML = `<img src="${productImageURL}" alt="Product Image" style="max-width: 100%;">`;
            removeButton.style.display = 'block';
        }

        fileInput.addEventListener('change', function () {
            const file = this.files[0]; // Get the selected file
            if (file) {
                const reader = new FileReader(); // Initialize FileReader object
                reader.onload = function (event) {
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
        removeButton.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default form submission behavior
        imagePreview.innerHTML = ''; // Clear the image preview
        fileInput.value = ''; // Clear the file input value
        this.style.display = 'none'; // Hide the remove button

        localStorage.removeItem('imageData');
    });


        window.addEventListener('beforeunload', function () {
            // Clear the stored image data in local storage
            localStorage.removeItem('imageData');
        });

        function handleIntegerInput(event) {
            let input = event.target.value;
            // Remove leading zeros
            input = input.replace(/^0+/, '');
            // Remove non-numeric characters except -
            input = input.replace(/\D/g, '');
            event.target.value = input;
        }
        document.getElementById("integerInput").addEventListener("input", handleIntegerInput);
        document.getElementById("smallIntegerInput").addEventListener("input", handleIntegerInput);
        document.getElementById("mediumIntegerInput").addEventListener("input", handleIntegerInput);
        document.getElementById("largeIntegerInput").addEventListener("input", handleIntegerInput);


    </script>



        <!-- container-scroller -->
        <!-- plugins:js -->
    @include('admin.script')
        <!-- End custom js for this page -->


    </body>
    </html>


