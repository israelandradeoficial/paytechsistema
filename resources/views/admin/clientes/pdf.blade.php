<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Ficha Cadastral - {{ $cliente->nome }}</title>
    <style>
        @page {
            margin: 0.8cm 1.0cm;
        }

        /* Strict Sans-Serif Enforcement */
        * {
            font-family: Helvetica, Arial, sans-serif !important;
        }

        body {
            color: #334155;
            line-height: 1.3;
            margin: 0;
            padding: 0;
            font-size: 10px;
        }

        .container {
            width: 100%;
        }

        /* Header Area */
        .header-table {
            width: 100%;
            border-bottom: 1px solid #6f727aff;
            margin-bottom: 15px;
            padding-bottom: 15px;
        }

        .logo-cell {
            width: 50%;
            vertical-align: middle;
        }

        .logo-img {
            max-height: 40px;
            max-width: 180px;
        }

        .company-cell {
            width: 50%;
            text-align: right;
            vertical-align: middle;
        }

        .company-name {
            font-size: 16px;
            font-weight: bold;
            color: #0f172a;
            margin: 0;
        }

        .company-info {
            font-size: 9px;
            color: #64748b;
            margin-top: 5px;
            text-transform: uppercase;
            line-height: 1.4;
        }

        /* Title Section - No borders here as per user request */
        .headline-section {
            margin-bottom: 15px;
            padding: 0;
        }

        .headline-section h1 {
            font-size: 24px;
            color: #0f172a;
            margin: 0;
            font-weight: bold;
        }

        .headline-meta {
            font-size: 10px;
            color: #6a788dff;
            margin-top: 0px;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* Structured Grid Tables - Borders ONLY here */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            table-layout: fixed;
            border: 1px solid #e2e8f0;
        }

        .table-header {
            background-color: #f8fafc;
        }

        .table-header td {
            padding: 6px 12px;
            border: 1px solid #e2e8f0;
            border-bottom: 2px solid #e2e8f0;
            font-weight: bold;
            color: #031125;
            text-transform: uppercase;
            font-size: 12px;
        }

        .data-row td {
            padding: 7px 12px;
            border: 1px solid #e2e8f0;
            vertical-align: middle;
        }

        .label-col {
            width: 35%;
            font-weight: bold;
            color: #525f72ff;
            font-size: 10px;
            text-transform: uppercase;
            background-color: #fafafa;
        }

        .value-col {
            color: #1e293b;
            font-size: 13px;
            font-weight: 500;
        }

        .value-prominent {
            font-size: 13px;
            font-weight: bold;
            color: #0f172a;
        }

        /* Status Indicator */
        .status-pill {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-active {
            background-color: #f0fdf4;
            color: #166534;
        }

        .status-inactive {
            background-color: #fef2f2;
            color: #991b1b;
        }

        .status-problem {
            background-color: #fffbeb;
            color: #92400e;
        }

        .status-maintenance {
            background-color: #f0f9ff;
            color: #075985;
        }

        /* footer */
        .footer {
            position: fixed;
            bottom: -1cm;
            width: 100%;
            border-top: 1px solid #e2e8f0;
            padding: 15px 0;
            text-align: center;
            color: #64748b;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <table class="header-table">
            <tr>
                <td class="logo-cell">
                    @if ($logoBase64)
                        <img src="{{ $logoBase64 }}" class="logo-img" alt="Logo">
                    @else
                        <div class="company-name">{{ $settings['site_name'] ?? 'PAYTECH' }}</div>
                    @endif
                </td>
                <td class="company-cell">
                    <div class="company-name">{{ $settings['site_name'] ?? 'PAYTECH' }}</div>
                    <div class="company-info">
                        {{ $settings['company_document'] ?? '' }} &bull; {{ $settings['company_address'] ?? '' }}
                    </div>
                </td>
            </tr>
        </table>

        <!-- Main Headline -->
        <div class="headline-section">
            <h1>Ficha Cadastral</h1>
            <div class="headline-meta">
                ID: #{{ str_pad($cliente->id, 5, '0', STR_PAD_LEFT) }} &nbsp;&nbsp; | &nbsp;&nbsp;
                EMISSÃO EM: {{ date('d/m/Y H:i') }}
            </div>
        </div>

        <!-- Section 01: Identification -->
        <table class="data-table">
            <tr class="table-header">
                <td colspan="2">Dados de Identificação</td>
            </tr>
            <tr class="data-row">
                <td class="label-col">Nome / Razão Social</td>
                <td class="value-col value-prominent">{{ $cliente->nome }}</td>
            </tr>
            <tr class="data-row">
                <td class="label-col">Documento (CPF/CNPJ)</td>
                <td class="value-col">{{ $cliente->cpf_cnpj_formatado }}</td>
            </tr>
            @if ($cliente->nascimento)
                <tr class="data-row">
                    <td class="label-col">Data de Nascimento</td>
                    <td class="value-col">{{ $cliente->nascimento->format('d/m/Y') }}</td>
                </tr>
            @else
                <tr class="data-row">
                    <td class="label-col">Data de Nascimento</td>
                    <td class="value-col">N/A</td>
                </tr>
            @endif
            <tr class="data-row">
                <td class="label-col">Situação Cadastral</td>
                <td class="value-col">
                    <span class="status-pill {{ $cliente->status === 'ativo' ? 'status-active' : 'status-inactive' }}">
                        {{ $cliente->status === 'ativo' ? 'Cadastro Ativo' : 'Cadastro Inativo' }}
                    </span>
                </td>
            </tr>
            <tr class="data-row">
                <td class="label-col">Data de Cadastro</td>
                <td class="value-col">{{ $cliente->created_at->format('d/m/Y') }}</td>
            </tr>
        </table>

        <!-- Section 02: Contact -->
        <table class="data-table">
            <tr class="table-header">
                <td colspan="2">Informações de Contato</td>
            </tr>
            <tr class="data-row">
                <td class="label-col">E-mail</td>
                <td class="value-col" style="font-weight: bold; color: #0f172a;">{{ $cliente->email }}</td>
            </tr>
            <tr class="data-row">
                <td class="label-col">Telefone</td>
                <td class="value-col">{{ $cliente->telefone_formatado }}</td>
            </tr>
        </table>

        <!-- Section 03: Location -->
        <table class="data-table" style="page-break-inside: avoid;">
            <tr class="table-header">
                <td colspan="2">Localização e Endereço</td>
            </tr>
            <tr class="data-row">
                <td class="label-col">Endereço</td>
                <td class="value-col">
                    <strong>{{ $cliente->rua }}, {{ $cliente->numero }}</strong>
                    @if ($cliente->complemento)
                        <div style="color: #64748b; font-size: 11px; margin-top: 2px;">{{ $cliente->complemento }}
                        </div>
                    @endif
                </td>
            </tr>
            <tr class="data-row">
                <td class="label-col">Bairro e Localidade</td>
                <td class="value-col">{{ $cliente->bairro }} &bull; {{ $cliente->cidade }} / {{ $cliente->estado }}
                </td>
            </tr>
            <tr class="data-row">
                <td class="label-col">Código Postal (CEP)</td>
                <td class="value-col">{{ $cliente->cep_formatado }}</td>
            </tr>
        </table>

        <!-- Section 05: Machines -->
        <table class="data-table" style="page-break-inside: avoid;">
            <tr class="table-header">
                <td colspan="4">Maquininha(s) Vinculada(s)</td>
            </tr>
            <tr class="data-row"
                style="background-color: #f8fafc; font-size: 9px; font-weight: bold; text-transform: uppercase;">
                <td style="width: 30%;">Modelo</td>
                <td style="width: 30%;">S/N</td>
                <td style="width: 20%; text-align: center;">Status</td>
                <td style="width: 20%; text-align: center;">Data Registro</td>
            </tr>
            @forelse($cliente->maquininhas as $m)
                @php
                    $statusClass = '';
                    $statusLabel = '';
                    switch ($m->status) {
                        case 'ativa':
                        case 'ativo':
                            $statusClass = 'status-active';
                            $statusLabel = 'Ativa';
                            break;
                        case 'inativa':
                        case 'inativo':
                            $statusClass = 'status-inactive';
                            $statusLabel = 'Inativa';
                            break;
                        case 'problema':
                            $statusClass = 'status-problem';
                            $statusLabel = 'Problema';
                            break;
                        case 'manutencao':
                            $statusClass = 'status-maintenance';
                            $statusLabel = 'Manutenção';
                            break;
                        default:
                            $statusClass = '';
                            $statusLabel = $m->status;
                    }
                @endphp
                <tr class="data-row">
                    <td class="value-col">{{ $m->modelo }}</td>
                    <td class="value-col">{{ $m->numero_serie }}</td>
                    <td class="value-col" style="text-align: center;">
                        <span class="status-pill {{ $statusClass }}">
                            {{ $statusLabel }}
                        </span>
                    </td>
                    <td class="value-col" style="text-align: center; font-size: 11px;">
                        {{ $m->created_at->format('d/m/Y') }}
                    </td>
                </tr>
            @empty
                <tr class="data-row">
                    <td colspan="4" class="value-col"
                        style="text-align: center; color: #64748b; font-style: italic;">
                        Nenhuma maquininha vinculada a este cliente.
                    </td>
                </tr>
            @endforelse
        </table>

        @if ($cliente->data_validade)
            <!-- Section 04: Validation -->
            <table class="data-table" style="page-break-inside: avoid;">
                <tr class="table-header">
                    <td colspan="2">Vigência Administrativa</td>
                </tr>
                <tr class="data-row">
                    <td class="label-col">Validade</td>
                    <td class="value-col value-prominent" style="color: #b91c1c;">
                        {{ $cliente->data_validade->format('d/m/Y') }}
                    </td>
                </tr>
            </table>
        @endif

        <div class="footer">
            Documento Gerado por {{ $settings['site_name'] ?? 'PayTech Tecnologia de Pagamentos' }}
        </div>
    </div>
</body>

</html>
