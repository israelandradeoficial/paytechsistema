@extends('admin.layout')

@section('content')
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Usuários</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar Usuário</li>
            </ol>
        </nav>
        <h1 class="h3 mb-0 text-gray-800">Editar Usuário: {{ $user->name }}</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-4">
                            <div class="col-md-12 text-center mb-3">
                                <label for="avatar" class="cursor-pointer">
                                    <div class="avatar-preview mx-auto position-relative"
                                        style="width: 120px; height: 120px;">
                                        <img id="preview" src="{{ $user->avatar_url }}"
                                            class="rounded-circle shadow-sm border p-1"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                        <div class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-2 shadow-sm border border-white"
                                            style="line-height: 1;">
                                            <i class="bi bi-camera-fill"></i>
                                        </div>
                                    </div>
                                    <input type="file" name="avatar" id="avatar" class="d-none" accept="image/*"
                                        onchange="previewImage(this)">
                                    <p class="mt-2 small text-muted">Clique para alterar foto</p>
                                </label>
                                @error('avatar')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label small fw-bold text-uppercase">Nome Completo</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label small fw-bold text-uppercase">E-mail</label>
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="bg-light p-3 rounded mb-3">
                                    <p class="small text-muted mb-2"><i class="bi bi-info-circle me-1"></i> Deixe os campos
                                        de senha em branco para não alterar a senha atual.</p>
                                    <div class="row">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <label for="password" class="form-label small fw-bold text-uppercase">Nova
                                                Senha</label>
                                            <input type="password" name="password" id="password"
                                                class="form-control @error('password') is-invalid @enderror">
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="password_confirmation"
                                                class="form-label small fw-bold text-uppercase">Confirmar Nova Senha</label>
                                            <input type="password" name="password_confirmation" id="password_confirmation"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="role" class="form-label small fw-bold text-uppercase">Nível de
                                    Acesso</label>
                                <select name="role" id="role"
                                    class="form-select @error('role') is-invalid @enderror" required
                                    @if (auth()->id() === $user->id) disabled @endif>
                                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>
                                        Usuário</option>
                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                                        Administrador</option>
                                </select>
                                @if (auth()->id() === $user->id)
                                    <input type="hidden" name="role" value="{{ $user->role }}">
                                    <p class="small text-muted mt-1">Você não pode alterar seu próprio nível de acesso.</p>
                                @endif
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-light px-4">Cancelar</a>
                            <button type="submit" class="btn btn-primary px-4">Salvar Alterações</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
