<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Kamar Kost Berhasil</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 500px;
            padding: 40px;
            text-align: center;
        }

        .success-icon {
            color: #4CAF50;
            font-size: 72px;
            margin-bottom: 20px;
        }

        h1 {
            color: #333;
            margin-bottom: 16px;
            font-weight: 600;
        }

        p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 24px;
        }

        .email-highlight {
            font-weight: bold;
            color: #2c7be5;
        }

        .cta-button {
            background-color: #2c7be5;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
            margin-top: 16px;
        }

        .cta-button:hover {
            background-color: #1a68d1;
        }

        .cta-button.secondary {
            background-color: #6c757d;
            margin-top: 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="success-icon">✓</div>
        <h1>Booking Kamar Kost Berhasil!</h1>
        <p> Pendaftaran booking kamar kost Anda telah berhasil. 
            Silakan tunggu konfirmasi dari admin yang akan dikirimkan melalui email anda.
        </p>

        <p
            style="background-color: #fff3cd; color: #856404; padding: 12px 16px; border-radius: 6px; border: 1px solid #ffeeba; margin-bottom: 24px;">
            <strong>Perhatian:</strong> Biasanya konfirmasi akan diterima dalam waktu 1x24 jam. Mohon periksa inbox atau folder spam email Anda.
        </p>

        <a href="{{ route('user.listroom') }}" class="cta-button">Kembali ke Daftar Booking</a>
        <a href="{{ route('user.home') }}" class="cta-button secondary">Kembali ke Beranda</a>
    </div>
</body>

</html>
