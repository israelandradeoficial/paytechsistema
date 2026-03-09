@extends('admin.layout')

@section('page_title', 'Personalização do Site')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-2 overflow-hidden">
                <div class="card-header py-3 px-4 border-bottom">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary-subtle p-2 rounded-1 me-3">
                            <i class="bi bi-palette text-primary fs-4"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 fw-bold">Personalização do Site</h4>
                            <p class="text-muted small mb-0">Gerencie todo o conteúdo visual e textual da Landing Page</p>
                        </div>
                    </div>
                </div>

                <form id="site-settings-form" action="{{ route('admin.site_settings.update') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body p-0">
                        <div class="d-flex flex-column flex-md-row">
                            <!-- Vertical Navigation Sidebar -->
                            <div class="col-md-3 col-lg-2 border-end bg-body-secondary shadow-sm"
                                style="min-height: 700px;">
                                <div class="p-3 border-bottom mb-2 d-none d-md-block">
                                    <h6 class="text-uppercase fw-bold text-muted extra-small mb-0">Menu de Personalização
                                    </h6>
                                </div>
                                <div class="nav flex-column nav-pills p-3 gap-1" id="siteSettingsTabs" role="tablist"
                                    aria-orientation="vertical">
                                    <button class="nav-link active d-flex align-items-center py-2 px-3 fw-medium border-0"
                                        id="branding-tab" data-bs-toggle="tab" data-bs-target="#branding" type="button"
                                        role="tab">
                                        <i class="bi bi-palette me-2"></i>Identidade Visual
                                    </button>
                                    <button class="nav-link d-flex align-items-center py-2 px-3 fw-medium border-0"
                                        id="hero-tab" data-bs-toggle="tab" data-bs-target="#hero" type="button"
                                        role="tab">
                                        <i class="bi bi-megaphone me-2"></i>Hero (Slides)
                                    </button>
                                    <button class="nav-link d-flex align-items-center py-2 px-3 fw-medium border-0"
                                        id="numbers-tab" data-bs-toggle="tab" data-bs-target="#numbers" type="button"
                                        role="tab">
                                        <i class="bi bi-123 me-2"></i>Números
                                    </button>
                                    <button class="nav-link d-flex align-items-center py-2 px-3 fw-medium border-0"
                                        id="about-tab" data-bs-toggle="tab" data-bs-target="#about" type="button"
                                        role="tab">
                                        <i class="bi bi-info-circle me-2"></i>Sobre & Crédito
                                    </button>
                                    <button class="nav-link d-flex align-items-center py-2 px-3 fw-medium border-0"
                                        id="faq-tab" data-bs-toggle="tab" data-bs-target="#faq" type="button"
                                        role="tab">
                                        <i class="bi bi-question-circle me-2"></i>FAQ & Depoimentos
                                    </button>
                                    <button class="nav-link d-flex align-items-center py-2 px-3 fw-medium border-0"
                                        id="machines-tab" data-bs-toggle="tab" data-bs-target="#machines" type="button"
                                        role="tab">
                                        <i class="bi bi-cpu me-2"></i>Maquininhas
                                    </button>
                                    <button class="nav-link d-flex align-items-center py-2 px-3 fw-medium border-0"
                                        id="legal-tab" data-bs-toggle="tab" data-bs-target="#legal" type="button"
                                        role="tab">
                                        <i class="bi bi-file-earmark-lock me-2"></i>Conteúdo Legal
                                    </button>

                                    <div class="my-2 border-top mx-2"></div>

                                    <button class="nav-link d-flex align-items-center py-2 px-3 fw-medium border-0"
                                        id="buttons-tab" data-bs-toggle="tab" data-bs-target="#buttons" type="button"
                                        role="tab">
                                        <i class="bi bi-link-45deg me-2"></i>Botões & Links
                                    </button>
                                    <button class="nav-link d-flex align-items-center py-2 px-3 fw-medium border-0"
                                        id="social-tab" data-bs-toggle="tab" data-bs-target="#social" type="button"
                                        role="tab">
                                        <i class="bi bi-share me-2"></i>Social & Rodapé
                                    </button>
                                    <button class="nav-link d-flex align-items-center py-2 px-3 fw-medium border-0"
                                        id="location-tab" data-bs-toggle="tab" data-bs-target="#location" type="button"
                                        role="tab">
                                        <i class="bi bi-geo-alt me-2"></i>Mapa & Localização
                                    </button>
                                </div>
                            </div>

                            <!-- Tab Content Area -->
                            <div class="col-md-9 col-lg-10 bg-body">
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm m-4 mb-0"
                                        role="alert">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-success text-white p-2 rounded-circle me-3"
                                                style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-check-lg"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold">Sucesso!</h6>
                                                <p class="mb-0 small">{{ session('success') }}</p>
                                            </div>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                <div class="tab-content p-4" id="siteSettingsTabsContent">
                                    <!-- Identidade Visual -->
                                    <div class="tab-pane fade show active" id="branding" role="tabpanel">
                                        <div class="row g-4">
                                            <div class="col-md-4">
                                                <div
                                                    class="card h-100 border-0 shadow-sm bg-body-secondary rounded-2 overflow-hidden card-hover">
                                                    <div class="card-body p-4">
                                                        <div class="d-flex align-items-center mb-3">
                                                            <i class="bi bi-globe fs-4 text-primary me-3"></i>
                                                            <h6 class="fw-bold mb-0">Logotipo do Site</h6>
                                                        </div>
                                                        <p class="text-muted small mb-4">Exibido no topo do site e
                                                            cabeçalhos de páginas legais.</p>

                                                        <div class="bg-body-emphasis-subtle shadow-sm border-0 d-flex align-items-center justify-content-center"
                                                            style="height: 140px; background-image: radial-gradient(var(--bs-border-color) 1px, transparent 1px); background-size: 20px 20px;">
                                                            @if (isset($settings['logo_site']))
                                                                <img id="preview-logo-site"
                                                                    src="{{ Storage::url($settings['logo_site']) }}"
                                                                    class="img-fluid rounded h-100 object-fit-contain transition-all">
                                                            @else
                                                                <div id="placeholder-logo-site"
                                                                    class="text-muted small d-flex flex-column align-items-center">
                                                                    <i class="bi bi-image fs-1 mb-2"></i>
                                                                    <span>Sem Logotipo</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label
                                                                class="btn btn-outline-primary w-100 rounded-pill btn-sm fw-bold">
                                                                <i class="bi bi-cloud-upload me-2"></i>Alterar Logotipo
                                                                <input type="file" name="logo_site" class="d-none"
                                                                    accept="image/*"
                                                                    onchange="previewImg(this, 'preview-logo-site', 'placeholder-logo-site')">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div
                                                    class="card h-100 border-0 shadow-sm bg-body-secondary rounded-2 overflow-hidden card-hover">
                                                    <div class="card-body p-4">
                                                        <div class="d-flex align-items-center mb-3">
                                                            <i
                                                                class="bi bi-layout-text-sidebar-reverse fs-4 text-indigo me-3"></i>
                                                            <h6 class="fw-bold mb-0">Logotipo do Rodapé</h6>
                                                        </div>
                                                        <p class="text-muted small mb-4">Exibido exclusivamente no rodapé
                                                            dinâmico do site.</p>

                                                        <div class="bg-body-emphasis-subtle shadow-sm border-0 d-flex align-items-center justify-content-center"
                                                            style="height: 140px; background-image: radial-gradient(var(--bs-border-color) 1px, transparent 1px); background-size: 20px 20px;">
                                                            @if (isset($settings['logo_footer']))
                                                                <img id="preview-logo-footer"
                                                                    src="{{ Storage::url($settings['logo_footer']) }}"
                                                                    class="img-fluid rounded h-100 object-fit-contain transition-all">
                                                            @else
                                                                <div id="placeholder-logo-footer"
                                                                    class="text-muted small d-flex flex-column align-items-center">
                                                                    <i class="bi bi-image fs-1 mb-2"></i>
                                                                    <span>Sem Logotipo</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label
                                                                class="btn btn-outline-indigo w-100 rounded-pill btn-sm fw-bold">
                                                                <i class="bi bi-cloud-upload me-2"></i>Alterar Logotipo
                                                                <input type="file" name="logo_footer" class="d-none"
                                                                    accept="image/*"
                                                                    onchange="previewImg(this, 'preview-logo-footer', 'placeholder-logo-footer')">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div
                                                    class="card h-100 border-0 shadow-sm bg-body-secondary rounded-2 overflow-hidden card-hover">
                                                    <div class="card-body p-4">
                                                        <div class="d-flex align-items-center mb-3">
                                                            <i class="bi bi-app-indicator fs-4 text-dark me-3"></i>
                                                            <h6 class="fw-bold mb-0">Favicon (Ícone)</h6>
                                                        </div>
                                                        <p class="text-muted small mb-4">Ícone da aba do navegador.
                                                            Sugerido: PNG quadrado.</p>

                                                        <div class="bg-body-emphasis-subtle shadow-sm border-0 d-flex align-items-center justify-content-center"
                                                            style="height: 140px; background-image: radial-gradient(var(--bs-border-color) 1px, transparent 1px); background-size: 20px 20px;">
                                                            @if (isset($settings['favicon']))
                                                                <img id="preview-favicon-main"
                                                                    src="{{ Storage::url($settings['favicon']) }}"
                                                                    class="img-fluid rounded h-100 object-fit-contain transition-all"
                                                                    style="max-height: 64px;">
                                                            @else
                                                                <div id="placeholder-favicon-main"
                                                                    class="text-muted small d-flex flex-column align-items-center">
                                                                    <i class="bi bi-diamond-half fs-1 mb-2"></i>
                                                                    <span>Sem Ícone</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label
                                                                class="btn btn-outline-dark w-100 rounded-pill btn-sm fw-bold">
                                                                <i class="bi bi-cloud-upload me-2"></i>Alterar Favicon
                                                                <input type="file" name="favicon" class="d-none"
                                                                    accept="image/*"
                                                                    onchange="previewImg(this, 'preview-favicon-main', 'placeholder-favicon-main')">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Hero Section -->
                                    <div class="tab-pane fade" id="hero" role="tabpanel">
                                        <div class="row g-4">
                                            <!-- Slide 1 -->
                                            <div class="col-md-6">
                                                <div
                                                    class="card h-100 border-0 shadow-sm bg-body-secondary rounded-2 overflow-hidden card-hover">
                                                    <div class="card-body p-4">
                                                        <div class="d-flex align-items-center mb-4">
                                                            <i class="bi bi-card-image fs-4 text-primary me-3"></i>
                                                            <h6 class="fw-bold mb-0">Slide 1 (Principal)</h6>
                                                        </div>

                                                        <div class="mb-4">
                                                            <label
                                                                class="form-label small fw-bold text-muted text-uppercase">Título
                                                                Principal</label>
                                                            <textarea name="hero_slide1_title" class="form-control rounded-1" rows="2">{{ $settings['hero_slide1_title'] ?? 'Sua loja com tecnologia de ponta.' }}</textarea>
                                                        </div>
                                                        <div class="mb-4">
                                                            <label
                                                                class="form-label small fw-bold text-muted text-uppercase">Subtítulo
                                                                / Descrição</label>
                                                            <textarea name="hero_slide1_desc" class="form-control rounded-1" rows="3">{{ $settings['hero_slide1_desc'] ?? 'Oferecemos maquininhas modernas e taxas competitivas para simplificar o recebimento das suas vendas no cartão com total suporte.' }}</textarea>
                                                        </div>

                                                        <div class="mb-0">
                                                            <label
                                                                class="form-label small fw-bold text-muted text-uppercase">Imagem
                                                                do Slide</label>
                                                            <div class="bg-body shadow-sm border-0 d-flex align-items-center justify-content-center"
                                                                style="height: 180px;">
                                                                @if (isset($settings['hero_slide1_image']))
                                                                    <img id="preview-hero1"
                                                                        src="{{ Storage::url($settings['hero_slide1_image']) }}"
                                                                        class="img-fluid rounded-1 h-100 object-fit-cover shadow-sm transition-all w-100">
                                                                @else
                                                                    <div id="placeholder-hero1"
                                                                        class="text-muted small d-flex flex-column align-items-center">
                                                                        <i class="bi bi-image fs-2 mb-2"></i>
                                                                        <span>Sem Imagem</span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <label
                                                                class="btn btn-primary btn-sm rounded-pill w-100 fw-bold">
                                                                <i class="bi bi-upload me-2"></i>Subir Nova Imagem
                                                                <input type="file" name="hero_slide1_image"
                                                                    class="d-none" accept="image/*"
                                                                    onchange="previewImg(this, 'preview-hero1', 'placeholder-hero1')">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Slide 2 -->
                                            <div class="col-md-6">
                                                <div
                                                    class="card h-100 border-0 shadow-sm bg-body-secondary rounded-2 overflow-hidden card-hover">
                                                    <div class="card-body p-4">
                                                        <div class="d-flex align-items-center mb-4">
                                                            <i class="bi bi-card-image fs-4 text-success me-3"></i>
                                                            <h6 class="fw-bold mb-0">Slide 2 (Alternativo)</h6>
                                                        </div>

                                                        <div class="mb-4">
                                                            <label
                                                                class="form-label small fw-bold text-muted text-uppercase">Título
                                                                Principal</label>
                                                            <textarea name="hero_slide2_title" class="form-control rounded-1" rows="2">{{ $settings['hero_slide2_title'] ?? 'Troque seu limite por dinheiro vivo.' }}</textarea>
                                                        </div>
                                                        <div class="mb-4">
                                                            <label
                                                                class="form-label small fw-bold text-muted text-uppercase">Subtítulo
                                                                / Descrição</label>
                                                            <textarea name="hero_slide2_desc" class="form-control rounded-1" rows="3">{{ $settings['hero_slide2_desc'] ?? 'Antecipação rápida e sem burocracia para você investir no seu negócio hoje mesmo através do cartão de crédito.' }}</textarea>
                                                        </div>

                                                        <div class="mb-0">
                                                            <label
                                                                class="form-label small fw-bold text-muted text-uppercase">Imagem
                                                                do Slide</label>
                                                            <div class="bg-body shadow-sm border-0 d-flex align-items-center justify-content-center"
                                                                style="height: 180px;">
                                                                @if (isset($settings['hero_slide2_image']))
                                                                    <img id="preview-hero2"
                                                                        src="{{ Storage::url($settings['hero_slide2_image']) }}"
                                                                        class="img-fluid rounded-1 h-100 object-fit-cover shadow-sm transition-all w-100">
                                                                @else
                                                                    <div id="placeholder-hero2"
                                                                        class="text-muted small d-flex flex-column align-items-center">
                                                                        <i class="bi bi-image fs-2 mb-2"></i>
                                                                        <span>Sem Imagem</span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <label
                                                                class="btn btn-success btn-sm rounded-pill w-100 fw-bold">
                                                                <i class="bi bi-upload me-2"></i>Subir Nova Imagem
                                                                <input type="file" name="hero_slide2_image"
                                                                    class="d-none" accept="image/*"
                                                                    onchange="previewImg(this, 'preview-hero2', 'placeholder-hero2')">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Numbers Section -->
                                    <div class="tab-pane fade" id="numbers" role="tabpanel">
                                        <div class="row g-4">
                                            @foreach (range(1, 4) as $i)
                                                @php
                                                    $defaultVals = [
                                                        1 => [
                                                            'val' => '+10k',
                                                            'label' => 'Clientes Satisfeitos',
                                                            'icon' => 'bi-people',
                                                            'color' => 'primary',
                                                        ],
                                                        2 => [
                                                            'val' => '24h',
                                                            'label' => 'Suporte Especializado',
                                                            'icon' => 'bi-headset',
                                                            'color' => 'indigo',
                                                        ],
                                                        3 => [
                                                            'val' => '0%',
                                                            'label' => 'Burocracia no Processo',
                                                            'icon' => 'bi-shield-check',
                                                            'color' => 'success',
                                                        ],
                                                        4 => [
                                                            'val' => '18x',
                                                            'label' => 'Parcelamento Máximo',
                                                            'icon' => 'bi-credit-card-2-front',
                                                            'color' => 'dark',
                                                        ],
                                                    ];
                                                    $currColor = $defaultVals[$i]['color'];
                                                @endphp
                                                <div class="col-md-3">
                                                    <div
                                                        class="card h-100 border-0 shadow-sm bg-body-secondary rounded-2 overflow-hidden card-hover">
                                                        <div class="card-body p-4">
                                                            <div class="d-flex align-items-center mb-3">
                                                                <i
                                                                    class="bi {{ $defaultVals[$i]['icon'] }} fs-4 text-{{ $currColor }} me-3"></i>
                                                                <h6 class="fw-bold mb-0">Métrica {{ $i }}</h6>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label
                                                                    class="form-label small fw-bold text-muted text-uppercase">Valor
                                                                    em Destaque</label>
                                                                <input type="text"
                                                                    name="counter{{ $i }}_val"
                                                                    class="form-control rounded-1" placeholder="Ex: +10k"
                                                                    value="{{ $settings['counter' . $i . '_val'] ?? $defaultVals[$i]['val'] }}">
                                                            </div>
                                                            <div class="mb-0">
                                                                <label
                                                                    class="form-label small fw-bold text-muted text-uppercase">Rótulo
                                                                    / Descrição</label>
                                                                <input type="text"
                                                                    name="counter{{ $i }}_label"
                                                                    class="form-control rounded-1"
                                                                    placeholder="Ex: Clientes Felizes"
                                                                    value="{{ $settings['counter' . $i . '_label'] ?? $defaultVals[$i]['label'] }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- About & Steps Section -->
                                    <div class="tab-pane fade" id="about" role="tabpanel">
                                        <div class="row g-4">
                                            <div class="col-md-7">
                                                <div
                                                    class="card h-100 border-0 shadow-sm bg-body-secondary rounded-2 overflow-hidden card-hover">
                                                    <div class="card-body p-4">
                                                        <div class="d-flex align-items-center mb-4">
                                                            <i class="bi bi-info-circle fs-4 text-primary me-3"></i>
                                                            <h6 class="fw-bold mb-0">Seção Institucional (Sobre)</h6>
                                                        </div>
                                                        <div class="mb-4">
                                                            <label
                                                                class="form-label small fw-bold text-muted text-uppercase">Texto
                                                                Principal (Aceita HTML/Strong)</label>
                                                            <textarea name="about_text" class="form-control rounded-1" rows="8">{{ $settings['about_text'] ?? 'Na PayTech, não oferecemos apenas máquinas; oferecemos uma parceria de crescimento. Nosso foco é conectar você à infraestrutura financeira necessária para que cada venda seja um passo para o próximo nível.' }}</textarea>
                                                        </div>
                                                        <div class="mb-0">
                                                            <label
                                                                class="form-label small fw-bold text-muted text-uppercase">Citação
                                                                em Destaque (Itálico)</label>
                                                            <input type="text" name="about_quote"
                                                                class="form-control rounded-1"
                                                                value="{{ $settings['about_quote'] ?? 'Tecnologia confiável para crescer com eficiência.' }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div
                                                    class="card h-100 border-0 shadow-sm bg-body-secondary rounded-2 overflow-hidden card-hover">
                                                    <div class="card-body p-4">
                                                        <div class="d-flex align-items-center mb-4">
                                                            <i class="bi bi-image fs-4 text-indigo me-3"></i>
                                                            <h6 class="fw-bold mb-0">Imagem de Destaque</h6>
                                                        </div>
                                                        <div class="bg-body shadow-sm border-0 d-flex align-items-center justify-content-center"
                                                            style="height: 250px;">
                                                            @if (isset($settings['about_image']))
                                                                <img id="preview-about"
                                                                    src="{{ Storage::url($settings['about_image']) }}"
                                                                    class="img-fluid rounded-1 h-100 object-fit-cover shadow-sm transition-all w-100">
                                                            @else
                                                                <div id="placeholder-about"
                                                                    class="text-muted small d-flex flex-column align-items-center">
                                                                    <i class="bi bi-image fs-1 mb-2"></i>
                                                                    <span>Sem Imagem</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <label class="btn btn-indigo btn-sm rounded-pill w-100 fw-bold">
                                                            <i class="bi bi-upload me-2"></i>Alterar Imagem
                                                            <input type="file" name="about_image" class="d-none"
                                                                accept="image/*"
                                                                onchange="previewImg(this, 'preview-about', 'placeholder-about')">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 mt-2">
                                                <div class="d-flex align-items-center mb-3 mt-2">
                                                    <i class="bi bi-list-check fs-4 text-dark me-3"></i>
                                                    <h6 class="fw-bold mb-0">Passo a Passo (Fluxo de Crédito)</h6>
                                                </div>
                                                <div class="row g-3">
                                                    @foreach (range(1, 3) as $i)
                                                        @php
                                                            $defaultSteps = [
                                                                1 => [
                                                                    'title' => 'Simulação Digital',
                                                                    'desc' =>
                                                                        'Entre em contato e diga o valor que você deseja antecipar.',
                                                                ],
                                                                2 => [
                                                                    'title' => 'Aprovação Transparente',
                                                                    'desc' =>
                                                                        'Passamos o valor no cartão em nossas máquinas seguras.',
                                                                ],
                                                                3 => [
                                                                    'title' => 'Recebimento Instantâneo',
                                                                    'desc' =>
                                                                        'O dinheiro cai na sua conta via PIX em poucos minutos.',
                                                                ],
                                                            ];
                                                        @endphp
                                                        <div class="col-md-4">
                                                            <div
                                                                class="card h-100 border-0 shadow-sm bg-body-secondary rounded-2 overflow-hidden card-hover">
                                                                <div class="card-body p-4 text-center">
                                                                    <div class="bg-body-secondary text-emphasis shadow-sm rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                                                        style="width: 48px; height: 48px; font-weight: 900; font-size: 1.2rem;">
                                                                        {{ $i }}
                                                                    </div>
                                                                    <div class="mb-3 text-start">
                                                                        <label
                                                                            class="form-label small fw-bold text-muted text-uppercase">Título
                                                                            do Passo</label>
                                                                        <input type="text"
                                                                            name="credit_step{{ $i }}_title"
                                                                            class="form-control rounded-1"
                                                                            value="{{ $settings['credit_step' . $i . '_title'] ?? $defaultSteps[$i]['title'] }}">
                                                                    </div>
                                                                    <div class="text-start">
                                                                        <label
                                                                            class="form-label small fw-bold text-muted text-uppercase">Descrição
                                                                            Curta</label>
                                                                        <textarea name="credit_step{{ $i }}_desc" class="form-control rounded-1" rows="2">{{ $settings['credit_step' . $i . '_desc'] ?? $defaultSteps[$i]['desc'] }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- FAQ & Testimonials -->
                                    <div class="tab-pane fade" id="faq" role="tabpanel">
                                        <div class="row g-4">
                                            <!-- FAQ Section -->
                                            <div class="col-md-6">
                                                <div
                                                    class="card h-100 border-0 shadow-sm bg-body-secondary rounded-2 overflow-hidden card-hover">
                                                    <div class="card-body p-4">
                                                        <div class="d-flex align-items-center mb-4">
                                                            <i class="bi bi-question-circle fs-4 text-primary me-3"></i>
                                                            <h6 class="fw-bold mb-0">Dúvidas Frequentes (FAQ)</h6>
                                                        </div>
                                                        @foreach (range(1, 3) as $i)
                                                            @php
                                                                $defaultFaqs = [
                                                                    1 => [
                                                                        'q' => 'Como funciona a antecipação?',
                                                                        'a' =>
                                                                            'Utilizamos o limite disponível do seu cartão de crédito para gerar um saldo em conta por meio de um link de pagamento seguro.',
                                                                    ],
                                                                    2 => [
                                                                        'q' => 'Em quanto tempo recebo o dinheiro?',
                                                                        'a' =>
                                                                            'Assim que a transação for aprovada pelo seu cartão, o PIX é enviado imediatamente para sua conta, levando em média 5 a 10 minutos.',
                                                                    ],
                                                                    3 => [
                                                                        'q' => 'É seguro realizar o processo?',
                                                                        'a' =>
                                                                            'Sim, utilizamos plataformas de pagamento certificadas e links seguros. O processo é transparente e acompanhado por nossa equipe.',
                                                                    ],
                                                                ];
                                                            @endphp
                                                            <div
                                                                class="bg-body-secondary rounded-2 p-4 mb-4 shadow-sm border-0">
                                                                <div class="mb-3">
                                                                    <label
                                                                        class="form-label small fw-bold text-muted text-uppercase">Pergunta
                                                                        {{ $i }}</label>
                                                                    <input type="text" name="faq{{ $i }}_q"
                                                                        class="form-control rounded-1 bg-body"
                                                                        value="{{ $settings['faq' . $i . '_q'] ?? $defaultFaqs[$i]['q'] }}">
                                                                </div>
                                                                <div class="mb-0">
                                                                    <label
                                                                        class="form-label small fw-bold text-muted text-uppercase">Resposta
                                                                        {{ $i }}</label>
                                                                    <textarea name="faq{{ $i }}_a" class="form-control rounded-1 bg-body" rows="2">{{ $settings['faq' . $i . '_a'] ?? $defaultFaqs[$i]['a'] }}</textarea>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Testimonials Section -->
                                            <div class="col-md-6">
                                                <div
                                                    class="card h-100 border-0 shadow-sm bg-body-secondary rounded-2 overflow-hidden card-hover">
                                                    <div class="card-body p-4">
                                                        <div class="d-flex align-items-center mb-4">
                                                            <i class="bi bi-star-fill fs-4 text-warning me-3"></i>
                                                            <h6 class="fw-bold mb-0">Depoimentos de Parceiros</h6>
                                                        </div>
                                                        @foreach (range(1, 4) as $i)
                                                            @php
                                                                $defaultTestimonials = [
                                                                    1 => [
                                                                        'name' => 'Ricardo Silva',
                                                                        'role' => 'Comerciante',
                                                                        'text' =>
                                                                            'A antecipação salvou meu capital de giro. Processo rápido e dinheiro na conta em minutos.',
                                                                    ],
                                                                    2 => [
                                                                        'name' => 'Mariana Costa',
                                                                        'role' => 'Dona de Loja',
                                                                        'text' =>
                                                                            'As taxas são muito justas e o atendimento é excelente. Recomendo para todos os parceiros.',
                                                                    ],
                                                                    3 => [
                                                                        'name' => 'Ana Pereira',
                                                                        'role' => 'Loja de Roupas',
                                                                        'text' =>
                                                                            'A troca de limite me salvou em um momento crítico de fluxo de caixa.',
                                                                    ],
                                                                    4 => [
                                                                        'name' => 'Marcos Oliveira',
                                                                        'role' => 'Oficina do Marcos',
                                                                        'text' =>
                                                                            'Uso a PayTech há dois anos e nunca tive problemas com suporte.',
                                                                    ],
                                                                ];
                                                            @endphp
                                                            <div
                                                                class="bg-body-secondary rounded-2 p-4 mb-4 shadow-sm border-0">
                                                                <div class="row g-3">
                                                                    <div class="col-md-6">
                                                                        <label
                                                                            class="form-label small fw-bold text-muted text-uppercase">Nome</label>
                                                                        <input type="text"
                                                                            name="testimonial{{ $i }}_name"
                                                                            class="form-control rounded-1 bg-body"
                                                                            value="{{ $settings['testimonial' . $i . '_name'] ?? $defaultTestimonials[$i]['name'] }}">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label
                                                                            class="form-label small fw-bold text-muted text-uppercase">Cargo
                                                                            / Empresa</label>
                                                                        <input type="text"
                                                                            name="testimonial{{ $i }}_role"
                                                                            class="form-control rounded-1 bg-body"
                                                                            value="{{ $settings['testimonial' . $i . '_role'] ?? $defaultTestimonials[$i]['role'] }}">
                                                                    </div>
                                                                    <div class="col-12 mt-2">
                                                                        <label
                                                                            class="form-label small fw-bold text-muted text-uppercase">Texto
                                                                            do Depoimento</label>
                                                                        <textarea name="testimonial{{ $i }}_text" class="form-control rounded-1 bg-body" rows="2">{{ $settings['testimonial' . $i . '_text'] ?? $defaultTestimonials[$i]['text'] }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Maquininhas Section -->
                                    <div class="tab-pane fade" id="machines" role="tabpanel">
                                        <div class="row g-4">
                                            @php
                                                $defaultMachines = [
                                                    1 => [
                                                        'name' => 'Moderninha Profit',
                                                        'desc' => 'O melhor custo-benefício',
                                                        'color' => 'danger',
                                                    ],
                                                    2 => [
                                                        'name' => 'Moderninha Pro 2',
                                                        'desc' => 'Mais completa, mais rápida',
                                                        'color' => 'primary',
                                                    ],
                                                    3 => [
                                                        'name' => 'Moderninha Smart 2',
                                                        'desc' => 'Sua loja num Smart Checkout',
                                                        'color' => 'success',
                                                    ],
                                                ];
                                            @endphp
                                            @foreach (range(1, 3) as $i)
                                                <div class="col-md-4">
                                                    <div
                                                        class="card h-100 border-0 shadow-sm bg-body-secondary rounded-2 overflow-hidden card-hover">
                                                        <div class="card-body p-4">
                                                            <div class="d-flex align-items-center mb-4">
                                                                <i
                                                                    class="bi bi-phone-vibrate fs-4 text-{{ $defaultMachines[$i]['color'] }} me-3"></i>
                                                                <h6 class="fw-bold mb-0">Máquina {{ $i }}</h6>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label
                                                                    class="form-label small fw-bold text-muted text-uppercase">Nome
                                                                    da Máquina</label>
                                                                <input type="text"
                                                                    name="machine{{ $i }}_name"
                                                                    class="form-control rounded-1"
                                                                    value="{{ $settings['machine' . $i . '_name'] ?? $defaultMachines[$i]['name'] }}">
                                                            </div>
                                                            <div class="mb-4">
                                                                <label
                                                                    class="form-label small fw-bold text-muted text-uppercase">Descrição
                                                                    / Slogan</label>
                                                                <input type="text"
                                                                    name="machine{{ $i }}_desc"
                                                                    class="form-control rounded-1"
                                                                    value="{{ $settings['machine' . $i . '_desc'] ?? $defaultMachines[$i]['desc'] }}">
                                                            </div>
                                                            <div class="mb-0">
                                                                <label
                                                                    class="form-label small fw-bold text-muted text-uppercase">Imagem
                                                                    do Produto</label>
                                                                <div class="bg-body-tertiary shadow-sm border-0 rounded-2 p-3 mb-3 d-flex align-items-center justify-content-center"
                                                                    style="height: 180px;">
                                                                    @if (isset($settings['machine' . $i . '_image']))
                                                                        <img id="preview-machine{{ $i }}"
                                                                            src="{{ Storage::url($settings['machine' . $i . '_image']) }}"
                                                                            class="img-fluid rounded-1 h-100 object-fit-contain transition-all"
                                                                            style="filter: drop-shadow(0 10px 15px rgba(0,0,0,0.1));">
                                                                    @else
                                                                        <div id="placeholder-machine{{ $i }}"
                                                                            class="text-muted small d-flex flex-column align-items-center">
                                                                            <i class="bi bi-phone fs-1 mb-2"></i>
                                                                            <span>Sem Imagem</span>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <label
                                                                    class="btn btn-outline-{{ $defaultMachines[$i]['color'] }} btn-sm rounded-pill w-100 fw-bold">
                                                                    <i class="bi bi-upload me-2"></i>Trocar Imagem
                                                                    <input type="file"
                                                                        name="machine{{ $i }}_image"
                                                                        class="d-none" accept="image/*"
                                                                        onchange="previewImg(this, 'preview-machine{{ $i }}', 'placeholder-machine{{ $i }}')">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Legal Content Section -->
                                    <div class="tab-pane fade" id="legal" role="tabpanel">
                                        <div class="row g-4">
                                            <div class="col-12">
                                                <div
                                                    class="card border-0 shadow-sm bg-body-secondary rounded-2 overflow-hidden card-hover">
                                                    <div class="card-body p-4">
                                                        <div class="d-flex align-items-center mb-4">
                                                            <i class="bi bi-file-earmark-text fs-4 text-indigo me-3"></i>
                                                            <div>
                                                                <h6 class="fw-bold mb-0">Jurídico & Compliance</h6>
                                                                <p class="text-muted small mb-0">Gerencie os termos de uso
                                                                    e políticas da plataforma.</p>
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="bg-body-tertiary shadow-sm border-0 rounded-1 p-4 mb-4">
                                                            <label
                                                                class="form-label small fw-bold text-muted text-uppercase d-flex align-items-center mb-3">
                                                                <i
                                                                    class="bi bi-shield-check me-2 text-primary"></i>Conteúdo
                                                                dos Termos de Uso
                                                            </label>
                                                            <textarea name="legal_terms_content" id="summernote-terms" class="form-control rounded-1 bg-body" rows="15">{{ $settings['legal_terms_content'] ?? 'Escreva aqui os termos de uso da sua plataforma...' }}</textarea>
                                                        </div>

                                                        <div
                                                            class="bg-body-tertiary shadow-sm border-0 rounded-1 p-4 mb-0">
                                                            <label
                                                                class="form-label small fw-bold text-muted text-uppercase d-flex align-items-center mb-3">
                                                                <i class="bi bi-lock me-2 text-success"></i>Conteúdo da
                                                                Política de Privacidade
                                                            </label>
                                                            <textarea name="legal_privacy_content" id="summernote-privacy" class="form-control rounded-1 bg-body"
                                                                rows="15">{{ $settings['legal_privacy_content'] ?? 'Escreva aqui a política de privacidade da sua plataforma...' }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Botões & Links -->
                                    <div class="tab-pane fade" id="buttons" role="tabpanel">
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <div
                                                    class="card h-100 border-0 shadow-sm bg-body-secondary rounded-2 overflow-hidden card-hover">
                                                    <div class="card-body p-4">
                                                        <div class="d-flex align-items-center mb-4">
                                                            <i class="bi bi-cursor-fill fs-4 text-primary me-3"></i>
                                                            <h6 class="fw-bold mb-0">Cabeçalho & Hero</h6>
                                                        </div>

                                                        <div
                                                            class="bg-body-tertiary shadow-sm border-0 rounded-2 p-4 mb-4">
                                                            <label
                                                                class="form-label small fw-bold text-muted text-uppercase mb-3">Botão
                                                                Menu Superior</label>
                                                            <div
                                                                class="input-group mb-2 shadow-sm rounded-1 overflow-hidden">
                                                                <span
                                                                    class="input-group-text border-0 bg-body rounded-0 extra-small fw-bold text-muted"
                                                                    style="width: 70px;">Texto</span>
                                                                <input type="text" name="header_cta_text"
                                                                    class="form-control border-0 bg-body rounded-0"
                                                                    value="{{ $settings['header_cta_text'] ?? 'Falar com Especialista' }}">
                                                            </div>
                                                            <div class="input-group shadow-sm rounded-1 overflow-hidden">
                                                                <span
                                                                    class="input-group-text border-0 bg-body rounded-0 extra-small fw-bold text-muted"
                                                                    style="width: 70px;">URL</span>
                                                                <input type="text" name="header_cta_url"
                                                                    class="form-control border-0 bg-body rounded-0"
                                                                    value="{{ $settings['header_cta_url'] ?? '#' }}">
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="bg-body-tertiary shadow-sm border-0 rounded-2 p-4 mb-4">
                                                            <label
                                                                class="form-label small fw-bold text-muted text-uppercase mb-3">Hero
                                                                Slide 1 - Primário</label>
                                                            <div
                                                                class="input-group mb-2 shadow-sm rounded-1 overflow-hidden">
                                                                <span
                                                                    class="input-group-text border-0 bg-body rounded-0 extra-small fw-bold text-muted"
                                                                    style="width: 70px;">Texto</span>
                                                                <input type="text" name="hero_slide1_btn1_text"
                                                                    class="form-control border-0 bg-body rounded-0"
                                                                    value="{{ $settings['hero_slide1_btn1_text'] ?? 'Pedir Agora' }}">
                                                            </div>
                                                            <div class="input-group shadow-sm rounded-1 overflow-hidden">
                                                                <span
                                                                    class="input-group-text border-0 bg-body rounded-0 extra-small fw-bold text-muted"
                                                                    style="width: 70px;">URL</span>
                                                                <input type="text" name="hero_slide1_btn1_url"
                                                                    class="form-control border-0 bg-body rounded-0"
                                                                    value="{{ $settings['hero_slide1_btn1_url'] ?? '#' }}">
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="bg-body-tertiary shadow-sm border-0 rounded-2 p-4 mb-0">
                                                            <label
                                                                class="form-label small fw-bold text-muted text-uppercase mb-3">Hero
                                                                Slide 2 - Principal</label>
                                                            <div
                                                                class="input-group mb-2 shadow-sm rounded-1 overflow-hidden">
                                                                <span
                                                                    class="input-group-text border-0 bg-body rounded-0 extra-small fw-bold text-muted"
                                                                    style="width: 70px;">Texto</span>
                                                                <input type="text" name="hero_slide2_btn_text"
                                                                    class="form-control border-0 bg-body rounded-0"
                                                                    value="{{ $settings['hero_slide2_btn_text'] ?? 'Simular PIX Agora' }}">
                                                            </div>
                                                            <div class="input-group shadow-sm rounded-1 overflow-hidden">
                                                                <span
                                                                    class="input-group-text border-0 bg-body rounded-0 extra-small fw-bold text-muted"
                                                                    style="width: 70px;">URL</span>
                                                                <input type="text" name="hero_slide2_btn_url"
                                                                    class="form-control border-0 bg-body rounded-0"
                                                                    value="{{ $settings['hero_slide2_btn_url'] ?? '#' }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div
                                                    class="card h-100 border-0 shadow-sm bg-body-secondary rounded-2 overflow-hidden card-hover">
                                                    <div class="card-body p-4">
                                                        <div class="d-flex align-items-center mb-4">
                                                            <i class="bi bi-lightning-charge fs-4 text-dark me-3"></i>
                                                            <h6 class="fw-bold mb-0">Seções Internas</h6>
                                                        </div>

                                                        <div
                                                            class="bg-body-tertiary shadow-sm border-0 rounded-2 p-4 mb-4">
                                                            <label
                                                                class="form-label small fw-bold text-muted text-uppercase mb-1">Seção
                                                                de Crédito</label>
                                                            <p class="extra-small text-muted mb-3">Botão principal da área
                                                                de antecipação.</p>
                                                            <div
                                                                class="input-group mb-2 shadow-sm rounded-1 overflow-hidden">
                                                                <span
                                                                    class="input-group-text border-0 bg-body rounded-0 extra-small fw-bold text-muted"
                                                                    style="width: 70px;">Texto</span>
                                                                <input type="text" name="credit_cta_text"
                                                                    class="form-control border-0 bg-body rounded-0"
                                                                    value="{{ $settings['credit_cta_text'] ?? 'Solicitar agora no WhatsApp' }}">
                                                            </div>
                                                            <div class="input-group shadow-sm rounded-1 overflow-hidden">
                                                                <span
                                                                    class="input-group-text border-0 bg-body rounded-0 extra-small fw-bold text-muted"
                                                                    style="width: 70px;">URL</span>
                                                                <input type="text" name="credit_cta_url"
                                                                    class="form-control border-0 bg-body rounded-0"
                                                                    value="{{ $settings['credit_cta_url'] ?? '#' }}">
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="bg-body-tertiary shadow-sm border-0 rounded-2 p-4 mb-4">
                                                            <label
                                                                class="form-label small fw-bold text-muted text-uppercase mb-1">Maquininhas</label>
                                                            <p class="extra-small text-muted mb-3">CTA global para todos os
                                                                cards de maquininhas.</p>
                                                            <div
                                                                class="input-group mb-2 shadow-sm rounded-1 overflow-hidden">
                                                                <span
                                                                    class="input-group-text border-0 bg-body rounded-0 extra-small fw-bold text-muted"
                                                                    style="width: 70px;">Texto</span>
                                                                <input type="text" name="machines_cta_text"
                                                                    class="form-control border-0 bg-body rounded-0"
                                                                    value="{{ $settings['machines_cta_text'] ?? 'Solicitar Agora' }}">
                                                            </div>
                                                            <div class="input-group shadow-sm rounded-1 overflow-hidden">
                                                                <span
                                                                    class="input-group-text border-0 bg-body rounded-0 extra-small fw-bold text-muted"
                                                                    style="width: 70px;">URL</span>
                                                                <input type="text" name="machines_cta_url"
                                                                    class="form-control border-0 bg-body rounded-0"
                                                                    value="{{ $settings['machines_cta_url'] ?? '#' }}">
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="bg-body-tertiary shadow-sm border-0 rounded-2 p-4 mb-0">
                                                            <label
                                                                class="form-label small fw-bold text-muted text-uppercase mb-2">Rodapé
                                                                (Institucional)</label>
                                                            <div class="input-group shadow-sm rounded-1 overflow-hidden">
                                                                <span
                                                                    class="input-group-text border-0 bg-body rounded-0 extra-small fw-bold text-muted">Texto
                                                                    Link</span>
                                                                <input type="text" name="careers_button_text"
                                                                    class="form-control border-0 bg-body rounded-0"
                                                                    value="{{ $settings['careers_button_text'] ?? 'Trabalhe Conosco' }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Social & Footer -->
                                    <div class="tab-pane fade" id="social" role="tabpanel">
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <div
                                                    class="card h-100 border-0 shadow-sm bg-body-secondary rounded-2 overflow-hidden card-hover">
                                                    <div class="card-body p-4">
                                                        <div class="d-flex align-items-center mb-4">
                                                            <i class="bi bi-share fs-4 text-primary me-3"></i>
                                                            <h6 class="fw-bold mb-0">Links Sociais</h6>
                                                        </div>

                                                        <div
                                                            class="bg-body-tertiary shadow-sm border-0 rounded-2 p-4 mb-4">
                                                            <label
                                                                class="form-label small fw-bold text-muted text-uppercase d-flex align-items-center mb-3">
                                                                <i class="bi bi-instagram me-2"></i>Instagram
                                                            </label>
                                                            <input type="text" name="social_instagram"
                                                                class="form-control rounded-1 bg-body"
                                                                value="{{ $settings['social_instagram'] ?? 'https://instagram.com/paytech' }}"
                                                                placeholder="https://instagram.com/seu-perfil">
                                                        </div>

                                                        <div
                                                            class="bg-body-tertiary shadow-sm border-0 rounded-2 p-4 mb-0">
                                                            <label
                                                                class="form-label small fw-bold text-muted text-uppercase d-flex align-items-center mb-3">
                                                                <i class="bi bi-facebook me-2"></i>Facebook
                                                            </label>
                                                            <input type="text" name="social_facebook"
                                                                class="form-control rounded-1 bg-body"
                                                                value="{{ $settings['social_facebook'] ?? 'https://facebook.com/paytech' }}"
                                                                placeholder="https://facebook.com/sua-pagina">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div
                                                    class="card h-100 border-0 shadow-sm bg-body-secondary rounded-2 overflow-hidden card-hover">
                                                    <div class="card-body p-4">
                                                        <div class="d-flex align-items-center mb-4">
                                                            <i class="bi bi-file-earmark-text fs-4 text-dark me-3"></i>
                                                            <h6 class="fw-bold mb-0">Links Rápidos & Jurídico</h6>
                                                        </div>

                                                        <div
                                                            class="bg-body-tertiary shadow-sm border-0 rounded-2 p-4 mb-4">
                                                            <div class="mb-3">
                                                                <label
                                                                    class="form-label extra-small fw-bold text-muted text-uppercase">Link
                                                                    Termos de Uso</label>
                                                                <input type="text" name="terms_of_use_link"
                                                                    class="form-control rounded-1 border-0 bg-body-tertiary shadow-none"
                                                                    value="{{ $settings['terms_of_use_link'] ?? '#' }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label
                                                                    class="form-label extra-small fw-bold text-muted text-uppercase">Link
                                                                    Política de Privacidade</label>
                                                                <input type="text" name="privacy_policy_link"
                                                                    class="form-control rounded-1 border-0 bg-body-tertiary shadow-none"
                                                                    value="{{ $settings['privacy_policy_link'] ?? '#' }}">
                                                            </div>
                                                            <div class="mb-0">
                                                                <label
                                                                    class="form-label extra-small fw-bold text-muted text-uppercase">Link
                                                                    Trabalhe Conosco</label>
                                                                <input type="text" name="careers_link"
                                                                    class="form-control rounded-1 border-0 bg-body-tertiary shadow-none"
                                                                    value="{{ $settings['careers_link'] ?? '#' }}">
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="bg-body-tertiary shadow-sm border-0 rounded-2 p-4 mb-0">
                                                            <label
                                                                class="form-label small fw-bold text-muted text-uppercase mb-2">Aviso
                                                                Legal (Footer)</label>
                                                            <textarea name="footer_legal_notice" class="form-control rounded-1 bg-body" rows="3">{{ $settings['footer_legal_notice'] ?? 'A PayTech é uma plataforma facilitadora de pagamentos. Não somos uma instituição financeira.' }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Mapa & Localização -->
                                    <div class="tab-pane fade" id="location" role="tabpanel">
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <div
                                                    class="card h-100 border-0 shadow-sm bg-body-secondary rounded-2 overflow-hidden card-hover">
                                                    <div class="card-body p-4">
                                                        <div class="d-flex align-items-center mb-4">
                                                            <i class="bi bi-geo-alt-fill fs-4 text-primary me-3"></i>
                                                            <h6 class="fw-bold mb-0">Botão de Localização</h6>
                                                        </div>

                                                        <div
                                                            class="bg-body-tertiary shadow-sm border-0 rounded-2 p-4 mb-4">
                                                            <div class="mb-3">
                                                                <label
                                                                    class="form-label extra-small fw-bold text-muted text-uppercase">Texto
                                                                    do Botão</label>
                                                                <input type="text" name="map_button_text"
                                                                    class="form-control rounded-1 border-0 bg-body-tertiary shadow-none"
                                                                    value="{{ $settings['map_button_text'] ?? 'Como Chegar' }}">
                                                            </div>
                                                            <div class="mb-0">
                                                                <label
                                                                    class="form-label extra-small fw-bold text-muted text-uppercase">URL
                                                                    Google Maps (Botão)</label>
                                                                <input type="text" name="map_button_url"
                                                                    class="form-control rounded-1 border-0 bg-body-tertiary shadow-none"
                                                                    value="{{ $settings['map_button_url'] ?? 'https://maps.google.com' }}">
                                                                <div class="extra-small text-muted mt-2">
                                                                    <i class="bi bi-info-circle me-1"></i>Link destino ao
                                                                    clicar no botão.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div
                                                    class="card h-100 border-0 shadow-sm bg-body-secondary rounded-2 overflow-hidden card-hover">
                                                    <div class="card-body p-4">
                                                        <div class="d-flex align-items-center mb-4">
                                                            <i class="bi bi-map fs-4 text-danger me-3"></i>
                                                            <h6 class="fw-bold mb-0">Mapa Interativo (Embed)</h6>
                                                        </div>

                                                        <div
                                                            class="bg-body-tertiary shadow-sm border-0 rounded-2 p-4 mb-0">
                                                            <label
                                                                class="form-label small fw-bold text-muted text-uppercase mb-2">Google
                                                                Maps Embed (URL ou Iframe)</label>
                                                            <textarea name="google_maps_embed_url" class="form-control rounded-1 bg-body" rows="5"
                                                                placeholder="Cole aqui o código do iframe ou apenas a URL src...">{{ $settings['google_maps_embed_url'] ?? '' }}</textarea>
                                                            <div
                                                                class="extra-small text-muted mt-3 p-2 bg-body-tertiary rounded-1">
                                                                <i class="bi bi-lightbulb me-1 text-warning"></i>
                                                                <strong>Dica:</strong> Vá ao Google Maps -> Compartilhar ->
                                                                Incorporar mapa.
                                                                Nosso sistema extrairá automaticamente a URL correta se você
                                                                colar o código completo.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-body-secondary text-end py-3 px-4">
                        <button type="submit" id="btn-save-settings"
                            class="btn btn-primary rounded-pill px-5 fw-bold shadow-sm">
                            <span class="btn-text"><i class="bi bi-save me-2"></i>Salvar Personalização do Site</span>
                            <span class="btn-loader d-none">
                                <span class="spinner-border spinner-border-sm me-2" role="status"
                                    aria-hidden="true"></span>
                                Salvando...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Force Summernote styles to show properly in Bootstrap 5 */
        .note-editor.note-frame {
            border: 1px solid #e2e8f0 !important;
            border-radius: 1rem !important;
            overflow: hidden !important;
            background: white !important;
        }

        .note-toolbar {
            background: #f8fafc !important;
            border-bottom: 1px solid #e2e8f0 !important;
            padding: 10px !important;
        }

        .note-editable {
            background: #fff !important;
            padding: 30px !important;
            color: #000 !important;
            min-height: 400px !important;
            font-family: inherit !important;
            line-height: 1.6 !important;
        }

        /* REGRAS ULTRA ESPECÍFICAS PARA GARANTIR FORMATAÇÃO NO FORMULÁRIO */
        #site-settings-form .note-editable b,
        #site-settings-form .note-editable strong {
            font-weight: 900 !important;
            color: #000 !important;
            display: inline;
        }

        #site-settings-form .note-editable i,
        #site-settings-form .note-editable em {
            font-style: italic !important;
            display: inline;
        }

        #site-settings-form .note-editable h1 {
            font-size: 2.5rem !important;
            font-weight: 900 !important;
            margin-bottom: 1rem !important;
            display: block;
        }

        #site-settings-form .note-editable h2 {
            font-size: 2rem !important;
            font-weight: 800 !important;
            margin-bottom: 0.75rem !important;
            display: block;
        }

        #site-settings-form .note-editable h3 {
            font-size: 1.5rem !important;
            font-weight: 700 !important;
            margin-bottom: 0.5rem !important;
            display: block;
        }

        #site-settings-form .note-editable h4 {
            font-size: 1.25rem !important;
            font-weight: 600 !important;
            margin-bottom: 0.5rem !important;
            display: block;
        }

        #site-settings-form .note-editable h5 {
            font-size: 1rem !important;
            font-weight: 600 !important;
            margin-bottom: 0.5rem !important;
            display: block;
        }

        #site-settings-form .note-editable h6 {
            font-size: 0.875rem !important;
            font-weight: 600 !important;
            margin-bottom: 0.5rem !important;
            display: block;
        }

        #site-settings-form .note-editable ul {
            list-style-type: disc !important;
            padding-left: 2rem !important;
            margin-bottom: 1rem !important;
            display: block;
        }

        #site-settings-form .note-editable ol {
            list-style-type: decimal !important;
            padding-left: 2rem !important;
            margin-bottom: 1rem !important;
            display: block;
        }

        #site-settings-form .note-editable li {
            margin-bottom: 0.25rem !important;
            display: list-item !important;
        }

        #site-settings-form .note-editable p {
            margin-bottom: 1rem !important;
            display: block;
        }

        #site-settings-form .note-editable u {
            text-decoration: underline !important;
            display: inline;
        }

        .nav-pills .nav-link {
            color: #64748b;
            border-radius: 0.75rem;
            transition: all 0.2s ease;
            text-align: left;
        }

        .nav-pills .nav-link:hover {
            background-color: rgba(99, 102, 241, 0.05);
            color: #4f46e5;
        }

        .nav-pills .nav-link.active {
            background-color: #4f46e5 !important;
            color: #fff !important;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
        }

        .card-hover {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
        }

        .border-dashed {
            border: 1px dashed var(--bs-border-color) !important;
        }

        .transition-all {
            transition: all 0.3s ease;
        }

        .extra-small {
            font-size: 0.7rem;
        }

        .bg-indigo {
            background-color: #6366f1 !important;
        }

        .text-indigo {
            color: #6366f1 !important;
        }

        .btn-outline-indigo {
            color: #6366f1;
            border-color: #6366f1;
        }

        .btn-outline-indigo:hover {
            background-color: #6366f1;
            color: white;
        }
    </style>


    @push('scripts')
        <script>
            window.addEventListener('load', function() {
                if (typeof $ !== 'undefined') {
                    $('#summernote-terms, #summernote-privacy').summernote({
                        placeholder: 'Escreva e formate seu conteúdo aqui...',
                        tabsize: 2,
                        height: 400,
                        toolbar: [
                            ['style', ['style']],
                            ['font', ['bold', 'underline', 'clear']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['table', ['table']],
                            ['insert', ['link']],
                            ['view', ['fullscreen', 'codeview', 'help']]
                        ]
                    });
                }

                document.getElementById('site-settings-form').addEventListener('submit', function(e) {
                    e.preventDefault();

                    const form = this;

                    // Sync Summernote content to textareas
                    if (typeof $ !== 'undefined' && $.fn.summernote) {
                        $('#summernote-terms, #summernote-privacy').each(function() {
                            $(this).val($(this).summernote('code'));
                        });
                    }

                    const btn = document.getElementById('btn-save-settings');
                    const btnText = btn.querySelector('.btn-text');
                    const btnLoader = btn.querySelector('.btn-loader');
                    const formData = new FormData(form);

                    // Show loading
                    btn.disabled = true;
                    btnText.classList.add('d-none');
                    btnLoader.classList.remove('d-none');

                    fetch(form.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                if (window.Toast) {
                                    Toast.fire({
                                        icon: 'success',
                                        title: data.message || 'Sucesso!'
                                    });
                                } else if (window.Swal) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Sucesso!',
                                        text: data.message,
                                        timer: 2000,
                                        showConfirmButton: false
                                    });
                                } else {
                                    alert(data.message);
                                }
                            } else {
                                alert('Erro ao salvar as configurações.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Ocorreu um erro inesperado.');
                        })
                        .finally(() => {
                            // Hide loading
                            btn.disabled = false;
                            btnText.classList.remove('d-none');
                            btnLoader.classList.add('d-none');
                        });
                });
            });

            function previewImg(input, previewId, placeholderId) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var preview = document.getElementById(previewId);
                        var placeholder = document.getElementById(placeholderId);

                        if (preview) {
                            preview.src = e.target.result;
                            preview.classList.remove('d-none');
                        } else {
                            // Create image if it doesn't exist
                            var container = placeholder.parentElement;
                            placeholder.remove();
                            var img = document.createElement('img');
                            img.id = previewId;
                            img.src = e.target.result;
                            img.className = 'img-fluid rounded h-100 object-fit-cover shadow-sm';
                            container.appendChild(img);
                        }
                        if (placeholder) placeholder.classList.add('d-none');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            // Active tab persistence
            document.addEventListener('DOMContentLoaded', function() {
                var activeTab = localStorage.getItem('siteSettingsActiveTab');
                if (activeTab) {
                    var tabEl = document.querySelector('button[data-bs-target="' + activeTab + '"]');
                    if (tabEl) {
                        var tab = new bootstrap.Tab(tabEl);
                        tab.show();
                    }
                }

                var tabButtons = document.querySelectorAll('button[data-bs-toggle="tab"]');
                tabButtons.forEach(function(btn) {
                    btn.addEventListener('shown.bs.tab', function(e) {
                        localStorage.setItem('siteSettingsActiveTab', e.target.getAttribute(
                            'data-bs-target'));
                    });
                });
            });
        </script>
    @endpush
@endsection
