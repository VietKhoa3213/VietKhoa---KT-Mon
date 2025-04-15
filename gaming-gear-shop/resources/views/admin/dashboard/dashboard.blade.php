
@extends('admin.layout_admin.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid"> 

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        {{-- Ví dụ nút tạo báo cáo (có thể bỏ đi) --}}
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
        </a> --}}
    </div>

    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Tổng Sản Phẩm</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalProducts ?? '...' }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                 <div class="card-body">
                     <div class="row no-gutters align-items-center">
                         <div class="col mr-2">
                             <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                 Tổng Đơn Hàng</div>
                             <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalOrders ?? '...' }}</div>
                         </div>
                         <div class="col-auto">
                             <i class="fas fa-receipt fa-2x text-gray-300"></i>
                         </div>
                     </div>
                 </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                     <div class="row no-gutters align-items-center">
                         <div class="col mr-2">
                             <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                 Tổng Người Dùng</div>
                             <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUsers ?? '...' }}</div>
                         </div>
                         <div class="col-auto">
                             <i class="fas fa-users fa-2x text-gray-300"></i>
                         </div>
                     </div>
                 </div>
            </div>
         </div>

         <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                 <div class="card-body">
                     <div class="row no-gutters align-items-center">
                         <div class="col mr-2">
                             <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                 Đơn Hàng Chờ</div>
                             <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingOrders ?? '...' }}</div>
                         </div>
                         <div class="col-auto">
                             <i class="fas fa-hourglass-half fa-2x text-gray-300"></i>
                         </div>
                     </div>
                 </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Chào mừng Admin!</h6>
                </div>
                <div class="card-body">
                    <p>Đây là trang Dashboard quản trị. Bạn có thể xem các thống kê nhanh hoặc truy cập các mục quản lý khác từ menu.</p>
                    <p>Sau này bạn có thể thêm biểu đồ hoặc các thông tin hữu ích khác vào đây.</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

{{-- @section('scripts')
// @endsection --}}