<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $query = Cliente::query();

        // Aplicar filtros de data se presentes
        if ($request->filled('data_inicio')) {
            $query->whereDate('created_at', '>=', $request->data_inicio);
        }

        if ($request->filled('data_fim')) {
            $query->whereDate('created_at', '<=', $request->data_fim);
        }

        // Aplicar filtro de status se presente e não for "todos"
        if ($request->filled('status') && $request->status !== 'todos') {
            if ($request->status === 'expirado') {
                $query->where('status', 'ativo')
                    ->whereNotNull('data_validade')
                    ->where('data_validade', '<', today());
            } else {
                $query->where('status', $request->status);
            }
        }

        // Clonar a base filtrada para as contagens rápidas
        $baseQuery = clone $query;

        $totalClientes     = (clone $baseQuery)->count();
        $clientesAtivos    = (clone $baseQuery)->where('status', 'ativo')->count();
        $clientesInativos  = (clone $baseQuery)->where('status', 'inativo')->count();
        $clientesExpirados = (clone $baseQuery)->where('status', 'ativo')
            ->whereNotNull('data_validade')
            ->where('data_validade', '<', today())
            ->count();

        // Clientes cadastrados nos últimos 30 dias (independente do filtro de data global se o usuário quiser ver o pulso do sistema, 
        // mas aqui vamos manter a lógica original ou adaptá-la)
        $clientesRecentes  = (clone $baseQuery)->where('created_at', '>=', Carbon::now()->subDays(30))->count();

        // Clientes expirando nos próximos 7 dias
        $clientesExpirando = (clone $baseQuery)->where('status', 'ativo')
            ->whereNotNull('data_validade')
            ->whereBetween('data_validade', [today(), today()->addDays(7)])
            ->count();

        // Últimos clientes cadastrados (respeitando o filtro)
        $ultimosClientes = (clone $baseQuery)->latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'totalClientes',
            'clientesAtivos',
            'clientesInativos',
            'clientesExpirados',
            'clientesRecentes',
            'clientesExpirando',
            'ultimosClientes'
        ));
    }
}
