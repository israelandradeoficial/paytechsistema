<tr id="cliente-row-{{ $cliente->id }}">
    <td class="ps-4">
        <div class="fw-bold">{{ $cliente->nome }}</div>
    </td>
    <td>{{ $cliente->cpf_cnpj_formatado }}</td>
    <td>{{ $cliente->email }}</td>
    <td>{{ $cliente->telefone_formatado }}</td>
    <td>
        @if ($cliente->status === 'ativo')
            <span class="badge bg-success-subtle text-success border border-success-subtle">Ativo</span>
        @else
            <span class="badge bg-danger-subtle text-danger border border-danger-subtle">Inativo</span>
        @endif
    </td>
    <td>
        @if ($cliente->data_validade)
            @if ($cliente->data_validade->lt(today()))
                <span class="badge bg-warning-subtle text-warning border border-warning-subtle">
                    <i class="bi bi-clock-history me-1"></i>{{ $cliente->data_validade->format('d/m/Y') }}
                </span>
            @else
                <span class="text-muted small">{{ $cliente->data_validade->format('d/m/Y') }}</span>
            @endif
        @else
            <span class="text-muted small">—</span>
        @endif
    </td>
    <td class="text-end pe-4">
        <div class="btn-group">
            <a href="{{ route('simulator.index') }}" target="_blank" class="btn btn-outline-info btn-sm border-0"
                title="Abrir Simulador">
                <i class="bi bi-box-arrow-up-right"></i>
            </a>

            @can('manage_rates')
                <button type="button" class="btn btn-outline-primary btn-sm border-0" data-bs-toggle="modal"
                    data-bs-target="#modalTaxas" data-cliente-id="{{ $cliente->id }}"
                    data-cliente-nome="{{ $cliente->nome }}" title="Gerenciar Taxas">
                    <i class="bi bi-percent"></i>
                </button>
            @endcan

            @can('manage_clients')
                <button type="button" class="btn btn-outline-secondary btn-sm border-0" data-bs-toggle="modal"
                    data-bs-target="#modalEditarCliente" data-id="{{ $cliente->id }}" data-nome="{{ $cliente->nome }}"
                    data-cpf_cnpj="{{ $cliente->cpf_cnpj_formatado }}" data-nascimento="{{ $cliente->nascimento }}"
                    data-email="{{ $cliente->email }}" data-telefone="{{ $cliente->telefone_formatado }}"
                    data-cep="{{ $cliente->cep_formatado }}" data-rua="{{ $cliente->rua }}"
                    data-bairro="{{ $cliente->bairro }}" data-numero="{{ $cliente->numero }}"
                    data-cidade="{{ $cliente->cidade }}" data-estado="{{ $cliente->estado }}"
                    data-complemento="{{ $cliente->complemento }}" data-status="{{ $cliente->status }}"
                    data-data_validade="{{ $cliente->data_validade ? $cliente->data_validade->format('Y-m-d') : '' }}">
                    <i class="bi bi-pencil"></i>
                </button>
            @endcan

            @can('manage_clients')
                <button type="button" class="btn btn-outline-danger btn-sm border-0 btn-delete-cliente"
                    data-id="{{ $cliente->id }}" data-nome="{{ $cliente->nome }}">
                    <i class="bi bi-trash"></i>
                </button>
            @endcan
        </div>
    </td>
</tr>
