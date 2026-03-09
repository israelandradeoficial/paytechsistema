<!DOCTYPE html>
<html lang="pt-br" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ \App\Models\Setting::get('site_name', 'PayTech | Soluções em Pagamentos e Capital de Giro') }}</title>
    @if ($favicon = \App\Models\Setting::get('favicon'))
        <link rel="icon" type="image/x-icon" href="{{ \Illuminate\Support\Facades\Storage::url($favicon) }}">
    @endif

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Icons & Slider CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            900: '#1e3a8a'
                        },
                        dark: '#0f172a'
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif']
                    },
                }
            }
        }
    </script>

    <style>
        .mySwiper {
            padding-bottom: 50px;
        }

        .mySwiper .swiper-slide {
            display: flex;
            align-items: center;
            min-height: 550px;
            padding: 40px 0;
        }

        .testimonialsSwiper .swiper-slide {
            display: flex;
            height: auto;
            align-items: stretch;
            padding: 10px 0;
        }

        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease-out;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .glass-header {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .slide-img {
            transition: all 1s ease;
            transform: scale(0.95);
            opacity: 0;
        }

        .swiper-slide-active .slide-img {
            transform: scale(1);
            opacity: 1;
        }

        .faq-item:hover {
            background-color: #f8fafc;
        }

        .swiper-pagination {
            top: 100% !important;
        }

        .swiper-pagination-bullet {
            background: #7871d8ff;
        }

        .maquininhasSwiper .swiper-pagination-bullet {
            background: #cbd5e1;
            opacity: 1;
            width: 12px;
            height: 12px;
            margin: 0 6px !important;
            transition: all 0.3s ease;
        }

        .maquininhasSwiper .swiper-pagination-bullet-active {
            background: #2563eb !important;
            width: 32px;
            border-radius: 6px;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .floating-machine {
            animation: float 4s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-[#fcfdfe] text-dark antialiased font-sans">

    <!-- HEADER -->
    <header class="glass-header fixed w-full z-[100]">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                @php
                    $headerLogo = \App\Models\Setting::get('logo_site') ?: \App\Models\Setting::get('logo_system');
                @endphp
                @if ($headerLogo)
                    <img src="{{ Storage::url($headerLogo) }}"
                        alt="{{ \App\Models\Setting::get('site_name', 'PayTech') }}"
                        class="h-10 w-auto object-contain transition-transform group-hover:scale-110">
                @else
                    <div class="flex items-center gap-2">
                        <div
                            class="w-10 h-10 bg-brand-600 rounded-xl flex items-center justify-center shadow-lg text-white">
                            <i class="bi bi-lightning-charge-fill text-xl"></i>
                        </div>
                        <span class="font-extrabold text-2xl tracking-tight text-brand-900 uppercase italic">
                            {{ \App\Models\Setting::get('site_name', 'PayTech') }}
                        </span>
                    </div>
                @endif
            </a>
            <nav class="hidden lg:flex gap-10 text-sm font-bold text-slate-600 uppercase tracking-widest">
                <a href="#sobre" class="hover:text-brand-600 transition-colors">Sobre</a>
                <a href="#maquininhas" class="hover:text-brand-600 transition-colors">Maquininhas</a>
                <a href="#credito" class="hover:text-brand-600 transition-colors">Troca de Limite</a>
                <a href="#depoimentos" class="hover:text-brand-600 transition-colors">Depoimentos</a>
                <a href="#faq" class="hover:text-brand-600 transition-colors">Dúvidas</a>
            </nav>
            <a href="{{ \App\Models\Setting::get('header_cta_url') && \App\Models\Setting::get('header_cta_url') !== '#' ? \App\Models\Setting::get('header_cta_url') : 'https://wa.me/' . preg_replace('/\D/', '', \App\Models\Setting::get('company_phone', '5511999999999')) }}"
                class="bg-brand-600 text-white px-7 py-3 rounded-full text-sm font-bold shadow-lg hover:scale-105 transition-all">
                {{ \App\Models\Setting::get('header_cta_text', 'Falar com Especialista') }}
            </a>
        </div>
    </header>

    <!-- HERO SLIDER (Imagens Lado a Lado) -->
    <section class="pt-24 lg:pt-32 bg-gradient-to-b from-brand-50/50 to-transparent">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">

                <!-- Slide 1: Maquininhas -->
                <div class="swiper-slide">
                    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-12 items-center w-full">
                        <div class="reveal active">
                            <h2 class="text-5xl lg:text-7xl font-extrabold text-brand-900 leading-tight mb-6">
                                {!! nl2br(e(\App\Models\Setting::get('hero_slide1_title', 'Sua loja com tecnologia de ponta.'))) !!}</h2>
                            <p class="text-lg text-slate-500 mb-8 max-w-lg leading-relaxed">
                                {{ \App\Models\Setting::get('hero_slide1_desc', 'Oferecemos maquininhas modernas e taxas competitivas para simplificar o recebimento das suas vendas no cartão com total suporte.') }}
                            </p>
                            <div class="flex gap-4">
                                <a href="{{ \App\Models\Setting::get('hero_slide1_btn1_url') && \App\Models\Setting::get('hero_slide1_btn1_url') !== '#' ? \App\Models\Setting::get('hero_slide1_btn1_url') : 'https://wa.me/' . preg_replace('/\D/', '', \App\Models\Setting::get('company_phone', '5511999999999')) }}"
                                    class="bg-brand-600 text-white px-8 py-4 rounded-2xl font-bold shadow-xl">{{ \App\Models\Setting::get('hero_slide1_btn1_text', 'Pedir Agora') }}</a>
                                <a href="{{ \App\Models\Setting::get('hero_slide1_btn2_url', '#solucoes') }}"
                                    class="bg-white border border-slate-200 text-slate-700 px-8 py-4 rounded-2xl font-bold">{{ \App\Models\Setting::get('hero_slide1_btn2_text', 'Ver Taxas') }}</a>
                            </div>
                        </div>
                        <div class="flex justify-center slide-img">
                            @if ($hero1 = \App\Models\Setting::get('hero_slide1_image'))
                                <img src="{{ Storage::url($hero1) }}" alt="POS"
                                    class="rounded-[3rem] shadow-2xl border-[12px] border-white">
                            @else
                                <img src="https://images.unsplash.com/photo-1556740738-b6a63e27c4df?q=80&w=800"
                                    class="rounded-[3rem] shadow-2xl border-[12px] border-white">
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Slide 2: Crédito -->
                <div class="swiper-slide">
                    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-12 items-center w-full">
                        <div class="reveal active">
                            <h2 class="text-5xl lg:text-7xl font-extrabold text-brand-900 leading-tight mb-6">
                                {!! nl2br(e(\App\Models\Setting::get('hero_slide2_title', 'Troque seu limite por dinheiro vivo.'))) !!}
                            </h2>
                            <p class="text-lg text-slate-500 mb-8 max-w-lg leading-relaxed">
                                {{ \App\Models\Setting::get('hero_slide2_desc', 'Antecipação rápida e sem burocracia para você investir no seu negócio hoje mesmo através do cartão de crédito.') }}
                            </p>
                            <a href="{{ \App\Models\Setting::get('hero_slide2_btn_url') && \App\Models\Setting::get('hero_slide2_btn_url') !== '#' ? \App\Models\Setting::get('hero_slide2_btn_url') : 'https://wa.me/' . preg_replace('/\D/', '', \App\Models\Setting::get('company_phone', '5511999999999')) }}"
                                class="bg-dark text-white px-10 py-5 rounded-2xl font-bold shadow-xl inline-block">{{ \App\Models\Setting::get('hero_slide2_btn_text', 'Simular PIX Agora') }}</a>
                        </div>
                        <div class="flex justify-center slide-img">
                            @if ($hero2 = \App\Models\Setting::get('hero_slide2_image'))
                                <img src="{{ Storage::url($hero2) }}" alt="Credit Card"
                                    class="rounded-[3rem] shadow-2xl border-[12px] border-white">
                            @else
                                <img src="https://images.unsplash.com/photo-1563013544-824ae1b704d3?q=80&w=800"
                                    class="rounded-[3rem] shadow-2xl border-[12px] border-white">
                            @endif
                        </div>
                    </div>
                </div>

            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <!-- NÚMEROS DE IMPACTO (Informação Adicional) -->
    <section class="py-10 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1 -->
                <div
                    class="bg-white p-6 rounded-[1.5rem] shadow-lg border border-slate-100 text-center group hover:border-brand-600 transition-all duration-300">
                    <div
                        class="text-3xl font-extrabold text-brand-600 mb-1 transition-transform group-hover:scale-110 duration-300">
                        {{ \App\Models\Setting::get('counter1_val', '+10k') }}
                    </div>
                    <p class="text-slate-500 font-bold text-sm uppercase tracking-wider">
                        {{ \App\Models\Setting::get('counter1_label', 'Clientes Ativos') }}</p>
                </div>
                <!-- Card 2 -->
                <div
                    class="bg-white p-6 rounded-[1.5rem] shadow-lg border border-slate-100 text-center group hover:border-brand-600 transition-all duration-300">
                    <div
                        class="text-3xl font-extrabold text-brand-600 mb-1 transition-transform group-hover:scale-110 duration-300">
                        {{ \App\Models\Setting::get('counter2_val', '15+') }}
                    </div>
                    <p class="text-slate-500 font-bold text-sm uppercase tracking-wider">
                        {{ \App\Models\Setting::get('counter2_label', 'Anos de Mercado') }}</p>
                </div>
                <!-- Card 3 -->
                <div
                    class="bg-white p-6 rounded-[1.5rem] shadow-lg border border-slate-100 text-center group hover:border-brand-600 transition-all duration-300">
                    <div
                        class="text-3xl font-extrabold text-brand-600 mb-1 transition-transform group-hover:scale-110 duration-300">
                        {{ \App\Models\Setting::get('counter3_val', '99%') }}
                    </div>
                    <p class="text-slate-500 font-bold text-sm uppercase tracking-wider">
                        {{ \App\Models\Setting::get('counter3_label', 'Satisfação') }}</p>
                </div>
                <!-- Card 4 -->
                <div
                    class="bg-white p-6 rounded-[1.5rem] shadow-lg border border-slate-100 text-center group hover:border-brand-600 transition-all duration-300">
                    <div
                        class="text-3xl font-extrabold text-brand-600 mb-1 transition-transform group-hover:scale-110 duration-300">
                        {{ \App\Models\Setting::get('counter4_val', '24') }}
                    </div>
                    <p class="text-slate-500 font-bold text-sm uppercase tracking-wider">
                        {{ \App\Models\Setting::get('counter4_label', 'Suporte') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SOBRE A PAYTECH (Seu texto institucional) -->
    <section id="sobre" class="py-16 my-16">
        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">
            <div class="reveal">
                @if ($aboutImg = \App\Models\Setting::get('about_image'))
                    <img src="{{ Storage::url($aboutImg) }}" alt="Technology"
                        class="w-full h-full object-cover rounded-[3rem] shadow-2xl">
                @else
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=800"
                        class="rounded-[3rem] shadow-xl">
                @endif
            </div>
            <div class="reveal delay-200">
                <h2 class="text-4xl font-extrabold text-brand-900 mb-8 tracking-tighter uppercase">
                    {{ \App\Models\Setting::get('about_title', 'Sobre a PayTech') }}</h2>
                <div class="space-y-6 text-slate-600 text-lg leading-relaxed">
                    <p class="text-slate-500 text-lg leading-relaxed mb-8 reveal delay-100">
                        {!! \App\Models\Setting::get(
                            'about_text',
                            'A <strong>PayTech</strong> é uma empresa especializada em soluções para meios de pagamento, focada em transformar a maneira como você recebe suas vendas. Combinamos segurança de ponta com as menores taxas do mercado.',
                        ) !!}
                    </p>

                    @if ($aboutQuote = \App\Models\Setting::get('about_quote'))
                        <div class="border-l-4 border-brand-600 pl-6 mb-8 reveal delay-200">
                            <p class="text-xl text-brand-900 font-medium italic">"{{ $aboutQuote }}"</p>
                        </div>
                    @else
                        <div class="border-l-4 border-brand-600 pl-6 mb-8 reveal delay-200">
                            <p class="text-xl text-brand-900 font-medium italic">"Nossa missão é democratizar o acesso
                                ao crédito e tecnologias de pagamento para todos os empreendedores."</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- COMO FUNCIONA O CRÉDITO (Informativo) -->
    <section id="credito" class="py-16 bg-slate-900 text-white overflow-hidden relative">
        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-20 items-center">
            <div class="reveal">
                <h2 class="text-4xl font-extrabold mb-8 uppercase">Transforme limite em capital de giro</h2>
                <p class="text-slate-400 mb-10 text-lg leading-relaxed">Precisa de dinheiro rápido para investir? A
                    PayTech oferece o método mais seguro para converter o limite do seu cartão em saldo na conta.</p>

                <div class="grid gap-6">
                    @for ($i = 1; $i <= 3; $i++)
                        @php
                            $title = \App\Models\Setting::get('credit_step' . $i . '_title');
                            $desc = \App\Models\Setting::get('credit_step' . $i . '_desc');
                        @endphp
                        @if ($title)
                            <div
                                class="bg-white/5 border border-white/10 p-8 rounded-[2rem] flex gap-6 items-start hover:bg-white/[0.07] transition-all group">
                                <div
                                    class="w-12 h-12 bg-green-600 rounded-xl flex items-center justify-center flex-shrink-0 text-white font-bold text-xl group-hover:scale-110 transition-transform">
                                    {{ $i }}
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold text-white mb-2">{{ $title }}</h4>
                                    <p class="text-slate-400 leading-relaxed">{{ $desc }}</p>
                                </div>
                            </div>
                        @endif
                    @endfor
                </div>
            </div>
            <div class="reveal delay-300">
                <div class="bg-white text-dark p-8 rounded-[2.5rem] shadow-2xl">
                    <h3 class="text-2xl font-bold mb-6 text-center">Por que fazer com a PayTech?</h3>
                    <ul class="space-y-4">
                        <li class="flex items-center gap-3 p-4 bg-slate-50 rounded-xl">
                            <i class="bi bi-check-circle-fill text-green-500 text-xl"></i>
                            <span class="font-medium">Menores taxas do mercado</span>
                        </li>
                        <li class="flex items-center gap-3 p-4 bg-slate-50 rounded-xl">
                            <i class="bi bi-check-circle-fill text-green-500 text-xl"></i>
                            <span class="font-medium">Parcelamento em até 18x</span>
                        </li>
                        <li class="flex items-center gap-3 p-4 bg-slate-50 rounded-xl">
                            <i class="bi bi-check-circle-fill text-green-500 text-xl"></i>
                            <span class="font-medium">Dinheiro liberado na hora</span>
                        </li>
                        <li class="flex items-center gap-3 p-4 bg-slate-50 rounded-xl">
                            <i class="bi bi-check-circle-fill text-green-500 text-xl"></i>
                            <span class="font-medium">Atendimento 100% humano</span>
                        </li>
                    </ul>
                    <a href="{{ \App\Models\Setting::get('credit_cta_url') && \App\Models\Setting::get('credit_cta_url') !== '#' ? \App\Models\Setting::get('credit_cta_url') : 'https://wa.me/' . preg_replace('/\D/', '', \App\Models\Setting::get('company_phone', '5511999999999')) }}"
                        class="block w-full text-center bg-brand-600 text-white font-bold py-5 rounded-2xl mt-8 shadow-lg shadow-brand-600/20">{{ \App\Models\Setting::get('credit_cta_text', 'Solicitar agora no WhatsApp') }}</a>
                </div>
            </div>
        </div>
    </section>

    <!-- SEÇÃO MAQUININHAS (Carousel) -->
    <section id="maquininhas" class="py-24 bg-slate-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 mb-16 text-center reveal">
            <div
                class="inline-block bg-brand-100 text-brand-600 px-4 py-1 rounded-full text-xs font-bold uppercase mb-6 italic">
                Tecnologia de Ponta</div>
            <h2 class="text-4xl md:text-5xl font-extrabold text-brand-900 mb-4 uppercase tracking-tighter">
                Nossas Maquininhas</h2>
            <p class="text-slate-500 max-w-2xl mx-auto text-lg italic">Escolha o modelo perfeito para o seu volume de
                vendas e
                receba em tempo recorde.</p>
        </div>

        <div class="swiper maquininhasSwiper max-w-7xl mx-auto px-6 overflow-visible">
            <div class="swiper-wrapper mb-20">
                <!-- Modelo Profit -->
                <div class="swiper-slide px-4">
                    <div
                        class="bg-white rounded-[3rem] p-8 shadow-xl shadow-slate-200/50 border border-slate-100 h-full flex flex-col items-center text-center hover:shadow-2xl hover:shadow-brand-600/10 transition-all duration-500 group">
                        <div class="relative mb-8">
                            <div class="absolute inset-0 bg-brand-600/5 blur-3xl rounded-full scale-150"></div>
                            @if ($machine1 = \App\Models\Setting::get('machine1_image'))
                                <img src="{{ Storage::url($machine1) }}" alt="Machine 1"
                                    class="w-64 h-64 object-contain relative z-10 floating-machine">
                            @else
                                <img src="https://assets.pagseguro.com.br/ps-products-assets/v4.6.1/img/moderninha_profit/photos/gallery-front@x2.png"
                                    alt="Moderninha Profit"
                                    class="w-64 h-64 object-contain relative z-10 floating-machine">
                            @endif
                        </div>
                        <h3 class="text-xl font-extrabold text-brand-900 mb-1 uppercase tracking-tight italic">
                            {{ \App\Models\Setting::get('machine1_name', 'Moderninha Profit') }}</h3>
                        <p class="text-slate-400 text-[10px] mb-8 font-bold uppercase tracking-[0.2em] italic">
                            {{ \App\Models\Setting::get('machine1_desc', 'O melhor custo-benefício') }}</p>

                        <div class="w-full space-y-4 mb-10 text-left">
                            <div class="flex items-center gap-4 group/item">
                                <div
                                    class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 group-hover/item:bg-brand-50 group-hover/item:text-brand-600 transition-colors">
                                    <i class="bi bi-slash-circle text-sm"></i>
                                </div>
                                <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Sem
                                    aluguel</span>
                            </div>
                            <div class="flex items-center gap-4 group/item">
                                <div
                                    class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 group-hover/item:bg-brand-50 group-hover/item:text-brand-600 transition-colors">
                                    <i class="bi bi-phone-vibrate text-sm"></i>
                                </div>
                                <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Chip grátis
                                    incluso</span>
                            </div>
                            <div class="flex items-center gap-4 group/item">
                                <div
                                    class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 group-hover/item:bg-brand-50 group-hover/item:text-brand-600 transition-colors">
                                    <i class="bi bi-headset text-sm"></i>
                                </div>
                                <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Suporte
                                    24h</span>
                            </div>
                            <div class="flex items-center gap-4 group/item">
                                <div
                                    class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 group-hover/item:bg-brand-50 group-hover/item:text-brand-600 transition-colors">
                                    <i class="bi bi-lightning-charge text-sm"></i>
                                </div>
                                <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Venda até
                                    18x</span>
                            </div>
                        </div>

                        <div class="mt-auto w-full">
                            <a href="{{ \App\Models\Setting::get('machines_cta_url') && \App\Models\Setting::get('machines_cta_url') !== '#' ? \App\Models\Setting::get('machines_cta_url') : 'https://wa.me/' . preg_replace('/\D/', '', \App\Models\Setting::get('company_phone', '5511999999999')) }}"
                                class="flex items-center justify-center gap-2 w-full bg-slate-900 text-white font-bold py-5 rounded-2xl hover:bg-brand-600 transition-all shadow-lg hover:shadow-brand-600/30 uppercase text-[11px] tracking-[0.15em] italic">
                                {{ \App\Models\Setting::get('machines_cta_text', 'Solicitar Agora') }} <i
                                    class="bi bi-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Modelo Pro 2 (FEATURED) -->
                <div class="swiper-slide px-4">
                    <div
                        class="bg-white rounded-[3.5rem] p-10 shadow-2xl shadow-brand-600/20 border-2 border-brand-600 h-full flex flex-col items-center text-center relative z-20 transition-transform duration-500 group overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-brand-600/5 rounded-full -mr-16 -mt-16"></div>
                        <div
                            class="absolute top-6 left-1/2 -translate-x-1/2 bg-brand-600 text-white text-[10px] font-black px-6 py-2 rounded-full uppercase tracking-[0.2em] italic z-30 shadow-xl shadow-brand-600/40">
                            A Mais Vendida</div>
                        <div class="relative mb-10">
                            <div class="absolute inset-0 bg-brand-600/10 blur-3xl rounded-full scale-150"></div>
                            @if ($machine2 = \App\Models\Setting::get('machine2_image'))
                                <img src="{{ Storage::url($machine2) }}" alt="Machine 2"
                                    class="w-72 h-72 object-contain relative z-10 floating-machine"
                                    style="animation-delay: -1s;">
                            @else
                                <img src="https://assets.pagseguro.com.br/ps-products-assets/v4.6.1/img/moderninha_pro_2s/photos/gallery-front@x2.png"
                                    alt="Moderninha Pro 2"
                                    class="w-72 h-72 object-contain relative z-10 floating-machine"
                                    style="animation-delay: -1s;">
                            @endif
                        </div>
                        <h3 class="text-2xl font-black text-brand-900 mb-1 uppercase tracking-tight italic">
                            {{ \App\Models\Setting::get('machine2_name', 'Moderninha Pro 2') }}</h3>
                        <p class="text-brand-600 text-[10px] mb-8 font-black uppercase tracking-[0.25em] italic">
                            {{ \App\Models\Setting::get('machine2_desc', 'Mais completa, mais rápida') }}</p>

                        <div class="w-full space-y-4 mb-10 text-left">
                            <div class="flex items-center gap-4 group/item">
                                <div
                                    class="w-9 h-9 rounded-xl bg-brand-50 flex items-center justify-center text-brand-600 shadow-sm">
                                    <i class="bi bi-slash-circle text-base"></i>
                                </div>
                                <span class="text-[13px] font-black text-brand-900 uppercase tracking-wide italic">Sem
                                    aluguel</span>
                            </div>
                            <div class="flex items-center gap-4 group/item">
                                <div
                                    class="w-9 h-9 rounded-xl bg-brand-50 flex items-center justify-center text-brand-600 shadow-sm">
                                    <i class="bi bi-printer text-base"></i>
                                </div>
                                <span
                                    class="text-[13px] font-black text-brand-900 uppercase tracking-wide italic">Imprime
                                    Comprovante</span>
                            </div>
                            <div class="flex items-center gap-4 group/item">
                                <div
                                    class="w-9 h-9 rounded-xl bg-brand-50 flex items-center justify-center text-brand-600 shadow-sm">
                                    <i class="bi bi-lightning-charge text-base"></i>
                                </div>
                                <span
                                    class="text-[13px] font-black text-brand-900 uppercase tracking-wide italic">Receba
                                    na hora</span>
                            </div>
                            <div class="flex items-center gap-4 group/item">
                                <div
                                    class="w-9 h-9 rounded-xl bg-brand-50 flex items-center justify-center text-brand-600 shadow-sm">
                                    <i class="bi bi-credit-card-2-front text-base"></i>
                                </div>
                                <span
                                    class="text-[13px] font-black text-brand-900 uppercase tracking-wide italic">Cartão
                                    + Cashback</span>
                            </div>
                        </div>

                        <div class="mt-auto w-full">
                            <a href="{{ \App\Models\Setting::get('machines_cta_url') && \App\Models\Setting::get('machines_cta_url') !== '#' ? \App\Models\Setting::get('machines_cta_url') : 'https://wa.me/' . preg_replace('/\D/', '', \App\Models\Setting::get('company_phone', '5511999999999')) }}"
                                class="flex items-center justify-center gap-3 w-full bg-brand-600 text-white font-black py-6 rounded-[2rem] shadow-xl shadow-brand-600/40 hover:bg-brand-700 transition-all hover:scale-[1.02] active:scale-95 uppercase text-xs tracking-[0.2em] italic">
                                {{ \App\Models\Setting::get('machines_cta_text', 'Solicitar agora') }} <i
                                    class="bi bi-whatsapp text-sm"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Modelo Smart 2 -->
                <div class="swiper-slide px-4">
                    <div
                        class="bg-white rounded-[3rem] p-8 shadow-xl shadow-slate-200/50 border border-slate-100 h-full flex flex-col items-center text-center hover:shadow-2xl hover:shadow-slate-400/10 transition-all duration-500 group">
                        <div class="relative mb-10">
                            <div class="absolute inset-0 bg-brand-600/5 blur-3xl rounded-full scale-150"></div>
                            @if ($machine3 = \App\Models\Setting::get('machine3_image'))
                                <img src="{{ Storage::url($machine3) }}" alt="Machine 3"
                                    class="w-64 h-64 object-contain relative z-10 floating-machine"
                                    style="animation-delay: -2s;">
                            @else
                                <img src="https://assets.pagseguro.com.br/ps-products-assets/v4.6.1/img/moderninha_smart_2/photos/gallery-front@x2.png"
                                    alt="Moderninha Smart 2"
                                    class="w-64 h-64 object-contain relative z-10 floating-machine"
                                    style="animation-delay: -2s;">
                            @endif
                        </div>
                        <h3 class="text-xl font-extrabold text-brand-900 mb-1 uppercase tracking-tight italic">
                            {{ \App\Models\Setting::get('machine3_name', 'Moderninha Smart 2') }}</h3>
                        <p class="text-slate-400 text-[10px] mb-8 font-bold uppercase tracking-[0.2em] italic">
                            {{ \App\Models\Setting::get('machine3_desc', 'Sua loja num Smart Checkout') }}</p>

                        <div class="w-full space-y-4 mb-10 text-left">
                            <div class="flex items-center gap-4 group/item">
                                <div
                                    class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 group-hover/item:bg-brand-50 group-hover/item:text-brand-600 transition-colors">
                                    <i class="bi bi-display text-sm"></i>
                                </div>
                                <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Sistema
                                    Android</span>
                            </div>
                            <div class="flex items-center gap-4 group/item">
                                <div
                                    class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 group-hover/item:bg-brand-50 group-hover/item:text-brand-600 transition-colors">
                                    <i class="bi bi-graph-up-arrow text-sm"></i>
                                </div>
                                <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Gestão de
                                    Negócio</span>
                            </div>
                            <div class="flex items-center gap-4 group/item">
                                <div
                                    class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 group-hover/item:bg-brand-50 group-hover/item:text-brand-600 transition-colors">
                                    <i class="bi bi-printer text-sm"></i>
                                </div>
                                <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Imprime
                                    tudo</span>
                            </div>
                            <div class="flex items-center gap-4 group/item">
                                <div
                                    class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 group-hover/item:bg-brand-50 group-hover/item:text-brand-600 transition-colors">
                                    <i class="bi bi-credit-card-2-front text-sm"></i>
                                </div>
                                <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Cartão +
                                    Cashback</span>
                            </div>
                        </div>

                        <div class="mt-auto w-full">
                            <a href="{{ \App\Models\Setting::get('machines_cta_url') && \App\Models\Setting::get('machines_cta_url') !== '#' ? \App\Models\Setting::get('machines_cta_url') : 'https://wa.me/' . preg_replace('/\D/', '', \App\Models\Setting::get('company_phone', '5511999999999')) }}"
                                class="flex items-center justify-center gap-2 w-full bg-slate-900 text-white font-bold py-5 rounded-2xl hover:bg-brand-600 transition-all shadow-lg hover:shadow-brand-600/30 uppercase text-[11px] tracking-[0.15em] italic">
                                {{ \App\Models\Setting::get('machines_cta_text', 'Solicitar Agora') }} <i
                                    class="bi bi-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Paginação centralizada -->
            <div class="swiper-pagination !static mt-10"></div>
        </div>
    </section>

    <!-- FAQ - PERGUNTAS FREQUENTES (Para aumentar a autoridade) -->
    <section id="faq" class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-6">
            <h2 class="text-4xl font-extrabold text-brand-900 text-center mb-10 uppercase">Dúvidas frequentes</h2>
            <div class="space-y-4">
                @for ($i = 1; $i <= 3; $i++)
                    @php
                        $q = \App\Models\Setting::get('faq' . $i . '_q');
                        $a = \App\Models\Setting::get('faq' . $i . '_a');
                    @endphp
                    @if ($q)
                        <div class="faq-item p-6 border border-slate-100 rounded-2xl transition-all cursor-pointer">
                            <h4 class="font-bold text-lg flex justify-between items-center italic">
                                {{ $q }}
                                <i
                                    class="bi {{ $i == 1 ? 'bi-dash-circle' : 'bi-plus-circle' }} text-brand-600 transition-transform"></i>
                            </h4>
                            <div
                                class="faq-content {{ $i == 1 ? '' : 'hidden' }} pt-4 text-slate-500 leading-relaxed">
                                {{ $a }}
                            </div>
                        </div>
                    @endif
                @endfor
            </div>
        </div>
    </section>

    <!-- DEPOIMENTOS (Prova Social) -->
    <section id="depoimentos" class="py-24 bg-slate-900 text-white overflow-hidden relative">
        <div class="max-w-7xl mx-auto px-6 mb-16 text-center reveal">
            <h2 class="text-4xl font-extrabold text-white mb-4 uppercase">O que dizem nossos parceiros</h2>
            <p class="text-slate-400 max-w-2xl mx-auto text-lg leading-relaxed">Mais do que clientes, construímos
                parcerias de sucesso em todo o país.</p>
        </div>

        <div class="swiper testimonialsSwiper max-w-7xl mx-auto px-6 overflow-visible">
            <div class="swiper-wrapper">
                @for ($i = 1; $i <= 4; $i++)
                    @php
                        $name = \App\Models\Setting::get('testimonial' . $i . '_name');
                        $role = \App\Models\Setting::get('testimonial' . $i . '_role');
                        $text = \App\Models\Setting::get('testimonial' . $i . '_text');
                    @endphp
                    @if ($name)
                        <div class="swiper-slide h-auto">
                            <div
                                class="bg-white p-5 rounded-[1rem] shadow-xl border border-slate-100 h-full flex flex-col group hover:border-brand-600 transition-all duration-500">
                                <div class="flex gap-1 mb-6">
                                    <i class="bi bi-star-fill text-yellow-400 text-sm"></i>
                                    <i class="bi bi-star-fill text-yellow-400 text-sm"></i>
                                    <i class="bi bi-star-fill text-yellow-400 text-sm"></i>
                                    <i class="bi bi-star-fill text-yellow-400 text-sm"></i>
                                    <i class="bi bi-star-fill text-yellow-400 text-sm"></i>
                                </div>
                                <p class="text-slate-600 italic mb-8 leading-relaxed text-lg flex-grow">
                                    "{{ $text }}"</p>
                                <div class="flex items-center gap-4 mt-auto">
                                    <div
                                        class="w-14 h-14 bg-brand-100 rounded-2xl flex items-center justify-center text-brand-600 font-bold text-xl">
                                        {{ substr($name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h5 class="font-bold text-brand-900 leading-none mb-1">{{ $name }}
                                        </h5>
                                        <p class="text-sm text-slate-400 font-medium tracking-wide uppercase">
                                            {{ $role }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endfor
            </div>
            <div class="swiper-pagination mt-12 relative !bottom-0"></div>
        </div>
    </section>

    <!-- SEÇÃO ANTES DO RODAPÉ (Imagem e Texto) -->
    <section class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">
            <div class="reveal">
                <div
                    class="inline-block bg-brand-100 text-brand-600 px-4 py-1 rounded-full text-xs font-bold uppercase mb-6 italic">
                    Inovação e Suporte</div>
                <h2 class="text-4xl font-extrabold text-brand-900 mb-8 leading-tight uppercase">Tecnologia confiável
                    para crescer
                    com eficiência.</h2>
                <p class="text-slate-600 text-lg leading-relaxed mb-10">
                    Na PayTech, não oferecemos apenas máquinas; oferecemos uma parceria de crescimento. Nosso foco é
                    conectar você à infraestrutura financeira necessária para que cada venda seja um passo para o
                    próximo nível.
                </p>
                <div class="flex items-center gap-6">
                    <div class="flex -space-x-3">
                        <img src="https://i.pravatar.cc/100?u=1" class="w-12 h-12 rounded-full border-4 border-white">
                        <img src="https://i.pravatar.cc/100?u=2" class="w-12 h-12 rounded-full border-4 border-white">
                        <img src="https://i.pravatar.cc/100?u=3" class="w-12 h-12 rounded-full border-4 border-white">
                    </div>
                    <span class="text-slate-500 font-bold text-sm">Aprovada por centenas de lojistas em todo o
                        Brasil.</span>
                </div>
            </div>
            <div class="reveal delay-300">
                <div class="relative">
                    <div class="absolute -inset-4 bg-brand-600 opacity-10 rounded-full blur-3xl"></div>
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=1000"
                        class="rounded-[4rem] relative z-10 shadow-2xl shadow-brand-900/10">
                </div>
            </div>
        </div>
    </section>

    <!-- SEÇÃO MAPA & LOCALIZAÇÃO -->
    <section id="localizacao" class="relative py-24 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-5 reveal">
                    <div
                        class="inline-block bg-brand-100 text-brand-600 px-4 py-1 rounded-full text-xs font-bold uppercase mb-6 italic">
                        Venha nos visitar</div>
                    <h2 class="text-4xl font-extrabold text-brand-900 mb-6 uppercase">
                        Sua parceira pertinho de nós</h2>
                    <p class="text-slate-600 text-lg leading-relaxed mb-8">
                        Além da nossa tecnologia, estamos presentes fisicamente para te dar todo o suporte
                        que o seu negócio merece.
                    </p>

                    <div class="space-y-6">
                        <div
                            class="flex items-start gap-4 p-5 rounded-2xl bg-slate-50 border border-slate-100 transition-all hover:bg-brand-50 hover:border-brand-200 group">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 bg-brand-50 rounded-xl flex items-center justify-center text-brand-600 shadow-sm">
                                    <i class="bi bi-geo-alt-fill text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-brand-900 mb-1 uppercase text-sm italic">Nosso Endereço
                                    </h4>
                                    <p class="text-slate-500 text-sm leading-snug font-medium">
                                        {!! nl2br(e(\App\Models\Setting::get('company_address', 'Av. Paulista, 1000 - Bela Vista - São Paulo - SP'))) !!}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div
                            class="flex items-start gap-4 p-5 rounded-2xl bg-slate-50 border border-slate-100 transition-all hover:bg-brand-50 hover:border-brand-200 group">
                            <div
                                class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm text-brand-600 group-hover:bg-brand-600 group-hover:text-white transition-all">
                                <i class="bi bi-clock-fill text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-brand-900 mb-1 uppercase text-sm italic">Horário de
                                    Atendimento</h4>
                                <p class="text-slate-500 text-sm leading-snug font-medium">Segunda a Sexta: 08:00 às
                                    18:00<br>Sábados: 09:00 às 13:00</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10">
                        <a href="{{ \App\Models\Setting::get('map_button_url', 'https://maps.google.com') }}"
                            target="_blank"
                            class="inline-flex items-center gap-2 bg-brand-600 text-white px-8 py-4 rounded-full font-bold text-sm shadow-xl shadow-brand-600/20 hover:bg-brand-700 transition-all hover:scale-105 active:scale-95 uppercase italic tracking-wider">
                            <i class="bi bi-cursor-fill"></i>
                            {{ \App\Models\Setting::get('map_button_text', 'Como Chegar') }}
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-12 xl:col-span-7 reveal delay-300">
                    <div class="relative rounded-[1rem] overflow-hidden shadow-2xl border-8 border-white p-2 bg-white">
                        <iframe
                            src="{{ \App\Models\Setting::get('google_maps_embed_url', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3921.7621043039962!2d-38.21542631585272!3d-10.59776388962996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x70e252835524595%3A0xf8e97d4ddf5f8070!2sIsrael%20Andrade!5e0!3m2!1spt-BR!2sbr!4v1772931563630!5m2!1spt-BR!2sbr') }}"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-slate-900 pt-24 pb-12 text-white overflow-hidden relative">
        <div
            class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-brand-600 to-transparent opacity-20">
        </div>

        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-16 mb-20">
                <!-- Coluna 1: Info -->
                <div class="reveal">
                    <div class="flex items-center gap-3 mb-6">
                        @php
                            $footerLogo =
                                \App\Models\Setting::get('logo_footer') ?:
                                \App\Models\Setting::get('logo_site') ?:
                                \App\Models\Setting::get('logo_system');
                        @endphp
                        @if ($footerLogo)
                            <img src="{{ Storage::url($footerLogo) }}" alt="Logo"
                                class="h-20 w-auto object-contain">
                        @else
                            <div
                                class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-lg text-brand-600 overflow-hidden p-1">
                                <i class="bi bi-lightning-charge-fill text-2xl"></i>
                            </div>
                            <span class="font-extrabold text-2xl tracking-tighter text-brand-900 uppercase italic">
                                {{ \App\Models\Setting::get('site_name', 'PayTech') }}
                            </span>
                        @endif
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed mb-8 italic">
                        Transformando a experiência de pagamentos no Brasil com tecnologia world-class e suporte humano
                        de verdade. Sua parceira ideal para crescer.
                    </p>
                    <div class="flex gap-4">
                        <a href="{{ \App\Models\Setting::get('social_instagram', '#') }}"
                            class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-brand-600 hover:text-white transition-all hover:scale-110 active:scale-95">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="{{ \App\Models\Setting::get('social_facebook', '#') }}"
                            class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-brand-600 hover:text-white transition-all hover:scale-110 active:scale-95">
                            <i class="bi bi-facebook"></i>
                        </a>

                        <a href="https://wa.me/{{ preg_replace('/\D/', '', \App\Models\Setting::get('company_phone', '5511999999999')) }}"
                            class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-brand-600 hover:text-white transition-all hover:scale-110 active:scale-95">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                    </div>
                </div>

                <!-- Coluna 2: Navegação -->
                <div class="reveal delay-100">
                    <h4 class="text-white font-bold uppercase tracking-widest text-xs mb-8 italic">Navegação</h4>
                    <ul class="space-y-4">
                        <li><a href="#sobre"
                                class="text-slate-400 hover:text-white transition-colors text-sm font-medium tracking-wider">Sobre</a>
                        </li>
                        <li><a href="#maquininhas"
                                class="text-slate-400 hover:text-white transition-colors text-sm font-medium tracking-wider">Maquinihas</a>
                        </li>
                        <li><a href="#credito"
                                class="text-slate-400 hover:text-white transition-colors text-sm font-medium tracking-wider">Crédito
                                & Capital</a></li>
                        <li><a href="#faq"
                                class="text-slate-400 hover:text-white transition-colors text-sm font-medium tracking-wider">Dúvidas
                                Frequentes</a></li>
                        <li><a href="#localizacao"
                                class="text-slate-400 hover:text-white transition-colors text-sm font-medium tracking-wider">Nossa
                                Unidade</a></li>
                    </ul>
                </div>

                <!-- Coluna 3: Suporte -->
                <div class="reveal delay-200">
                    <h4 class="text-white font-bold uppercase tracking-widest text-xs mb-8 italic">Atendimento</h4>
                    <ul class="space-y-4">
                        <li><a href="https://wa.me/{{ preg_replace('/\D/', '', \App\Models\Setting::get('company_phone', '5511999999999')) }}"
                                class="text-slate-400 hover:text-white transition-colors text-sm font-medium tracking-wider">WhatsApp</a>
                        </li>
                        <li><a href="{{ \App\Models\Setting::get('social_instagram', '#') }}"
                                class="text-slate-400 hover:text-white transition-colors text-sm font-medium tracking-wider">Instagram</a>
                        </li>
                        <li><a href="{{ \App\Models\Setting::get('social_facebook', '#') }}"
                                class="text-slate-400 hover:text-white transition-colors text-sm font-medium tracking-wider">Facebook</a>
                        </li>
                        <li><a href="#"
                                class="text-slate-400 hover:text-white transition-colors text-sm font-medium tracking-wider">Trabalhe
                                Conosco</a></li>
                    </ul>
                </div>
            </div>

            <div
                class="pt-12 border-t border-slate-800 flex flex-col lg:flex-row justify-between items-center gap-8 reveal">
                <div class="flex flex-col items-center lg:items-start space-y-2">
                    <p class="text-slate-500 text-sm leading-relaxed mb-8 max-w-sm font-medium">
                        {{ \App\Models\Setting::get('footer_legal_notice', 'A PayTech é uma plataforma facilitadora de pagamentos. Não somos uma instituição financeira, mas sim um parceiro tecnológico para o seu negócio.') }}
                    </p>
                    <p class="text-slate-600 text-[11px] font-bold tracking-widest uppercase italic">
                        © {{ date('Y') }} {{ \App\Models\Setting::get('site_name', 'PayTech') }}. Todos os
                        direitos reservados.
                    </p>
                </div>

                <div class="flex gap-8 text-[11px] font-black tracking-widest uppercase text-slate-500 italic">
                    <a href="{{ route('legal.terms') }}"
                        class="hover:text-brand-600 transition-colors underline underline-offset-4 decoration-slate-800">Termos
                        de Uso</a>
                    <a href="{{ route('legal.privacy') }}"
                        class="hover:text-brand-600 transition-colors underline underline-offset-4 decoration-slate-800">Privacidade</a>
                    <a href="{{ \App\Models\Setting::get('careers_link', '#') }}"
                        class="hover:text-brand-500 transition-colors text-brand-600">{{ \App\Models\Setting::get('careers_button_text', 'Trabalhe Conosco') }}</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            loop: true,
            autoplay: {
                delay: 7000,
                disableOnInteraction: false
            },
            pagination: {
                el: ".mySwiper .swiper-pagination",
                clickable: true
            },
            speed: 1000,
            effect: "fade",
            fadeEffect: {
                crossFade: true
            }
        });

        var testimonialsSwiper = new Swiper(".testimonialsSwiper", {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 6000,
                disableOnInteraction: false
            },
            pagination: {
                el: ".testimonialsSwiper .swiper-pagination",
                clickable: true
            },
            breakpoints: {
                640: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                }
            }
        });

        var maquininhasSwiper = new Swiper(".maquininhasSwiper", {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false
            },
            pagination: {
                el: ".maquininhasSwiper .swiper-pagination",
                clickable: true
            },
            breakpoints: {
                640: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                }
            }
        });

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                    if (entry.target.classList.contains('counter-trigger')) {
                        startCounters();
                    }
                }
            });
        }, {
            threshold: 0.1
        });

        // Add trigger class to the stats container
        const statsGrid = document.querySelector('.grid.grid-cols-1.md\\:grid-cols-2.lg\\:grid-cols-4');
        if (statsGrid) {
            statsGrid.classList.add('counter-trigger');
            observer.observe(statsGrid);
        }

        let started = false;

        function startCounters() {
            if (started) return;
            started = true;

            const counters = document.querySelectorAll('.counter');
            const speed = 100; // Adjusted speed for better feel

            counters.forEach(counter => {
                const animate = () => {
                    const value = +counter.getAttribute('data-target');
                    const data = +counter.innerText;
                    const time = value / speed;
                    if (data < value) {
                        counter.innerText = Math.ceil(data + time);
                        setTimeout(animate, 10);
                    } else {
                        counter.innerText = value;
                    }
                }
                animate();
            });
        }

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // FAQ Accordion
        document.querySelectorAll('.faq-item').forEach(item => {
            item.addEventListener('click', () => {
                const content = item.querySelector('.faq-content');
                const icon = item.querySelector('i');

                // Toggle current item
                content.classList.toggle('hidden');
                icon.classList.toggle('bi-plus-circle');
                icon.classList.toggle('bi-dash-circle');

                // Close other items (optional, but better UX)
                document.querySelectorAll('.faq-item').forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.querySelector('.faq-content').classList.add('hidden');
                        const otherIcon = otherItem.querySelector('i');
                        otherIcon.classList.add('bi-plus-circle');
                        otherIcon.classList.remove('bi-dash-circle');
                    }
                });
            });
        });
    </script>
</body>

</html>
