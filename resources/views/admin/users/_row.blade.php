<tr class="transition-all" id="user-row-{{ $user->id }}">
    <td class="ps-4">
        <div class="position-relative d-inline-block">
            <img src="{{ $user->avatar_url }}" class="rounded-circle border border-2 border-white shadow-sm"
                alt="{{ $user->name }}" style="width: 48px; height: 48px; object-fit: cover;">
            @if ($user->email_verified_at)
                <span class="position-absolute bottom-0 end-0 bg-success border border-white rounded-circle"
                    style="width: 12px; height: 12px;" title="E-mail verificado"></span>
            @endif
        </div>
    </td>
    <td>
        <div class="d-flex flex-column">
            <span class="fw-semibold text-dark">{{ $user->name }}</span>
            <span class="text-muted small">{{ $user->email }}</span>
        </div>
    </td>
    <td>
        @if ($user->isAdmin())
            <span class="badge rounded-pill bg-primary-subtle text-primary border border-primary-subtle px-3">
                <i class="bi bi-shield-shaded me-1"></i> Admin
            </span>
        @elseif($user->role === 'gerente')
            <span class="badge rounded-pill bg-info-subtle text-info border border-info-subtle px-3">
                <i class="bi bi-briefcase me-1"></i> Gerente
            </span>
        @elseif($user->role === 'atendente')
            <span class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-3">
                <i class="bi bi-headset me-1"></i> Atendente
            </span>
        @endif
    </td>
    <td>
        @if ($user->email_verified_at)
            <div class="d-flex align-items-center text-success small fw-medium">
                <div class="bg-success rounded-circle me-2" style="width: 6px; height: 6px;">
                </div>
                Confirmado
            </div>
        @else
            <div class="d-flex align-items-center text-warning small fw-medium">
                <div class="bg-warning rounded-circle me-2" style="width: 6px; height: 6px;">
                </div>
                Pendente
            </div>
        @endif
    </td>
    <td>
        @if ($user->is_active)
            <span class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-3">
                <i class="bi bi-check-circle me-1"></i> Ativo
            </span>
        @else
            <span class="badge rounded-pill bg-danger-subtle text-danger border border-danger-subtle px-3">
                <i class="bi bi-x-circle me-1"></i> Inativo
            </span>
        @endif
    </td>
    <td class="text-end pe-4">
        <div class="d-flex justify-content-end gap-1">
            @can('manage_users')
                <button type="button" class="btn btn-icon btn-light btn-sm rounded-circle btn-edit-user" title="Editar"
                    data-bs-toggle="modal" data-bs-target="#modalUserEdit" data-user='{!! str_replace("'", '&apos;', $user->toJson()) !!}'
                    data-avatar="{{ $user->avatar_url }}"
                    data-permissions="{{ $user->permissions->pluck('id')->toJson() }}">
                    <i class="bi bi-pencil-square text-primary"></i>
                </button>
            @endcan

            @can('manage_users')
                @if (auth()->id() !== $user->id)
                    <button type="button" class="btn btn-icon btn-light btn-sm rounded-circle" title="Excluir"
                        onclick="confirmDelete('{{ $user->id }}', '{{ $user->name }}')">
                        <i class="bi bi-trash3 text-danger"></i>
                    </button>
                @endif
            @endcan
        </div>
    </td>
</tr>
