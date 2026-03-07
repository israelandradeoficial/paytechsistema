@extends('admin.layout')

@section('page_title', 'Dashboard')

@section('content')

    <style>
        .dash-header {
            margin-bottom: 2rem;
        }

        .dash-header h2 {
            font-weight: 800;
            font-size: 1.6rem;
            color: var(--bs-heading-color);
            letter-spacing: -0.03em;
        }

        .dash-header p {
            color: var(--bs-secondary-color);
            font-size: 0.9rem;
            margin: 0;
        }

        .filter-bar {
            background: var(--bs-tertiary-bg);
            padding: 0.75rem 1.25rem;
            border-radius: 1rem;
            border: 1px solid var(--bs-border-color);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-group label {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--bs-secondary-color);
            text-transform: uppercase;
            margin: 0;
            white-space: nowrap;
        }

        .filter-control {
            border: 1px solid var(--bs-border-color);
            border-radius: 0.5rem;
            padding: 0.4rem 0.75rem;
            font-size: 0.85rem;
            color: var(--bs-body-color);
            outline: none;
            transition: all 0.2s;
            background: var(--bs-body-bg);
        }

        .filter-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        /* Stat Cards */
        .stat-card {
            background: var(--bs-body-bg);
            border-radius: 1.25rem;
            padding: 1.25rem;
            border: 1px solid var(--bs-border-color);
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px -10px rgba(0, 0, 0, 0.1);
            border-color: var(--bs-primary);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            border-radius: 1.25rem 1.25rem 0 0;
        }

        .stat-card.indigo::before {
            background: #6366f1;
        }

        .stat-card.emerald::before {
            background: #10b981;
        }

        .stat-card.rose::before {
            background: #f43f5e;
        }

        .stat-card.amber::before {
            background: #f59e0b;
        }

        .stat-card.violet::before {
            background: #8b5cf6;
        }

        .stat-card.sky::before {
            background: #0ea5e9;
        }

        .stat-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.25rem;
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
            opacity: 0.9;
        }

        .stat-icon.indigo {
            background: rgba(99, 102, 241, 0.15);
            color: #6366f1;
        }

        .stat-icon.emerald {
            background: rgba(16, 185, 129, 0.15);
            color: #10b981;
        }

        .stat-icon.rose {
            background: rgba(244, 63, 94, 0.15);
            color: #f43f5e;
        }

        .stat-icon.amber {
            background: rgba(245, 158, 11, 0.15);
            color: #f59e0b;
        }

        .stat-icon.violet {
            background: rgba(139, 92, 246, 0.15);
            color: #8b5cf6;
        }

        .stat-icon.sky {
            background: rgba(14, 165, 233, 0.15);
            color: #0ea5e9;
        }

        .stat-label {
            font-size: 0.75rem;
            color: var(--bs-secondary-color);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .stat-value {
            font-size: 1.85rem;
            font-weight: 800;
            line-height: 1;
            color: var(--bs-body-color);
            letter-spacing: -0.03em;
            margin-bottom: 0px;
        }

        .stat-bottom {
            margin-top: 5px;
            display: flex;
            align-items: center;
            min-height: 20px;
        }

        .stat-trend {
            font-size: 0.78rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            border-radius: 2rem;
            padding: 0.15rem 0.6rem;
        }

        .stat-trend.up {
            background: rgba(16, 185, 129, 0.15);
            color: #10b981;
        }

        .stat-trend.warn {
            background: rgba(245, 158, 11, 0.15);
            color: #f59e0b;
        }

        .stat-trend.danger {
            background: rgba(244, 63, 94, 0.15);
            color: #f43f5e;
        }

        /* Recent clients table */
        .recent-card {
            background: var(--bs-body-bg);
            border: 1px solid var(--bs-border-color);
            border-radius: 1.25rem;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            border-top: 4px solid #6b70f3;
        }

        .recent-card h6 {
            font-weight: 700;
            font-size: 0.9rem;
            color: var(--bs-heading-color);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 1.25rem;
        }

        .recent-table td {
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--bs-border-color);
            vertical-align: middle;
            font-size: 0.9rem;
        }

        .recent-table tr:last-child td {
            border-bottom: none;
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.85rem;
            flex-shrink: 0;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff;
        }

        /* Mobile Optimizations */
        @media (max-width: 768px) {
            .dash-header h2 {
                font-size: 1.4rem;
            }

            .filter-bar {
                padding: 0.75rem;
                flex-direction: column;
                align-items: stretch;
            }

            .filter-group {
                display: grid;
                grid-template-columns: 80px 1fr;
                align-items: center;
                gap: 0.5rem;
                width: 100%;
            }

            .filter-control {
                width: 100%;
                height: 32px;
            }

            .stat-card {
                padding: 1rem;
            }

            .stat-value {
                font-size: 1.5rem;
            }

            .recent-card {
                padding: 1rem;
            }
        }
    </style>

    {{-- Header & Filters --}}
    <div class="dash-header d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
        <div>
            <h2><i class="bi bi-speedometer2 me-2 text-indigo-500"></i>Dashboard</h2>
            <p>Bem-vindo! Aqui está um resumo filtrado da sua base.</p>
        </div>

        <form action="{{ route('admin.dashboard') }}" method="GET" class="filter-bar">
            <div class="filter-group">
                <label><i class="bi bi-calendar-week me-1"></i>Início</label>
                <input type="date" name="data_inicio" value="{{ request('data_inicio') }}" class="filter-control">
            </div>
            <div class="filter-group">
                <label><i class="bi bi-calendar-check me-1"></i>Fim</label>
                <input type="date" name="data_fim" value="{{ request('data_fim') }}" class="filter-control">
            </div>
            <div class="filter-group">
                <label><i class="bi bi-funnel me-1"></i>Status</label>
                <select name="status" class="filter-control">
                    <option value="todos" {{ request('status') == 'todos' ? 'selected' : '' }}>Todos</option>
                    <option value="ativo" {{ request('status') == 'ativo' ? 'selected' : '' }}>Ativos</option>
                    <option value="inativo" {{ request('status') == 'inativo' ? 'selected' : '' }}>Inativos</option>
                    <option value="expirado" {{ request('status') == 'expirado' ? 'selected' : '' }}>Expirados</option>
                </select>
            </div>
            <div class="filter-actions">
                <button type="submit" class="btn btn-primary btn-sm rounded-pill">
                    <i class="bi bi-search me-1"></i>Filtrar
                </button>
                @if (request()->hasAny(['data_inicio', 'data_fim', 'status']))
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                        <i class="bi bi-x-circle me-1"></i>Limpar
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Row 1: Principais Métricas --}}
    <div class="row g-3 mb-3 align-items-stretch">
        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="stat-card indigo">
                <div class="stat-top">
                    <span class="stat-label">Total de Clientes</span>
                    <div class="stat-icon indigo"><i class="bi bi-people-fill"></i></div>
                </div>
                <div class="stat-value">{{ $totalClientes }}</div>
                <div class="stat-bottom">
                    <span class="text-muted small">Base total cadastrada</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="stat-card emerald">
                <div class="stat-top">
                    <span class="stat-label">Clientes Ativos</span>
                    <div class="stat-icon emerald"><i class="bi bi-person-check-fill"></i></div>
                </div>
                <div class="stat-value">{{ $clientesAtivos }}</div>
                <div class="stat-bottom">
                    @if ($totalClientes > 0)
                        <span class="stat-trend up">
                            <i class="bi bi-arrow-up-short"></i>
                            {{ round(($clientesAtivos / $totalClientes) * 100) }}% da base
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="stat-card violet">
                <div class="stat-top">
                    <span class="stat-label">Novos (30 dias)</span>
                    <div class="stat-icon violet"><i class="bi bi-person-add"></i></div>
                </div>
                <div class="stat-value">{{ $clientesRecentes }}</div>
                <div class="stat-bottom">
                    @if ($clientesRecentes > 0)
                        <span class="stat-trend up">
                            <i class="bi bi-calendar-check text-violet-500"></i> Crescimento recente
                        </span>
                    @else
                        <span class="text-muted small">Sem novos cadastros</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Row 2: Manutenção e Alertas --}}
    <div class="row g-3 mb-4 align-items-stretch">
        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="stat-card rose">
                <div class="stat-top">
                    <span class="stat-label">Clientes Inativos</span>
                    <div class="stat-icon rose"><i class="bi bi-person-x-fill"></i></div>
                </div>
                <div class="stat-value">{{ $clientesInativos }}</div>
                <div class="stat-bottom">
                    <span class="text-muted small">Contas desativadas</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="stat-card sky">
                <div class="stat-top">
                    <span class="stat-label">Expiram em 7 dias</span>
                    <div class="stat-icon sky"><i class="bi bi-calendar-event"></i></div>
                </div>
                <div class="stat-value">{{ $clientesExpirando }}</div>
                <div class="stat-bottom">
                    @if ($clientesExpirando > 0)
                        <span class="stat-trend warn">
                            <i class="bi bi-bell-fill"></i> Necessita renovação
                        </span>
                    @else
                        <span class="stat-trend up">
                            <i class="bi bi-check-circle-fill"></i> Tudo em dia
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="stat-card amber">
                <div class="stat-top">
                    <span class="stat-label">Acesso Expirado</span>
                    <div class="stat-icon amber"><i class="bi bi-clock-history"></i></div>
                </div>
                <div class="stat-value">{{ $clientesExpirados }}</div>
                <div class="stat-bottom">
                    @if ($clientesExpirados > 0)
                        <span class="stat-trend danger">
                            <i class="bi bi-exclamation-triangle-fill"></i> Requer atenção
                        </span>
                    @else
                        <span class="text-muted small">Nenhum expirado</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Clients Table --}}
    <div class="row g-3">
        <div class="col-12">
            <div class="recent-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="mb-0"><i class="bi bi-clock me-2 text-primary"></i>Últimos Clientes Cadastrados</h6>
                    <a href="{{ route('admin.clientes.index') }}" class="btn btn-outline-primary btn-sm rounded-pill">
                        Ver todos <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                @if ($ultimosClientes->isEmpty())
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-people display-5 d-block mb-2 opacity-25"></i>
                        Nenhum cliente cadastrado ainda.
                    </div>
                @else
                    <div class="recent-table-wrapper">
                        <table class="table recent-table mb-0">
                            <thead>
                                <tr class="text-muted"
                                    style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.06em;">
                                    <th class="fw-semibold border-0 pb-2">Cliente</th>
                                    <th class="fw-semibold border-0 pb-2 d-none d-md-table-cell">CPF/CNPJ</th>
                                    <th class="fw-semibold border-0 pb-2 d-none d-lg-table-cell">Email</th>
                                    <th class="fw-semibold border-0 pb-2">Validade</th>
                                    <th class="fw-semibold border-0 pb-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ultimosClientes as $c)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="avatar">{{ strtoupper(substr($c->nome, 0, 2)) }}</div>
                                                <div>
                                                    <div class="fw-semibold text-dark" style="font-size:0.9rem;">
                                                        {{ $c->nome }}</div>
                                                    <div class="text-muted" style="font-size:0.78rem;">
                                                        {{ $c->telefone_formatado }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-muted d-none d-md-table-cell">{{ $c->cpf_cnpj_formatado }}</td>
                                        <td class="text-muted d-none d-lg-table-cell">{{ $c->email }}</td>
                                        <td>
                                            @if ($c->data_validade)
                                                @if ($c->data_validade->toDateString() < today()->toDateString())
                                                    <span
                                                        class="badge bg-danger-subtle text-danger border border-danger-subtle">
                                                        <i
                                                            class="bi bi-calendar-x me-1"></i>{{ $c->data_validade->format('d/m/Y') }}
                                                    </span>
                                                @else
                                                    <span class="badge bg-light text-secondary border">
                                                        {{ $c->data_validade->format('d/m/Y') }}
                                                    </span>
                                                @endif
                                            @else
                                                <span class="text-muted small">Vitalício</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($c->status === 'ativo')
                                                <span
                                                    class="badge bg-success-subtle text-success border border-success-subtle">
                                                    <span class="status-dot dot-ativo"></span>Ativo
                                                </span>
                                            @else
                                                <span
                                                    class="badge bg-danger-subtle text-danger border border-danger-subtle">
                                                    <span class="status-dot dot-inativo"></span>Inativo
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
