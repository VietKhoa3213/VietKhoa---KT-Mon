@extends('layout.master')

@section('title', 'Thanh toán đơn hàng')



@section('content')
<div class="container" style="margin-top: 30px; margin-bottom: 50px;">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb bg-light p-2 rounded">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('cart.index') }}">Giỏ hàng</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
        </ol>
    </nav>

    <h1 class="mb-4 h2">Thanh Toán Đơn Hàng</h1>

    @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('checkout.placeOrder') }}" method="POST" class="checkout-form">
        @csrf
        <div class="row">
            <div class="col-lg-7 mb-4">
                <h4 class="mb-3">Thông tin giao hàng</h4>
                 @auth
                    <div class="alert alert-info">
                        Đang đặt hàng với tài khoản: {{ Auth::user()->email }}
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-checkout').submit();">(Đăng xuất?)</a>
                    </div>
                     <form id="logout-form-checkout" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form>

                     <div class="form-group">
                        <label for="customer_name">Tên người nhận <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ old('customer_name', Auth::user()->name) }}" required>
                     </div>
                      <div class="form-group">
                        <label for="customer_email">Email người nhận <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="customer_email" name="customer_email" value="{{ old('customer_email', Auth::user()->email) }}" required>
                     </div>
                     <div class="form-group">
                        <label for="customer_phone">Số điện thoại người nhận <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control" id="customer_phone" name="customer_phone" value="{{ old('customer_phone', Auth::user()->phone) }}" required>
                     </div>
                      <div class="form-group">
                        <label for="customer_address">Địa chỉ giao hàng <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="customer_address" name="customer_address" value="{{ old('customer_address', Auth::user()->address) }}" required>
                     </div>

                 @else 
                     <div class="form-group">
                        <label for="customer_name">Họ và tên <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required>
                     </div>
                      <div class="form-group">
                        <label for="customer_email">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="customer_email" name="customer_email" value="{{ old('customer_email') }}" required>
                     </div>
                     <div class="form-group">
                        <label for="customer_phone">Số điện thoại <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control" id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}" required>
                     </div>
                      <div class="form-group">
                        <label for="customer_address">Địa chỉ giao hàng <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="customer_address" name="customer_address" value="{{ old('customer_address') }}" required>
                     </div>
                      <p class="text-muted"><a href="{{ route('login') }}">Đăng nhập</a> nếu bạn đã có tài khoản.</p>
                 @endguest

                <div class="form-group">
                    <label for="note">Ghi chú (tùy chọn)</label>
                    <textarea name="note" id="note" rows="3" class="form-control">{{ old('note') }}</textarea>
                </div>

                <hr class="my-4">

                <h4 class="mb-3">Phương thức thanh toán</h4>
                <div class="payment-methods">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="payment_cod" value="COD" {{ old('payment_method', 'COD') == 'COD' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="payment_cod">
                            <i class="fas fa-truck mr-2"></i>Thanh toán khi nhận hàng (COD)
                        </label>
                         <small class="form-text text-muted ml-4">Trả tiền mặt trực tiếp cho nhân viên giao hàng khi bạn nhận được sản phẩm.</small>
                    </div>
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="payment_bank" value="BankTransfer" {{ old('payment_method') == 'BankTransfer' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="payment_bank">
                             <i class="fas fa-university mr-2"></i>Chuyển khoản ngân hàng
                        </label>
                         <small class="form-text text-muted ml-4">Thực hiện thanh toán vào tài khoản ngân hàng của chúng tôi. Vui lòng sử dụng ID Đơn hàng làm tham chiếu thanh toán. Đơn hàng sẽ được giao sau khi tiền đã chuyển.</small>
                    </div>
                     @error('payment_method') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </div>

                <hr class="my-4">

                <button class="btn btn-primary btn-lg btn-block" type="submit">
                    <i class="fas fa-check-circle mr-2"></i> Đặt Hàng Ngay
                </button>

            </div>

            <div class="col-lg-5">
                 <div class="order-summary-box">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-primary">Đơn hàng của bạn</span>
                        <span class="badge badge-primary badge-pill">{{ $cartItemCount ?? 0 }}</span>
                    </h4>
                    <ul class="list-group mb-3" style="max-height: 400px; overflow-y: auto;">
                         @if(isset($cartItems) && !empty($cartItems))
                            @foreach ($cartItems as $id => $item)
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                 <div class="d-flex align-items-center">
                                    @php
                                        $itemImageValue = $item['image'] ?? null;
                                        $itemImageUrl = $itemImageValue ? asset($itemImageValue) : asset('images/placeholder_thumb.png');
                                        if ($itemImageValue && !\Str::startsWith($itemImageValue, ['http', 'preview/'])) {
                                            $itemImageUrl = asset('preview/image/product/' . $itemImageValue);
                                        }
                                    @endphp
                                    <img src="{{ $itemImageUrl }}" alt="{{ $item['name'] ?? '' }}" width="50" height="50" style="object-fit: cover; border-radius: 4px;" class="me-3">
                                    <div>
                                        <h6 class="my-0" style="font-size: 0.95em;">{{ $item['name'] ?? '' }}</h6>
                                        <small class="text-muted">Số lượng: {{ $item['quantity'] ?? 0 }}</small>
                                     </div>
                                 </div>
                                <span class="text-muted text-nowrap">{{ number_format(($item['quantity'] ?? 0) * ($item['price'] ?? 0), 0, ',', '.') }}₫</span>
                            </li>
                            @endforeach
                         @endif
                    </ul>

                    <ul class="list-group mb-3">
                         <li class="list-group-item d-flex justify-content-between">
                            <span>Tạm tính</span>
                            <strong>{{ number_format($cartSubtotal ?? 0, 0, ',', '.') }}₫</strong>
                        </li>
                         <li class="list-group-item d-flex justify-content-between bg-light">
                            <div class="text-success">
                                <h6 class="my-0">Mã giảm giá</h6>
                            </div>
                            <span class="text-success">−{{ number_format($discountAmount ?? 0, 0, ',', '.') }}₫</span>
                        </li>
                         <li class="list-group-item d-flex justify-content-between">
                            <span>Phí vận chuyển</span>
                            <strong>{{ number_format($shippingFee ?? 0, 0, ',', '.') }}₫</strong>
                        </li>
                         <li class="list-group-item d-flex justify-content-between h5">
                            <span>Tổng cộng (VNĐ)</span>
                            <strong>{{ number_format($finalTotal ?? 0, 0, ',', '.') }}₫</strong>
                        </li>
                    </ul>
                    {{-- Có thể thêm ô nhập mã giảm giá ở đây --}}
                 </div>
            </div>
        </div>
    </form>
</div>
@endsection