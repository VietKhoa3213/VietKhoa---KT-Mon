@if($products->count() > 0)
    <div class="product-dropdown-grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; padding: 15px;">
        @foreach($products as $product)
            <div class="product-dropdown-item">
                <a href="{{ route('products.show', $product) }}" style="text-decoration: none; color: #333; display: block; background: #f9f9f9; padding: 5px; border-radius: 4px; transition: background-color 0.2s ease;">
                    <div class="img-container" style="margin-bottom: 5px;">                 
                        @if($product->image)
                            @if (\Str::startsWith($product->image, 'preview/image/product/'))
                                <img src="{{ asset($product->image) }}"
                                    loading="lazy" style="width: 100%; height: 80px; object-fit: contain; background-color: #fff;"
                                    alt="{{ $product->name }}"
                                    loading="lazy"
                                    class="product-card-image"> 
                            @else
                                <img src="{{ asset('preview/image/product/' . $product->image) }}"
                                    loading="lazy" style="width: 100%; height: 80px; object-fit: contain; background-color: #fff;"
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
                    </div>
                    <div class="product-name" style="font-size: 0.85em; font-weight: 500; margin-bottom: 3px; line-height: 1.3; height: 2.6em; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                        {{ $product->name }}
                    </div>
                    <div class="product-price" style="font-size: 0.9em; font-weight: bold; color: #dc3545;">
                         @if($product->discount_price > 0 && $product->discount_price < $product->price)
                            {{ number_format($product->discount_price, 0, ',', '.') }}₫
                         @else
                            {{ number_format($product->price, 0, ',', '.') }}₫
                         @endif
                    </div>
                </a>
            </div>
        @endforeach
    </div>
     <div style="text-align: center; padding: 10px 15px; border-top: 1px solid #eee; margin-top: 5px;">
         <a href="{{ route('categories.show', $category) }}" style="font-size: 0.9em; font-weight: bold; text-decoration: none;">Xem tất cả {{ $category->name }} &rarr;</a>
     </div>
@else
    <div style="padding: 20px; text-align: center; color: #6c757d;">Không có sản phẩm tiêu biểu.</div>
     <div style="text-align: center; padding: 10px 15px; border-top: 1px solid #eee; margin-top: 5px;">
         <a href="{{ route('categories.show', $category) }}" style="font-size: 0.9em; font-weight: bold; text-decoration: none;">Xem tất cả {{ $category->name }} &rarr;</a>
     </div>
@endif