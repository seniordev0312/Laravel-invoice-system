@section('title', 'Remove Stock')
@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Remove Stock') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('product.remove.stock') }}">
                            @csrf
                            <div class="form-group">
                                <label for="prodCode">{{ __('Product Code') }}</label>
                                <input id="prodCode" type="text" class="form-control" name="prodCode" required autofocus>
                                <label for="qty">{{ __('Qty') }}</label>
                                <input id="qty" type="number" class="form-control" name="qty" required>
                                <button type="submit" class="btn btn-primary">{{ __('Remove Stock') }}</button>
                            </div>
                        </form>
                </div>
            <div class="card-body">

            @if (isset($product))
                <div class="card mt-4">
                    <div class="card-header">{{ __('Search Results') }}</div>
                    <div>
                        @if ($product || $polyProduct)
                            <div class="card-product">
                                @if ($product)
                                    <p class="inventory-text">Warehouse Inventory</p>
                                    <p>Product Code: <span class="product-code">{{ $product->Code }}</span></p>
                                    <p>Category: {{ $product->Category }}</p>
                                    <p>Description En / Fr :<br> {{ $product->Description }} / {{ $product->DescriptionFR }}</p>
                                    <p>Color / Couleur: {{ $product->Color }} / {{ $product->FRColor }}</p>
                                    <p>Size: {{ $product->Size }}</p>
                                    <p>Option: {{ $product->options }}</p>
                                    <p>Extra: {{ $product->Extra }}</p>
                                    <p>Cost: ${{ $product->Cost }}</p>
                                    <p>Price: ${{ $product->Price }}</p>
                                    <p><class=a href="{{ url('/images/photo/'.$product->photoID) }}"><img class="product-photo" src="{{ url('/images/photo/'.$product->photoID) }}" alt="Product Photo"></a></p>
                                    <p class="barcode-text">Barcode: {{ $product->ProdCode }}</p>
                                    <p class="instock-text">InStock: {{ $product->InStock }}</p>
                                @endif
                            </div>
                            @if ($polyProduct)
                                <div class="card-polyproduct">
                                    <p class="inventory-text">Resellers Inventory</p>
                                    <p>Product Code: <span class="product-code">{{ $polyProduct->Code }}</span></p>
                                    <p>Category: {{ $polyProduct->Category }}</p>
                                    <p>Description En / Fr :<br> {{ $polyProduct->Description }} / {{ $polyProduct->DescriptionFR }}</p>
                                    <p>Color / Couleur: {{ $polyProduct->Color }} / {{ $polyProduct->FRColor }}</p>
                                    <p>Size: {{ $polyProduct->Size }}</p>
                                    <p>Option: {{ $polyProduct->options }}</p>
                                    <p>Extra: {{ $polyProduct->Extra }}</p>
                                    <p>Cost: ${{ $polyProduct->Cost }}</p>
                                    <p><span class="@if ($product->Price != $polyProduct->Price) text-red-price @else text-green-price @endif">Price: $</span><span class="@if ($product->Price != $polyProduct->Price) text-red-price blink @else text-green-price @endif">{{ $polyProduct->Price }}</span></p>
                                    <p><class=a href="{{ url('/images/photo/'.$product->photoID) }}"><img class="product-photo" src="{{ url('/images/photo/'.$product->photoID) }}" alt="Product Photo">
                                    <p class="barcode-text">Barcode: {{ $polyProduct->ProdCode }}</p>
                                    <p><span class="@if ($product->InStock != $polyProduct->InStock) text-red @else text-green @endif">InStock: </span><span class="@if ($product->InStock != $polyProduct->InStock) text-red blink @else text-green @endif">{{ $polyProduct->InStock }}</span></p>
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

            @if (isset($successMessage))
            <div class="alert alert-success" role="alert">
                {{ $successMessage }}
            </div>
            @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
