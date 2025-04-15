<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận Đơn hàng #{{ $order->code }}</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; color: #333333; background-color: #f7f7f7; margin: 0; padding: 0; }
        .email-wrapper { width: 100%; background-color: #f7f7f7; padding: 20px 0; }
        .email-container { background-color: #ffffff; max-width: 600px; margin: 0 auto; padding: 30px; border: 1px solid #dddddd; border-radius: 5px; }
        .email-header { text-align: center; padding-bottom: 20px; border-bottom: 1px solid #eeeeee; }
        .email-header h1 { color: #007bff; margin: 0; }
        .email-body { margin: 20px 0; }
        .email-footer { text-align: center; margin-top: 30px; font-size: 12px; color: #999999; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #dddddd; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .total-row td { border-top: 2px solid #aaaaaa; font-weight: bold; }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-container">
            <div class="email-header">
                <h1>Đặt hàng thành công!</h1>
            </div>
            <div class="email-body">
                <p>Chào {{ $order->customer_name ?? 'Quý khách' }},</p>
                <p>Cảm ơn bạn đã đặt hàng tại <strong>{{ config('app.name') }}</strong>. Chúng tôi đã nhận được đơn hàng của bạn:</p>
                <p><strong>Mã đơn hàng:</strong> #{{ $order->code }}</p>
                <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                <hr style="border: none; border-top: 1px solid #eee;">
                <h3>Thông tin giao hàng</h3>
                <p><strong>Người nhận:</strong> {{ $order->customer_name }}</p>
                <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                <p><strong>Điện thoại:</strong> {{ $order->customer_phone }}</p>
                <p><strong>Địa chỉ:</strong> {{ $order->shipping_address }}</p>
                <p><strong>Ghi chú:</strong> {{ $order->note ?? '(Không có)' }}</p>
                 <hr style="border: none; border-top: 1px solid #eee;">
                <h3>Chi tiết đơn hàng</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th style="text-align:center;">SL</th>
                            <th style="text-align:right;">Đơn giá</th>
                            <th style="text-align:right;">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderDetails as $detail)
                        <tr>
                            <td>{{ $detail->product_name }}</td>
                            <td style="text-align:center;">{{ $detail->quantity }}</td>
                            <td style="text-align:right;">{{ number_format($detail->price, 0, ',', '.') }}₫</td>
                            <td style="text-align:right;">{{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}₫</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="total-row">
                            <td colspan="3" style="text-align: right;"><strong>Tổng cộng:</strong></td>
                            <td style="text-align:right;"><strong>{{ number_format($order->final_amount, 0, ',', '.') }}₫</strong></td>
                        </tr>
                    </tfoot>
                </table>
                <p>Chúng tôi sẽ xử lý đơn hàng và thông báo cho bạn sớm nhất. Bạn có thể xem lại đơn hàng tại [Link Lịch sử đơn hàng - cần tạo sau].</p>
                <p>Xin cảm ơn!</p>
            </div>
            <div class="email-footer">
                &copy; {{ date('Y') }} {{ config('app.name') }}
            </div>
        </div>
    </div>
</body>
</html>