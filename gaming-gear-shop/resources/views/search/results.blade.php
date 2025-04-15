@extends('layout.master')

@section('title', "Kết quả tìm kiếm cho: '" . e($query) . "'")

@section('content')
<div class="container my-5">

    <h1 class="mb-4 h2">
        Kết quả tìm kiếm cho: <span class="text-primary">"{{ e($query) }}"</span>
        @if(isset($products))
         <span class="text-muted h5 fw-normal">({{ $products->total() }} kết quả)</span>
        @endif
    </h1>

    @if(isset($products) && $products->count() > 0)
        <div class="product-grid product-grid-shop"> 
            @foreach ($products as $product)
                @include('partials.product_card', ['product' => $product])
            @endforeach
        </div>

        <div class="pagination-wrapper mt-5 d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    @else
        <div class="alert alert-warning text-center" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i> Không tìm thấy sản phẩm nào phù hợp với từ khóa "{{ e($query) }}".
            <p class="mt-2 mb-0"><a href="{{ route('products.index') }}" class="alert-link">Xem tất cả sản phẩm</a> hoặc <a href="{{ route('home') }}" class="alert-link">quay lại Trang chủ</a>.</p>
        </div>
    @endif

</div>
@endsection