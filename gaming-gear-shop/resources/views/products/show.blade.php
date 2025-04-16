@extends('layout.master') 

@section('title', $product->name)

@section('content')
<div class="container product-detail-container" style="margin-top: 30px; margin-bottom: 30px;">

    <nav aria-label="breadcrumb" class="mb-3">
      <ol class="breadcrumb" style="background-color: #f8f9fa; padding: 0.75rem 1rem; border-radius: 0.25rem;">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
        @if($product->category)
            <li class="breadcrumb-item"><a href="{{ route('categories.show', $product->category) }}">{{ $product->category->name }}</a></li>
        @endif
        <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($product->name, 50) }}</li> 
      </ol>
    </nav>

    <div class="row">
        <div class="col-lg-6 mb-4">
        <div class="product-gallery">
            <div class="main-image-container text-center mb-3">
                @php
                    $mainImageUrl = null;
                    $primaryImage = $product->image;
                    
                    $galleryArray = [];
                    if (!empty($product->gallery)) {
                        $galleryArray = is_array($product->gallery) ? $product->gallery : json_decode($product->gallery, true);
                        $galleryArray = is_array($galleryArray) ? $galleryArray : [];
                    }

                    if (!empty($primaryImage)) {
                        $mainImageUrl = Str::startsWith($primaryImage, ['http://', 'https://', 'preview/image/product/']) 
                            ? asset($primaryImage)
                            : asset('preview/image/product/' . $primaryImage);
                    } elseif (!empty($galleryArray)) {
                        $firstImage = reset($galleryArray);
                        $mainImageUrl = Str::startsWith($firstImage, ['http://', 'https://', 'preview/image/product/gallery/'])
                            ? asset($firstImage)
                            : asset('preview/image/product/gallery/' . $firstImage);
                    } else {
                        $mainImageUrl = asset('images/placeholder_600x600.png');
                    }
                @endphp

                <img src="{{ $mainImageUrl }}"
                    id="mainProductImage"
                    class="main-product-image img-fluid" 
                    alt="{{ $product->name }}"
                    style="min-height: 500px ; max-height: 500px; ">
            </div>

            @if(!empty($galleryArray))
                <div class="product-gallery-thumbnails">
                    @if($product->image)
                        @php
                            $mainThumbUrl = Str::startsWith($product->image, ['http://', 'https://', 'preview/image/product/'])
                                ? asset($product->image)
                                : asset('preview/image/product/' . $product->image);
                        @endphp
                        <img src="{{ $mainThumbUrl }}" 
                             alt="{{ $product->name }} thumbnail" 
                             data-main-src="{{ $mainThumbUrl }}" 
                             class="active-thumb" 
                             style="width: 70px; height: 70px; object-fit: cover;">
                    @endif

                    @foreach($galleryArray as $index => $img)
                        @if(!empty($img))
                            @php
                                $thumbUrl = Str::startsWith($img, ['http://', 'https://', 'preview/image/product/gallery/'])
                                    ? asset($img)
                                    : asset('preview/image/product/gallery/' . $img);
                            @endphp
                            <img src="{{ $thumbUrl }}" 
                                 alt="{{ $product->name }} thumbnail {{ $index + 1 }}" 
                                 data-main-src="{{ $thumbUrl }}" 
                                 class="{{ !$product->image && $index == 0 ? 'active-thumb' : '' }}"
                                 style="width: 70px; height: 70px; object-fit: cover;">
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>

        <div class="col-lg-6">
            <h1 class="product-title h2 mb-3">{{ $product->name }}</h1>

            <div class="product-meta mb-3">
                @if($product->brand)
                    <span class="text-muted">Thương hiệu:</span>
                    <a href="{{ route('brands.show', $product->brand) }}" class="text-primary font-weight-bold">{{ $product->brand->name }}</a>
                    <span class="mx-2 text-muted">|</span>
                @endif
                @if($product->category)
                    <span class="text-muted">Loại:</span>
                    <a href="{{ route('categories.show', $product->category) }}" class="text-primary font-weight-bold">{{ $product->category->name }}</a>
                @endif
            </div>

            <div class="product-price-details mb-3">
                 @if($product->discount_price > 0 && $product->discount_price < $product->price)
                    <span class="h3 text-danger font-weight-bold">{{ number_format($product->discount_price, 0, ',', '.') }}₫</span>
                    <span class="h5 text-muted text-decoration-line-through ml-2">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                    @php
                        $discountPercent = round((($product->price - $product->discount_price) / $product->price) * 100);
                    @endphp
                    <span class="badge badge-danger ml-2">-{{ $discountPercent }}%</span>
                 @else
                    <span class="h3 font-weight-bold">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                 @endif
            </div>

            <div class="stock-status mb-3">
                 @if($product->stock_quantity > 5) 
                     <span class="badge badge-success p-2"><i class="fa fa-check-circle mr-1"></i> Còn hàng</span>
                 @elseif($product->stock_quantity > 0)
                     <span class="badge badge-warning p-2"><i class="fa fa-exclamation-triangle mr-1"></i> Sắp hết hàng (chỉ còn {{ $product->stock_quantity }})</span>
                 @else
                     <span class="badge badge-danger p-2"><i class="fa fa-times-circle mr-1"></i> Hết hàng</span>
                 @endif
            </div>

            

            <form action="{{ route('cart.add', $product) }}" method="POST" class="add-to-cart-form mb-4"> {{-- Sửa action --}}
                @csrf 
                <div class="row align-items-center">
                    <div class="col-auto">
                        <label for="quantity_detail" class="mr-2">Số lượng:</label> 
                    </div>
                    <div class="col-auto" style="max-width: 100px;">
                        <input type="number" name="quantity" id="quantity_detail" value="1" min="1"
                                max="{{ $product->stock_quantity > 0 ? $product->stock_quantity : '1' }}"
                                class="form-control text-center"
                                {{ $product->stock_quantity <= 0 ? 'disabled' : '' }}>
                    </div>
                    
                    @if(@auth()->user())
                        <div class="col">
                            <button type="submit" class="btn btn-primary btn-lg" {{ $product->stock_quantity <= 0 ? 'disabled' : '' }}>
                                <i class="fa fa-shopping-cart mr-2"></i> Thêm vào giỏ hàng
                            </button>
                        </div>
                    @elseif(!@auth()->user())
                        <div class="col">
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                                <i class="fa fa-shopping-cart mr-2"></i> Đăng nhập để thêm vào giỏ hàng
                            </a>
                        </div>
                    @endif
                    
                </div>
                @if($product->stock_quantity <= 0)
                    <small class="text-danger d-block mt-2">Sản phẩm hiện đã hết hàng.</small>
                @endif
                    
            </form>
            <div class="product-actions mt-3 pt-3 border-top">
         @auth
            <div class="wishlist-button d-inline-block mr-3"> 
                @if(in_array($product->id, $wishlistedIds ?? []))
                    <form action="{{ route('wishlist.remove', $product) }}" method="POST" class="d-inline-block" title="Xóa khỏi yêu thích">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-link text-danger p-0">
                            <i class="fas fa-heart"></i> <span class="ml-1">Đã thích</span>
                        </button>
                    </form>
                @else
                    <form action="{{ route('wishlist.add', $product) }}" method="POST" class="d-inline-block" title="Thêm vào yêu thích">
                        @csrf
                        <button type="submit" class="btn btn-link text-secondary p-0">
                            <i class="far fa-heart"></i> <span class="ml-1">Yêu thích</span>
                        </button>
                    </form>
                @endif
            </div>
        @endauth

        </div>
    </div>

    <hr class="my-5">

    <div class="product-tabs-section">
        <ul class="nav nav-tabs mb-4" id="productTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="description-tab" data-toggle="tab" data-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Mô tả chi tiết</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="specifications-tab" data-toggle="tab" data-target="#specifications" type="button" role="tab" aria-controls="specifications" aria-selected="false">Thông số kỹ thuật</button>
            </li>
             <li class="nav-item" role="presentation">
                <button class="nav-link" id="reviews-tab" data-toggle="tab" data-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Đánh giá ({{ $product->reviews->count() }})</button>
             </li>
        </ul>

        <div class="tab-content" id="productTabContent">
            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                @if($product->description)
                    <div class="description-content">
                         {!! nl2br(e($product->description)) !!}
                    </div>
                @else
                    <p>Chưa có mô tả chi tiết cho sản phẩm này.</p>
                @endif
            </div>

            <div class="tab-pane fade" id="specifications" role="tabpanel" aria-labelledby="specifications-tab" style="opacity: 1;">
                @php
                    $specs = is_string($product->specifications) ? json_decode($product->specifications, true) : $product->specifications;
                @endphp

                @if($specs && is_array($specs) && count($specs) > 0)
                    <table class="table table-bordered table-striped specs-table" style="max-width: 700px;">
                        <tbody>
                            @foreach($specs as $key => $value)
                                @if(!empty($value))
                                    <tr>
                                        <th scope="row">{{ $key }}</th>
                                        <td>
                                            @if(is_array($value))
                                                @if(isset($value['Công nghệ']) || isset($value['Tính năng']))
                                                    @foreach($value as $subKey => $subValue)
                                                        <strong>{{ $subKey }}:</strong>
                                                        @if(is_array($subValue))
                                                            <ul class="mb-2">
                                                                @foreach($subValue as $item)
                                                                    <li>{{ is_scalar($item) ? $item : json_encode($item) }}</li>
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            <p class="mb-2">{{ is_scalar($subValue) ? $subValue : json_encode($subValue) }}</p>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <ul class="mb-0">
                                                        @foreach($value as $item)
                                                            <li>{{ is_scalar($item) ? $item : json_encode($item) }}</li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            @else
                                                {{ is_scalar($value) ? $value : json_encode($value) }}
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Chưa có thông số kỹ thuật cho sản phẩm này.</p>
                @endif

            </div>
            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab" style="opacity: 1;">
                <h4 class="mb-3">Đánh giá của khách hàng ({{ $product->reviews->where('status', true)->count() }})</h4>
                <div class="review-list mb-4">
                    @forelse($product->reviews->where('status', \App\Models\Review::STATUS_APPROVED) as $review)
                        <div class="review-item">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <strong>{{ $review->user->name ?? 'Người dùng ẩn danh' }}</strong>
                                    <span class="review-rating ms-2"> 
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fa fa-star{{ $i <= $review->rating ? '' : '-o text-muted' }}"></i> 
                                        @endfor
                                    </span>
                                </div>
                                <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-0">{!! nl2br(e($review->comment)) !!}</p>
                        </div>
                    @empty
                        <p class="text-muted">Chưa có đánh giá nào được duyệt cho sản phẩm này.</p>
                    @endforelse
                </div>

                <hr class="my-4">
                <div class="add-review-section">
                    @auth 
                        <h5 class="mb-3">Viết đánh giá của bạn</h5>
                        @if ($errors->has('rating') || $errors->has('comment'))
                            <div class="alert alert-danger">
                                <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                            </div>
                        @endif
                        @if(session('review_success'))
                            <div class="alert alert-success">{{ session('review_success') }}</div>
                        @endif

                        <form action="{{ route('reviews.store', $product) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="rating" class="form-label">Đánh giá của bạn <span class="text-danger">*</span></label>
                                <select name="rating" id="rating" class="form-select" required style="max-width: 150px;">
                                    <option value="">Chọn số sao</option>
                                    <option value="5" {{ old('rating') == 5 ? 'selected' : '' }}>★★★★★ (5 sao)</option>
                                    <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>★★★★☆ (4 sao)</option>
                                    <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>★★★☆☆ (3 sao)</option>
                                    <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>★★☆☆☆ (2 sao)</option>
                                    <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>★☆☆☆☆ (1 sao)</option>
                                </select>
                                @error('rating') <small class="text-danger d-block mt-1">{{ $message }}</small> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="comment" class="form-label">Bình luận của bạn <span class="text-danger">*</span></label>
                                <textarea name="comment" id="comment" rows="4" class="form-control" required placeholder="Viết bình luận của bạn ở đây...">{{ old('comment') }}</textarea>
                                {{--  @error('comment') <small class="text-danger d-block mt-1">{{ $message }}</small> @enderror  --}}
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
                        </form>
                    @else
                        <p class="text-center text-muted">Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để viết đánh giá.</p>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <hr class="my-5">
  <section class="related-products-section">
    <h3 class="mb-4">Sản phẩm liên quan</h3>
    @if($relatedProducts->count() > 0)
        <div class="row">
            @foreach($relatedProducts as $relatedProduct)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="product-image-container" style="height: 200px; overflow: hidden;">
                            @php
                                $productImage = !empty($relatedProduct->image) 
                                    ? (Str::startsWith($relatedProduct->image, ['http://', 'https://', 'preview/image/product/'])
                                        ? asset($relatedProduct->image)
                                        : asset('preview/image/product/' . $relatedProduct->image))
                                    : asset('images/placeholder_600x600.png');
                            @endphp
                            <img src="{{ $productImage }}" 
                                 class="card-img-top" 
                                 alt="{{ $relatedProduct->name }}"
                                 style="height: 100%; object-fit: cover;">
                        </div>

                        <div class="card-body">
                            <h5 class="card-title" style="font-size: 1rem;">
                                <a href="{{ route('products.show', $relatedProduct) }}" 
                                   class="text-decoration-none text-dark">
                                    {{ Str::limit($relatedProduct->name, 50) }}
                                </a>
                            </h5>

                            <div class="product-price">
                                @if($relatedProduct->discount_price > 0 && $relatedProduct->discount_price < $relatedProduct->price)
                                    <span class="text-danger font-weight-bold">
                                        {{ number_format($relatedProduct->discount_price, 0, ',', '.') }}₫
                                    </span>
                                    <small class="text-muted text-decoration-line-through ml-2">
                                        {{ number_format($relatedProduct->price, 0, ',', '.') }}₫
                                    </small>
                                @else
                                    <span class="font-weight-bold">
                                        {{ number_format($relatedProduct->price, 0, ',', '.') }}₫
                                    </span>
                                @endif
                            </div>

                            <div class="stock-status mt-2">
                                @if($relatedProduct->stock_quantity > 5)
                                    <small class="text-success">
                                        <i class="fa fa-check-circle"></i> Còn hàng
                                    </small>
                                @elseif($relatedProduct->stock_quantity > 0)
                                    <small class="text-warning">
                                        <i class="fa fa-exclamation-circle"></i> Sắp hết hàng
                                    </small>
                                @else
                                    <small class="text-danger">
                                        <i class="fa fa-times-circle"></i> Hết hàng
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <button class="btn btn-outline-primary btn-sm w-100" 
                                    {{ $relatedProduct->stock_quantity <= 0 ? 'disabled' : '' }}>
                                <i class="fa fa-shopping-cart"></i> Thêm vào giỏ
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-muted">Không có sản phẩm liên quan.</p>
    @endif
</section>

</div>
</div>
@endsection

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const mainImage = document.getElementById('mainProductImage');
    const thumbnails = document.querySelectorAll('.product-gallery-thumbnails img');

    if (mainImage && thumbnails.length > 0) {
        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', function() {
                const newMainSrc = this.dataset.mainSrc;
                if (newMainSrc) {
                    mainImage.src = newMainSrc; 

                    document.querySelector('.product-gallery-thumbnails img.active-thumb')?.classList.remove('active-thumb');
                    this.classList.add('active-thumb');
                }
            });
        });
    }


    if (typeof $ !== 'undefined' && typeof $.fn.tab !== 'undefined') {
         $('#productTab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
         })
    } else if (typeof bootstrap !== 'undefined') {
         var triggerTabList = [].slice.call(document.querySelectorAll('#productTab a[data-toggle="tab"]')) 
         triggerTabList.forEach(function (triggerEl) {
             var tabTrigger = new bootstrap.Tab(triggerEl);
             triggerEl.addEventListener('click', function (event) {
                 event.preventDefault();
                 tabTrigger.show();
             });
         });
    } else {
         console.warn('Bootstrap Tab JavaScript not found or not loaded correctly.');
    }

});
</script>
@endsection
