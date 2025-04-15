@extends('layout.master') 

@section('title', 'Chi tiết Đơn hàng #' . $order->code)



@section('content')
<div class="container my-4"> 

   
    <nav aria-label="breadcrumb" class="mb-4">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="{{ route('profile.show') }}">Tài khoản</a></li>
        <li class="breadcrumb-item"><a href="{{ route('profile.orders') }}">Lịch sử đơn hàng</a></li>
        <li class="breadcrumb-item active" aria-current="page">Chi tiết Đơn hàng #{{ $order->code }}</li>
      </ol>
    </nav>

    <h1 class="mb-4 h3">Chi tiết Đơn hàng <span class="text-primary fw-bold">#{{ $order->code }}</span></h1>

    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

    <div class="row">
        <div class="col-lg-4 order-lg-last mb-4">
             <div class="card shadow-sm order-detail-card">
                 <div class="card-header">Tóm tắt</div>
                 <div class="card-body">
                     <ul class="list-unstyled mb-0">
                         <li class="d-flex justify-content-between py-1"><span>Mã ĐH:</span><strong>#{{ $order->code }}</strong></li>
                         <li class="d-flex justify-content-between py-1"><span>Ngày đặt:</span><strong>{{ $order->created_at->format('d/m/Y H:i') }}</strong></li>
                         <li class="d-flex justify-content-between py-1"><span>Trạng thái:</span><strong><span class="badge rounded-pill status-badge bg-{{ $order->status_class }}" style="color: brown;">{{ $order->status_text }}</span></strong></li>
                         <li class="d-flex justify-content-between py-1"><span>Thanh toán:</span><strong><span class="badge rounded-pill bg-{{ $order->payment_status == 'paid' ? 'success' : 'warning' }}">{{ $order->payment_status == 'paid' ? 'Đã thanh toán' : 'Chưa thanh toán' }}</span></strong></li>
                         <li class="d-flex justify-content-between py-1 mt-2 border-top pt-2"><span>Tổng cộng:</span><strong class="text-danger h5 mb-0">{{ number_format($order->final_amount, 0, ',', '.') }}₫</strong></li>
                     </ul>
                 </div>
             </div>

             <div class="card shadow-sm order-detail-card">
                <div class="card-header">Thông tin Giao hàng</div>
                <div class="card-body">
                    <p class="mb-1"><strong>{{ $order->customer_name }}</strong></p>
                    <p class="mb-1"><i class="fas fa-phone-alt fa-fw me-2 text-muted"></i>{{ $order->customer_phone }}</p>
                    <p class="mb-1"><i class="fas fa-envelope fa-fw me-2 text-muted"></i>{{ $order->customer_email }}</p>
                    <p class="mb-0"><i class="fas fa-map-marker-alt fa-fw me-2 text-muted"></i>{{ $order->shipping_address }}</p>
                    @if($order->note)<hr><p class="mb-0 fst-italic"><small><strong>Ghi chú:</strong> {{ $order->note }}</small></p>@endif
                </div>
            </div>

            <div class="card shadow-sm order-detail-card">
                <div class="card-header">Phương thức Thanh toán</div>
                <div class="card-body">
                    @if($order->payment_method == 'BankTransfer')
                        <p class="mb-1"><strong>Chuyển khoản ngân hàng</strong></p>
                    @elseif($order->payment_method == 'COD')
                        <p class="mb-1"><strong>Thanh toán khi nhận hàng</strong></p>
                    @elseif($order->payment_method == 'Momo')
                        <p class="mb-1"><strong>Thanh toán qua Momo</strong></p>
                    @endif
                </div>
            </div>

             <a href="{{ route('profile.orders') }}" class="btn btn-outline-secondary mt-2"><i class="fas fa-arrow-left me-1"></i> Quay lại lịch sử</a>

        </div>

        <div class="col-lg-8 order-lg-first mb-4">
             <div class="card shadow-sm order-detail-card">
                 <div class="card-header">Chi tiết Sản phẩm</div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table order-items-table mb-0">
                            <thead>
                                <tr>
                                    <th colspan="2">Sản phẩm</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-end">Đơn giá</th> 
                                    <th class="text-end">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($order->orderDetails as $detail)
                                    <tr>
                                        <td style="width: 70px;">
                                             @php
                                                  $productImage = $detail->product->image ?? null;
                                                  $finalImgUrl = $productImage ? asset($productImage) : asset('images/placeholder_thumb.png');
                                                  if ($productImage && !\Str::startsWith($productImage, ['http', 'preview/'])) {
                                                        $finalImgUrl = asset('preview/image/product/' . $productImage);
                                                  }
                                             @endphp
                                             @if($detail->product) 
                                                <a href="{{ route('products.show', $detail->product) }}">
                                                     <img src="{{ $finalImgUrl }}" alt="{{ $detail->product_name }}">
                                                </a>
                                             @else
                                                 <img src="{{ $finalImgUrl }}" alt="{{ $detail->product_name }}">
                                             @endif
                                        </td>
                                        <td class="align-middle">
                                             @if($detail->product)
                                                 <a href="{{ route('products.show', $detail->product) }}" class="text-dark fw-bold">{{ $detail->product_name }}</a>
                                             @else
                                                 <span class="text-muted">{{ $detail->product_name }} [Đã xóa]</span>
                                             @endif
                                        </td>
                                        <td class="text-center align-middle">{{ $detail->quantity }}</td>
                                        <td class="text-end align-middle">{{ number_format($detail->price, 0, ',', '.') }}₫</td>
                                        <td class="text-end align-middle fw-bold">{{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}₫</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="text-center text-muted p-4">Không có chi tiết sản phẩm.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <table class="table table-sm table-borderless mb-0 order-totals">
                        <tbody>
                            <tr><td>Tạm tính:</td><td>{{ number_format($order->total_amount, 0, ',', '.') }}₫</td></tr>
                            <tr><td>Phí vận chuyển:</td><td>{{ number_format($order->shipping_fee, 0, ',', '.') }}₫</td></tr>
                            @if($order->discount_amount > 0)
                            <tr class="text-success"><td>Giảm giá:</td><td>−{{ number_format($order->discount_amount, 0, ',', '.') }}₫</td></tr>
                            @endif
                            <tr class="border-top fs-5"> 
                                <td class="pt-2">Tổng cộng:</td>
                                <td class="pt-2 text-danger fw-bold">{{ number_format($order->final_amount, 0, ',', '.') }}₫</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
             </div>
        </div>
    </div> 
</div> 
@endsection