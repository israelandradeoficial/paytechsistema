@extends('admin.layout')

@section('page_title', '')

@section('content')
    @push('styles')
        <style>
            .dt-container {
                padding: 0;
            }

            .dt-length,
            .dt-search {
                padding: 1.25rem 1.5rem 0.75rem !important;
            }

            .dt-length label,
            .dt-search label {
                font-weight: 600 !important;
                color: var(--bs-secondary-color) !important;
                font-size: 0.85rem !important;
                text-transform: uppercase !important;
                letter-spacing: 0.5px !important;
                display: flex !important;
                align-items: center !important;
                gap: 0.5rem !important;
                margin-bottom: 0 !important;
            }

            .dt-length select {
                border-radius: 10px !important;
                padding: 0.35rem 2.25rem 0.35rem 0.75rem !important;
                border: 1px solid var(--bs-border-color) !important;
                background-color: var(--bs-body-bg) !important;
                cursor: pointer !important;
                font-weight: 500 !important;
                font-size: 0.9rem !important;
            }

            .dt-search input {
                border-radius: 20px !important;
                padding: 0.5rem 1.25rem 0.5rem 2.85rem !important;
                border: 1px solid var(--bs-border-color) !important;
                background-color: var(--bs-body-bg) !important;
                width: 250px !important;
                transition: all 0.2s ease !important;
                font-weight: 500 !important;
                font-size: 0.9rem !important;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2364748b' class='bi bi-search' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/%3E%3C/svg%3E") !important;
                background-repeat: no-repeat !important;
                background-position: left 1rem center !important;
            }

            .dt-search input:focus {
                width: 320px !important;
                border-color: var(--bs-primary) !important;
                box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.1) !important;
                outline: none !important;
            }

            .dt-info {
                font-size: 0.85rem !important;
                color: var(--bs-secondary-color) !important;
                padding: 1.25rem 1.5rem !important;
                font-weight: 500 !important;
            }

            .dt-paging {
                padding: 1.25rem 1.5rem !important;
            }

            .pagination {
                gap: 4px !important;
                margin-bottom: 0 !important;
            }

            .page-link {
                border-radius: 8px !important;
                border: 1px solid var(--bs-border-color) !important;
                background-color: var(--bs-body-bg) !important;
                color: var(--bs-secondary-color) !important;
                padding: 0.4rem 0.8rem !important;
                font-weight: 600 !important;
                font-size: 0.85rem !important;
                transition: all 0.2s !important;
            }

            .page-link:hover {
                background-color: var(--bs-tertiary-bg) !important;
                color: var(--bs-primary) !important;
            }

            .page-item.active .page-link {
                background-color: var(--bs-primary) !important;
                border-color: var(--bs-primary) !important;
                color: #fff !important;
                box-shadow: 0 4px 6px -1px rgba(99, 102, 241, 0.3) !important;
            }

            .page-item.disabled .page-link {
                opacity: 0.5 !important;
                cursor: not-allowed !important;
            }

            table.dataTable thead th {
                border-bottom: 1px solid var(--bs-border-color) !important;
                background-color: var(--bs-tertiary-bg) !important;
                padding: 1rem 1rem !important;
                font-size: 0.75rem !important;
                letter-spacing: 0.5px !important;
                color: var(--bs-secondary-color) !important;
            }

            table.dataTable thead th:first-child,
            table.dataTable tbody td:first-child {
                padding-left: 1.5rem !important;
            }

            table.dataTable thead th:last-child,
            table.dataTable tbody td:last-child {
                padding-right: 1.5rem !important;
            }

            table.dataTable tbody td {
                padding: 0.85rem 1rem !important;
                font-size: 0.9rem !important;
                border-bottom: 1px solid var(--bs-border-color-translucent) !important;
            }

            .dt-processing {
                background: var(--bs-body-bg) !important;
                color: var(--bs-primary) !important;
                border: 1px solid var(--bs-border-color) !important;
                border-radius: 12px !important;
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
                font-weight: 600;
                padding: 0.75rem 1.5rem !important;
                height: auto !important;
                top: 150px !important;
                left: 50% !important;
                transform: translateX(-50%) !important;
                z-index: 1000 !important;
                font-size: 0.85rem !important;
                margin: 0 !important;
            }
        </style>
    @endpush
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline shadow-sm">
                <div class="card-header border-bottom d-flex align-items-center">
                    <h3 class="card-title fw-bold mb-0">Gestão de Clientes</h3>
                    <div class="ms-auto">
                        @can('manage_clients')
                            <button type="button" class="btn btn-primary btn-sm rounded-pill px-4" data-bs-toggle="modal"
                                data-bs-target="#modalNovoCliente">
                                <i class="bi bi-person-plus me-1"></i> Novo Cliente
                            </button>
                        @endcan
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive p-0">
                        <table class="table table-hover align-middle mb-0 w-100" id="tableClientes">
                            <thead class="bg-body-secondary text-muted small text-uppercase">
                                <tr>
                                    <th>Nome</th>
                                    <th>CPF/CNPJ</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th>Status</th>
                                    <th>Validade</th>
                                    <th class="text-end">Ações</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Novo Cliente -->
    <div class="modal fade" id="modalNovoCliente" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="bi bi-person-plus me-2"></i>Novo Cliente</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="formNovoCliente" action="{{ route('admin.clientes.store') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="modal-section-card">
                                    <h6 class="fw-bold text-primary border-bottom pb-2 mb-3">
                                        <i class="bi bi-person-fill me-2"></i>Dados Pessoais
                                    </h6>
                                    <div class="row g-3">
                                        <div class="col-md-5">
                                            <label class="form-label small fw-bold text-muted text-uppercase">Nome
                                                Completo</label>
                                            <div class="input-group">
                                                <span class="input-group-text border-end-0"><i
                                                        class="bi bi-person text-muted"></i></span>
                                                <input type="text" name="nome" class="form-control border-start-0"
                                                    required placeholder="Ex: João Silva">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small fw-bold text-muted text-uppercase">Data de
                                                Nasc.</label>
                                            <div class="input-group">
                                                <span class="input-group-text border-end-0"><i
                                                        class="bi bi-calendar-event text-muted"></i></span>
                                                <input type="date" name="nascimento" class="form-control border-start-0">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label
                                                class="form-label small fw-bold text-muted text-uppercase">CPF/CNPJ</label>
                                            <div class="input-group">
                                                <span class="input-group-text border-end-0"><i
                                                        class="bi bi-card-text text-muted"></i></span>
                                                <input type="text" name="cpf_cnpj" class="form-control border-start-0"
                                                    required placeholder="000.000.000-00">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="modal-section-card">
                                    <h6 class="fw-bold text-primary border-bottom pb-2 mb-3">
                                        <i class="bi bi-envelope-fill me-2"></i>Contato
                                    </h6>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-muted text-uppercase">Email</label>
                                            <div class="input-group">
                                                <span class="input-group-text border-end-0"><i
                                                        class="bi bi-envelope text-muted"></i></span>
                                                <input type="email" name="email" class="form-control border-start-0"
                                                    required placeholder="joao@email.com">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label
                                                class="form-label small fw-bold text-muted text-uppercase">Telefone</label>
                                            <div class="input-group">
                                                <span class="input-group-text border-end-0"><i
                                                        class="bi bi-telephone text-muted"></i></span>
                                                <input type="text" name="telefone" class="form-control border-start-0"
                                                    required placeholder="(00) 00000-0000">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="modal-section-card">
                                    <h6 class="fw-bold text-primary border-bottom pb-2 mb-3">
                                        <i class="bi bi-geo-alt-fill me-2"></i>Endereço
                                    </h6>
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label small fw-bold text-muted text-uppercase">CEP</label>
                                            <div class="input-group">
                                                <span class="input-group-text border-end-0"><i
                                                        class="bi bi-search text-muted"></i></span>
                                                <input type="text" name="cep" class="form-control border-start-0"
                                                    required onblur="lookupCep(this)" placeholder="00000-000">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="form-label small fw-bold text-muted text-uppercase">Rua</label>
                                            <input type="text" name="rua" class="form-control" required
                                                placeholder="Nome da rua">
                                        </div>
                                        <div class="col-md-5">
                                            <label
                                                class="form-label small fw-bold text-muted text-uppercase">Bairro</label>
                                            <input type="text" name="bairro" class="form-control" required
                                                placeholder="Bairro">
                                        </div>
                                        <div class="col-md-3">
                                            <label
                                                class="form-label small fw-bold text-muted text-uppercase">Número</label>
                                            <input type="text" name="numero" class="form-control" required
                                                placeholder="Núº">
                                        </div>
                                        <div class="col-md-4">
                                            <label
                                                class="form-label small fw-bold text-muted text-uppercase">Cidade</label>
                                            <input type="text" name="cidade" class="form-control" required
                                                placeholder="Cidade">
                                        </div>
                                        <div class="col-md-3">
                                            <label
                                                class="form-label small fw-bold text-muted text-uppercase">Estado</label>
                                            <input type="text" name="estado" class="form-control" required
                                                placeholder="UF" maxlength="2">
                                        </div>
                                        <div class="col-md-9">
                                            <label
                                                class="form-label small fw-bold text-muted text-uppercase">Complemento</label>
                                            <input type="text" name="complemento" class="form-control"
                                                placeholder="Apto, Sala, Bloco...">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="modal-section-card mb-0">
                                    <h6 class="fw-bold text-primary border-bottom pb-2 mb-3">
                                        <i class="bi bi-shield-lock-fill me-2"></i>Controle de Acesso
                                    </h6>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label
                                                class="form-label small fw-bold text-muted text-uppercase">Status</label>
                                            <select name="status" class="form-select">
                                                <option value="ativo">✅ Ativo</option>
                                                <option value="inativo">🔴 Inativo</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-muted text-uppercase">Data de
                                                Validade</label>
                                            <input type="date" name="data_validade" class="form-control">
                                            <div class="form-text">Deixe em branco para acesso vitalício.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-body-secondary px-4 py-3">
                        <button type="button" class="btn btn-light rounded-pill px-4"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btnSalvarCliente" class="btn btn-primary rounded-pill px-4">Salvar
                            Cliente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Editar Cliente -->
    <div class="modal fade" id="modalEditarCliente" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title"><i class="bi bi-pencil me-2"></i>Editar Cliente</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="formEditarCliente" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="modal-section-card">
                                    <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3">
                                        <i class="bi bi-person-fill me-2"></i>Dados Pessoais
                                    </h6>
                                    <div class="row g-3">
                                        <div class="col-md-5">
                                            <label class="form-label small fw-bold text-muted text-uppercase">Nome
                                                Completo</label>
                                            <div class="input-group">
                                                <span class="input-group-text border-end-0"><i
                                                        class="bi bi-person text-muted"></i></span>
                                                <input type="text" name="nome" id="edit_nome"
                                                    class="form-control border-start-0" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small fw-bold text-muted text-uppercase">Data de
                                                Nasc.</label>
                                            <div class="input-group">
                                                <span class="input-group-text border-end-0"><i
                                                        class="bi bi-calendar-event text-muted"></i></span>
                                                <input type="date" name="nascimento" id="edit_nascimento"
                                                    class="form-control border-start-0">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label
                                                class="form-label small fw-bold text-muted text-uppercase">CPF/CNPJ</label>
                                            <div class="input-group">
                                                <span class="input-group-text border-end-0"><i
                                                        class="bi bi-card-text text-muted"></i></span>
                                                <input type="text" name="cpf_cnpj" id="edit_cpf_cnpj"
                                                    class="form-control border-start-0" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="modal-section-card">
                                    <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3">
                                        <i class="bi bi-envelope-fill me-2"></i>Contato
                                    </h6>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-muted text-uppercase">Email</label>
                                            <div class="input-group">
                                                <span class="input-group-text border-end-0"><i
                                                        class="bi bi-envelope text-muted"></i></span>
                                                <input type="email" name="email" id="edit_email"
                                                    class="form-control border-start-0" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label
                                                class="form-label small fw-bold text-muted text-uppercase">Telefone</label>
                                            <div class="input-group">
                                                <span class="input-group-text border-end-0"><i
                                                        class="bi bi-telephone text-muted"></i></span>
                                                <input type="text" name="telefone" id="edit_telefone"
                                                    class="form-control border-start-0" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="modal-section-card">
                                    <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3">
                                        <i class="bi bi-geo-alt-fill me-2"></i>Endereço
                                    </h6>
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label small fw-bold text-muted text-uppercase">CEP</label>
                                            <div class="input-group">
                                                <span class="input-group-text border-end-0"><i
                                                        class="bi bi-search text-muted"></i></span>
                                                <input type="text" name="cep" id="edit_cep"
                                                    class="form-control border-start-0" required onblur="lookupCep(this)">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="form-label small fw-bold text-muted text-uppercase">Rua</label>
                                            <input type="text" name="rua" id="edit_rua" class="form-control"
                                                required>
                                        </div>
                                        <div class="col-md-5">
                                            <label
                                                class="form-label small fw-bold text-muted text-uppercase">Bairro</label>
                                            <input type="text" name="bairro" id="edit_bairro" class="form-control"
                                                required>
                                        </div>
                                        <div class="col-md-3">
                                            <label
                                                class="form-label small fw-bold text-muted text-uppercase">Número</label>
                                            <input type="text" name="numero" id="edit_numero" class="form-control"
                                                required>
                                        </div>
                                        <div class="col-md-4">
                                            <label
                                                class="form-label small fw-bold text-muted text-uppercase">Cidade</label>
                                            <input type="text" name="cidade" id="edit_cidade" class="form-control"
                                                required>
                                        </div>
                                        <div class="col-md-3">
                                            <label
                                                class="form-label small fw-bold text-muted text-uppercase">Estado</label>
                                            <input type="text" name="estado" id="edit_estado" class="form-control"
                                                required maxlength="2">
                                        </div>
                                        <div class="col-md-9">
                                            <label
                                                class="form-label small fw-bold text-muted text-uppercase">Complemento</label>
                                            <input type="text" name="complemento" id="edit_complemento"
                                                class="form-control" placeholder="Apto, Sala, Bloco...">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="modal-section-card mb-0">
                                    <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3">
                                        <i class="bi bi-shield-lock-fill me-2"></i>Controle de Acesso
                                    </h6>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label
                                                class="form-label small fw-bold text-muted text-uppercase">Status</label>
                                            <select name="status" id="edit_status" class="form-select">
                                                <option value="ativo">✅ Ativo</option>
                                                <option value="inativo">🔴 Inativo</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-muted text-uppercase">Data de
                                                Validade</label>
                                            <input type="date" name="data_validade" id="edit_data_validade"
                                                class="form-control">
                                            <div class="form-text">Deixe em branco para acesso vitalício.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-body-secondary px-4 py-3">
                        <button type="button" class="btn btn-light rounded-pill px-4"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btnAtualizarCliente"
                            class="btn btn-secondary rounded-pill px-4">Atualizar Cliente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Gerenciar Taxas -->
    <div class="modal fade" id="modalTaxas" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header border-0 bg-primary bg-gradient text-white py-3">
                    <h5 class="modal-title d-flex align-items-center">
                        <div class="bg-primary bg-opacity-20 rounded-circle p-2 me-3 d-flex align-items-center justify-content-center"
                            style="width: 40px; height: 40px;">
                            <i class="bi bi-percent fs-5 text-white"></i>
                        </div>
                        <div>
                            <span class="d-block lh-1 fw-bold">Gerenciar Taxas</span>
                            <small class="opacity-75 fw-normal" id="taxa_cliente_nome"
                                style="font-size: 0.85rem;"></small>
                        </div>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-4">
                        <!-- Form de Cadastro em Massa -->
                        <div class="col-md-5">
                            <div class="modal-section-card">
                                <div class="card-body p-0">
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-2 me-3">
                                            <i class="bi bi-stack fs-5"></i>
                                        </div>
                                        <h6 class="fw-bold mb-0">Gerador em Massa</h6>
                                    </div>
                                    <form id="formNovaTaxa" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label
                                                class="form-label small fw-bold text-muted text-uppercase">Bandeira</label>
                                            <select name="bandeira" class="form-select border-0 shadow-sm" required>
                                                <option value="Mastercard/Visa">Mastercard/Visa</option>
                                                <option value="Elo/Outros">Elo/Outros</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold text-muted text-uppercase">Até
                                                Parcelas</label>
                                            <select id="qtd_parcelas" class="form-select border-0 shadow-sm" required
                                                onchange="gerarCamposTaxas(this.value)">
                                                <option value="">Selecione...</option>
                                                @for ($i = 1; $i <= 36; $i++)
                                                    <option value="{{ $i }}">{{ $i }}x</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div id="containerTaxas" class="mb-4 custom-scrollbar"
                                            style="max-height: 300px; overflow-y: auto;">
                                            <div class="text-center py-4 text-muted border border-dashed rounded-3">
                                                <i class="bi bi-grid-3x3-gap d-block fs-3 mb-2 opacity-25"></i>
                                                Selecione a quantidade
                                            </div>
                                        </div>
                                        <button type="submit"
                                            class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-sm">
                                            Salvar Taxas
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Listagem e Ações Individuais -->
                        <div class="col-md-7">
                            <div class="d-flex align-items-center justify-content-between mb-3 px-2">
                                <div class="d-flex align-items-center">
                                    <div class="bg-secondary bg-opacity-10 text-secondary rounded-3 p-2 me-3">
                                        <i class="bi bi-list-stars fs-5"></i>
                                    </div>
                                    <h6 class="fw-bold mb-0">Taxas Cadastradas</h6>
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-dark btn-sm rounded-pill px-3"
                                        onclick="showAddSingleForm()">
                                        <i class="bi bi-plus-lg me-1"></i> Adicionar Taxa
                                    </button>
                                    <span class="badge bg-body-tertiary text-body border py-2 px-3 rounded-pill fw-normal">
                                        Total: <span id="taxas_count" class="fw-bold">0</span>
                                    </span>
                                </div>
                            </div>

                            <!-- Formulário Adição Individual (Hidden by default) -->
                            <div id="divAddSingle"
                                class="card border-primary border-opacity-25 bg-primary bg-opacity-10 rounded-4 mb-4 shadow-sm"
                                style="display: none;">
                                <div class="card-body p-3">
                                    <form id="formAddSingle" class="row g-2 align-items-end">
                                        @csrf
                                        <div class="col-md-4">
                                            <label
                                                class="form-label small fw-bold text-muted text-uppercase mb-1">Bandeira</label>
                                            <select name="bandeira" class="form-select form-select-sm border-0" required>
                                                <option value="Mastercard/Visa">Mastercard/Visa</option>
                                                <option value="Elo/Outros">Elo/Outros</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label
                                                class="form-label small fw-bold text-muted text-uppercase mb-1">Parcela</label>
                                            <input type="number" name="parcela"
                                                class="form-control form-select-sm border-0" required placeholder="Ex: 5">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small fw-bold text-muted text-uppercase mb-1">Taxa
                                                (%)</label>
                                            <div class="input-group input-group-sm rounded-3 overflow-hidden shadow-sm">
                                                <input type="number" name="valor" step="0.01"
                                                    class="form-control border-0 bg-body" required placeholder="0.00">
                                                <span
                                                    class="input-group-text border-0 bg-body-secondary text-muted fw-bold">%</span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit"
                                                class="btn btn-primary btn-sm w-100 rounded-pill h-100">
                                                Salvar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Abas de Bandeiras -->
                            <ul class="nav nav-pills nav-fill bg-body-tertiary p-1 rounded-pill mb-4 border"
                                id="taxasTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active rounded-pill px-4" id="master-tab"
                                        data-bs-toggle="pill" data-bs-target="#pane-master" type="button"
                                        role="tab">
                                        <i class="bi bi-credit-card-2-front me-2"></i>Mastercard/Visa
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link rounded-pill px-4" id="elo-tab" data-bs-toggle="pill"
                                        data-bs-target="#pane-elo" type="button" role="tab">
                                        <i class="bi bi-credit-card me-2"></i>Elo/Outros
                                    </button>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="pane-master" role="tabpanel">
                                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-3">
                                        <div class="table-responsive">
                                            <table class="table table-hover align-middle mb-0">
                                                <thead class="bg-body-secondary small text-muted text-uppercase">
                                                    <tr>
                                                        <th class="ps-4">Parcela</th>
                                                        <th>Taxa (%)</th>
                                                        <th class="text-end pe-4">Ações</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="listaTaxasMaster" class="border-top-0"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="text-end px-2" id="btnSaveAllMaster" style="display: none;">
                                        <button type="button" class="btn btn-success rounded-pill px-4 fw-bold shadow-sm"
                                            onclick="saveAllTaxas('Mastercard/Visa')">
                                            <i class="bi bi-check-all me-1"></i> Salvar Todas (Master/Visa)
                                        </button>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pane-elo" role="tabpanel">
                                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-3">
                                        <div class="table-responsive">
                                            <table class="table table-hover align-middle mb-0">
                                                <thead class="bg-body-secondary small text-muted text-uppercase">
                                                    <tr>
                                                        <th class="ps-4">Parcela</th>
                                                        <th>Taxa (%)</th>
                                                        <th class="text-end pe-4">Ações</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="listaTaxasElo" class="border-top-0"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="text-end px-2" id="btnSaveAllElo" style="display: none;">
                                        <button type="button" class="btn btn-success rounded-pill px-4 fw-bold shadow-sm"
                                            onclick="saveAllTaxas('Elo/Outros')">
                                            <i class="bi bi-check-all me-1"></i> Salvar Todas (Elo/Outros)
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Gerenciar Maquininhas -->
    <div class="modal fade" id="modalMaquininhas" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header border-0 bg-dark text-white py-3">
                    <h5 class="modal-title d-flex align-items-center">
                        <div class="bg-warning bg-opacity-20 rounded-circle p-2 me-3 d-flex align-items-center justify-content-center"
                            style="width: 40px; height: 40px;">
                            <i class="bi bi-pci-card fs-5 text-dark"></i>
                        </div>
                        <div>
                            <span class="d-block lh-1 fw-bold">Gerenciar Maquininhas</span>
                            <small class="opacity-75 fw-normal" id="maquininha_cliente_nome"
                                style="font-size: 0.85rem;"></small>
                        </div>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="formNovaMaquininha" method="POST" class="mb-4">
                        @csrf
                        <div class="row g-2">
                            <div class="col-md-5">
                                <label class="form-label small fw-bold text-muted text-uppercase">Modelo / Nome</label>
                                <input type="text" name="modelo" class="form-control" required
                                    placeholder="Ex: Pax A920">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold text-muted text-uppercase">Número de Série</label>
                                <input type="text" name="numero_serie" class="form-control" required
                                    placeholder="S/N da máquina">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-muted text-uppercase">Status</label>
                                <select name="status" class="form-select">
                                    <option value="ativa">Ativa</option>
                                    <option value="inativa">Inativa</option>
                                    <option value="problema">Problema</option>
                                    <option value="manutencao">Manutenção</option>
                                </select>
                            </div>
                            <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-primary w-100 fw-bold">
                                    <i class="bi bi-plus-lg me-1"></i> Adicionar Máquininha
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text bg-body border-end-0">
                                <i class="bi bi-search text-muted"></i>
                            </span>
                            <input type="text" id="searchMaquininha" class="form-control border-start-0 ps-0"
                                placeholder="Buscar pelo número de série (S/N)..." onkeyup="filterMaquininhas()">
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="table-responsive" style="max-height: 350px;">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-body-secondary small text-muted text-uppercase">
                                    <tr>
                                        <th class="ps-4">Modelo</th>
                                        <th>S/N</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Registro</th>
                                        <th class="text-end pe-4">Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="listaMaquininhas"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: var(--bs-tertiary-bg);
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: var(--bs-secondary-bg);
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: var(--bs-secondary-color);
        }

        .border-dashed {
            border-style: dashed !important;
        }

        #modalTaxas .form-select,
        #modalTaxas .form-control {
            border-color: var(--bs-border-color);
            background-color: var(--bs-body-bg);
            color: var(--bs-body-color);
            padding: 0.6rem 0.9rem;
        }

        #modalTaxas .form-select:focus,
        #modalTaxas .form-control:focus {
            border-color: var(--bs-primary);
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
        }

        .taxa-bulk-input {
            border: none !important;
            background: transparent !important;
            padding: 0 !important;
            font-weight: bold;
            color: var(--bs-primary);
            text-align: right;
            box-shadow: none !important;
        }

        .taxa-bulk-input:focus {
            text-align: left;
            background: var(--bs-body-bg) !important;
        }

        .input-group-tax-list {
            background-color: var(--bs-body-bg);
            border: 1px solid var(--bs-border-color);
            border-radius: 8px;
            padding: 2px 8px;
            transition: all 0.2s;
            max-width: 110px;
        }

        .input-group-tax-list:focus-within {
            border-color: var(--bs-primary);
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
        }
    </style>

    @push('scripts')
        <script>
            let table;

            async function ajaxSubmit(u, m, d) {
                const o = {
                    method: m,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': window.csrfToken
                    }
                };
                if (d instanceof FormData) o.body = d;
                else {
                    o.headers['Content-Type'] = 'application/json';
                    o.body = JSON.stringify(d);
                }
                const r = await fetch(u, o);
                const res = await r.json();
                if (!r.ok) throw new Error(res.message || 'Erro na requisição.');
                return res;
            }

            function swalSuccess(m) {
                Toast.fire({
                    icon: 'success',
                    title: m
                });
            }

            function swalError(m) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: m,
                    confirmButtonColor: '#6366f1'
                });
            }

            window.addEventListener('load', function() {
                table = $('#tableClientes').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('admin.clientes.index') }}",
                        type: "GET"
                    },
                    columns: [{
                            data: 'nome',
                            name: 'nome'
                        },
                        {
                            data: 'cpf_cnpj',
                            name: 'cpf_cnpj'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'telefone',
                            name: 'telefone'
                        },
                        {
                            data: 'status',
                            name: 'status',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'data_validade',
                            name: 'data_validade'
                        },
                        {
                            data: 'actions',
                            name: 'actions',
                            orderable: false,
                            searchable: false,
                            className: 'text-end pe-4'
                        }
                    ],
                    layout: {
                        topStart: {
                            features: {
                                pageLength: {
                                    menu: [10, 25, 50, 100],
                                    text: 'Exibir _MENU_ registros'
                                }
                            }
                        },
                        topEnd: {
                            features: {
                                search: {
                                    placeholder: 'Pesquisar clientes...'
                                }
                            }
                        },
                        bottomStart: 'info',
                        bottomEnd: 'paging'
                    },
                    language: {
                        url: "{{ asset('lang/pt-BR.json') }}",
                        search: "",
                        searchPlaceholder: "Pesquisar clientes...",
                        lengthMenu: "Exibir _MENU_ registros",
                        info: "Mostrando _START_ até _END_ de _TOTAL_ clientes",
                        infoEmpty: "Mostrando 0 até 0 de 0 clientes",
                        infoFiltered: "(filtrado de _MAX_ total)",
                        paginate: {
                            first: '<i class="bi bi-chevron-double-left"></i>',
                            last: '<i class="bi bi-chevron-double-right"></i>',
                            next: '<i class="bi bi-chevron-right"></i>',
                            previous: '<i class="bi bi-chevron-left"></i>'
                        }
                    },
                    pageLength: 10,
                    order: [
                        [0, 'asc']
                    ],
                    drawCallback: function() {
                        // Custom adjustments if needed
                    }
                });

                // Initialize AJAX Forms
                handleAjaxForm({
                    formId: 'formNovoCliente',
                    modalId: 'modalNovoCliente',
                    entityName: 'cliente',
                    onSuccess: function() {
                        table.ajax.reload(null, false);
                    }
                });

                handleAjaxForm({
                    formId: 'formEditarCliente',
                    modalId: 'modalEditarCliente',
                    entityName: 'cliente',
                    isEdit: true,
                    onSuccess: function() {
                        table.ajax.reload(null, false);
                    }
                });
            });

            // Override the delete handler to use global Swal
            document.addEventListener('click', function(e) {
                const btn = e.target.closest('.btn-delete-cliente');
                if (!btn) return;

                Swal.fire({
                    title: 'Tem certeza?',
                    text: `Deseja realmente excluir o cliente "${btn.dataset.nome}"?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Sim, excluir!',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        try {
                            const response = await fetch(`/admin/clientes/${btn.dataset.id}`, {
                                method: 'POST',
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': window.csrfToken,
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    _method: 'DELETE'
                                })
                            });

                            const data = await response.json();

                            if (response.ok) {
                                Toast.fire({
                                    icon: 'success',
                                    title: data.message || 'Excluído com sucesso!'
                                }).then(() => {
                                    table.ajax.reload(null, false);
                                });
                            } else {
                                throw new Error(data.message || 'Erro ao excluir cliente.');
                            }
                        } catch (error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Erro',
                                text: error.message
                            });
                        }
                    }
                });
            });


            // ===================== TAXAS: GERADOR MASSA =====================
            function gerarCamposTaxas(qtd) {
                const ctr = document.getElementById('containerTaxas');
                ctr.innerHTML = '';
                if (!qtd) {
                    ctr.innerHTML =
                        '<div class="text-center py-4 opacity-50"><i class="bi bi-grid-3x3-gap d-block fs-3 mb-2"></i>Selecione o limite</div>';
                    return;
                }
                const grid = document.createElement('div');
                grid.className = 'row g-2';
                for (let i = 1; i <= qtd; i++) {
                    const col = document.createElement('div');
                    col.className = 'col-6';
                    col.innerHTML = `<div class="p-2 border rounded-3 bg-body-tertiary shadow-sm small">
                    <span class="text-muted fw-bold d-block mb-1">${i}x</span>
                    <div class="input-group input-group-sm rounded-2 overflow-hidden border border-secondary border-opacity-25">
                        <input type="number" name="taxas[]" step="0.01" class="form-control border-0 bg-body" value="0.00" required>
                        <span class="input-group-text border-0 bg-body-secondary text-muted fw-bold">%</span>
                    </div>
                </div>`;
                    grid.appendChild(col);
                }
                ctr.appendChild(grid);
            }

            document.getElementById('formNovaTaxa').addEventListener('submit', async function(e) {
                e.preventDefault();
                const btn = this.querySelector('[type="submit"]');
                btn.disabled = true;
                try {
                    const data = await ajaxSubmit(this.action, 'POST', new FormData(this));
                    const cId = this.action.match(/\/clientes\/(\d+)\//)[1];
                    loadTaxas(cId);
                    swalSuccess(data.message);
                    this.reset();
                    document.getElementById('containerTaxas').innerHTML = '';
                } catch (err) {
                    swalError(err.message);
                } finally {
                    btn.disabled = false;
                }
            });

            // ===================== TAXAS: INDIVIDUAL =====================
            function showAddSingleForm() {
                const div = document.getElementById('divAddSingle');
                div.style.display = div.style.display === 'none' ? 'block' : 'none';
            }

            document.getElementById('formAddSingle').addEventListener('submit', async function(e) {
                e.preventDefault();
                const form = document.getElementById('formNovaTaxa');
                const cId = form.action.match(/\/clientes\/(\d+)\//)[1];
                const btn = this.querySelector('[type="submit"]');
                btn.disabled = true;
                try {
                    const data = await ajaxSubmit(`/admin/clientes/${cId}/taxas/single`, 'POST', new FormData(
                        this));
                    loadTaxas(cId);
                    swalSuccess(data.message);
                    this.reset();
                    document.getElementById('divAddSingle').style.display = 'none';
                } catch (err) {
                    swalError(err.message);
                } finally {
                    btn.disabled = false;
                }
            });

            async function saveAllTaxas(brand) {
                const container = brand === 'Mastercard/Visa' ? document.getElementById('pane-master') : document
                    .getElementById('pane-elo');
                const inputs = container.querySelectorAll('.taxa-bulk-input');

                const dataToUpdate = [];
                inputs.forEach(input => {
                    dataToUpdate.push({
                        id: input.dataset.id,
                        valor: input.value
                    });
                });

                if (dataToUpdate.length === 0) return;

                try {
                    await ajaxSubmit('/admin/taxas/bulk', 'PUT', {
                        taxas: dataToUpdate
                    });
                    loadTaxas(lastLoadedClienteId);
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Todas as taxas atualizadas!',
                        showConfirmButton: false,
                        timer: 3000
                    });
                } catch (err) {
                    swalError(err.message);
                }
            }

            let lastLoadedClienteId = null;
            async function loadTaxas(cId) {
                lastLoadedClienteId = cId;
                const tMaster = document.getElementById('listaTaxasMaster');
                const tElo = document.getElementById('listaTaxasElo');
                const bMaster = document.getElementById('btnSaveAllMaster');
                const bElo = document.getElementById('btnSaveAllElo');

                const loader =
                    '<tr><td colspan="3" class="text-center py-4"><div class="spinner-border spinner-border-sm text-primary"></div></td></tr>';
                tMaster.innerHTML = loader;
                tElo.innerHTML = loader;
                bMaster.style.display = 'none';
                bElo.style.display = 'none';

                try {
                    const res = await fetch(`/admin/clientes/${cId}/taxas`);
                    const taxas = await res.json();
                    tMaster.innerHTML = '';
                    tElo.innerHTML = '';
                    document.getElementById('taxas_count').innerText = taxas.length;

                    const renderTable = (list, container, btnContainer) => {
                        if (list.length === 0) {
                            container.innerHTML =
                                '<tr><td colspan="3" class="text-center py-4 text-muted small">Nenhuma taxa.</td></tr>';
                            btnContainer.style.display = 'none';
                            return;
                        }
                        btnContainer.style.display = 'block';
                        list.forEach(t => {
                            container.innerHTML += `<tr>
                            <td class="ps-4 fw-bold text-secondary">${t.parcela}x</td>
                            <td class="fw-bold text-primary">
                                <div class="input-group input-group-sm input-group-tax-list">
                                    <input type="number" step="0.01" value="${t.valor}" class="form-control taxa-bulk-input" data-id="${t.id}">
                                    <span class="input-group-text border-0 bg-transparent text-muted fw-bold ps-1">%</span>
                                </div>
                            </td>
                            <td class="text-end pe-4">
                                <button class="btn btn-sm btn-outline-danger border-0" onclick="deleteTax(${t.id})"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>`;
                        });
                    };
                    renderTable(taxas.filter(x => x.bandeira === 'Mastercard/Visa'), tMaster, bMaster);
                    renderTable(taxas.filter(x => x.bandeira !== 'Mastercard/Visa'), tElo, bElo);
                } catch (err) {
                    swalError('Erro ao carregar taxas.');
                }
            }

            function deleteTax(id) {
                Swal.fire({
                    title: 'Excluir?',
                    text: 'Tem certeza que deseja excluir esta taxa?',
                    icon: 'warning',
                    confirmButtonText: 'Sim, excluir',
                    confirmButtonColor: '#dc3545',
                    cancelButtonText: 'Cancelar',
                    showCancelButton: true
                }).then(async (r) => {
                    if (r.isConfirmed) {
                        try {
                            await ajaxSubmit(`/admin/taxas/${id}`, 'DELETE', {});
                            loadTaxas(lastLoadedClienteId);
                        } catch (err) {
                            swalError(err.message);
                        }
                    }
                });
            }

            // ===================== UTILS & MASKS =====================
            function maskCpfCnpj(i) {
                let v = i.value.replace(/\D/g, '');
                if (v.length <= 11) {
                    // CPF: 000.000.000-00
                    v = v.substring(0, 11);
                    v = v.replace(/^(\d{3})(\d)/, '$1.$2');
                    v = v.replace(/^(\d{3})\.(\d{3})(\d)/, '$1.$2.$3');
                    v = v.replace(/^(\d{3})\.(\d{3})\.(\d{3})(\d{1,2})$/, '$1.$2.$3-$4');
                } else {
                    // CNPJ: 00.000.000/0000-00
                    v = v.substring(0, 14);
                    v = v.replace(/^(\d{2})(\d)/, '$1.$2');
                    v = v.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
                    v = v.replace(/^(\d{2})\.(\d{3})\.(\d{3})(\d)/, '$1.$2.$3/$4');
                    v = v.replace(/^(\d{2})\.(\d{3})\.(\d{3})\/(\d{4})(\d{1,2})$/, '$1.$2.$3/$4-$5');
                }
                i.value = v;
            }

            function maskTelefone(i) {
                let v = i.value.replace(/\D/g, '');
                if (v.length > 11) v = v.substring(0, 11);
                if (v.length > 10) v = v.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');
                else if (v.length > 2) v = v.replace(/^(\d{2})(\d+)/, '($1) $2');
                i.value = v;
            }

            function maskCep(i) {
                i.value = i.value.replace(/\D/g, '').substring(0, 8).replace(/^(\d{5})(\d)/, '$1-$2');
            }

            document.querySelectorAll('[name="cpf_cnpj"]').forEach(e => e.addEventListener('input', () => maskCpfCnpj(e)));
            document.querySelectorAll('[name="telefone"]').forEach(e => e.addEventListener('input', () => maskTelefone(e)));
            document.querySelectorAll('[name="cep"]').forEach(e => e.addEventListener('input', () => maskCep(e)));

            window.addEventListener('load', () => {
                document.getElementById('modalEditarCliente').addEventListener('show.bs.modal', function(e) {
                    const b = e.relatedTarget;
                    const f = document.getElementById('formEditarCliente');
                    f.action = `/admin/clientes/${b.dataset.id}`;
                    ['nome', 'cpf_cnpj', 'nascimento', 'email', 'telefone', 'cep', 'rua', 'bairro', 'numero',
                        'cidade', 'estado', 'complemento', 'data_validade'
                    ].forEach(k => {
                        const el = document.getElementById('edit_' + k);
                        if (el) el.value = b.dataset[k] || '';
                    });
                    // Status (select)
                    const statusEl = document.getElementById('edit_status');
                    if (statusEl) statusEl.value = b.dataset.status || 'ativo';
                    // Re-apply masks after populating values
                    maskCpfCnpj(document.getElementById('edit_cpf_cnpj'));
                    maskTelefone(document.getElementById('edit_telefone'));
                    maskCep(document.getElementById('edit_cep'));
                });
                document.getElementById('modalTaxas').addEventListener('show.bs.modal', function(e) {
                    const b = e.relatedTarget;
                    document.getElementById('taxa_cliente_nome').innerText = b.dataset.clienteNome;
                    const f = document.getElementById('formNovaTaxa');
                    f.action = `/admin/clientes/${b.dataset.clienteId}/taxas`;
                    loadTaxas(b.dataset.clienteId);
                });

                document.getElementById('modalMaquininhas').addEventListener('show.bs.modal', function(e) {
                    const b = e.relatedTarget;
                    document.getElementById('maquininha_cliente_nome').innerText = b.dataset.clienteNome;
                    const f = document.getElementById('formNovaMaquininha');
                    f.dataset.clienteId = b.dataset.clienteId;
                    resetMaquininhaForm();
                    loadMaquininhas(b.dataset.clienteId);
                });
            });

            // Maquininhas Logic
            async function loadMaquininhas(clienteId) {
                const list = document.getElementById('listaMaquininhas');
                list.innerHTML =
                    '<tr><td colspan="5" class="text-center py-4"><div class="spinner-border spinner-border-sm text-primary"></div></td></tr>';

                try {
                    const res = await fetch(`/admin/clientes/${clienteId}/maquininhas`);
                    const data = await res.json();
                    list.innerHTML = '';

                    if (data.length === 0) {
                        list.innerHTML =
                            '<tr><td colspan="5" class="text-center py-4 text-muted">Nenhuma máquina cadastrada.</td></tr>';
                        return;
                    }

                    data.forEach(m => {
                        const dateObj = new Date(m.created_at);
                        const date = dateObj.toLocaleDateString('pt-BR');
                        const time = dateObj.toLocaleTimeString('pt-BR', {
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                        let statusBadge = '';
                        switch (m.status) {
                            case 'ativa':
                            case 'ativo':
                                statusBadge =
                                    '<span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3">Ativa</span>';
                                break;
                            case 'inativa':
                            case 'inativo':
                                statusBadge =
                                    '<span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3">Inativa</span>';
                                break;
                            case 'problema':
                                statusBadge =
                                    '<span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-3">Problema</span>';
                                break;
                            case 'manutencao':
                                statusBadge =
                                    '<span class="badge bg-info-subtle text-info border border-info-subtle rounded-pill px-3">Manutenção</span>';
                                break;
                            default:
                                statusBadge =
                                    `<span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-3">${m.status}</span>`;
                        }

                        list.innerHTML += `
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold">${m.modelo || '---'}</div>
                                </td>
                                <td class="small text-muted">${m.numero_serie}</td>
                                <td class="text-center">${statusBadge}</td>
                                <td class="text-center small text-muted">${date} <br> <small>${time}</small></td>
                                <td class="text-end pe-4">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-outline-primary btn-sm border-0" 
                                            onclick='editMaquininha(${JSON.stringify(m)})'>
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-sm border-0" onclick="deleteMaquininha(${m.id}, ${clienteId})">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        `;
                    });
                } catch (e) {
                    Swal.fire('Erro', 'Não foi possível carregar as máquinas.', 'error');
                }
            }

            function editMaquininha(m) {
                const f = document.getElementById('formNovaMaquininha');
                f.dataset.mode = 'edit';
                f.dataset.maquininhaId = m.id;
                f.querySelector('[name="modelo"]').value = m.modelo;
                f.querySelector('[name="numero_serie"]').value = m.numero_serie;
                f.querySelector('[name="status"]').value = m.status;
                const btn = f.querySelector('button[type="submit"]');
                btn.innerHTML = '<i class="bi bi-check-lg me-1"></i> Salvar Alterações';
                btn.classList.replace('btn-primary', 'btn-warning');
                if (!document.getElementById('btnCancelarEdicao')) {
                    const c = document.createElement('button');
                    c.id = 'btnCancelarEdicao';
                    c.type = 'button';
                    c.className = 'btn btn-light w-100 fw-bold mt-2';
                    c.innerText = 'Cancelar Edição';
                    c.onclick = resetMaquininhaForm;
                    btn.parentElement.appendChild(c);
                }
            }

            function resetMaquininhaForm() {
                const f = document.getElementById('formNovaMaquininha');
                f.dataset.mode = 'create';
                delete f.dataset.maquininhaId;
                f.reset();

                const search = document.getElementById('searchMaquininha');
                if (search) {
                    search.value = '';
                    filterMaquininhas();
                }

                const btn = f.querySelector('button[type="submit"]');
                btn.innerHTML = '<i class="bi bi-plus-lg me-1"></i> Adicionar Máquina';
                btn.classList.replace('btn-warning', 'btn-primary');
                const c = document.getElementById('btnCancelarEdicao');
                if (c) c.remove();
            }

            function filterMaquininhas() {
                const query = document.getElementById('searchMaquininha').value.toLowerCase();
                const rows = document.querySelectorAll('#listaMaquininhas tr');

                rows.forEach(row => {
                    // Check if it's the "no machines" row
                    if (row.cells.length === 1) return;

                    const sn = row.cells[1]?.innerText.toLowerCase();
                    if (sn) {
                        row.style.display = sn.includes(query) ? '' : 'none';
                    }
                });
            }

            document.getElementById('formNovaMaquininha').addEventListener('submit', async function(e) {
                e.preventDefault();
                const f = e.target;
                const mode = f.dataset.mode || 'create';
                const clienteId = f.dataset.clienteId;
                const maquininhaId = f.dataset.maquininhaId;
                const btn = f.querySelector('button[type="submit"]');
                const url = mode === 'create' ? `/admin/clientes/${clienteId}/maquininhas` :
                    `/admin/maquininhas/${maquininhaId}`;
                const method = mode === 'create' ? 'POST' : 'PUT';

                btn.disabled = true;
                try {
                    const res = await fetch(url, {
                        method: method,
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            modelo: f.querySelector('[name="modelo"]').value,
                            numero_serie: f.querySelector('[name="numero_serie"]').value,
                            status: f.querySelector('[name="status"]').value
                        })
                    });
                    const data = await res.json();
                    if (res.ok) {
                        resetMaquininhaForm();
                        loadMaquininhas(clienteId);
                        Toast.fire({
                            icon: 'success',
                            title: data.message
                        });
                    } else if (res.status === 422) {
                        let msgs = '';
                        Object.values(data.errors).forEach(errs => {
                            errs.forEach(err => {
                                msgs += `${err}<br>`;
                            });
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro de Validação',
                            html: msgs,
                            confirmButtonColor: '#6366f1'
                        });
                    } else {
                        throw new Error(data.message || 'Erro ao processar máquina.');
                    }
                } catch (e) {
                    Swal.fire('Erro', e.message, 'error');
                } finally {
                    btn.disabled = false;
                }
            });

            async function deleteMaquininha(id, clienteId) {
                const {
                    isConfirmed
                } = await Swal.fire({
                    title: 'Remover Máquina?',
                    text: "Esta ação não pode ser desfeita.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sim, remover!',
                    cancelButtonText: 'Cancelar',
                    customClass: {
                        confirmButton: 'btn btn-danger rounded-pill',
                        cancelButton: 'btn btn-light rounded-pill'
                    }
                });

                if (isConfirmed) {
                    try {
                        const res = await fetch(`/admin/maquininhas/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        });
                        const data = await res.json();
                        if (data.success) {
                            loadMaquininhas(clienteId);
                            Toast.fire({
                                icon: 'success',
                                title: data.message
                            });
                        }
                    } catch (e) {
                        Swal.fire('Erro', 'Erro ao remover máquina.', 'error');
                    }
                }
            }

            async function lookupCep(i) {
                const cep = i.value.replace(/\D/g, '');
                if (cep.length !== 8) return;
                const f = i.closest('form');
                try {
                    const r = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
                    const d = await r.json();
                    if (d.erro) return;
                    f.querySelector('[name="rua"]').value = d.logradouro || '';
                    f.querySelector('[name="bairro"]').value = d.bairro || '';
                    f.querySelector('[name="cidade"]').value = d.localidade || '';
                    f.querySelector('[name="estado"]').value = d.uf || '';
                    f.querySelector('[name="numero"]').focus();
                } catch (e) {}
            }
        </script>
    @endpush
@endsection
