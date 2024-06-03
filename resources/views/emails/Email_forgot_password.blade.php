<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mã OTP của bạn</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        p {
            text-align: center;
            color: #666;
        }
        .otp {
            display: block;
            margin: 20px auto;
            padding: 15px 20px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            font-size: 24px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <p>Hi {{$customer->customer_name}}</p>
        <h1>Mã OTP của bạn</h1>
        <p>Vui lòng sử dụng mã OTP sau để hoàn thành quá trình xác thực:</p>
        <span class="otp">{{ $otp }}</span>
    </div>
</body>
</html>