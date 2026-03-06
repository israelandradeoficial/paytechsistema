<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso ao Simulador | {{ \App\Models\Setting::get('site_name', 'PayTech') }}</title>

    @if ($favicon = \App\Models\Setting::get('favicon'))
        <link rel="icon" type="image/x-icon" href="{{ \Illuminate\Support\Facades\Storage::url($favicon) }}">
    @endif

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #ec4899;
            --dark: #0f172a;
            --darkER: #020617;
            --glass: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.1);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--darkER);
            background-image:
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(236, 72, 153, 0.1) 0px, transparent 50%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            color: #fff;
            overflow: hidden;
        }

        .login-card {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 2rem;
            padding: 3rem;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-container {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo-container img {
            max-height: 70px;
            margin-bottom: 1.5rem;
        }

        .logo-container h1 {
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.025em;
            margin-bottom: 0.5rem;
        }

        .logo-container p {
            color: #94a3b8;
            font-size: 0.95rem;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            color: #fff;
            padding: 0.85rem 1.25rem;
            border-radius: 1rem;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.2);
            color: #fff;
        }

        .form-control::placeholder {
            color: #94a3b8;
            opacity: 1;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border: none;
            padding: 1rem;
            border-radius: 1rem;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 0.01em;
            transition: all 0.3s;
            margin-top: 1rem;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(99, 102, 241, 0.4);
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            border-radius: 1rem;
            padding: 1rem;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        .footer-text {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.85rem;
            color: #64748b;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <div class="logo-container">
            @if ($logo = \App\Models\Setting::get('logo_simulator'))
                <img src="{{ \Illuminate\Support\Facades\Storage::url($logo) }}" alt="Logo">
            @else
                <div class="display-4 mb-3">💳</div>
            @endif
            <h1>Acessar Simulador</h1>
            <p>Informe sua identificação para continuar</p>
        </div>

        @if (session('error'))
            <div class="alert alert-danger d-flex align-items-center">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('simulator.access') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="form-label fw-bold text-uppercase mb-2"
                    style="color: #e2e8f0; font-size: 0.8rem; letter-spacing: 0.1em;">
                    <i class="bi bi-person-vcard me-1" style="color: #6366f1;"></i> CPF, CNPJ ou E-mail
                </label>
                <input type="text" id="identificacao" name="identificacao" class="form-control"
                    placeholder="Digite aqui..." required autofocus>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-shield-lock me-2"></i> Acessar Simulador
            </button>
        </form>

        <div class="footer-text">
            &copy; {{ date('Y') }} {{ \App\Models\Setting::get('site_name', 'PayTech') }}
        </div>
    </div>

    <script>
        const identInput = document.getElementById('identificacao');

        identInput.addEventListener('input', function() {
            let v = this.value;

            // Se tiver letras ou @ → modo e-mail, sem máscara
            if (/[a-zA-Z@]/.test(v)) {
                return;
            }

            // Apenas dígitos → aplica máscara de CPF ou CNPJ
            v = v.replace(/\D/g, '');

            if (v.length <= 11) {
                // CPF: 000.000.000-00
                v = v.replace(/(\d{3})(\d)/, '$1.$2');
                v = v.replace(/(\d{3})(\d)/, '$1.$2');
                v = v.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            } else {
                // CNPJ: 00.000.000/0000-00
                v = v.substring(0, 14);
                v = v.replace(/^(\d{2})(\d)/, '$1.$2');
                v = v.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
                v = v.replace(/\.(\d{3})(\d)/, '.$1/$2');
                v = v.replace(/(\d{4})(\d)/, '$1-$2');
            }

            this.value = v;
        });
    </script>
</body>

</html>
