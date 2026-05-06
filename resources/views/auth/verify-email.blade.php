<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar correo - carsTUmotor</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            overflow-x: hidden;
            background: #f8f8f8;
            min-height: 100vh;
        }
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.2rem 2rem;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }
        .logo i { color: #ff6b35; font-size: 2rem; }
        .logo span {
            background: linear-gradient(135deg, #ff6b35, #ff9f1c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .page {
            padding: 3.2rem 2rem 4rem;
            display: flex;
            justify-content: center;
        }
        .wrap {
            width: 100%;
            max-width: 1100px;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 1.6rem;
            align-items: stretch;
        }
        .panel {
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(0,0,0,0.06);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            background: #fff;
        }
        .left {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 55%, #0f3460 100%);
            color: #fff;
            position: relative;
        }
        .left::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -20%;
            width: 520px;
            height: 520px;
            background: radial-gradient(circle, rgba(255, 107, 53, 0.18) 0%, transparent 70%);
            border-radius: 50%;
        }
        .left::after {
            content: '';
            position: absolute;
            bottom: -50%;
            left: -15%;
            width: 520px;
            height: 520px;
            background: radial-gradient(circle, rgba(255, 159, 28, 0.12) 0%, transparent 70%);
            border-radius: 50%;
        }
        .left-inner {
            position: relative;
            z-index: 2;
            padding: 2.2rem;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 2rem;
        }
        .tag {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255,255,255,0.10);
            border: 1px solid rgba(255,255,255,0.16);
            border-radius: 999px;
            padding: 0.4rem 0.75rem;
            font-weight: 700;
            color: rgba(255,255,255,0.9);
            width: fit-content;
        }
        .left h1 {
            font-size: 2.4rem;
            line-height: 1.15;
            font-weight: 900;
            margin-top: 1rem;
            background: linear-gradient(135deg, #fff, #ff9f1c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .left p {
            color: rgba(255,255,255,0.82);
            max-width: 520px;
        }
        .benefits {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.7rem;
        }
        .benefit {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            padding: 0.8rem 0.9rem;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.14);
            border-radius: 14px;
        }
        .benefit i { color: #ff9f1c; }
        .right {
            padding: 2.2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .form-title {
            font-size: 1.6rem;
            font-weight: 900;
            color: #1a1a2e;
            margin-bottom: 0.35rem;
        }
        .form-subtitle {
            color: #666;
            margin-bottom: 1.4rem;
        }
        .info-box {
            background: #eef6ff;
            border: 1px solid rgba(15, 52, 96, 0.15);
            border-radius: 12px;
            padding: 1.2rem;
            color: #0f3460;
            font-size: 0.95rem;
            margin-bottom: 1.2rem;
            display: flex;
            gap: 0.75rem;
            align-items: flex-start;
        }
        .info-box i {
            color: #ff6b35;
            font-size: 1.2rem;
            margin-top: 2px;
        }
        .resend-form {
            margin-top: 0.5rem;
        }
        .submit {
            padding: 0.95rem 1.2rem;
            border-radius: 12px;
            border: none;
            background: linear-gradient(135deg, #ff6b35, #ff9f1c);
            color: #fff;
            font-weight: 900;
            font-size: 1.05rem;
            cursor: pointer;
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.55rem;
            width: 100%;
        }
        .submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(255, 107, 53, 0.22);
        }
        .link {
            color: #ff6b35;
            font-weight: 900;
            text-decoration: none;
        }
        .link:hover { text-decoration: underline; text-underline-offset: 4px; }
        .alert {
            padding: 0.9rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            font-weight: 600;
            font-size: 0.95rem;
        }
        .alert-success {
            background: #e8f5e9;
            border: 1px solid rgba(46, 125, 50, 0.2);
            color: #2e7d32;
        }
        footer {
            background: #0f0f1e;
            color: #999;
            padding: 2rem;
            text-align: center;
            font-size: 0.9rem;
        }
        @media (max-width: 980px) {
            .wrap { grid-template-columns: 1fr; }
        }
        @media (max-width: 768px) {
            .page { padding: 2.2rem 1.1rem 3.2rem; }
            .left-inner, .right { padding: 1.6rem; }
            .left h1 { font-size: 2rem; }
        }
    </style>
</head>
<body>
    <nav>
        <a href="/" class="logo">
            <i class="fas fa-car-side"></i>
            <span>carsTUmotor</span>
        </a>
    </nav>

    <main class="page">
        <div class="wrap">
            <section class="panel left">
                <div class="left-inner">
                    <div>
                        <div class="tag"><i class="fas fa-shield"></i> Seguridad</div>
                        <h1>Verificá tu cuenta</h1>
                        <p>Para continuar usando carsTUmotor, necesitamos confirmar que el correo electrónico te pertenece.</p>
                    </div>
                    <div class="benefits">
                        <div class="benefit"><i class="fas fa-lock"></i> Protegemos tu información</div>
                        <div class="benefit"><i class="fas fa-envelope"></i> Enviamos un link exclusivo</div>
                        <div class="benefit"><i class="fas fa-check-circle"></i> Acceso completo al verificar</div>
                    </div>
                </div>
            </section>

            <section class="panel right">
                <div class="form-title">Verificá tu correo</div>
                <div class="form-subtitle">Revisá tu bandeja de entrada y hacé clic en el link.</div>

                @if (session('status'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> {{ session('status') }}
                    </div>
                @endif

                <div class="info-box">
                    <i class="fas fa-circle-info"></i>
                    <div>
                        Si no recibiste el email, podés solicitar otro haciendo clic en el botón de abajo.
                    </div>
                </div>

                <form class="resend-form" method="POST" action="/email/verification-notification">
                    @csrf
                    <button type="submit" class="submit">
                        <i class="fas fa-paper-plane"></i> Reenviar email de verificación
                    </button>
                </form>

                <div style="margin-top: 1.2rem; text-align: center; font-size: 0.95rem; color: #666;">
                    ¿No es tu correo? <a class="link" href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
                    <form id="logout-form" action="/logout" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </section>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 carsTUmotor. Todos los derechos reservados.</p>
        <p>Términos de servicio | Política de privacidad | Contáctanos</p>
    </footer>
</body>
</html>
