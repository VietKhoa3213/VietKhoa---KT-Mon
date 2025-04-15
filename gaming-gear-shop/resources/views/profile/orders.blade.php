@extends('layout.master')

@section('title', 'Lịch sử đơn hàng')

@section('content')
<div class="container my-5">
    <div class="row">


        <div class="col-12">

            <nav aria-label="breadcrumb" class="mb-4">
              <ol class="breadcrumb bg-light p-2 rounded">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('profile.show') }}">Tài khoản</a></li>
                <li class="breadcrumb-item active" aria-current="page">Lịch sử đơn hàng</li>
              </ol>
            </nav>

            <h1 class="mb-4 h2">Lịch sử Đơn hàng</h1>

             @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
             @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif


            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover order-history-table">
                            <thead>
                                <tr>
                                    <th>Mã ĐH</th>
                                    <th>Ngày Đặt</th>
                                    <th class="text-center">Số SP</th>
                                    <th class="text-right">Tổng Tiền</th>
                                    <th>Trạng Thái GH</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td><strong>#{{ $order->code }}
                                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="text-center">{{ $order->order_details_count }}</td>
                                        <td class="text-right font-weight-bold">{{ number_format($order->final_amount, 0, ',', '.') }}₫</td>
                                        <td>
                                            <span class="badge rounded-pill bg-{{ $order->status_class }}" style="color: brown;">
                                                {{ $order->shipping_status_text }}
                                                {{ $order->status_text }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                                Xem chi tiết
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            Bạn chưa có đơn hàng nào.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($orders->hasPages())
                    <div class="card-footer bg-light d-flex justify-content-center">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>

        </div> 
    </div> 
</div> 
@endsection