<div class="btn-group">
    <a href="{{ route('simulator.index') }}" target="_blank" class="btn btn-outline-info btn-sm border-0"
        title="Abrir Simulador">
        <i class="bi bi-box-arrow-up-right"></i>
    </a>

    <a href="{{ route('admin.clientes.pdf', $cliente->id) }}" target="_blank"
        class="btn btn-outline-danger btn-sm border-0" title="Imprimir Ficha">
        <i class="bi bi-file-earmark-pdf"></i>
    </a>

    @can('manage_rates')
        <button type="button" class="btn btn-outline-primary btn-sm border-0" data-bs-toggle="modal"
            data-bs-target="#modalTaxas" data-cliente-id="{{ $cliente->id }}" data-cliente-nome="{{ $cliente->nome }}"
            title="Gerenciar Taxas">
            <i class="bi bi-percent"></i>
        </button>
    @endcan

    @can('manage_clients')
        <button type="button" class="btn btn-outline-secondary btn-sm border-0" data-bs-toggle="modal"
            data-bs-target="#modalEditarCliente" data-id="{{ $cliente->id }}" data-nome="{{ $cliente->nome }}"
            data-cpf_cnpj="{{ $cliente->cpf_cnpj_formatado }}" data-nascimento="{{ $cliente->nascimento }}"
            data-email="{{ $cliente->email }}" data-telefone="{{ $cliente->telefone_formatado }}"
            data-cep="{{ $cliente->cep_formatado }}" data-rua="{{ $cliente->rua }}" data-bairro="{{ $cliente->bairro }}"
            data-numero="{{ $cliente->numero }}" data-cidade="{{ $cliente->cidade }}"
            data-estado="{{ $cliente->estado }}" data-complemento="{{ $cliente->complemento }}"
            data-status="{{ $cliente->status }}"
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
