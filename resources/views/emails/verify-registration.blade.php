<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Verifikasi Pendaftaran PropCentral</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 40px auto; background-color: #ffffff; padding: 40px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        
        <div style="text-align: center; margin-bottom: 30px;">
            <h1 style="color: #4b372d; margin: 0; font-size: 28px;">Selamat Datang di PropCentral!</h1>
        </div>

        <div style="color: #4a5568; font-size: 16px; line-height: 1.6;">
            <p>Halo,</p>
            <p>Terima kasih telah mendaftar di PropCentral. Untuk menyelesaikan proses pendaftaran dan mengaktifkan akun Anda, silakan masukkan kode verifikasi berikut:</p>
            
            <div style="background-color: #f8f9fa; border: 2px dashed #b79a85; border-radius: 8px; padding: 20px; text-align: center; margin: 30px 0;">
                <span style="font-size: 36px; font-weight: bold; color: #3d2b1f; letter-spacing: 5px;">{{ $token }}</span>
            </div>
            
            <p>Kode ini akan kedaluwarsa dalam 15 menit. Jika Anda tidak merasa mendaftar di PropCentral, Anda dapat mengabaikan email ini.</p>
        </div>

        <div style="border-top: 1px solid #e2e8f0; margin-top: 40px; padding-top: 20px; text-align: center; color: #a0aec0; font-size: 14px;">
            <p>Terima kasih,<br>Tim PropCentral</p>
        </div>
    </div>
</body>
</html>
