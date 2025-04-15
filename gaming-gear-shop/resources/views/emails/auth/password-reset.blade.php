<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yêu cầu Đặt lại Mật khẩu - Mega Mart</title>
    <style>
        body { margin: 0; padding: 0; font-family: Arial, sans-serif; font-size: 16px; line-height: 1.6; color: #333333; background-color: #f4f4f4; }
        .email-wrapper { padding: 20px 0; background-color: #f4f4f4; width: 100%; }
        .email-container { background-color: #ffffff; max-width: 600px; margin: 0 auto; padding: 30px; border: 1px solid #dddddd; border-radius: 5px; }
        .email-header { text-align: center; padding-bottom: 20px; border-bottom: 1px solid #eeeeee; margin-bottom: 25px;}
        .email-header h1 { color: #333; margin: 0; font-size: 24px; }
        .email-body { margin: 20px 0; }
        .email-body p { margin: 0 0 15px 0; }
        .email-footer { text-align: center; margin-top: 30px; padding-top: 20px; font-size: 12px; color: #999999; border-top: 1px solid #eeeeee;}
        .button-container { text-align: center; margin: 25px 0; }
        .button { display: inline-block; padding: 12px 25px; font-size: 16px; color: #ffffff !important; background-color: #0d6efd; text-decoration: none !important; border-radius: 5px; border: none; font-weight: bold; }
        a.button { color: #ffffff !important; }
        .link-wrapper { word-break: break-all; font-size: 11px; }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-container">
            <div class="email-header">
                <h1>Yêu cầu Đặt lại Mật khẩu</h1>
            </div>
            <div class="email-body">
                <p>Chào {{ $userName ?? 'bạn' }},</p>
                <p>Bạn nhận được email này vì chúng tôi nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn tại <strong>Mega Mart</strong>.</p>
                <p>Vui lòng nhấp vào nút bên dưới để tiến hành đặt lại mật khẩu:</p>

                <div class="button-container">
                    <a href="{{ $resetUrl ?? '#' }}" class="button" target="_blank">Đặt lại mật khẩu</a>
                </div>

                <p>Liên kết đặt lại mật khẩu này sẽ hết hạn sau <strong>{{ config('auth.passwords.'.config('auth.defaults.passwords').'.expire', 60) }}</strong> phút.</p>
                <p>Nếu bạn không yêu cầu đặt lại mật khẩu, bạn không cần thực hiện thêm hành động nào.</p>
                <p>Trân trọng,</p>
                <p><strong>Mega Mart</strong></p>
            </div>
            <div class="email-footer">
                Nếu bạn gặp sự cố khi nhấp vào nút "Đặt lại mật khẩu", hãy sao chép và dán URL sau vào trình duyệt web của bạn:<br>
                <span class="link-wrapper">{{ $resetUrl ?? '' }}</span>
            </div>
        </div>
    </div>
</body>
</html>