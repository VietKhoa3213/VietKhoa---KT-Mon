@extends('layout.master') 

@section('title', 'Danh mục: ' . $category->name) 



@section('content')
<div class="container category-page-container" style="margin-top: 20px; margin-bottom: 40px;">
    <section class="category-header mb-5"> 
        @if($category->image)
         <div class="category-header-image">
           
            @if (\Str::startsWith($category->image, 'preview/image/category/'))
                 <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="category-image-display">
             @else
                 <img src="{{ asset('preview/image/category/' . $category->image) }}" alt="{{ $category->name }}" class="category-image-display">
             @endif
         </div>
        @endif

        <div class="category-header-info">
            
            <nav aria-label="breadcrumb" class="mb-2">
              <ol class="breadcrumb" style="background: none; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
              </ol>
            </nav>
            <h1 class="category-title">{{ $category->name }}</h1>
            @if($category->description)
                <p class="category-description">{{ $category->description }}</p>
            @endif
        </div>
    </section>

    <section class="product-listing-section">
        @if($products && $products->count() > 0)
            <div class="category-product-grid">
                @foreach ($products as $product)
                    @include('partials.product_card', ['product' => $product])
                @endforeach
            </div>

            <div class="pagination-wrapper mt-5"> 
                {{ $products->links() }} 
            </div>
        @else
            <div class="alert alert-info text-center" role="alert">
                <i class="fas fa-info-circle mr-2"></i> Không có sản phẩm nào thuộc danh mục này.
                <a href="{{ route('home') }}" class="btn btn-link">Quay lại Trang chủ</a>
            </div>
        @endif
    </section>

</div>
@endsection

@push('scripts')
{{--  <script src="{{ asset('js/category-page.js') }}"></script>  --}}
@endpush