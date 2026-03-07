<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ \App\Models\Setting::get('site_name', 'PayTech | Sistema') }}</title>
    @if ($favicon = \App\Models\Setting::get('favicon'))
        <link rel="icon" type="image/x-icon" href="{{ \Illuminate\Support\Facades\Storage::url($favicon) }}">
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Global AJAX setup
        window.csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const getStoredTheme = () => localStorage.getItem('theme')
        const setStoredTheme = theme => localStorage.setItem('theme', theme)
        const getPreferredTheme = () => {
            const storedTheme = getStoredTheme()
            if (storedTheme) {
                return storedTheme
            }
            return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
        }
        const setTheme = theme => {
            if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.setAttribute('data-bs-theme', 'dark')
            } else {
                document.documentElement.setAttribute('data-bs-theme', theme)
            }
        }
        setTheme(getPreferredTheme())

        // Global SweetAlert Toast Configuration
        window.Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        async function handleAjaxForm(options) {
            const {
                formId,
                modalId,
                entityName,
                isEdit = false,
                onSuccess = null
            } = options;

            const form = document.getElementById(formId);
            if (!form) return;

            const modalElement = document.getElementById(modalId);
            const modal = modalElement ? bootstrap.Modal.getOrCreateInstance(modalElement) : null;

            form.addEventListener('submit', async (e) => {
                e.preventDefault();

                const formData = new FormData(form);
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalBtnContent = submitBtn.innerHTML;

                submitBtn.disabled = true;
                submitBtn.innerHTML =
                    '<span class="spinner-border spinner-border-sm me-2"></span>Processando...';

                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': window.csrfToken
                        }
                    });

                    const data = await response.json();

                    if (response.ok) {
                        if (modal) modal.hide();

                        if (data.html) {
                            const entityId = data[entityName]?.id;
                            if (isEdit && entityId) {
                                const row = document.getElementById(`${entityName}-row-${entityId}`);
                                if (row) {
                                    row.outerHTML = data.html;
                                    const newRow = document.getElementById(`${entityName}-row-${entityId}`);
                                    newRow.style.backgroundColor = 'rgba(99, 102, 241, 0.1)';
                                    setTimeout(() => newRow.style.backgroundColor = '', 2000);
                                }
                            } else {
                                const tbody = document.querySelector('table tbody');
                                const noDataRow = tbody.querySelector('td[colspan="7"]')?.parentElement ||
                                    tbody.querySelector('td[colspan="6"]')?.parentElement ||
                                    tbody.querySelector('td[colspan="5"]')?.parentElement;
                                if (noDataRow) noDataRow.remove();

                                tbody.insertAdjacentHTML('afterbegin', data.html);
                                const newRow = tbody.firstElementChild;
                                newRow.style.backgroundColor = 'rgba(34, 197, 94, 0.1)';
                                setTimeout(() => newRow.style.backgroundColor = '', 2000);
                            }
                        }

                        Toast.fire({
                            icon: 'success',
                            title: data.message || 'Operação realizada com sucesso!'
                        });

                        if (typeof onSuccess === 'function') onSuccess(data);

                    } else if (response.status === 422) {
                        let errorMessages = '';
                        Object.values(data.errors).forEach(errors => {
                            errors.forEach(error => {
                                errorMessages += `${error}<br>`;
                            });
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro de Validação',
                            html: errorMessages,
                            confirmButtonColor: '#6366f1'
                        });
                    } else {
                        throw new Error(data.message || 'Ocorreu um erro inesperado.');
                    }
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: error.message,
                        confirmButtonColor: '#6366f1'
                    });
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnContent;
                }
            });
        }
    </script>
    <style>
        .app-sidebar {
            background-color: #111827 !important;
            color: #f1f5f9 !important;
        }

        .app-header {
            background-color: #111827 !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .app-sidebar .sidebar-brand {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Sidebar Nav Styling */
        .app-sidebar .nav-link {
            color: #f1f5f9;
            opacity: 0.8;
            transition: all 0.2s;
        }

        .app-sidebar .nav-link:hover {
            opacity: 1;
            background-color: rgba(99, 102, 241, 0.1);
            color: #6366f1;
        }

        .app-sidebar .nav-link.active {
            background-color: #6366f1 !important;
            color: #fff !important;
            opacity: 1;
        }

        /* Card and Border Adjustments */
        .card {
            border-color: var(--bs-border-color);
            background-color: var(--bs-body-bg);
        }

        .modal-content {
            background-color: var(--bs-body-bg);
            color: var(--bs-body-color);
        }

        /* Input Adjustments */
        .input-group-text {
            background-color: var(--bs-tertiary-bg);
            border-color: var(--bs-border-color);
            color: var(--bs-secondary-color);
            transition: all 0.2s;
        }

        [data-bs-theme="dark"] .input-group-text {
            background-color: rgba(255, 255, 255, 0.05) !important;
        }

        .form-control,
        .form-select {
            background-color: var(--bs-body-bg);
            border-color: var(--bs-border-color);
            color: var(--bs-body-color);
        }

        /* Section Cards in Modals */
        .modal-section-card {
            background-color: var(--bs-tertiary-bg);
            border: 1px solid var(--bs-border-color);
            border-radius: 1rem;
            padding: 1.25rem;
            margin-bottom: 1.25rem;
        }

        [data-bs-theme="dark"] .modal-section-card {
            background-color: rgba(255, 255, 255, 0.02) !important;
            border-style: dashed;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bs-tertiary-bg);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--bs-secondary-bg);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--bs-secondary-color);
        }
    </style>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <!-- Header -->
        <nav class="app-header navbar navbar-expand shadow" data-bs-theme="dark">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <!-- Theme Toggle -->
                    <li class="nav-item dropdown">
                        <button class="nav-link btn btn-link" id="bd-theme" type="button" aria-expanded="false"
                            data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
                            <i class="bi bi-circle-half my-1 theme-icon-active"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center"
                                    data-bs-theme-value="light" aria-pressed="false">
                                    <i class="bi bi-sun-fill me-2 opacity-50 theme-icon"></i>
                                    Light
                                </button>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center"
                                    data-bs-theme-value="dark" aria-pressed="false">
                                    <i class="bi bi-moon-stars-fill me-2 opacity-50 theme-icon"></i>
                                    Dark
                                </button>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center"
                                    data-bs-theme-value="auto" aria-pressed="true">
                                    <i class="bi bi-circle-half me-2 opacity-50 theme-icon"></i>
                                    Auto
                                </button>
                            </li>
                        </ul>
                    </li>
                    <!-- User Menu Dropdown -->
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="{{ auth()->user()->avatar_url }}" class="user-image rounded-circle shadow"
                                alt="User Image">
                            <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="min-width: 200px;">
                            <!-- Menu Header -->
                            <li class="user-header bg-primary text-white p-4 text-center rounded-top">
                                <img src="{{ auth()->user()->avatar_url }}" class="rounded-circle shadow mb-2"
                                    alt="User Image" style="width: 80px;">
                                <p>
                                    {{ auth()->user()->name }}
                                    <small class="d-block opacity-75">{{ auth()->user()->email }}</small>
                                </p>
                            </li>
                            <!-- Menu Footer -->
                            <li class="user-footer p-3 bg-body-tertiary d-flex justify-content-center rounded-bottom">
                                <form method="POST" action="{{ route('logout') }}" class="w-100">
                                    @csrf
                                    <button type="submit"
                                        class="btn btn-danger btn-flat w-100 d-flex align-items-center justify-content-center gap-2">
                                        <i class="bi bi-box-arrow-right"></i>
                                        Sair do Sistema
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Sidebar -->
        <aside class="app-sidebar shadow" data-bs-theme="dark">
            <div class="sidebar-brand">
                <a href="{{ route('admin.dashboard') }}" class="brand-link text-center px-0">
                    @if ($logo = \App\Models\Setting::get('logo_system'))
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($logo) }}" alt="Logo"
                            class="brand-image-xl opacity-75 shadow-none"
                            style="max-height: 40px; float: none; margin-left: 0;">
                    @else
                        <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                            class="brand-image opacity-75 shadow">
                    @endif
                </a>
            </div>
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}"
                                class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-speedometer2"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        @can('manage_clients')
                            <li class="nav-item">
                                <a href="{{ route('admin.clientes.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.clientes.*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-people"></i>
                                    <p>Clientes</p>
                                </a>
                            </li>
                        @endcan

                        @can('manage_users')
                            <li class="nav-item">
                                <a href="{{ route('admin.users.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-person-gear"></i>
                                    <p>Usuários</p>
                                </a>
                            </li>
                        @endcan

                        @if (auth()->user()->role === 'admin')
                            <li class="nav-header small text-muted text-uppercase mt-3 ms-3">Configurações</li>
                            <li class="nav-item">
                                <a href="{{ route('admin.settings.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-gear"></i>
                                    <p>Ajustes Gerenciais</p>
                                </a>
                            </li>
                        @endif

                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="app-main">
            <div class="app-content pt-4">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="app-footer">
            <div class="float-end d-none d-sm-inline">
                Desenvolvido por <strong>Israel Andrade</strong>
            </div>
            Copyright &copy; {{ date('Y') }} <strong><a href="#"
                    class="text-decoration-none">{{ \App\Models\Setting::get('site_name', 'PayTech | Sistema') }}</a>.</strong>
            Todos os direitos reservados.
        </footer>
    </div>
</body>

</html>
