<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <h2 style="color: #333333; text-align: center;">Reset Password Anda</h2>
        <p style="color: #666666; font-size: 16px;">
            Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda di PropCentral.
        </p>
        <div style="text-align: center; margin: 30px 0;">
            <span style="font-size: 32px; font-weight: bold; letter-spacing: 5px; color: #3d2b1f; background-color: #f5e6e1; padding: 15px 25px; border-radius: 8px;">
                {{ $token }}
            </span>
        </div>
        <p style="color: #666666; font-size: 16px;">
            Masukkan kode 6 digit di atas pada halaman verifikasi untuk melanjutkan proses reset password. Kode ini akan kedaluwarsa dalam 60 menit.
        </p>
        <p style="color: #999999; font-size: 14px; text-align: center; margin-top: 40px;">
            Jika Anda tidak meminta reset password, abaikan email ini.
        </p>
    </div>
</body>
</html>
