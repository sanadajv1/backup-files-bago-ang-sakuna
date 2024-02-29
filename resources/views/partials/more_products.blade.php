@foreach($moreProducts as $product)
    @if($product->category_id == $categoryId)
        <div class="col-sm-6 col-md-4 col-lg-3">
            <!-- Your product box HTML here -->
        </div>
    @endif
@endforeach
