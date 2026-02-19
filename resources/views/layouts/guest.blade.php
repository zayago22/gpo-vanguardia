<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="noindex, nofollow">
        <title>Acceso — GPO Vanguardia</title>
        <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <style>
            * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Montserrat', sans-serif; }
            body { min-height: 100vh; display: flex; background: #1E1B4B; }
            .login-side {
                flex: 1;
                display: flex;
                align-items: center;
                justify-content: center;
                background: linear-gradient(135deg, #1E1B4B 0%, #312E81 50%, #4338CA 100%);
                position: relative;
                overflow: hidden;
            }
            .login-side::before {
                content: '';
                position: absolute;
                top: -50%;
                right: -30%;
                width: 600px;
                height: 600px;
                background: radial-gradient(circle, rgba(99,102,241,0.15) 0%, transparent 70%);
                border-radius: 50%;
            }
            .login-side::after {
                content: '';
                position: absolute;
                bottom: -40%;
                left: -20%;
                width: 500px;
                height: 500px;
                background: radial-gradient(circle, rgba(129,140,248,0.1) 0%, transparent 70%);
                border-radius: 50%;
            }
            .login-container {
                width: 100%;
                max-width: 420px;
                padding: 40px;
                position: relative;
                z-index: 1;
            }
            .login-logo {
                text-align: center;
                margin-bottom: 40px;
            }
            .login-logo img {
                height: 60px;
                filter: brightness(0) invert(1);
                margin-bottom: 16px;
            }
            .login-logo h1 {
                color: #fff;
                font-size: 22px;
                font-weight: 700;
                letter-spacing: -0.3px;
            }
            .login-logo p {
                color: rgba(255,255,255,0.5);
                font-size: 13px;
                margin-top: 6px;
                font-weight: 400;
            }
            .login-card {
                background: rgba(255,255,255,0.07);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(255,255,255,0.12);
                border-radius: 16px;
                padding: 32px;
            }
            .form-group { margin-bottom: 20px; }
            .form-group label {
                display: block;
                color: rgba(255,255,255,0.7);
                font-size: 13px;
                font-weight: 600;
                margin-bottom: 8px;
            }
            .form-input {
                width: 100%;
                padding: 12px 16px;
                background: rgba(255,255,255,0.08);
                border: 1px solid rgba(255,255,255,0.15);
                border-radius: 10px;
                color: #fff;
                font-size: 14px;
                font-family: 'Montserrat', sans-serif;
                transition: all 0.3s;
                outline: none;
            }
            .form-input::placeholder { color: rgba(255,255,255,0.3); }
            .form-input:focus {
                border-color: #818CF8;
                background: rgba(255,255,255,0.12);
                box-shadow: 0 0 0 3px rgba(129,140,248,0.15);
            }
            .form-error {
                color: #FCA5A5;
                font-size: 12px;
                margin-top: 6px;
            }
            .form-row {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 24px;
            }
            .remember-label {
                display: flex;
                align-items: center;
                gap: 8px;
                color: rgba(255,255,255,0.6);
                font-size: 13px;
                cursor: pointer;
            }
            .remember-label input[type="checkbox"] {
                width: 16px;
                height: 16px;
                accent-color: #6366F1;
                border-radius: 4px;
                cursor: pointer;
            }
            .forgot-link {
                color: #818CF8;
                font-size: 13px;
                text-decoration: none;
                font-weight: 500;
                transition: color 0.2s;
            }
            .forgot-link:hover { color: #A5B4FC; }
            .btn-login {
                width: 100%;
                padding: 13px;
                background: linear-gradient(135deg, #4338CA, #6366F1);
                color: #fff;
                border: none;
                border-radius: 10px;
                font-size: 15px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s;
                font-family: 'Montserrat', sans-serif;
                letter-spacing: 0.3px;
            }
            .btn-login:hover {
                background: linear-gradient(135deg, #3730A3, #4F46E5);
                box-shadow: 0 8px 25px rgba(67,56,202,0.3);
                transform: translateY(-1px);
            }
            .login-footer {
                text-align: center;
                margin-top: 32px;
                color: rgba(255,255,255,0.3);
                font-size: 12px;
            }
            .login-footer a {
                color: rgba(255,255,255,0.5);
                text-decoration: none;
            }
            .login-footer a:hover { color: #818CF8; }
            .session-status {
                background: rgba(16,185,129,0.15);
                border: 1px solid rgba(16,185,129,0.3);
                color: #6EE7B7;
                padding: 12px 16px;
                border-radius: 10px;
                font-size: 13px;
                margin-bottom: 20px;
            }
            @media (max-width: 480px) {
                .login-container { padding: 24px 16px; }
                .login-card { padding: 24px 20px; }
            }
        </style>
    </head>
    <body>
        <div class="login-side">
            <div class="login-container">
                <div class="login-logo">
                    <a href="/">
                        <img src="{{ asset('images/logo.png') }}" alt="GPO Vanguardia">
                    </a>
                    <h1>Panel de Administración</h1>
                    <p>Grupo Vanguardia en Información y Conocimiento</p>
                </div>
                <div class="login-card">
                    {{ $slot }}
                </div>
                <div class="login-footer">
                    &copy; {{ date('Y') }} GPO Vanguardia &mdash; <a href="/">Volver al sitio</a>
                </div>
            </div>
        </div>
    </body>
</html>
