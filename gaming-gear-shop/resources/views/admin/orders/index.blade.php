@extends('admin.layout_admin.master')
@section('title', 'Quản lý Đơn Hàng')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Quản lý Đơn Hàng</h1>

    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif

    <ul class="nav nav-tabs mb-3">
        @foreach($statuses as $statusCode => $statusText)
            <li class="nav-item">
               
                <a class="nav-link {{ $currentStatus == $statusCode ? 'active' : '' }}"
                   href="{{ route('admin.orders.index', ['status' => $statusCode]) }}">
                    {{ $statusText }}
                    {{-- Có thể thêm số lượng đơn hàng cho mỗi trạng thái --}}
                    {{-- ( \App\Models\Order::where('shipping_status', $statusCode)->count() ) --}}
                </a>
            </li>
        @endforeach
         <li class="nav-item">
            <a class="nav-link {{ !$currentStatus ? 'active' : '' }}"
               href="{{ route('admin.orders.index') }}"> 
                Tất cả
            </a>
         </li>
    </ul>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách đơn hàng: {{ $currentStatusText }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID DH</th>
                            <th>Tên Khách Hàng</th>
                            <th>Email</th>
                            <th>Ngày Đặt</th>
                            <th>Tổng Tiền</th>
                            <th>Thanh Toán</th> 
                            <th>TT Thanh Toán</th> 
                            <th>Trạng Thái GH</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                               <td>
                                    <a href="{{ route('admin.orders.show', $order) }}" title="Xem chi tiết đơn hàng #{{ $order->id }}">
                                        <strong>#{{ $order->id }}</strong>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order) }}" title="Xem chi tiết đơn hàng {{ $order->code }}">
                                        <strong>{{ $order->code }}</strong><br>
                                        <small>(ID: #{{ $order->id }})</small>
                                    </a>
                                </td>
                                <td>{{ $order->customer_name }} </td>
                                <td>{{ $order->customer_email }}</td>
                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ number_format($order->final_amount, 0, ',', '.') }}₫</td>
                                <td>{{ $order->payment_method }}</td>
                                <td>
                                     <span class="badge badge-{{ $order->payment_status == 'paid' ? 'success' : 'warning' }}">
                                         {{ ucfirst($order->payment_status) }}
                                     </span>
                                </td>
                                <td>
                                    <span class="badge {{ $order->status_class }}">
                                        {{ $order->status_text }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-info btn-sm" style="width: 100%; font-weight: bolder;">Xem chi tiết đơn hàng</a>
                                     <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="d-inline-block ml-1" style="min-width: 200px;">
                                        @csrf     
                                        @method('PATCH')

                                        <div class="input-group input-group-sm" style="display: flex; margin-top: 5px;">
                                            <select name="status" class="form-control custom-select custom-select-sm" required title="Chọn trạng thái mới">
                                                @foreach ($statuses as $statusCode => $statusText)
                                                    <option value="{{ $statusCode }}" {{ $order->shipping_status == $statusCode ? 'selected' : '' }}>
                                                        {{ $statusText }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-sm btn-outline-primary" style="background-color: green; color: aliceblue;" title="Cập nhật trạng thái">
                                                    <i class="fa fa-check"></i> 
                                                </button>
                                            </div>
                                        </div>
                                       
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="9" class="text-center">Không có đơn hàng nào thuộc trạng thái này.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
             <div class="d-flex justify-content-center">
                {{ $orders->links() }}
             </div>
        </div>
    </div>
</div>
@endsection