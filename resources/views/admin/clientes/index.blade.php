@extends('admin.layout')

@section('page_title', '')

@section('content')
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
                    @if ($clientes->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-body-secondary text-muted small text-uppercase">
                                    <tr>
                                        <th class="ps-4">Nome</th>
                                        <th>CPF/CNPJ</th>
                                        <th>Email</th>
                                        <th>Telefone</th>
                                        <th>Status</th>
                                        <th>Validade</th>
                                        <th class="text-end pe-4">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clientes as $cliente)
                                        @include('admin.clientes._row')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-people display-1 text-body-secondary opacity-25"></i>
                            <p class="text-muted mt-3">Nenhum cliente encontrado.</p>
                        </div>
                    @endif
                </div>
                <div class="card-footer border-top">
                    {{ $clientes->links() }}
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
                    <div class="modal-footer bg-body-tertiary px-4 py-3">
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
                    <div class="modal-footer bg-body-tertiary px-4 py-3">
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
                                                    class="form-control border-0 bg-white" required placeholder="0.00">
                                                <span
                                                    class="input-group-text border-0 bg-light-subtle text-muted fw-bold">%</span>
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
                            <ul class="nav nav-pills nav-fill bg-light p-1 rounded-pill mb-4 border" id="taxasTabs"
                                role="tablist">
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

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #bbb;
        }

        .border-dashed {
            border-style: dashed !important;
        }

        #modalTaxas .form-select,
        #modalTaxas .form-control {
            border-color: #eef0f2;
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
            background: #fff !important;
        }

        .input-group-tax-list {
            background-color: #fff;
            border: 1px solid #eef0f2;
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

    <script>
        // Initialize AJAX Forms
        document.addEventListener('DOMContentLoaded', function() {
            handleAjaxForm({
                formId: 'formNovoCliente',
                modalId: 'modalNovoCliente',
                entityName: 'cliente'
            });

            handleAjaxForm({
                formId: 'formEditarCliente',
                modalId: 'modalEditarCliente',
                entityName: 'cliente',
                isEdit: true
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
                                window.location.reload();
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
                col.innerHTML = `<div class="p-2 border rounded-3 bg-white shadow-sm small">
                    <span class="text-muted fw-bold d-block mb-1">${i}x</span>
                    <div class="input-group input-group-sm rounded-2 overflow-hidden border">
                        <input type="number" name="taxas[]" step="0.01" class="form-control border-0 bg-white" value="0.00" required>
                        <span class="input-group-text border-0 bg-light text-muted fw-bold">%</span>
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

        document.addEventListener('DOMContentLoaded', () => {
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
        });

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
        // Loading state para os botões de salvar/atualizar cliente
        function setLoadingBtn(btn, label) {
            btn.disabled = true;
            btn.innerHTML =
                `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>${label}`;
        }

        document.getElementById('btnSalvarCliente')?.closest('form')?.addEventListener('submit', function() {
            setLoadingBtn(document.getElementById('btnSalvarCliente'), 'Aguarde Salvando...');
        });

        document.getElementById('btnAtualizarCliente')?.closest('form')?.addEventListener('submit', function() {
            setLoadingBtn(document.getElementById('btnAtualizarCliente'), 'Aguarde Salvando...');
        });
    </script>
@endsection
