<div class="product-card" style="padding-top: 15px;">
    <div class="product-img">
    
          <a href="{{ route('products.show', $product) }}"> 


        @if($product->image)
                @if (\Str::startsWith($product->image, 'preview/image/product/'))
                    <img src="{{ asset($product->image) }}"
                         alt="{{ $product->name }}"
                         loading="lazy"
                         class="product-card-image"> 
                @else
                    <img src="{{ asset('preview/image/product/' . $product->image) }}"
                         alt="{{ $product->name }}"
                         loading="lazy"
                         class="product-card-image"> 
                @endif
            @else
                <img src="{{ asset('images/placeholder.png') }}"
                     alt="Không có ảnh"
                     loading="lazy"
                     class="product-card-image product-card-placeholder">
            @endif 
        </a>
    </div>
    <div class="product-info">
        <div class="product-name">
            <a href="{{ route('products.show', $product) }}" title="{{ $product->name }}" style="text-decoration: none; color: #333;">
                 {{ Illuminate\Support\Str::limit($product->name, 40) }}
             </a>
        </div>
        <div class="product-price">
            @if($product->discount_price > 0 && $product->discount_price < $product->price)
                <span style="font-weight: bold; color: #dc3545; margin-right: 5px;">
                    {{ number_format($product->discount_price, 0, ',', '.') }}₫
                </span>
                <span style="text-decoration: line-through; color: #999; font-size: 0.9em;">
                    {{ number_format($product->price, 0, ',', '.') }}₫
                </span>
            @else
                <span style="font-weight: bold; color: #333;">
                    {{ number_format($product->price, 0, ',', '.') }}₫
                </span>
            @endif
        </div>
    </div>
        <div class="product-actions mt-2 text-center"> 
            @auth
                <form action="{{ route('cart.add', $product) }}" method="POST" class="d-inline-block">
                    @csrf
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn btn-outline-primary btn-sm" title="Thêm vào giỏ" {{ $product->stock_quantity <= 0 ? 'disabled' : '' }}>
                        <i class="fa fa-cart-plus"></i> Thêm vào giỏ
                    </button>
                </form>
            @endauth
            @auth 
                <div class="wishlist-button mt-1 text-center">
                    @php
                        $productId = $product->id ?? null;
                        $sharedWishlistIds = $wishlistedIds ?? null; 

                        $isInWishlist = false; 
                        $debugMessage = 'Chưa kiểm tra';

                        if ($productId !== null && is_array($sharedWishlistIds)) {
                            $isInWishlist = in_array($productId, $sharedWishlistIds);
                            $debugMessage = $isInWishlist ? 'TRUE (Đã thích)' : 'FALSE (Chưa thích)';
                        } elseif (!is_array($sharedWishlistIds)) {
                            $debugMessage = 'Lỗi: $wishlistedIds không phải là mảng!';
                        } elseif ($productId === null) {
                            $debugMessage = 'Lỗi: $product->id không xác định!';
                        }
                    @endphp
                    @if($isInWishlist)
                        <form action="{{ route('wishlist.remove', $product) }}" method="POST" class="d-inline-block wishlist-form" title="Xóa khỏi yêu thích">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link p-0 border-0 text-danger">
                                <i class="fas fa-heart"></i>
                            </button>
                        </form>
                    @else
                        <form action="{{ route('wishlist.add', $product) }}" method="POST" class="d-inline-block wishlist-form" title="Thêm vào yêu thích">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 border-0 text-secondary">
                                <i class="far fa-heart"></i>
                            </button>
                        </form>
                    @endif
                </div>
            @endauth
        </div>
    <br>
</div>