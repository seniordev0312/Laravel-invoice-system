@section('title', 'Search')
@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Search Inventory') }}</div>

                <div class="card-body">
                    <form method="GET" action="{{ route('product.search.view') }}">
                        <div class="form-group search">
                            <label for="prodCode">{{ __('Product Code') }}</label>
                            <input id="prodCode" type="text" class="form-control" name="prodCode" required autofocus>
                            <button type="submit" class="btn btn-primary">{{ __('Search') }}</button>
                        </div>
                    </form>
                </div>
            </div>

            @if (isset($product))
                <div class="card mt-4">
                    <div class="card-header">{{ __('Search Results') }}</div>
                    <div>
                        @if ($product || $polyProduct)
                            <div class="card-product">
                                @if ($product)
                                    <p class="inventory-text">Warehouse Inventory</p>
                                    <p>Product Code: <span class="product-code">{{ $product->style }}</span></p>
                                    <p>Category: {{ $product->Category }}</p>
                                    <p>Description En / Fr :<br> {{ $product->Description }} / {{ $product->DescriptionFR }}</p>
                                    <p>Color / Couleur: {{ $product->Color }} / {{ $product->FRColor }}</p>
                                    <p>Size: {{ $product->Size }}</p>
                                    <p>Option: {{ $product->options }}</p>
                                    <p>Extra: {{ $product->Extra }}</p>
                                    <p>Cost: ${{ $product->Cost }}</p>
                                    <p>Price: ${{ $product->price }}</p>
                                    <p><class=a href="{{ url('/images/photo/'.$product->photoID) }}"><img class="product-photo" src="{{ url('/images/photo/'.$product->photoID) }}" alt="Product Photo">
                                    <p class="barcode-text">Barcode: {{ $product->ProdCode }}</p>
                                    <p class="instock-text">InStock: {{ $product->InStock }}</p>
                                @endif
                            </div>
                            @else
                                <p>No reseller inventory found</p>
                            @endif
                        @else
                            <p>No product found</p>
                        @endif
                    </div>
                </div>
            @endif



        </div>
    </div>
</div>

<script>
    // Set the focus on the prodCode input field after the page loads
    window.addEventListener('load', function() {
        document.getElementById('prodCode').focus();
    });
</script>
@endsection
