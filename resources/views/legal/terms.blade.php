<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Termos de Uso - {{ \App\Models\Setting::get('site_name', 'PayTech') }}</title>
    @if ($favicon = \App\Models\Setting::get('favicon'))
        <link rel="icon" type="image/x-icon" href="{{ \Illuminate\Support\Facades\Storage::url($favicon) }}">
    @endif
    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }

        /* Custom formatting for Summernote HTML */
        .legal-content {
            color: #475569;
            line-height: 1.8;
        }

        .legal-content h1 {
            font-size: 2.25rem;
            font-weight: 800;
            color: #0f172a;
            margin-top: 2.5rem;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .legal-content h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-top: 2rem;
            margin-bottom: 1rem;
            line-height: 1.3;
        }

        .legal-content h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1e293b;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
        }

        .legal-content p {
            margin-bottom: 1.25rem;
        }

        .legal-content b,
        .legal-content strong {
            font-weight: 800;
            color: #0f172a;
        }

        .legal-content i,
        .legal-content em {
            font-style: italic;
        }

        .legal-content ul {
            list-style-type: disc;
            padding-left: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .legal-content ol {
            list-style-type: decimal;
            padding-left: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .legal-content li {
            margin-bottom: 0.5rem;
        }

        .legal-content a {
            color: #2563eb;
            text-decoration: underline;
            font-weight: 600;
        }

        .legal-content table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1.5rem;
        }

        .legal-content th,
        .legal-content td {
            border: 1px solid #e2e8f0;
            padding: 0.75rem;
            text-align: left;
        }

        .legal-content th {
            bg-color: #f8fafc;
            font-weight: 700;
        }
    </style>
</head>

<body class="bg-[#f8faff] text-slate-800 antialiased min-h-screen flex flex-col">
    <!-- Background Decor -->
    <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute top-[-10%] right-[-10%] w-[50%] h-[50%] bg-blue-600/5 blur-[120px] rounded-full"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[50%] h-[50%] bg-indigo-600/5 blur-[120px] rounded-full"></div>
    </div>
    <!-- Navbar Simples -->
    <nav class="bg-white/80 backdrop-blur-xl sticky top-0 z-50 border-b border-slate-200/60 py-5 shadow-sm">
        <div class="max-w-5xl mx-auto px-6 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center gap-3 group transition-transform hover:scale-[1.02]">
                @php
                    $legalLogo = \App\Models\Setting::get('logo_site') ?: \App\Models\Setting::get('logo_system');
                @endphp
                @if ($legalLogo)
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($legalLogo) }}" alt="Logo"
                        class="h-10 w-auto object-contain">
                @else
                    <div
                        class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-600/20">
                        <i class="bi bi-lightning-charge-fill text-lg"></i>
                    </div>
                    <span class="font-black text-xl tracking-tighter text-slate-900 uppercase italic">
                        {{ \App\Models\Setting::get('site_name', 'PayTech') }}
                    </span>
                @endif
            </a>
            <a href="{{ route('home') }}"
                class="text-xs font-bold uppercase tracking-widest text-blue-600 hover:text-blue-700 flex items-center gap-2 transition-all bg-blue-50 px-4 py-2 rounded-full">
                <i class="bi bi-arrow-left"></i> Início
            </a>
        </div>
    </nav>

    <main class="py-20 px-6 relative z-10 flex-grow">
        <article
            class="max-w-4xl mx-auto bg-white rounded-[2.5rem] shadow-2xl shadow-blue-900/5 p-10 md:p-20 border border-slate-100/80">
            <header class="mb-12 border-b border-slate-100 pb-8">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-[10px] font-bold uppercase tracking-widest mb-4">
                    <i class="bi bi-file-earmark-text"></i> Documento Legal
                </div>
                <h1 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight italic uppercase mb-2">Termos
                    de Uso</h1>
                <p class="text-slate-400 text-sm">Última atualização: {{ date('d/m/Y') }}</p>
            </header>

            <div class="legal-content max-w-none">
                @php
                    $content = \App\Models\Setting::get('legal_terms_content');
                @endphp

                @if (empty($content) || trim(strip_tags($content)) == '')
                    <div class="bg-slate-50 border-2 border-dashed border-slate-200 rounded-3xl p-12 text-center">
                        <i class="bi bi-pencil-square text-4xl text-slate-300 mb-4 block"></i>
                        <p class="text-slate-400 font-medium italic">O conteúdo dos Termos de Uso ainda não foi
                            configurado no painel administrativo.</p>
                    </div>
                @else
                    {!! $content !!}
                @endif
            </div>
        </article>
    </main>

    <footer class="py-12 text-center border-t border-slate-100 bg-white">
        <p class="text-slate-400 text-sm italic">&copy; {{ date('Y') }}
            {{ \App\Models\Setting::get('site_name', 'PayTech') }}. Todos os direitos reservados.</p>
    </footer>
</body>

</html>
