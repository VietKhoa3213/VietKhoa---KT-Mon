@extends('layout.master')

@section('title', "Thương hiệu: " . $brand->name) 


@section('content')
<div class="container" style="margin-top: 20px; margin-bottom: 40px;">

    <nav aria-label="breadcrumb" class="mb-4">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $brand->name }}</li>
      </ol>
    </nav>

     <section class="brand-header mb-5"> 
    @if($brand->logo)
     <div class="brand-header-logo"> 
        @if (\Str::startsWith($brand->logo, 'preview/image/brand/'))
             <img src="{{ asset($brand->logo) }}" alt="{{ $brand->name }} Logo" class="brand-logo-display">
         @else
             <img src="{{ asset('preview/image/brand/' . $brand->logo) }}" alt="{{ $brand->name }} Logo" class="brand-logo-display">
         @endif
     </div>
    @endif

    <div class="brand-header-info"> 
        <nav aria-label="breadcrumb" class="mb-2">
          <ol class="breadcrumb" style="background: none; padding: 0;">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $brand->name }}</li>
          </ol>
        </nav>
        <h1 class="brand-title">{{ $brand->name }}</h1> 
        @if($brand->description)
            <p class="brand-description">{{ $brand->description }}</p> 
        @endif
    </div>
</section>

    <section class="product-listing-section mt-4">
         <h2 class="mb-4 h4">Sản phẩm của thương hiệu {{ $brand->name }}</h2>

        @if($products && $products->count() > 0)
            <div class="brand-product-grid" style="grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));display: grid; gap: 24px;;">
                @foreach ($products as $product)
                    @include('partials.product_card', ['product' => $product])
                @endforeach
            </div>

            <div class="pagination-wrapper">
                 {{ $products->links() }} 
            </div>
        @else
            <div class="alert alert-info text-center" role="alert">
                Hiện chưa có sản phẩm nào thuộc thương hiệu này.
            </div>
             <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="btn btn-secondary">Quay lại Trang chủ</a>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Xem tất cả sản phẩm</a> 
            </div>
        @endif
    </section>

</div> 
@endsection