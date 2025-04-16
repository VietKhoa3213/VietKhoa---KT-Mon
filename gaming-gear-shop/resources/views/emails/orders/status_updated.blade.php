<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật Trạng thái Đơn hàng #{{ $order->code }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        
        .header {
            background-color: #3182ce;
            color: white;
            padding: 25px;
            text-align: center;
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .content {
            padding: 30px;
        }
        
        .order-info {
            background-color: #f0f7ff;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
            border-left: 4px solid #3182ce;
        }
        
        .order-number {
            font-size: 18px;
            color: #2c5282;
            margin-bottom: 10px;
        }
        
        .status-badge {
            display: inline-block;
            font-size: 16px;
            font-weight: bold;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            margin: 15px 0;
        }
        
        .status-processing {
            background-color: #3182ce;
        }
        
        .status-shipped {
            background-color: #38b2ac;
        }
        
        .status-delivered {
            background-color: #48bb78;
        }
        
        .status-cancelled {
            background-color: #e53e3e;
        }
        
        .message {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
            border-left: 3px solid #cbd5e0;
        }
        
        .footer {
            text-align: center;
            padding: 20px;
            background-color: #f7fafc;
            color: #718096;
            font-size: 14px;
            border-top: 1px solid #edf2f7;
        }
        
        .social-links {
            margin-top: 15px;
        }
        
        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #3182ce;
            text-decoration: none;
        }
        
        .button {
            display: inline-block;
            background-color: #3182ce;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            margin-top: 20px;
        }
        
        /* Responsive */
        @media only screen and (max-width: 600px) {
            .container {
                width: 100%;
                border-radius: 0;
            }
            
            .content {
                padding: 20px;
            }
        }

        .product-list {
        list-style: none;
        padding: 0;
        margin-top: 10px;
    }

    .product-list li {
        background-color: #f9f9f9;
        border: 1px solid #e0e0e0;
        padding: 10px 15px;
        margin-bottom: 8px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 15px;
    }

    .product-name {
        font-weight: 600;
        color: #333;
    }

    .product-info {
        color: #666;
        font-size: 14px;
    }

    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">Mega Mart</div>
            <div>Cập nhật Trạng thái Đơn hàng</div>
        </div>
        
        <div class="content">
            <p>Chào <strong>{{ $order->customer_name ?? 'Quý khách' }}</strong>,</p>
            
            <p>Cảm ơn bạn đã tin tưởng và mua sắm tại <strong>Mega Mart</strong>. Chúng tôi rất vui thông báo đến bạn về cập nhật mới nhất cho đơn hàng của bạn:</p>
            <div>Sản phẩm đã đặt:</div>
                
            <div class="order-info">
                
                <div class="order-number">Đơn hàng <strong>#{{ $order->code }}</strong></div>
                    @foreach ($order->orderDetails as $detail)
                        <h3 class="product-name">
                            * {{ $detail->product->name }} - 
                            <span style="color:rgb(69, 139, 204);">SL: {{ $detail->quantity }} </span> - 
                            <span style="color:green">Giá: {{ number_format($detail->price, 0, ',', '.') }}đ</span>
                        </h3>
                    @endforeach


                <div>Ngày đặt: <strong>{{ date('d/m/Y', strtotime($order->order_date)) }}</strong></div>
                <div>Phí Ship: <strong>{{ number_format($order->shipping_fee, 0, ',', '.') }}đ</strong></div>
                <div>Tổng tiền: <strong>{{ number_format($order->final_amount, 0, ',', '.') }}đ</strong></div>
                
                

                @php
                    $statusClass = '';
                    switch($order->shipping_status) {
                        case \App\Models\Order::STATUS_PROCESSING:
                            $statusClass = 'status-processing';
                            break;
                        case \App\Models\Order::STATUS_SHIPPED:
                            $statusClass = 'status-shipped';
                            break;
                        case \App\Models\Order::STATUS_DELIVERED:
                            $statusClass = 'status-delivered';
                            break;
                        case \App\Models\Order::STATUS_CANCELLED:
                            $statusClass = 'status-cancelled';
                            break;
                        default:
                            $statusClass = 'status-processing';
                    }
                @endphp
                
                <div>
                    <span class="status-badge {{ $statusClass }}">{{ $newStatusText }}</span>
                </div>
            </div>
            
            <div class="message">
                @if($order->shipping_status == \App\Models\Order::STATUS_PROCESSING)
                    <p>Đơn hàng của bạn đang được xử lý. Chúng tôi sẽ nhanh chóng đóng gói và gửi hàng đến bạn.</p>
                @elseif($order->shipping_status == \App\Models\Order::STATUS_SHIPPED)
                    <p>Đơn hàng đã được giao cho đơn vị vận chuyển và đang trên đường đến với bạn. Dự kiến hàng sẽ đến trong 1-3 ngày tới.</p>
                    <p>Shipper sẽ liên hệ với bạn trước khi giao hàng.</p>
                @elseif($order->shipping_status == \App\Models\Order::STATUS_DELIVERED)
                    <p>Đơn hàng đã được giao thành công đến địa chỉ của bạn.</p>
                    <p>Chúng tôi hy vọng bạn hài lòng với sản phẩm. Nếu có bất kỳ vấn đề gì, vui lòng liên hệ với chúng tôi trong vòng 7 ngày.</p>
                @elseif($order->shipping_status == \App\Models\Order::STATUS_CANCELLED)
                    <p>Đơn hàng của bạn đã bị hủy theo yêu cầu hoặc do một số vấn đề phát sinh.</p>
                    <p>Nếu bạn không yêu cầu hủy đơn hàng này, vui lòng liên hệ với bộ phận hỗ trợ khách hàng của chúng tôi để được giải đáp.</p>
                @endif
            </div>
            
            
            <p style="margin-top: 30px;">Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi qua email hỗ trợ hoặc hotline.</p>
            
            <p>Trân trọng cảm ơn,<br>Đội ngũ Mega Mart</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} Mega Mart. Tất cả các quyền được bảo lưu.</p>
            <p>Địa chỉ: 123 Đường ABC, Quận XYZ, TP.HCM</p>
            <p>Hotline: 19001234</p>
            
            <div class="social-links">
                <a href="#">Facebook</a>
                <a href="#">Instagram</a>
                <a href="#">Zalo</a>
            </div>
        </div>
    </div>
</body>
</html>
