<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso Expirado | {{ \App\Models\Setting::get('site_name', 'PayTech') }}</title>
    @if ($favicon = \App\Models\Setting::get('favicon'))
        <link rel="icon" type="image/x-icon" href="{{ \Illuminate\Support\Facades\Storage::url($favicon) }}">
    @endif
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #020617;
            background-image:
                radial-gradient(at 0% 0%, rgba(245, 158, 11, 0.12) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(99, 102, 241, 0.08) 0px, transparent 50%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            color: #fff;
        }

        .card {
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(245, 158, 11, 0.25);
            border-radius: 2rem;
            padding: 3rem;
            width: 100%;
            max-width: 460px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            text-align: center;
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .icon-circle {
            width: 80px;
            height: 80px;
            background: rgba(245, 158, 11, 0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: #fbbf24;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
        }

        .expired-date {
            display: inline-block;
            background: rgba(245, 158, 11, 0.15);
            border: 1px solid rgba(245, 158, 11, 0.3);
            color: #fbbf24;
            border-radius: 0.75rem;
            padding: 0.4rem 1rem;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        p {
            color: #94a3b8;
            line-height: 1.7;
            margin-bottom: 1.5rem;
        }

        .contact-info {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 1rem;
            padding: 1rem 1.25rem;
            font-size: 0.9rem;
            color: #cbd5e1;
            margin-bottom: 2rem;
        }

        .contact-info strong {
            color: #fff;
        }

        .btn-logout {
            display: inline-block;
            color: #64748b;
            font-size: 0.82rem;
            text-decoration: none;
            transition: color 0.2s;
        }

        .btn-logout:hover {
            color: #94a3b8;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="icon-circle"><i class="bi bi-clock-history"></i></div>
        <h1>Acesso Expirado</h1>
        @if ($cliente->data_validade)
            <div class="expired-date">
                <i class="bi bi-calendar-x me-1"></i>
                Expirou em {{ $cliente->data_validade->format('d/m/Y') }}
            </div>
        @endif
        <p>Seu período de acesso ao simulador foi encerrado. Entre em contato com a nossa equipe para <strong>renovar
                seu plano</strong>.</p>

        <div class="contact-info">
            @if (\App\Models\Setting::get('company_phone'))
                <div><i class="bi bi-whatsapp me-2" style="color:#25D366;"></i>
                    <strong>{{ \App\Models\Setting::get('company_phone') }}</strong>
                </div>
            @endif
            @if (\App\Models\Setting::get('company_email'))
                <div class="mt-2"><i class="bi bi-envelope me-2" style="color:#6366f1;"></i>
                    <strong>{{ \App\Models\Setting::get('company_email') }}</strong>
                </div>
            @endif
            @if (!\App\Models\Setting::get('company_phone') && !\App\Models\Setting::get('company_email'))
                <div><i class="bi bi-headset me-2"></i> Entre em contato com
                    <strong>{{ \App\Models\Setting::get('site_name', 'PayTech') }}</strong></div>
            @endif
        </div>

        <a href="{{ route('simulator.logout') }}" class="btn-logout">
            <i class="bi bi-arrow-left me-1"></i> Tentar com outra conta
        </a>
    </div>
</body>

</html>
