<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulador | {{ $cliente->nome }}</title>
    <meta name="description" content="Simulador de vendas personalizado para {{ $cliente->nome }}">
    @if ($favicon = \App\Models\Setting::get('favicon'))
        <link rel="icon" type="image/x-icon" href="{{ \Illuminate\Support\Facades\Storage::url($favicon) }}">
    @endif
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-glow: rgba(99, 102, 241, 0.35);
            --success: #10b981;
            --danger: #ef4444;
            --bg: #0f0f1a;
            --surface: #16162a;
            --surface2: #1e1e35;
            --surface3: #252540;
            --border: rgba(255, 255, 255, 0.08);
            --text: #f1f5f9;
            --muted: #94a3b8;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            background-image:
                radial-gradient(ellipse at 20% 10%, rgba(99, 102, 241, 0.15) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 90%, rgba(16, 185, 129, 0.08) 0%, transparent 50%);
        }

        .sim-wrapper {
            width: 100%;
            max-width: 540px;
        }

        .sim-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 24px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.5);
            overflow: hidden;
        }

        /* ===== HEADER ===== */
        .sim-header {
            background: linear-gradient(135deg, #0a082b, #4244b7 50%, #0a082b);
            padding: 2.25rem 2rem 1.75rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .sim-header::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 30% 40%, rgba(255, 255, 255, 0.1), transparent 60%);
            animation: shimmer 5s ease-in-out infinite alternate;
        }

        @keyframes shimmer {
            from {
                opacity: 1;
            }

            to {
                opacity: 0.4;
            }
        }

        .logo-icon {
            width: 56px;
            height: 56px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin-bottom: 0.75rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .sim-header h1 {
            font-size: 1.3rem;
            font-weight: 400;
            color: #fff;
            letter-spacing: -0.02em;
        }

        .sim-header .client-name {
            font-size: 0.82rem;
            color: rgba(255, 255, 255, 0.65);
            margin-top: 0.2rem;
        }

        /* ===== BODY ===== */
        .sim-body {
            padding: 1.75rem;
        }

        /* ===== MODO TOGGLE ===== */
        .mode-toggle {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.5rem;
            background: var(--surface2);
            border-radius: 14px;
            padding: 0.4rem;
            margin-bottom: 1.5rem;
            border: 1px solid var(--border);
        }

        .mode-btn {
            border: none;
            border-radius: 10px;
            padding: 0.7rem 1rem;
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            background: transparent;
            color: var(--muted);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
        }

        .mode-btn.active {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.35);
        }

        /* ===== FIELD ===== */
        .field-group {
            margin-bottom: 1.25rem;
        }

        .field-label {
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.09em;
            color: var(--muted);
            margin-bottom: 0.45rem;
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        /* ===== VALUE INPUT ===== */
        .input-wrap {
            position: relative;
        }

        .currency-prefix {
            position: absolute;
            left: 1.1rem;
            top: 50%;
            transform: translateY(-50%);
            font-weight: 700;
            color: var(--muted);
            font-size: 1rem;
            pointer-events: none;
            z-index: 2;
        }

        .sim-input {
            width: 100%;
            background: var(--surface2);
            border: 1.5px solid var(--border);
            border-radius: 14px;
            padding: 0.9rem 1.1rem 0.9rem 3.2rem;
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--text);
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: all 0.2s ease;
        }

        .sim-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px var(--primary-glow);
        }

        .sim-input::placeholder {
            color: var(--muted);
            font-weight: 400;
            font-size: 1rem;
        }

        /* ===== CUSTOM SELECT ===== */
        .sim-select {
            width: 100%;
            background: var(--surface2);
            border: 1.5px solid var(--border);
            border-radius: 14px;
            padding: 0.85rem 3rem 0.85rem 1.1rem;
            font-size: 0.92rem;
            font-weight: 500;
            color: var(--text);
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: all 0.2s ease;
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2394a3b8' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1.1rem center;
        }

        .sim-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px var(--primary-glow);
        }

        .sim-select option {
            background: #1e1e35;
            color: var(--text);
        }

        .sim-select:disabled {
            opacity: 0.45;
            cursor: not-allowed;
        }

        /* ===== DIVIDER ===== */
        .sim-divider {
            border: none;
            height: 1px;
            background: var(--border);
            margin: 1.5rem 0;
        }

        /* ===== RESULTS ===== */
        .results-area {
            opacity: 0;
            transform: translateY(8px);
            transition: opacity 0.35s ease, transform 0.35s ease;
            pointer-events: none;
        }

        .results-area.visible {
            opacity: 1;
            transform: translateY(0);
            pointer-events: all;
        }

        .results-label {
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--muted);
            margin-bottom: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        .result-panel {
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
        }

        .result-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.85rem 1.1rem;
            border-bottom: 1px solid var(--border);
        }

        .result-row:last-child {
            border-bottom: none;
        }

        .result-label {
            display: flex;
            align-items: center;
            gap: 0.55rem;
            font-size: 0.85rem;
            color: var(--muted);
            font-weight: 500;
        }

        .ri-icon {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
        }

        .ri-blue {
            background: rgba(99, 102, 241, 0.15);
            color: var(--primary);
        }

        .ri-red {
            background: rgba(239, 68, 68, 0.12);
            color: var(--danger);
        }

        .ri-amb {
            background: rgba(245, 158, 11, 0.12);
            color: #f59e0b;
        }

        .ri-green {
            background: rgba(16, 185, 129, 0.12);
            color: var(--success);
        }

        .result-value {
            font-size: 0.92rem;
            font-weight: 700;
            color: var(--text);
        }

        .result-value.danger {
            color: var(--danger);
        }

        .result-value.amber {
            color: #f59e0b;
        }

        .tag-badge {
            display: inline-flex;
            align-items: center;
            background: rgba(99, 102, 241, 0.12);
            color: var(--primary);
            border: 1px solid rgba(99, 102, 241, 0.25);
            border-radius: 6px;
            padding: 0.1rem 0.45rem;
            font-size: 0.7rem;
            font-weight: 700;
        }

        /* ===== LIQUID / CHARGE BOX ===== */
        .highlight-box {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(16, 185, 129, 0.04));
            border: 1px solid rgba(16, 185, 129, 0.22);
            border-radius: 16px;
            padding: 1.25rem;
            margin-top: 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .highlight-box.repassa {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(99, 102, 241, 0.04));
            border-color: rgba(99, 102, 241, 0.22);
        }

        .highlight-meta {
            display: flex;
            flex-direction: column;
        }

        .highlight-meta .hlabel {
            font-size: 0.68rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--muted);
            font-weight: 700;
        }

        .highlight-meta .hname {
            font-size: 0.88rem;
            color: var(--text);
            font-weight: 600;
            margin-top: 0.15rem;
        }

        .highlight-value {
            font-size: 2rem;
            font-weight: 900;
            color: var(--success);
            letter-spacing: -0.03em;
            white-space: nowrap;
        }

        .highlight-value.repassa {
            color: var(--primary);
        }

        .highlight-value.pulse {
            animation: pulse 0.3s ease;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.06);
            }

            100% {
                transform: scale(1);
            }
        }

        /* ===== INFO ===== */
        .sim-info {
            text-align: center;
            margin-top: 1.25rem;
            font-size: 0.73rem;
            color: var(--muted);
        }

        /* ===== PLACEHOLDER ===== */
        .empty-state {
            text-align: center;
            padding: 1.75rem 1rem;
            color: var(--muted);
        }

        .empty-state i {
            font-size: 2.2rem;
            opacity: 0.25;
        }

        .empty-state p {
            font-size: 0.82rem;
            margin-top: 0.6rem;
        }

        /* ===== FOOTER ===== */
        .sim-footer {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.22);
        }

        .sim-footer strong {
            color: rgba(255, 255, 255, 0.4);
        }

        @media (max-width: 480px) {
            .sim-body {
                padding: 1.25rem;
            }

            .sim-input {
                font-size: 1.3rem;
            }

            .highlight-value {
                font-size: 1.6rem;
            }
        }
    </style>
</head>

<body>
    <div class="sim-wrapper">
        <div class="sim-card">

            {{-- HEADER --}}
            <div class="sim-header">
                <div class="logo-wrapper mb-3">
                    @if ($logo = \App\Models\Setting::get('logo_simulator'))
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($logo) }}" alt="Logo"
                            class="img-fluid" style="max-height: 100px;">
                    @else
                        <div class="logo-icon">💳</div>
                    @endif
                </div>
                <h1>Simulador de Vendas</h1>
                <div class="client-name"><i class="bi bi-building" style="margin-right: 3px;"></i>{{ $cliente->nome }}
                </div>
            </div>

            {{-- BODY --}}
            <div class="sim-body">

                {{-- MODO: COBRAR / RECEBER --}}
                <div class="mode-toggle">
                    <button class="mode-btn active" id="btn-cobrar" onclick="setMode('cobrar')">
                        <i class="bi bi-credit-card"></i> Cobrar
                    </button>
                    <button class="mode-btn" id="btn-receber" onclick="setMode('receber')">
                        <i class="bi bi-bullseye"></i> Receber
                    </button>
                </div>

                {{-- LUCRO --}}
                <div class="field-group">
                    <div class="field-label">
                        <i class="bi bi-graph-up-arrow"></i> Porcentagem de Lucro
                    </div>
                    <div class="input-wrap">
                        <span class="currency-prefix">%</span>
                        <input type="number" id="lucro_perc" class="sim-input" placeholder="0,00" step="0.01"
                            min="0" autocomplete="off" style="padding-left: 2.22rem;">
                    </div>
                </div>

                {{-- VALOR --}}
                <div class="field-group">
                    <div class="field-label" id="valor-label">
                        <i class="bi bi-cash-coin"></i> Valor da Venda
                    </div>
                    <div class="input-wrap">
                        <span class="currency-prefix">R$</span>
                        <input type="number" id="valor_venda" class="sim-input" placeholder="0,00" step="0.01"
                            min="0" autocomplete="off">
                    </div>
                </div>

                {{-- BANDEIRA --}}
                <div class="field-group">
                    <div class="field-label">
                        <i class="bi bi-credit-card-2-front"></i> Bandeira do Cartão
                    </div>
                    @if ($cliente->taxas->isEmpty())
                        <div class="empty-state">
                            <i class="bi bi-exclamation-circle"></i>
                            <p>Nenhuma taxa cadastrada para este cliente.</p>
                        </div>
                    @else
                        <select id="sel_bandeira" class="sim-select" onchange="onBandeiraChange()">
                            <option value="">Selecione a bandeira...</option>
                            @foreach ($cliente->taxas->pluck('bandeira')->unique()->sort() as $bandeira)
                                <option value="{{ $bandeira }}">{{ $bandeira }}</option>
                            @endforeach
                        </select>
                    @endif
                </div>

                {{-- PARCELAS --}}
                <div class="field-group">
                    <div class="field-label">
                        <i class="bi bi-list-ol"></i> Plano / Parcelas
                    </div>
                    <select id="sel_taxa" class="sim-select" disabled onchange="calcular()">
                        <option value="">Selecione a bandeira primeiro...</option>
                    </select>
                </div>

                <hr class="sim-divider">

                {{-- RESULTADOS --}}
                <div id="results" class="results-area">
                    <div class="results-label">
                        <i class="bi bi-bar-chart-line"></i> Resultado da Simulação
                    </div>

                    <div class="result-panel">
                        <div class="result-row">
                            <div class="result-label">
                                <div class="ri-icon ri-blue"><i class="bi bi-cash"></i></div>
                                <span id="label-bruto">Valor Bruto</span>
                            </div>
                            <span class="result-value" id="res_bruto">R$ 0,00</span>
                        </div>
                        <div class="result-row">
                            <div class="result-label">
                                <div class="ri-icon ri-red"><i class="bi bi-percent"></i></div>
                                Taxa &nbsp;<span id="res_badge" class="tag-badge">0%</span>
                            </div>
                            <span class="result-value danger" id="res_taxa">- R$ 0,00</span>
                        </div>
                        <div class="result-row" id="row-cobrar" style="display:none">
                            <div class="result-label">
                                <div class="ri-icon ri-amb"><i class="bi bi-tag"></i></div>
                                Valor a Cobrar do Cliente
                            </div>
                            <span class="result-value amber" id="res_cobrar">R$ 0,00</span>
                        </div>
                        <div class="result-row" id="row-lucro" style="display:none">
                            <div class="result-label">
                                <div class="ri-icon ri-green"><i class="bi bi-wallet2"></i></div>
                                Valor do Lucro
                            </div>
                            <span class="result-value" id="res_lucro" style="color: var(--success)">R$ 0,00</span>
                        </div>
                    </div>

                    {{-- HIGHLIGHT --}}
                    <div class="highlight-box" id="highlight-box">
                        <div class="highlight-meta">
                            <span class="hlabel" id="hl-label">Você Recebe</span>
                            <span class="hname" id="hl-name">—</span>
                        </div>
                        <div class="highlight-value" id="res_highlight">R$ 0,00</div>
                    </div>

                    <div class="sim-info">
                        <i class="bi bi-shield-check me-1"></i>
                        Valores calculados com base nas taxas cadastradas.
                    </div>
                </div>

                {{-- PLACEHOLDER --}}
                <div id="placeholder" class="empty-state">
                    <i class="bi bi-calculator"></i>
                    <p>Informe o valor, bandeira e plano para simular.</p>
                </div>

            </div>
        </div>

        <div class="sim-footer"
            style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 0.5rem;">
            <span>Desenvolvido por <strong>{{ \App\Models\Setting::get('site_name') }}</strong></span>
            <a href="{{ route('simulator.logout') }}" style="color: #fff; font-size: 0.75rem; text-decoration: none;"
                title="Sair / Trocar conta">
                <i class="bi bi-box-arrow-right"></i> Sair
            </a>
        </div>
    </div>

    <script>
        // Dados das taxas (embutidos server-side)
        const taxas = @json($cliente->taxas);

        let modo = 'cobrar'; // 'cobrar' = desconta taxa | 'receber' = acrescenta taxa

        function fmt(val) {
            return val.toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            });
        }

        function roundTo2(val) {
            return Math.round((val + Number.EPSILON) * 100) / 100;
        }

        function setMode(m) {
            modo = m;
            document.getElementById('btn-cobrar').classList.toggle('active', m === 'cobrar');
            document.getElementById('btn-receber').classList.toggle('active', m === 'receber');

            document.getElementById('valor-label').innerHTML =
                m === 'cobrar' ?
                '<i class="bi bi-credit-card"></i> Valor a Cobrar no Cartão' :
                '<i class="bi bi-bullseye"></i> Valor que Quero Receber';

            if (document.getElementById('sel_bandeira')?.value) onBandeiraChange();
            else calcular();
        }

        function onBandeiraChange() {
            const bandeiraSel = document.getElementById('sel_bandeira').value;
            const selTaxa = document.getElementById('sel_taxa');
            const valor = parseFloat(document.getElementById('valor_venda').value) || 0;
            const lucroPerc = parseFloat(document.getElementById('lucro_perc').value) || 0;
            const currentSelected = selTaxa.value;

            selTaxa.innerHTML = '<option value="">Selecione o plano...</option>';
            selTaxa.disabled = !bandeiraSel;

            if (!bandeiraSel) {
                calcular();
                return;
            }

            const filtradas = taxas.filter(t => t.bandeira === bandeiraSel);

            let optMaxima = filtradas.length > 0 ? filtradas.reduce((max, obj) => parseInt(obj.parcela) > parseInt(max.parcela) ? obj : max) : null;
            let totalPagarGlobal = 0;
            if (valor > 0 && optMaxima) {
                const taxaSelMax = parseFloat(optMaxima.valor);
                if (modo === 'cobrar') {
                    totalPagarGlobal = valor;
                } else {
                    const valorComLucro = valor + (valor * lucroPerc / 100);
                    totalPagarGlobal = roundTo2(valorComLucro / (1 - taxaSelMax / 100));
                }
            }

            filtradas.forEach((t) => {
                const num = parseInt(t.parcela) || 1;
                const taxaPerc = parseFloat(t.valor);

                // Montar label dinâmico com valor calculado
                let label = '';
                const taxaTotalExibicao = (taxaPerc + lucroPerc).toLocaleString('pt-BR') + '%';

                if (valor > 0) {
                    const valorParcela = roundTo2(totalPagarGlobal / num);
                    label = `${num}x de ${fmt(valorParcela)} (${taxaTotalExibicao})`;
                } else {
                    label = `${num}x · ${taxaTotalExibicao}`;
                }

                const opt = document.createElement('option');
                opt.value = t.id;
                opt.dataset.valor = taxaPerc;
                opt.dataset.num = num;
                opt.textContent = label;
                if (t.id == currentSelected) opt.selected = true;
                selTaxa.appendChild(opt);
            });

            calcular();
        }

        // Rerender parcelas quando valor ou lucro mudam
        document.getElementById('valor_venda').addEventListener('input', function() {
            if (document.getElementById('sel_bandeira')?.value) {
                onBandeiraChange();
            }
            calcular();
        });

        document.getElementById('lucro_perc').addEventListener('input', function() {
            if (document.getElementById('sel_bandeira')?.value) {
                onBandeiraChange();
            }
            calcular();
        });

        function calcular() {
            const valor = parseFloat(document.getElementById('valor_venda').value);
            const selTaxa = document.getElementById('sel_taxa');
            const opt = selTaxa?.options[selTaxa.selectedIndex];

            const resultsDiv = document.getElementById('results');
            const placeholder = document.getElementById('placeholder');

            if (!valor || !opt?.value) {
                resultsDiv.classList.remove('visible');
                placeholder.style.display = '';
                return;
            }

            const taxaPerc = parseFloat(opt.dataset.valor);
            const descricao = opt.dataset.descricao;
            const num = parseInt(opt.dataset.num) || 1;
            const bandeira = document.getElementById('sel_bandeira').value;

            const lucroPerc = parseFloat(document.getElementById('lucro_perc').value) || 0;

            let valorBruto, valorTaxaAmt, valorLiquido, valorCobrar, valorLucro;
            
            const bandeiraSelVal = document.getElementById('sel_bandeira').value;
            const filtradasT = taxas.filter(t => t.bandeira === bandeiraSelVal);
            let optMaxima = filtradasT.length > 0 ? filtradasT.reduce((max, obj) => parseInt(obj.parcela) > parseInt(max.parcela) ? obj : max) : null;
            let totalPagarGlobal = valor;
            if (valor > 0 && optMaxima) {
                if (modo === 'receber') {
                    const taxaSelMax = parseFloat(optMaxima.valor);
                    const valorComLucro = valor + (valor * lucroPerc / 100);
                    totalPagarGlobal = roundTo2(valorComLucro / (1 - taxaSelMax / 100));
                }
            }

            if (modo === 'cobrar') {
                // Cobrar: passa X no cartão → desconta a taxa → desconta o lucro → mostra quanto recebe
                valorBruto = valor;
                valorTaxaAmt = (valorBruto * (taxaPerc + lucroPerc)) / 100; // Taxa Visual Total
                valorLucro = (valorBruto * lucroPerc) / 100;
                valorLiquido = valorBruto - valorTaxaAmt;
                valorCobrar = null;
            } else {
                // Receber: Calcula precisamente o bruto com base na taxa estática Max da maquina
                valorLiquido = valor;
                const valorParcelaSelecionada = roundTo2(totalPagarGlobal / num);

                valorBruto = valorParcelaSelecionada * num;
                valorTaxaAmt = (valorBruto * (taxaPerc + lucroPerc)) / 100; // Taxa Visual Total
                valorLucro = (valor * lucroPerc) / 100; // Lucro incide na base
                valorCobrar = valorBruto;
            }

            // Preencher resultados
            const taxaTotalBadge = taxaPerc + lucroPerc;
            document.getElementById('res_bruto').innerText = fmt(modo === 'cobrar' ? valorBruto : valorLiquido);
            document.getElementById('res_badge').innerText = taxaTotalBadge.toLocaleString('pt-BR') + '%';

            const elTaxa = document.getElementById('res_taxa');
            if (modo === 'receber') {
                elTaxa.innerText = '+ ' + fmt(valorTaxaAmt);
                elTaxa.style.color = 'var(--primary)'; // Azul amigável para acréscimo 
            } else {
                elTaxa.innerText = '- ' + fmt(valorTaxaAmt);
                elTaxa.style.color = 'var(--danger)'; // Vermelho para decréscimo
            }

            document.getElementById('label-bruto').innerText = modo === 'cobrar' ? 'Valor Cobrado no Cartão' :
                'Valor Desejado Líquido';

            // Linha "cobrar"
            const rowCobrar = document.getElementById('row-cobrar');
            if (modo === 'receber') {
                rowCobrar.style.display = '';
                document.getElementById('res_cobrar').innerText = fmt(valorCobrar);
            } else {
                rowCobrar.style.display = 'none';
            }

            // Linha "lucro"
            const rowLucro = document.getElementById('row-lucro');
            if (lucroPerc > 0) {
                rowLucro.style.display = '';
                document.getElementById('res_lucro').innerText = fmt(valorLucro);
            } else {
                rowLucro.style.display = 'none';
            }

            // Highlight box
            const hlBox = document.getElementById('highlight-box');
            const hlLabel = document.getElementById('hl-label');
            const hlName = document.getElementById('hl-name');
            const hlVal = document.getElementById('res_highlight');
            const parcPorVez = (modo === 'cobrar' ? valorLiquido : valorCobrar) / num;

            if (modo === 'cobrar') {
                hlBox.className = 'highlight-box';
                hlVal.className = 'highlight-value';
                hlLabel.innerText = 'Cliente Recebe';
                hlVal.innerText = fmt(valorLiquido);
            } else {
                hlBox.className = 'highlight-box repassa';
                hlVal.className = 'highlight-value repassa';
                hlLabel.innerText = 'Cobrar do Cliente';
                hlVal.innerText = fmt(valorCobrar);
            }

            hlName.innerText = bandeira;

            // Pulse animation
            hlVal.classList.remove('pulse');
            void hlVal.offsetWidth;
            hlVal.classList.add('pulse');

            placeholder.style.display = 'none';
            resultsDiv.classList.add('visible');
        }
    </script>
</body>

</html>
