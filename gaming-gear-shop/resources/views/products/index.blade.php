@extends('layout.master') 

@section('title', 'Cửa hàng - Tất cả sản phẩm') 

@push('styles')
<style>

</style>
@endpush

@section('content')
<div class="container" style="margin-top: 20px; margin-bottom: 40px;">

    <nav aria-label="breadcrumb" class="mb-4">
      <ol class="breadcrumb" style="background-color: #f8f9fa; padding: 0.75rem 1rem; border-radius: 0.25rem;">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
        <li class="breadcrumb-item active" aria-current="page">Cửa hàng</li>
      </ol>
    </nav>

    <div class="shop-layout">

        <aside class="shop-sidebar">
            <div class="widget category-widget" >
                <h3 class="widget-title">Sản phẩm</h3>
                @if(isset($categoriesForMenu) && $categoriesForMenu->count() > 0)
                 <ul class=" list-group-flush ">
                    <li class="list-group-item {{ !request('category') ? 'active' : '' }}"> 
                        <a href="{{ route('products.index') }}">Tất cả danh mục</a>
                    </li>
                    @foreach ($categoriesForMenu as $category)
                        <li class="list-group-item {{ request('category') == $category->slug ? 'active' : '' }}"> 
                            <a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
                @endif
            </div>
            <div class="widget brand-widget mt-4">
                <h3 class="widget-title">Thương hiệu</h3>
                @if(isset($brandsForMenu) && $brandsForMenu->count() > 0)
                <ul class="list-group-flush">
                    @foreach ($brandsForMenu as $brand)
                        <li class="list-group-item {{ request('brand') == $brand->slug ? 'active' : '' }}">
                            <a href="{{ route('brands.show', $brand) }}">{{ $brand->name }}</a>
                        </li>
                    @endforeach
                </ul>
                @endif
            </div>

        </aside>

        <section class="shop-main-content">
            <div class="toolbar">
                <div class="result-count">
                    Hiển thị {{ $products->firstItem() }}-{{ $products->lastItem() }} của {{ $products->total() }} kết quả
                </div>
                
            </div>
            <div class="product-grid-shop" style="display: grid; grid-template-columns: repeat(4,1fr); gap: 20px; "> 
                @forelse ($products as $product)
                    @include('partials.product_card', ['product' => $product])
                @empty
                    <div class="col-span-full alert alert-warning"> 
                        Không tìm thấy sản phẩm nào phù hợp.
                    </div>
                @endforelse
            </div>

            <div class="pagination-wrapper">
                 {{ $products->appends(request()->query())->links() }}
            </div>

        </section>

    </div> 
</div> 
@endsection

