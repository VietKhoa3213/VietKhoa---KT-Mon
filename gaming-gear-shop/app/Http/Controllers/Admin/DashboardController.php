<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    /**
     * Hiển thị trang dashboard chính của admin.
     * Hàm này sẽ được gọi bởi route GET /admin/dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        // --- PHẦN LẤY DỮ LIỆU THỐNG KÊ (VÍ DỤ - SẼ LÀM SAU) ---
        // Ví dụ cách lấy số lượng:
        // $totalUsers = User::count(); // Đếm tổng số user
        // $totalOrders = Order::count(); // Đếm tổng số đơn hàng
        // $totalProducts = Product::count(); // Đếm tổng số sản phẩm
        // $pendingOrders = Order::where('shipping_status', Order::STATUS_PENDING)->count(); // Đếm đơn hàng chờ xử lý

        // --- TRUYỀN DỮ LIỆU SANG VIEW (VÍ DỤ - SẼ LÀM SAU) ---
        // return view('admin.dashboard', compact(
        //     'totalUsers',
        //     'totalOrders',
        //     'totalProducts',
        //     'pendingOrders'
        // ));

        // --- HIỆN TẠI: CHỈ TRẢ VỀ VIEW RỖNG ---
        // Trả về file view tại resources/views/admin/dashboard.blade.php
        return view('admin.dashboard.dashboard');
    }
}