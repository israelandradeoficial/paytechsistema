@extends('admin.layout')

@section('content')
    <style>
        .transition-all {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(99, 102, 241, 0.05);
        }

        .modal-content {
            border-radius: 1.25rem;
            border: none;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.2);
            background-color: var(--bs-body-bg);
        }

        .form-label {
            color: var(--bs-secondary-color);
            letter-spacing: 0.025em;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .form-control,
        .form-select {
            border: 1px solid var(--bs-border-color);
            background-color: var(--bs-body-bg);
            color: var(--bs-body-color);
            border-radius: 0.75rem;
            transition: all 0.2s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            background-color: var(--bs-body-bg);
            color: var(--bs-body-color);
        }

        .permission-card {
            cursor: pointer;
            border: 1px solid var(--bs-border-color);
            background: var(--bs-body-bg);
            padding: 1rem;
            border-radius: 1rem;
            transition: all 0.3s ease;
        }

        .permission-card:hover {
            border-color: #6366f1;
            background: var(--bs-tertiary-bg);
            transform: translateY(-2px);
        }

        .permission-card .form-check-input:checked~label {
            color: #6366f1;
            font-weight: 600;
        }

        .shadow-xs {
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .form-check-input {
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: #6366f1;
            border-color: #6366f1;
        }

        .avatar-upload-container {
            position: relative;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .avatar-upload-container:hover .avatar-overlay {
            opacity: 1;
        }

        .avatar-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.3s ease;
            cursor: pointer;
            border-radius: 50%;
        }
    </style>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card card-primary card-outline shadow-sm overflow-hidden" style="border-radius: 1rem;">
        <div class="card-header border-bottom d-flex align-items-center py-3">
            <div class="d-flex flex-column">
                <h3 class="card-title fw-bold mb-0">Gestão de Usuários</h3>
                <p class="text-muted small mb-0">Gerencie as permissões e perfis de acesso do sistema</p>
            </div>
            <div class="ms-auto">
                @can('manage_users')
                    <button type="button" class="btn btn-primary btn-sm rounded-pill px-4 d-flex align-items-center gap-2"
                        data-bs-toggle="modal" data-bs-target="#modalUserCreate">
                        <i class="bi bi-person-plus"></i>
                        Novo Usuário
                    </button>
                @endcan
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-body-secondary text-muted small text-uppercase">
                        <tr>
                            <th class="ps-4 py-3 text-muted small fw-bold text-uppercase italic"
                                style="width: 80px; letter-spacing: 0.05em;">Perfil</th>
                            <th class="py-3 text-muted small fw-bold text-uppercase" style="letter-spacing: 0.05em;">
                                Identificação</th>
                            <th class="py-3 text-muted small fw-bold text-uppercase" style="letter-spacing: 0.05em;">Nível
                            </th>
                            <th class="py-3 text-muted small fw-bold text-uppercase" style="letter-spacing: 0.05em;">
                                Verificação</th>
                            <th class="py-3 text-muted small fw-bold text-uppercase" style="letter-spacing: 0.05em;">
                                Status</th>
                            <th class="text-end pe-4 py-3 text-muted small fw-bold text-uppercase"
                                style="letter-spacing: 0.05em;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            @include('admin.users._row')
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-people d-block fs-1 mb-3 opacity-25"></i>
                                        Nenhum usuário cadastrado até o momento.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($users->hasPages())
                <div class="card-footer border-top">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Create -->
    <div class="modal fade" id="modalUserCreate" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header">
                    <div class="d-flex align-items-start w-100">
                        <div
                            class="bg-primary bg-opacity-10 dark:bg-opacity-20 p-2 rounded-2 me-3 shadow-sm border border-primary border-opacity-10">
                            <i class="bi bi-person-plus-fill text-primary"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="modal-title fw-800 mb-0" style="letter-spacing: -0.02em;">Cadastrar Novo
                                Usuário</h5>
                            <p class="text-muted small mb-0 fw-medium opacity-75">Configure o perfil e permissões do novo
                                colaborador</p>
                        </div>
                        <button type="button" class="btn-close ms-auto shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                </div>
                <form id="formUserCreate" action="{{ route('admin.users.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-12 text-center mb-4">
                                <div class="avatar-upload-container">
                                    <div class="avatar-preview mx-auto position-relative"
                                        style="width: 120px; height: 120px;">
                                        <img id="create_preview"
                                            src="https://ui-avatars.com/api/?name=New+User&color=7F9CF5&background=EBF4FF"
                                            class="rounded-circle shadow-sm border p-1"
                                            style="width: 100%; height: 100%; border-radius: 50% !important; object-fit: cover;">
                                        <label for="create_avatar" class="avatar-overlay rounded-circle">
                                            <i class="bi bi-camera text-white fs-4"></i>
                                        </label>
                                    </div>
                                    <p class="mt-2 mb-0 x-small text-muted fw-bold text-uppercase">Foto de Perfil</p>
                                    <input type="file" name="avatar" id="create_avatar" class="d-none" accept="image/*"
                                        onchange="previewImage(this, 'create_preview')">
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-uppercase">Nome Completo</label>
                                <div class="input-group">
                                    <span class="input-group-text border-end-0"><i
                                            class="bi bi-person text-muted"></i></span>
                                    <input type="text" name="name" class="form-control" placeholder="Ex: João Silva"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-uppercase">E-mail</label>
                                <div class="input-group">
                                    <span class="input-group-text border-end-0"><i
                                            class="bi bi-envelope text-muted"></i></span>
                                    <input type="email" name="email" class="form-control"
                                        placeholder="joao@paytech.com" required>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label small fw-bold text-uppercase">CPF</label>
                                <div class="input-group">
                                    <span class="input-group-text border-end-0"><i
                                            class="bi bi-card-text text-muted"></i></span>
                                    <input type="text" name="cpf" id="create_cpf" class="form-control"
                                        placeholder="000.000.000-00" value="{{ old('cpf') }}">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label small fw-bold text-uppercase">Telefone</label>
                                <div class="input-group">
                                    <span class="input-group-text border-end-0"><i
                                            class="bi bi-telephone text-muted"></i></span>
                                    <input type="text" name="phone" id="create_phone" class="form-control"
                                        placeholder="(00) 00000-0000" value="{{ old('phone') }}">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label small fw-bold text-uppercase">Data de Nascimento</label>
                                <div class="input-group">
                                    <span class="input-group-text border-end-0"><i
                                            class="bi bi-calendar-event text-muted"></i></span>
                                    <input type="date" name="birth_date" class="form-control"
                                        value="{{ old('birth_date') }}">
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="modal-section-card">
                                    <p class="x-small text-muted mb-3 fw-bold text-uppercase"><i
                                            class="bi bi-geo-alt me-1 text-primary"></i> Endereço Completo</p>
                                    <div class="row g-3">
                                        <div class="col-md-3">
                                            <label class="form-label x-small fw-bold text-uppercase">CEP</label>
                                            <input type="text" name="cep" id="create_cep"
                                                class="form-control form-control-sm" placeholder="00000-000"
                                                onblur="buscarCep(this.value, 'create')" value="{{ old('cep') }}">
                                        </div>
                                        <div class="col-md-7">
                                            <label class="form-label x-small fw-bold text-uppercase">Logradouro</label>
                                            <input type="text" name="address" id="create_address"
                                                class="form-control form-control-sm" placeholder="Rua, Avenida..."
                                                value="{{ old('address') }}">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label x-small fw-bold text-uppercase">Número</label>
                                            <input type="text" name="number" id="create_number"
                                                class="form-control form-control-sm" placeholder="123"
                                                value="{{ old('number') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label x-small fw-bold text-uppercase">Complemento</label>
                                            <input type="text" name="complement" id="create_complement"
                                                class="form-control form-control-sm" placeholder="Apto, Bloco..."
                                                value="{{ old('complement') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label x-small fw-bold text-uppercase">Bairro</label>
                                            <input type="text" name="neighborhood" id="create_neighborhood"
                                                class="form-control form-control-sm" placeholder="Bairro"
                                                value="{{ old('neighborhood') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label x-small fw-bold text-uppercase">Cidade</label>
                                            <input type="text" name="city" id="create_city"
                                                class="form-control form-control-sm" placeholder="Cidade"
                                                value="{{ old('city') }}">
                                        </div>
                                        <div class="col-md-1">
                                            <label class="form-label x-small fw-bold text-uppercase">UF</label>
                                            <input type="text" name="state" id="create_state"
                                                class="form-control form-control-sm" placeholder="UF" maxlength="2"
                                                value="{{ old('state') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="modal-section-card">
                                    <p class="x-small text-muted mb-3 fw-bold text-uppercase"><i
                                            class="bi bi-shield-lock me-1"></i> Segurança de Acesso</p>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label x-small fw-bold text-uppercase">Nova Senha</label>
                                            <div class="input-group">
                                                <span class="input-group-text border-end-0"><i
                                                        class="bi bi-key text-muted"></i></span>
                                                <input type="password" name="password" class="form-control"
                                                    placeholder="Deixe em branco para manter">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label x-small fw-bold text-uppercase">Confirmar
                                                Senha</label>
                                            <div class="input-group">
                                                <span class="input-group-text border-end-0"><i
                                                        class="bi bi-shield-check text-muted"></i></span>
                                                <input type="password" name="password_confirmation" class="form-control"
                                                    placeholder="••••••••">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="modal-section-card">
                                    <div class="form-check form-switch d-flex align-items-center mb-0">
                                        <input type="hidden" name="is_active" value="0">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                            id="create_is_active" checked>
                                        <label class="form-check-label fw-bold text-uppercase small ms-2"
                                            for="create_is_active">
                                            Status da Conta: <span class="text-success ms-1">Ativa</span>
                                        </label>
                                    </div>
                                    <p class="x-small text-muted mb-0 mt-1">Quando inativa, o usuário não conseguirá
                                        acessar o sistema.</p>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label class="form-label small fw-bold text-uppercase">Nível de Acesso</label>
                                <div class="input-group">
                                    <span class="input-group-text border-end-0"><i
                                            class="bi bi-layers text-muted"></i></span>
                                    <select name="role" class="form-select" required
                                        onchange="togglePermissions(this, 'create_permissions_section')">
                                        <option value="atendente">Atendente</option>
                                        <option value="gerente">Gerente</option>
                                        <option value="admin">Administrador (Acesso Total)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12" id="create_permissions_section">
                                <div class="modal-section-card">
                                    <h6 class="small fw-bold text-uppercase mb-3 d-flex align-items-center">
                                        <i class="bi bi-key me-2 text-primary"></i> Permissões de Módulo
                                    </h6>
                                    <div class="row g-3">
                                        @foreach ($permissions as $permission)
                                            @if ($permission->slug !== 'use_simulator')
                                                <div class="col-md-6">
                                                    <div class="permission-card transition-all">
                                                        <div class="form-check form-switch mb-0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="permissions[]" value="{{ $permission->id }}"
                                                                id="perm_create_{{ $permission->id }}">
                                                            <label class="form-check-label d-block ms-2 pe-none"
                                                                for="perm_create_{{ $permission->id }}">
                                                                <div class="d-flex align-items-center">
                                                                    @php
                                                                        $icon = match ($permission->slug) {
                                                                            'manage_users' => 'bi-people',
                                                                            'manage_clients' => 'bi-briefcase',
                                                                            'manage_rates' => 'bi-percent',
                                                                            default => 'bi-check-circle',
                                                                        };
                                                                    @endphp
                                                                    <i
                                                                        class="bi {{ $icon }} me-2 text-muted x-small"></i>
                                                                    <span
                                                                        class="fw-bold d-block">{{ $permission->name }}</span>
                                                                </div>
                                                                <span
                                                                    class="d-block x-small text-muted fw-normal mt-0">{{ $permission->description }}</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-link text-muted text-decoration-none fw-bold"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary px-5 rounded-pill fw-bold shadow-sm">
                            <i class="bi bi-check2-circle me-2"></i>Salvar Usuário
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="modalUserEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header">
                    <div class="d-flex align-items-start w-100">
                        <div
                            class="bg-primary bg-opacity-10 dark:bg-opacity-20 p-2 rounded-2 me-3 shadow-sm border border-primary border-opacity-10">
                            <i class="bi bi-pencil-fill text-primary"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="modal-title fw-800 mb-0" style="letter-spacing: -0.02em;">Editar Usuário
                            </h5>
                            <p class="text-muted small mb-0 fw-medium opacity-75">Atualize as informações e níveis de
                                acesso do colaborador</p>
                        </div>
                        <button type="button" class="btn-close ms-auto shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                </div>
                <form id="formUserEdit" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-12 text-center mb-4">
                                <div class="avatar-upload-container">
                                    <div class="avatar-preview mx-auto position-relative"
                                        style="width: 120px; height: 120px;">
                                        <img id="edit_preview" src="" class="rounded-circle shadow-sm border p-1"
                                            style="width: 100%; height: 100%; border-radius: 50% !important; object-fit: cover;">
                                        <label for="edit_avatar" class="avatar-overlay rounded-circle">
                                            <i class="bi bi-camera text-white fs-4"></i>
                                        </label>
                                    </div>
                                    <p class="mt-2 mb-0 x-small text-muted fw-bold text-uppercase">Alterar Foto</p>
                                    <input type="file" name="avatar" id="edit_avatar" class="d-none"
                                        accept="image/*" onchange="previewImage(this, 'edit_preview')">
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-uppercase">Nome Completo</label>
                                <div class="input-group">
                                    <span class="input-group-text border-end-0"><i
                                            class="bi bi-person text-muted"></i></span>
                                    <input type="text" name="name" id="edit_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-uppercase">E-mail</label>
                                <div class="input-group">
                                    <span class="input-group-text border-end-0"><i
                                            class="bi bi-envelope text-muted"></i></span>
                                    <input type="email" name="email" id="edit_email" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label small fw-bold text-uppercase">CPF</label>
                                <div class="input-group">
                                    <span class="input-group-text border-end-0"><i
                                            class="bi bi-card-text text-muted"></i></span>
                                    <input type="text" name="cpf" id="edit_cpf" class="form-control"
                                        placeholder="000.000.000-00">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label small fw-bold text-uppercase">Telefone</label>
                                <div class="input-group">
                                    <span class="input-group-text border-end-0"><i
                                            class="bi bi-telephone text-muted"></i></span>
                                    <input type="text" name="phone" id="edit_phone" class="form-control"
                                        placeholder="(00) 00000-0000">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label small fw-bold text-uppercase">Data de Nascimento</label>
                                <div class="input-group">
                                    <span class="input-group-text border-end-0"><i
                                            class="bi bi-calendar-event text-muted"></i></span>
                                    <input type="date" name="birth_date" id="edit_birth_date" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="card border-0 bg-body-tertiary rounded-4 p-3 border border-dashed">
                                    <p class="x-small text-muted mb-3 fw-bold text-uppercase"><i
                                            class="bi bi-geo-alt me-1 text-primary"></i> Endereço Completo</p>
                                    <div class="row g-3">
                                        <div class="col-md-3">
                                            <label class="form-label x-small fw-bold text-uppercase">CEP</label>
                                            <input type="text" name="cep" id="edit_cep"
                                                class="form-control form-control-sm" placeholder="00000-000"
                                                onblur="buscarCep(this.value, 'edit')">
                                        </div>
                                        <div class="col-md-7">
                                            <label class="form-label x-small fw-bold text-uppercase">Logradouro</label>
                                            <input type="text" name="address" id="edit_address"
                                                class="form-control form-control-sm" placeholder="Rua, Avenida...">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label x-small fw-bold text-uppercase">Número</label>
                                            <input type="text" name="number" id="edit_number"
                                                class="form-control form-control-sm" placeholder="123">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label x-small fw-bold text-uppercase">Complemento</label>
                                            <input type="text" name="complement" id="edit_complement"
                                                class="form-control form-control-sm" placeholder="Apto, Bloco...">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label x-small fw-bold text-uppercase">Bairro</label>
                                            <input type="text" name="neighborhood" id="edit_neighborhood"
                                                class="form-control form-control-sm" placeholder="Bairro">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label x-small fw-bold text-uppercase">Cidade</label>
                                            <input type="text" name="city" id="edit_city"
                                                class="form-control form-control-sm" placeholder="Cidade">
                                        </div>
                                        <div class="col-md-1">
                                            <label class="form-label x-small fw-bold text-uppercase">UF</label>
                                            <input type="text" name="state" id="edit_state"
                                                class="form-control form-control-sm" placeholder="UF" maxlength="2">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="modal-section-card">
                                    <p class="x-small text-muted mb-3 fw-bold text-uppercase"><i
                                            class="bi bi-shield-lock me-1"></i> Segurança de Acesso</p>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label x-small fw-bold text-uppercase">Nova Senha</label>
                                            <div class="input-group">
                                                <span class="input-group-text border-end-0"><i
                                                        class="bi bi-key text-muted"></i></span>
                                                <input type="password" name="password" class="form-control"
                                                    placeholder="Deixe em branco para manter">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label x-small fw-bold text-uppercase">Confirmar
                                                Senha</label>
                                            <div class="input-group">
                                                <span class="input-group-text border-end-0"><i
                                                        class="bi bi-shield-check text-muted"></i></span>
                                                <input type="password" name="password_confirmation" class="form-control"
                                                    placeholder="••••••••">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="modal-section-card">
                                    <div class="form-check form-switch d-flex align-items-center mb-0">
                                        <input type="hidden" name="is_active" value="0">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                            id="edit_is_active">
                                        <label class="form-check-label fw-bold text-uppercase small ms-2"
                                            for="edit_is_active">
                                            Status da Conta: <span id="edit_status_label" class="ms-1"></span>
                                        </label>
                                    </div>
                                    <p class="x-small text-muted mb-0 mt-1">Quando inativa, o usuário não conseguirá
                                        acessar o sistema.</p>
                                </div>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label class="form-label small fw-bold text-uppercase">Nível de Acesso</label>
                                <div class="input-group">
                                    <span class="input-group-text border-end-0"><i
                                            class="bi bi-layers text-muted"></i></span>
                                    <select name="role" id="edit_role" class="form-select" required
                                        onchange="togglePermissions(this, 'edit_permissions_section')">
                                        <option value="atendente">Atendente</option>
                                        <option value="gerente">Gerente</option>
                                        <option value="admin">Administrador (Acesso Total)</option>
                                    </select>
                                </div>
                                <div id="edit_role_note" class="x-small text-warning mt-2 d-none">
                                    <i class="bi bi-exclamation-triangle-fill me-1"></i> Você não pode alterar seu próprio
                                    nível de acesso.
                                </div>
                            </div>

                            <div class="col-md-12" id="edit_permissions_section">
                                <div class="p-3 rounded-4 bg-body-tertiary border border-dashed">
                                    <h6 class="small fw-bold text-uppercase mb-3 d-flex align-items-center">
                                        <i class="bi bi-key me-2 text-primary"></i> Permissões de Módulo
                                    </h6>
                                    <div class="row g-3">
                                        @foreach ($permissions as $permission)
                                            @if ($permission->slug !== 'use_simulator')
                                                <div class="col-md-6">
                                                    <div class="permission-card transition-all">
                                                        <div class="form-check form-switch mb-0">
                                                            <input class="form-check-input permission-checkbox"
                                                                type="checkbox" name="permissions[]"
                                                                value="{{ $permission->id }}"
                                                                id="perm_edit_{{ $permission->id }}">
                                                            <label class="form-check-label d-block ms-2 pe-none"
                                                                for="perm_edit_{{ $permission->id }}">
                                                                <div class="d-flex align-items-center">
                                                                    @php
                                                                        $icon = match ($permission->slug) {
                                                                            'manage_users' => 'bi-people',
                                                                            'manage_clients' => 'bi-briefcase',
                                                                            'manage_rates' => 'bi-percent',
                                                                            default => 'bi-check-circle',
                                                                        };
                                                                    @endphp
                                                                    <i
                                                                        class="bi {{ $icon }} me-2 text-muted x-small"></i>
                                                                    <span
                                                                        class="fw-bold d-block">{{ $permission->name }}</span>
                                                                </div>
                                                                <span
                                                                    class="d-block x-small text-muted fw-normal mt-0">{{ $permission->description }}</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-link text-muted text-decoration-none fw-bold"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary px-5 rounded-pill fw-bold shadow-sm">
                            <i class="bi bi-check2-circle me-2"></i>Salvar Alterações
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input, previewId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(previewId).src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function togglePermissions(select, sectionId) {
            const section = document.getElementById(sectionId);
            if (!section) return;
            if (select.value === 'admin') {
                section.style.opacity = '0.5';
                section.style.pointerEvents = 'none';
                section.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = true);
            } else {
                section.style.opacity = '1';
                section.style.pointerEvents = 'auto';
            }
        }

        function buscarCep(cep, prefix) {
            cep = cep.replace(/\D/g, '');
            if (cep != "") {
                var validacep = /^[0-9]{8}$/;
                if (validacep.test(cep)) {
                    document.getElementById(prefix + '_address').value = "...";
                    document.getElementById(prefix + '_neighborhood').value = "...";
                    document.getElementById(prefix + '_city').value = "...";
                    document.getElementById(prefix + '_state').value = "...";

                    fetch(`https://viacep.com.br/ws/${cep}/json/`)
                        .then(response => response.json())
                        .then(data => {
                            if (!("erro" in data)) {
                                document.getElementById(prefix + '_address').value = data.logradouro;
                                document.getElementById(prefix + '_neighborhood').value = data.bairro;
                                document.getElementById(prefix + '_city').value = data.localidade;
                                document.getElementById(prefix + '_state').value = data.uf;
                                document.getElementById(prefix + '_number').focus();
                            } else {
                                alert("CEP não encontrado.");
                                document.getElementById(prefix + '_address').value = "";
                                document.getElementById(prefix + '_neighborhood').value = "";
                                document.getElementById(prefix + '_city').value = "";
                                document.getElementById(prefix + '_state').value = "";
                            }
                        })
                        .catch(error => {
                            console.error('Erro ao buscar CEP:', error);
                            alert("Erro ao buscar o CEP.");
                        });
                }
            }
        }

        // Status Label Toggle Handlers
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('create_is_active')?.addEventListener('change', function() {
                const label = this.nextElementSibling.querySelector('span');
                if (this.checked) {
                    label.textContent = 'Ativa';
                    label.className = 'text-success ms-1';
                } else {
                    label.textContent = 'Inativa';
                    label.className = 'text-danger ms-1';
                }
            });

            document.getElementById('edit_is_active')?.addEventListener('change', function() {
                const label = document.getElementById('edit_status_label');
                if (this.checked) {
                    label.textContent = 'Ativa';
                    label.className = 'text-success ms-1';
                } else {
                    label.textContent = 'Inativa';
                    label.className = 'text-danger ms-1';
                }
            });
        });

        function applyMasks() {
            const cpfInputs = document.querySelectorAll('input[name="cpf"]');
            const phoneInputs = document.querySelectorAll('input[name="phone"]');
            const cepInputs = document.querySelectorAll('input[name="cep"]');

            cpfInputs.forEach(input => {
                input.addEventListener('input', e => {
                    let v = e.target.value.replace(/\D/g, '');
                    v = v.replace(/(\d{3})(\d)/, '$1.$2');
                    v = v.replace(/(\d{3})(\d)/, '$1.$2');
                    v = v.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                    e.target.value = v.substring(0, 14);
                });
            });

            phoneInputs.forEach(input => {
                input.addEventListener('input', e => {
                    let v = e.target.value.replace(/\D/g, '');
                    v = v.replace(/^(\d{2})(\d)/g, '($1) $2');
                    v = v.replace(/(\d)(\d{4})$/, '$1-$2');
                    e.target.value = v.substring(0, 15);
                });
            });

            cepInputs.forEach(input => {
                input.addEventListener('input', e => {
                    let v = e.target.value.replace(/\D/g, '');
                    v = v.replace(/^(\d{5})(\d)/, '$1-$2');
                    e.target.value = v.substring(0, 9);
                });
            });
        }

        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Tem certeza?',
                text: `Deseja realmente excluir o usuário "${name}"? Esta ação não pode ser desfeita.`,
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
                        const response = await fetch(`/admin/users/${id}`, {
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
                            const row = document.getElementById(`user-row-${id}`);
                            if (row) {
                                row.style.opacity = '0';
                                row.style.transform = 'translateX(20px)';
                                setTimeout(() => row.remove(), 300);
                            }

                            Toast.fire({
                                icon: 'success',
                                title: data.message || 'Excluído com sucesso!'
                            });
                        } else {
                            throw new Error(data.message || 'Erro ao excluir usuário.');
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
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Apply masks correctly
            applyMasks();

            // Initialize AJAX Forms
            handleAjaxForm({
                formId: 'formUserCreate',
                modalId: 'modalUserCreate',
                entityName: 'user'
            });

            handleAjaxForm({
                formId: 'formUserEdit',
                modalId: 'modalUserEdit',
                entityName: 'user',
                isEdit: true
            });

            // Make permission cards clickable
            document.querySelectorAll('.permission-card').forEach(card => {
                card.addEventListener('click', function(e) {
                    if (e.target.tagName !== 'INPUT') {
                        const checkbox = this.querySelector('input[type="checkbox"]');
                        if (checkbox && !checkbox.disabled) {
                            checkbox.checked = !checkbox.checked;
                            checkbox.dispatchEvent(new Event('change'));
                        }
                    }
                });
            });

            const modalEdit = document.getElementById('modalUserEdit');
            if (modalEdit) {
                applyMasks();
                modalEdit.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    if (!button) return;

                    const user = JSON.parse(button.getAttribute('data-user'));
                    const avatarUrl = button.getAttribute('data-avatar');
                    const userPermissions = JSON.parse(button.getAttribute('data-permissions'));

                    const form = document.getElementById('formUserEdit');
                    form.action = `/admin/users/${user.id}`;

                    // Basic Info
                    document.getElementById('edit_name').value = user.name;
                    document.getElementById('edit_email').value = user.email;
                    document.getElementById('edit_preview').src = avatarUrl ||
                        `https://ui-avatars.com/api/?name=${encodeURIComponent(user.name)}&color=7F9CF5&background=EBF4FF`;

                    // Profile Fields
                    document.getElementById('edit_cpf').value = user.cpf || '';
                    document.getElementById('edit_phone').value = user.phone || '';
                    document.getElementById('edit_birth_date').value = user.birth_date || '';

                    // Address Fields
                    document.getElementById('edit_cep').value = user.cep || '';
                    document.getElementById('edit_address').value = user.address || '';
                    document.getElementById('edit_number').value = user.number || '';
                    document.getElementById('edit_complement').value = user.complement || '';
                    document.getElementById('edit_neighborhood').value = user.neighborhood || '';
                    document.getElementById('edit_city').value = user.city || '';
                    document.getElementById('edit_state').value = user.state || '';

                    const roleSelect = document.getElementById('edit_role');
                    roleSelect.value = user.role;

                    // Reset permissions
                    document.querySelectorAll('.permission-checkbox').forEach(cb => {
                        cb.checked = userPermissions.includes(parseInt(cb.value));
                    });

                    // Populate is_active
                    const isActive = user.is_active;
                    const isActiveCheckbox = document.getElementById('edit_is_active');
                    const statusLabel = document.getElementById('edit_status_label');

                    isActiveCheckbox.checked = !!isActive;
                    if (isActiveCheckbox.checked) {
                        statusLabel.textContent = 'Ativa';
                        statusLabel.className = 'text-success ms-1';
                    } else {
                        statusLabel.textContent = 'Inativa';
                        statusLabel.className = 'text-danger ms-1';
                    }

                    togglePermissions(roleSelect, 'edit_permissions_section');

                    const currentUserId = {{ auth()->id() }};
                    const roleNote = document.getElementById('edit_role_note');

                    if (user.id === currentUserId) {
                        roleSelect.disabled = true;
                        roleNote.classList.remove('d-none');
                        if (!document.getElementById('hidden_role')) {
                            const hiddenRole = document.createElement('input');
                            hiddenRole.type = 'hidden';
                            hiddenRole.name = 'role';
                            hiddenRole.id = 'hidden_role';
                            hiddenRole.value = user.role;
                            form.appendChild(hiddenRole);
                        }
                    } else {
                        roleSelect.disabled = false;
                        roleNote.classList.add('d-none');
                        const hiddenRole = document.getElementById('hidden_role');
                        if (hiddenRole) hiddenRole.remove();
                    }
                });
            }

            @if ($errors->any())
                @if (old('_method') != 'PUT')
                    // Open create modal if validation failed on store
                    const createModalEl = document.getElementById('modalUserCreate');
                    if (createModalEl && typeof bootstrap !== 'undefined') {
                        new bootstrap.Modal(createModalEl).show();
                    }
                @endif
            @endif
        });
    </script>
@endsection
