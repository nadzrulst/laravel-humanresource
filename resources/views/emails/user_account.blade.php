<!DOCTYPE html>
<html>
<head>
    <title>Informasi Akun Anda</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #f8f9fa; padding: 10px; text-align: center; }
        .content { padding: 20px; }
        .footer { margin-top: 20px; font-size: 0.8em; color: #6c757d; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Informasi Akun Anda</h2>
        </div>
        
        <div class="content">
            <p>Halo,</p>
            
            <p>Berikut adalah informasi akun Anda:</p>
            
            <table>
                <tr>
                    <td><strong>Email</strong></td>
                    <td>{{ $email }}</td>
                </tr>
                <tr>
                    <td><strong>Password</strong></td>
                    <td>{{ $password }}</td>
                </tr>
            </table>
            
            <p>Silakan gunakan informasi di atas untuk login ke sistem kami.</p>
        </div>
        
        <div class="footer">
            <p>Hormat kami,<br>Tim {{ config('app.name') }}</p>
        </div>
    </div>
</body>
</html>