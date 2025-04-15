@extends('layout.master')

@section('title', 'Tất cả sản phẩm')

@section('content')
<div class="container" style="margin-top: 20px; margin-bottom: 20px;">
    <h1 class="mb-4">Tất cả sản phẩm</h1>

    @if($products && $products->count() > 0)
        <div class="product-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px;">
            @foreach ($products as $product)
                @include('partials.product_card', ['product' => $product])
            @endforeach
        </div>

        <div class="mt-6 d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    @else
        <p>Không tìm thấy sản phẩm nào.</p>
    @endif

</div>
@endsection