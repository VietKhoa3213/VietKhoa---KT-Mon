@extends('admin.layout_admin.master')
@section('title', 'Chi tiết Đơn Hàng #' . $order->id)

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Chi tiết Đơn Hàng #{{ $order->id }}</h1>

     @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
     @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
     @if ($errors->any())
        <div class="alert alert-danger"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif


    <div class="row">
        {{-- Cột trái: Thông tin đơn hàng & khách hàng --}}
        <div class="col-lg-7 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Thông tin Khách Hàng & Giao Hàng</h6></div>
                <div class="card-body">
                    <p><strong>ID Đơn hàng:</strong> {{ $order->id }}</p>
                    <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i:s') }}</p>
                     <p><strong>Người đặt:</strong> {{ $order->user->name ?? 'Khách vãng lai' }}</p>
                    <hr>
                    <p><strong>Tên người nhận:</strong> {{ $order->customer_name }}</p>
                    <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                    <p><strong>Điện thoại:</strong> {{ $order->customer_phone }}</p>
                    <p><strong>Địa chỉ giao hàng:</strong> {{ $order->shipping_address }}</p>
                    <p><strong>Ghi chú KH:</strong> {{ $order->note ?? 'Không có' }}</p>
                     <hr>
                     <p><strong>Phương thức thanh toán:</strong> {{ $order->payment_method }}</p>
                     <p><strong>Trạng thái thanh toán:</strong>
                        <span class="badge badge-{{ $order->payment_status == 'paid' ? 'success' : 'warning' }}">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </p>
                    <p><strong>Trạng thái giao hàng hiện tại:</strong>
                         <span class="badge badge-{{ $order->status_class }}">
                             {{ $order->status_text }}
                         </span>
                    </p>
                </div>
            </div>

             

        </div>

        {{-- Cột phải: Chi tiết sản phẩm trong đơn hàng --}}
        <div class="col-lg-5 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Chi tiết Sản phẩm</h6></div>
                <div class="card-body">
                     <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>SL</th>
                                    <th>Đơn giá</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($order->orderDetails as $detail)
                                    <tr>
                                        <td>
                                            @if($detail->product) 
                                                <img src="{{ $detail->product->image ? asset($detail->product->image) : '/api/placeholder/50/50' }}" alt="" width="40" class="mr-2 img-thumbnail-admin">
                                                {{ $detail->product->name }}
                                            @else
                                                <span class="text-muted">[Sản phẩm đã xóa]</span><br>
                                                <small>{{ $detail->product_name }}</small> 
                                            @endif
                                        </td>
                                        <td>{{ $detail->quantity }}</td>
                                        <td>{{ number_format($detail->price, 0, ',', '.') }}₫</td>
                                        <td>{{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}₫</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4">Chi tiết đơn hàng trống.</td></tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-right">Tổng tiền hàng:</th>
                                    <td>{{ number_format($order->total_amount, 0, ',', '.') }}₫</td>
                                </tr>
                                 <tr>
                                    <th colspan="3" class="text-right">Phí vận chuyển:</th>
                                    <td>{{ number_format($order->shipping_fee, 0, ',', '.') }}₫</td>
                                </tr>
                                 <tr>
                                    <th colspan="3" class="text-right">Giảm giá:</th>
                                    <td>- {{ number_format($order->discount_amount, 0, ',', '.') }}₫</td>
                                </tr>
                                 <tr>
                                    <th colspan="3" class="text-right">Tổng cộng:</th>
                                    <th>{{ number_format($order->final_amount, 0, ',', '.') }}₫</th>
                                </tr>
                            </tfoot>
                        </table>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection