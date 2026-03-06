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
    </script>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <!-- Header -->
        <nav class="app-header navbar navbar-expand bg-body shadow" data-bs-theme="dark">
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
                            <li class="user-footer p-3 bg-light d-flex justify-content-center rounded-bottom">
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
        <aside class="app-sidebar bg-body shadow" data-bs-theme="dark">
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
