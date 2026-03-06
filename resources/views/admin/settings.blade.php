@extends('admin.layout')

@section('page_title', 'Configurações do Sistema')

@section('content')
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="card card-primary card-outline shadow-sm">
                <div class="card-header py-3">
                    <h3 class="card-title fw-bold"><i class="bi bi-sliders me-2"></i>Personalização do Sistema</h3>
                </div>
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body p-4">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4"
                                role="alert">
                                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Identidade Visual -->
                        <div class="row g-4 mb-5">
                            <div class="col-12">
                                <h5 class="fw-bold text-primary border-bottom pb-2 mb-4">
                                    <i class="bi bi-palette me-2"></i>Identidade Visual (Logotipos)
                                </h5>
                            </div>

                            {{-- Logo Sistema --}}
                            <div class="col-md-3 text-center">
                                <div class="p-3 border rounded-4 bg-light h-100 d-flex flex-column align-items-center">
                                    <label class="form-label small fw-bold text-muted text-uppercase mb-3">Painel
                                        Admin</label>
                                    <div class="bg-white rounded p-2 mb-3 d-flex align-items-center justify-content-center"
                                        style="width: 100%; height: 80px; border: 1px dashed #ccc;">
                                        @if (isset($settings['logo_system']))
                                            <img id="preview-system" src="{{ Storage::url($settings['logo_system']) }}"
                                                alt="Logo Sistema" class="img-fluid" style="max-height: 60px;">
                                        @else
                                            <div id="placeholder-system" class="text-muted small"
                                                style="font-size: 0.7rem;">Sem Logo</div>
                                        @endif
                                    </div>
                                    <input type="file" name="logo_system" class="form-control form-control-sm"
                                        accept="image/*"
                                        onchange="previewImg(this, 'preview-system', 'placeholder-system')">
                                </div>
                            </div>

                            {{-- Logo Simulador --}}
                            <div class="col-md-3 text-center">
                                <div class="p-3 border rounded-4 bg-light h-100 d-flex flex-column align-items-center">
                                    <label class="form-label small fw-bold text-muted text-uppercase mb-3">Simulador</label>
                                    <div class="bg-white rounded p-2 mb-3 d-flex align-items-center justify-content-center"
                                        style="width: 100%; height: 80px; border: 1px dashed #ccc;">
                                        @if (isset($settings['logo_simulator']))
                                            <img id="preview-simulator"
                                                src="{{ Storage::url($settings['logo_simulator']) }}" alt="Logo Simulador"
                                                class="img-fluid" style="max-height: 60px;">
                                        @else
                                            <div id="placeholder-simulator" class="text-muted small"
                                                style="font-size: 0.7rem;">Sem Logo</div>
                                        @endif
                                    </div>
                                    <input type="file" name="logo_simulator" class="form-control form-control-sm"
                                        accept="image/*"
                                        onchange="previewImg(this, 'preview-simulator', 'placeholder-simulator')">
                                </div>
                            </div>

                            {{-- Logo PDF --}}
                            <div class="col-md-3 text-center">
                                <div class="p-3 border rounded-4 bg-light h-100 d-flex flex-column align-items-center">
                                    <label class="form-label small fw-bold text-muted text-uppercase mb-3">PDFs</label>
                                    <div class="bg-white rounded p-2 mb-3 d-flex align-items-center justify-content-center"
                                        style="width: 100%; height: 80px; border: 1px dashed #ccc;">
                                        @if (isset($settings['logo_pdf']))
                                            <img id="preview-pdf" src="{{ Storage::url($settings['logo_pdf']) }}"
                                                alt="Logo PDF" class="img-fluid" style="max-height: 60px;">
                                        @else
                                            <div id="placeholder-pdf" class="text-muted small" style="font-size: 0.7rem;">
                                                Sem Logo</div>
                                        @endif
                                    </div>
                                    <input type="file" name="logo_pdf" class="form-control form-control-sm"
                                        accept="image/*" onchange="previewImg(this, 'preview-pdf', 'placeholder-pdf')">
                                </div>
                            </div>

                            {{-- Favicon --}}
                            <div class="col-md-3 text-center">
                                <div class="p-3 border rounded-4 bg-light h-100 d-flex flex-column align-items-center">
                                    <label class="form-label small fw-bold text-muted text-uppercase mb-3">Favicon</label>
                                    <div class="bg-white rounded p-2 mb-3 d-flex align-items-center justify-content-center"
                                        style="width: 100%; height: 80px; border: 1px dashed #ccc;">
                                        @if (isset($settings['favicon']))
                                            <img id="preview-favicon" src="{{ Storage::url($settings['favicon']) }}"
                                                alt="Favicon" class="img-fluid" style="max-height: 48px;">
                                        @else
                                            <div id="placeholder-favicon" class="text-muted small"
                                                style="font-size: 0.7rem;">Sem Ícone</div>
                                        @endif
                                    </div>
                                    <input type="file" name="favicon" class="form-control form-control-sm"
                                        accept="image/*"
                                        onchange="previewImg(this, 'preview-favicon', 'placeholder-favicon')">
                                </div>
                            </div>
                        </div>

                        <!-- Informações da Empresa -->
                        <div class="row g-4">
                            <div class="col-12">
                                <h5 class="fw-bold text-primary border-bottom pb-2 mb-4">
                                    <i class="bi bi-building me-2"></i>Dados da Empresa
                                </h5>
                            </div>

                            <div class="col-md-8">
                                <label class="form-label small fw-bold text-muted text-uppercase">Nome do Sistema /
                                    Empresa</label>
                                <input type="text" name="site_name" class="form-control"
                                    value="{{ $settings['site_name'] ?? 'PayTech | Sistema' }}"
                                    placeholder="Ex: PayTech Tecnologia">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label small fw-bold text-muted text-uppercase">CNPJ / CPF</label>
                                <input type="text" name="company_document" class="form-control"
                                    value="{{ $settings['company_document'] ?? '' }}" placeholder="00.000.000/0000-00">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label small fw-bold text-muted text-uppercase">Telefone /
                                    WhatsApp</label>
                                <input type="text" name="company_phone" class="form-control"
                                    value="{{ $settings['company_phone'] ?? '' }}" placeholder="(00) 00000-0000">
                            </div>

                            <div class="col-md-8">
                                <label class="form-label small fw-bold text-muted text-uppercase">E-mail de Contato</label>
                                <input type="email" name="company_email" class="form-control"
                                    value="{{ $settings['company_email'] ?? '' }}" placeholder="contato@empresa.com.br">
                            </div>

                            <div class="col-12">
                                <label class="form-label small fw-bold text-muted text-uppercase">Endereço Completo</label>
                                <input type="text" name="company_address" class="form-control"
                                    value="{{ $settings['company_address'] ?? '' }}"
                                    placeholder="Rua, Número, Bairro, Cidade - UF">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light text-end py-3 px-4">
                        <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold shadow-sm">
                            <i class="bi bi-save me-2"></i>Salvar Todas as Configurações
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImg(input, previewId, placeholderId) {
            const [file] = input.files;
            if (file) {
                const preview = document.getElementById(previewId);
                const placeholder = document.getElementById(placeholderId);

                if (preview) {
                    preview.src = URL.createObjectURL(file);
                } else if (placeholder) {
                    const img = document.createElement('img');
                    img.id = previewId;
                    img.src = URL.createObjectURL(file);
                    img.className = 'img-fluid';
                    img.style.maxHeight = '80px';
                    placeholder.parentNode.replaceChild(img, placeholder);
                }
            }
        }
    </script>
@endsection
