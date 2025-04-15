<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $replySubject }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #0056b3;
            padding: 20px;
            text-align: center;
        }
        .logo {
            max-height: 60px;
        }
        .header-title {
            color: #ffffff;
            font-size: 24px;
            margin: 10px 0 0;
        }
        .content {
            padding: 30px 25px;
        }
        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .message-label {
            font-weight: 600;
            margin-bottom: 10px;
            color: #0056b3;
        }
        .original-message {
            border-left: 4px solid #ddd;
            padding: 15px;
            margin: 15px 0;
            background-color: #f9f9f9;
            color: #666;
            font-style: italic;
        }
        .reply-message {
            background-color: #e8f4ff;
            padding: 20px;
            border-radius: 6px;
            margin: 20px 0;
            border-left: 4px solid #0056b3;
        }
        .footer {
            background-color: #f0f0f0;
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }
        .signature {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        .company-name {
            font-weight: bold;
            color: #0056b3;
        }
        @media only screen and (max-width: 620px) {
            .container {
                width: 100% !important;
                border-radius: 0;
            }
            .content {
                padding: 25px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="header-title">Phản Hồi Từ Mega Mart</h1>
        </div>
        <div class="content">
            <p class="greeting">Kính chào quý khách,</p>
            
            <p>Cảm ơn quý khách đã liên hệ với chúng tôi. Chúng tôi đã nhận được thông tin liên hệ với nội dung như sau:</p>
            
            <div class="message-label">Tiêu đề gốc:</div>
            <p><strong>{{ $originalSubject ?? '(không có tiêu đề)' }}</strong></p>
            
            <div class="message-label">Nội dung liên hệ:</div>
            <div class="original-message">
                {!! nl2br(e($originalMessage)) !!}
            </div>
            
            <div class="message-label">Phản hồi của chúng tôi:</div>
            <div class="reply-message">
                {!! nl2br(e($replyMessageContent)) !!}
            </div>
            
            <div class="signature">
                <p>Trân trọng,</p>
                <p class="company-name">Đội Ngũ Chăm Sóc Khách Hàng<br>Mega Mart</p>
            </div>
        </div>
        
        <div class="footer">
            <p>© {{ date('Y') }} Mega Mart. Tất cả các quyền được bảo lưu.</p>
            <p>Nếu quý khách cần hỗ trợ thêm, vui lòng liên hệ với chúng tôi.</p>
        </div>
    </div>
</body>
</html>