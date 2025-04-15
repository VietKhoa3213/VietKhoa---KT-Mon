@extends('layout.master')

@section('title', 'Đặt hàng thành công')

@section('content')
<div class="container text-center" style="margin-top: 50px; margin-bottom: 50px;">
     <div class="row justify-content-center">
         <div class="col-md-8">
             <div class="card shadow">
                 <div class="card-body py-5">
                     <i class="fas fa-check-circle fa-5x text-success mb-4"></i>
                     <h1 class="h3 mb-3 font-weight-normal">Đặt Hàng Thành Công!</h1>
                     <p class="lead text-muted">Cảm ơn bạn đã mua hàng tại cửa hàng của chúng tôi.</p>
                     @if(isset($order))
                         <p>Mã đơn hàng của bạn là: <strong class="text-primary">#{{ $order->code }}</strong></p>
                         <p>Chúng tôi đã gửi thông tin chi tiết đơn hàng đến email: <strong>{{ $order->customer_email }}</strong></p>
                     @endif
                     <hr class="my-4">
                     <p>Bạn có thể theo dõi đơn hàng hoặc tiếp tục mua sắm.</p>
                     <a href="{{ route('home') }}" class="btn btn-primary mt-2">
                         <i class="fas fa-home mr-1"></i> Về Trang chủ
                     </a>
                      @auth
                     <a href="{{ route('profile.orders') }}#" class="btn btn-outline-secondary mt-2">
                         <i class="fas fa-history mr-1"></i> Xem lịch sử đơn hàng
                     </a>
                     @endauth 
                 </div>
             </div>
         </div>
     </div>
</div>
@endsection