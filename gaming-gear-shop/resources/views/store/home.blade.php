@extends('layout.master')

@section('content')
    
    
    <main class="container">
        @if(isset($slides) && $slides->count() > 0)
        <div class="swiper-container hero-slider" style="margin-bottom: 30px;"> 
            <div class="swiper-wrapper">
                @foreach ($slides as $slide)
                    <div class="swiper-slide">
                        <a href="{{ $slide->link ?? '#' }}" target="_blank" rel="noopener noreferrer" class="slide-link">
                            <div class="slide-item-content" style="position: relative; min-height: 400px; display: flex; align-items: center; justify-content: center; text-align: center; padding: 20px; overflow: hidden;">

                                @if($slide->image)
                                    @if (\Str::startsWith($slide->image, 'preview/image/slides/'))
                                        <img src="{{ asset($slide->image) }}"
                                            alt="{{ $slide->title ?? 'Slide' }}"
                                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 1; filter: brightness(0.7);">
                                    @else
                                        <img src="{{ asset('preview/image/slides/' . $slide->image) }}"
                                            alt="{{ $slide->title ?? 'Slide' }}"
                                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 1; filter: brightness(0.7);">
                                    @endif
                                @else
                                    <img src="/api/placeholder/1400/400" 
                                        alt="{{ $slide->title ?? 'Slide' }}"
                                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 1; background-color: #ccc;">
                                @endif

                                <div class="hero-content" style="position: relative; z-index: 2; color: #fff; max-width: 600px;">
                                    @if($slide->title)
                                        <h3 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 0.5rem; text-shadow: 1px 1px 2px rgba(0,0,0,0.5);">{{ $slide->title }}</h3>
                                    @endif
                                    @if($slide->description)
                                        <div style="font-size: 2.5rem; font-weight: bold; margin-bottom: 1rem; text-shadow: 1px 1px 3px rgba(0,0,0,0.6);">{!! nl2br(e($slide->description)) !!}</div>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="swiper-button-prev" style="color: #fff;"></div> 
            <div class="swiper-button-next" style="color: #fff;"></div>

            <div class="swiper-pagination" style="bottom: 15px !important;"></div> 
        </div>

        

        
    @else
        <div class="hero-banner-placeholder" style="min-height: 400px; background-color: #eee; display: flex; align-items: center; justify-content: center; margin-bottom: 30px;">
            <p>Hero Banner Area</p>
        </div>
    @endif
        
        <div class="product-section">
            <div class="section-title">
       
                <h3>Sản phẩm mới nhất</h3>
                <a href="{{ route('products.index', ['sort' => 'latest']) }}">Xem tất cả &rarr;</a>
            </div>

            <div class="product-grid">
                @if(isset($latestProducts) && $latestProducts->count() > 0)
                    @foreach ($latestProducts as $product)

                        @include('partials.product_card', ['product' => $product])
                    @endforeach
                @else
                    <p>Không có sản phẩm mới nào.</p>
                @endif
            </div>
        </div>


        <section class="mb-16"> 
            <h2 class="text-3xl font-semibold mb-6 border-l-4 border-purple-500 pl-3">Thương Hiệu Nổi Bật</h2> 

            @if(isset($brandsForMenu) && $brandsForMenu->count() > 0)
                <div class="brands-list" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(100px, 1fr)); gap: 15px; text-align: center;">

                    @foreach ($brandsForMenu as $brand)
                        <div class="brand-item" style="display: grid; grid-template-columns: repeat(160px,1.4fr);" >
                            <a href="{{ route('brands.show', $brand) }}" style="display: block; text-decoration: none; color: inherit; padding: 10px; border: 1px solid #eee; border-radius: 8px; background: #fff; transition: box-shadow 0.2s ease;">
                                <div class="brand-logo" style="margin-bottom: 8px; height: 50px; display: flex; align-items: center; justify-content: center;"> 
                                    @if($brand->logo)
                                        @if (\Str::startsWith($brand->logo, 'preview/image/brand/'))
                                            <img src="{{ asset($brand->logo) }}" alt="{{ $brand->name }}" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                        @else
                                            <img src="{{ asset('preview/image/brand/' . $brand->logo) }}" alt="{{ $brand->name }}" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                        @endif
                                    @else
                                        <span style="font-size: 0.8em; color: #999;">(No Logo)</span>
                                    @endif
                                </div>
                                <div class="brand-name" style="font-weight: 500; font-size: 0.85em;">
                                    {{ $brand->name }}
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
            @else
                <p class="text-gray-500">Chưa có thương hiệu nào để hiển thị.</p>
            @endif
        </section>


        
        <section class="mb-16">
            <h2 class="text-3xl font-semibold mb-6 border-l-4 border-green-500 pl-3">Danh Mục Sản Phẩm</h2>

            @if(isset($categories) && $categories->count() > 0)

                <div class="categories" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 20px; text-align: center;">

                    @foreach ($categories as $category)
                        <div class="category-item">

                            <a href="{{ route('categories.show', $category) }}" style="display: block; text-decoration: none; color: inherit;">
                                <div class="category-icon" style="margin-bottom: 10px;">
        
                                    @if($category->image)
                            @if (\Str::startsWith($category->image, 'preview/image/category/'))
                               
                                <img src="{{ asset($category->image) }}"
                                    alt="{{ $category->name }}"
                                    loading="lazy"
                                    style="width: 60px; height: 60px; border-radius: 50%; margin: 0 auto; object-fit: cover; border: 1px solid #eee;">
                            @else
                                
                                <img src="{{ asset('preview/image/category/' . $category->image) }}"
                                    alt="{{ $category->name }}"
                                    loading="lazy"
                                    style="width: 60px; height: 60px; border-radius: 50%; margin: 0 auto; object-fit: cover; border: 1px solid #eee;">
                            @endif
                            @else
                                
                                <img src="/api/placeholder/60/60"
                                    alt="Không có ảnh"
                                    loading="lazy"
                                    style="width: 60px; height: 60px; border-radius: 50%; margin: 0 auto; object-fit: cover; border: 1px solid #eee; background-color: #f0f0f0;">
                            @endif
                                    </div>
                                    <div class="category-name" style="font-weight: 500;">
                                        {{ $category->name }}
                                    </div>
                                </a>
                            </div>
                    @endforeach

                </div>
            @else
                <p class="text-gray-500">Không có danh mục nào để hiển thị.</p>
            @endif
        </section>
        
        <section class="mb-16">
            <h2 class="text-3xl font-semibold mb-6 border-l-4 border-orange-500 pl-3">Tin tức mới nhất</h2>

            @if(isset($recentNews) && $recentNews->count() > 0)
                <div class="news-list">
                    @foreach ($recentNews as $newsItem)
                    <article class="news-item">
                        @if($newsItem->image)
                            <a href="{{-- route('news.show', $newsItem) --}}#">
                                @if (\Str::startsWith($newsItem->image, 'preview/image/news/'))
                                    <img src="{{ asset($newsItem->image) }}"
                                        style=" object-fit: inherit;"
                                        alt="{{ $newsItem->title }}"
                                        loading="lazy"
                                        class="news-item-image"> 
                                @else
                                    <img src="{{ asset('preview/image/news/' . $newsItem->image) }}"
                                        alt="{{ $newsItem->title }}"
                                        loading="lazy"
                                        class="news-item-image"> 
                                @endif
                            </a>
                        @endif

                    <div class="news-content">
                        <h3 class="news-title">
                            <a href="{{-- route('news.show', $newsItem) --}}#" style="color: #333; text-decoration: none;">
                                {{ $newsItem->title }}
                            </a>
                        </h3>
                        <div class="news-meta">
                            <a href="{{-- route('news.show', $newsItem) --}}#" class="read-more">
                                Đọc thêm &rarr;
                            </a>
                            <p class="news-date">
                                {{ $newsItem->created_at->format('d/m/Y') }}
                            </p>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    @else
        <p class="text-gray-500">Chưa có tin tức nào.</p>
    @endif
</section>

        
       <div class="product-section">
            <div class="section-title">
                <h3>Sản phẩm nổi bật</h3>
                <a href="{{ route('products.index', ['filter' => 'featured']) }}">Xem tất cả &rarr;</a>
            </div>

            <div class="product-grid">
                 @if(isset($featuredProducts) && $featuredProducts->count() > 0)
                    @foreach ($featuredProducts as $product)
                        @include('partials.product_card', ['product' => $product])
                    @endforeach
                @else
                    <p>Không có sản phẩm nổi bật nào.</p>
                @endif
            </div>
        </div>

    <section class="product-section mb-5">
        <div class="section-title" style="...">
            <h2 class="text-2xl font-semibold text-danger">Đang Khuyến Mãi</h2>
            <a href="{{ route('products.index', ['filter' => 'discounted']) }}" >Xem tất cả &rarr;</a>
        </div>
        <div class="product-grid" style="...">
            @if(isset($discountedProducts) && $discountedProducts->count() > 0)
                @foreach ($discountedProducts as $product)
                    @include('partials.product_card', ['product' => $product])
                @endforeach
            @else
                <p class="col-span-full">Chưa có sản phẩm nào đang khuyến mãi.</p>
            @endif
        </div>
    </section>

    </main>

    @endsection

@section('js')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const heroSwiper = new Swiper('.hero-slider', {
            loop: true, 
            autoplay: {
                delay: 5000, 
                disableOnInteraction: false, 
            },
            pagination: {
                el: '.swiper-pagination', 
                clickable: true,          
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            effect: 'cube',
            grabCursor: true, // Hiện con trỏ hình bàn tay khi rê chuột, cho biết có thể kéo
            cubeEffect: {
            shadow: true, // Hiển thị bóng đổ của khối cube (trông thật hơn)
            slideShadows: true, // Hiển thị bóng đổ trên các mặt slide
            shadowOffset: 20, // Khoảng cách bóng đổ chính (px)
            shadowScale: 0.94, // Tỉ lệ bóng đổ (0-1)
            },
            
            });
    });
</script>

@endsection