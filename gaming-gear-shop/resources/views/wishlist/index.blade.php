@extends('layout.master')

@section('title', 'Sản phẩm yêu thích')

@section('content')
<div class="container" style="margin-top: 30px; margin-bottom: 50px;">

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb bg-light p-2 rounded">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sản phẩm yêu thích</li>
        </ol>
    </nav>

    <h1 class="mb-4 h2">Danh Sách Yêu Thích</h1>

    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
    @if(session('info'))<div class="alert alert-info">{{ session('info') }}</div>@endif

    @if(isset($wishlistedProducts) && $wishlistedProducts->count() > 0)
        <div class="table-responsive shadow-sm rounded bg-white">
            <table class="table table-hover align-middle"> 
                <thead>
                    <tr>
                        <th scope="col" colspan="2">Sản phẩm</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Trạng thái kho</th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wishlistedProducts as $product)
                        <tr>
                            <td style="width: 80px;">
                                <a href="{{ route('products.show', $product) }}">
                                    @php
                                        $productImageValue = $product->image ?? null;
                                        $imageUrl = asset('images/placeholder_thumb.png');

                                        if ($productImageValue) {
                                            $prefixes = ['http://', 'https://', 'preview/image/product/'];

                                            if (\Str::startsWith($productImageValue, $prefixes)) {
                                                $imageUrl = asset($productImageValue);
                                            } else {
                                                $imageUrl = asset('preview/image/product/' . $productImageValue);
                                            }
                                        }
                                    @endphp
                                    <img src="{{ $imageUrl }}"
                                        alt="{{ $product->name ?? 'Sản phẩm' }}" 
                                        width="70" height="70" 
                                        style="object-fit: cover; border-radius: 4px; border: 1px solid #eee;">
                                </a>
                            </td>

                            <td class="product-name align-middle">
                                <a href="{{ route('products.show', $product) }}">{{ $product->name ?? '[N/A]' }}</a>
                                @if($product->category) <br><small class="text-muted">{{ $product->category->name }}</small> @endif
                            </td>
                            <td class="align-middle">
                                 @if($product->discount_price > 0 && $product->discount_price < $product->price)
                                    <span class="font-weight-bold text-danger">{{ number_format($product->discount_price, 0, ',', '.') }}₫</span><br>
                                    <small class="text-muted text-decoration-line-through">{{ number_format($product->price, 0, ',', '.') }}₫</small>
                                 @else
                                    <span class="font-weight-bold">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                                 @endif
                            </td>
                            <td class="align-middle">
                                 @if($product->stock_quantity > 0)
                                     <span class="badge badge-success" style="color: green;">Còn hàng</span>
                                 @else
                                     <span class="badge badge-danger"style="color: black;">Hết hàng</span>
                                 @endif
                            </td>
                            <td class="align-middle text-center">
                                 <form action="{{ route('cart.add', $product) }}" method="POST" class="mb-1">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-primary btn-sm" title="Thêm vào giỏ" {{ $product->stock_quantity <= 0 ? 'disabled' : '' }}>
                                         <i class="fa fa-cart-plus"></i>
                                    </button>
                                 </form>
                                <form action="{{ route('wishlist.remove', $product) }}" method="POST" onsubmit="return confirm('Xóa sản phẩm này khỏi danh sách yêu thích?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Xóa khỏi yêu thích">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $wishlistedProducts->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="far fa-heart fa-4x text-muted mb-3"></i> 
            <p>Danh sách yêu thích của bạn đang trống.</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left mr-1"></i> Khám phá sản phẩm
            </a>
        </div>
    @endif
</div>
@endsection