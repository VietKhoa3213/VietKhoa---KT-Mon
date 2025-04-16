@extends('layout.master') 

@section('title', 'Giỏ hàng của bạn')

@section('content')
<div class="container" style="margin-top: 30px; margin-bottom: 50px;">

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb bg-light p-2 rounded">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
        </ol>
    </nav>

    <h1 class="mb-4 h2">Giỏ Hàng Của Bạn</h1>

    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif

    @if(isset($cartItems) && !empty($cartItems))
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="table-responsive shadow-sm rounded bg-white">
                    <table class="table cart-table mb-0">
                        <thead>
                            <tr>
                                <th scope="col" colspan="2">Sản phẩm</th>
                                <th scope="col">Đơn giá</th>
                                <th scope="col" style="min-width: 130px;">Số lượng</th> 
                                <th scope="col" class="text-right">Tạm tính</th>
                                <th scope="col">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $id => $item)
                                <tr>
                                    <td style="width: 80px;">
                                        <a href="{{ route('products.show', $id) }}">
                                            @php
                                                $itemImageValue = $item['image'] ?? null;
                                                $imageUrl = asset('images/placeholder_thumb.png'); 
                                                if ($itemImageValue) {
                                                    $prefixes = ['http://', 'https://', 'preview/image/product/'];

                                                    if (\Str::startsWith($itemImageValue, $prefixes)) {
                                                        $imageUrl = asset($itemImageValue);
                                                    } else {
                                                        $imageUrl = asset('preview/image/product/' . $itemImageValue);
                                                    }
                                                }
                                            @endphp

                                            <img src="{{ $imageUrl }}"
                                                alt="{{ $item['name'] ?? 'Sản phẩm' }}" 
                                                width="70" height="70" 
                                                style="object-fit: cover; border-radius: 4px; border: 1px solid #eee;">
                                        </a>
                                    </td>
                                    <td class="product-name align-middle">
                                        <a href="{{ route('products.show', $id) }}">{{ $item['name'] ?? '[Sản phẩm không tồn tại]' }}</a>
                                    </td>
                                    <td class="align-middle">
                                        {{ number_format($item['price'] ?? 0, 0, ',', '.') }}₫
                                    </td>
                                    <td class="align-middle">
                                        <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex align-items-center update-cart-form">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number"
                                                   name="quantity"
                                                   value="{{ $item['quantity'] ?? 1 }}"
                                                   min="1"
                                                   max="100" 
                                                   class="form-control form-control-sm quantity-input mr-2"
                                                   required>
                                            <button type="submit" class="btn btn-outline-secondary btn-sm" title="Cập nhật SL">
                                                <i class="fa fa-check"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="align-middle text-right">
                                        {{ number_format(($item['quantity'] ?? 0) * ($item['price'] ?? 0), 0, ',', '.') }}₫
                                    </td>
                                    <td class="align-middle text-center">
                                        <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('Xóa sản phẩm này khỏi giỏ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="remove-btn" title="Xóa sản phẩm">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3 text-right">
                    <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Bạn muốn xóa toàn bộ giỏ hàng?');">
                         @csrf
                         @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="fa fa-trash mr-1"></i> Xóa toàn bộ giỏ hàng
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="cart-summary shadow-sm rounded">
                    <h5 class="mb-3 font-weight-bold border-bottom pb-2">Tóm tắt đơn hàng</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tổng tạm tính ({{ $cartItemCount ?? 0 }} sản phẩm):</span>
                        <span>{{ number_format($cartSubtotal ?? 0, 0, ',', '.') }}₫</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Phí vận chuyển:</span>
                        <span>30.000₫</span> 
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between h5 font-weight-bold">
                        <span>Tổng cộng:</span>
                        <span>{{ number_format($cartSubtotal+30000 ?? 0, 0, ',', '.') }}₫</span> 
                    </div>
                    <hr>
                     <a href="{{ route('checkout.index') }}#" class="btn btn-primary btn-block btn-lg mt-3">
                        Tiến hành Thanh toán
                     </a>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-block mt-2">
                        Tiếp tục mua hàng
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
            <p>Giỏ hàng của bạn đang trống.</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left mr-1"></i> Bắt đầu mua sắm
            </a>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
   
    document.querySelectorAll('.update-cart-form input[name="quantity"]').forEach(input => {
        input.addEventListener('change', function() {
            Lấy form gần nhất và submit để reload trang
             this.closest('form').submit();
             
              const form = this.closest('form');
            const productId = form.action.split('/').pop();
             const quantity = this.value;
             updateCartQuantity(productId, quantity, null); 
        });
    });
    
</script>
@endpush
