<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Maquininha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MaquininhaController extends Controller
{
    public function index(Cliente $cliente)
    {
        Gate::authorize('manage_clients');
        return response()->json($cliente->maquininhas()->latest()->get());
    }

    public function store(Request $request, Cliente $cliente)
    {
        Gate::authorize('manage_clients');
        $request->validate([
            'modelo'       => 'required|string|max:255',
            'numero_serie' => 'required|string|max:255|unique:maquininhas,numero_serie',
            'status'       => 'required|string|in:ativa,inativa,problema,manutencao',
        ], [
            'numero_serie.unique' => 'Esta maquininha já está cadastrada no sistema.',
            'modelo.required' => 'O modelo é obrigatório.',
            'numero_serie.required' => 'O número de série é obrigatório.',
            'status.required' => 'O status é obrigatório.',
        ]);

        $maquininha = $cliente->maquininhas()->create([
            'modelo'       => $request->modelo,
            'numero_serie' => $request->numero_serie,
            'status'       => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Maquininha cadastrada com sucesso!',
            'maquininha' => $maquininha
        ]);
    }

    public function update(Request $request, Maquininha $maquininha)
    {
        Gate::authorize('manage_clients');
        $request->validate([
            'modelo'       => 'required|string|max:255',
            'numero_serie' => 'required|string|max:255|unique:maquininhas,numero_serie,' . $maquininha->id,
            'status'       => 'required|string|in:ativa,inativa,problema,manutencao',
        ], [
            'numero_serie.unique' => 'Esta maquininha já está cadastrada no sistema.',
            'modelo.required' => 'O modelo é obrigatório.',
            'numero_serie.required' => 'O número de série é obrigatório.',
            'status.required' => 'O status é obrigatório.',
        ]);

        $maquininha->update([
            'modelo'       => $request->modelo,
            'numero_serie' => $request->numero_serie,
            'status'       => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Maquininha atualizada com sucesso!',
            'maquininha' => $maquininha
        ]);
    }

    public function destroy(Maquininha $maquininha)
    {
        Gate::authorize('manage_clients');
        $maquininha->delete();

        return response()->json([
            'success' => true,
            'message' => 'Maquininha removida com sucesso!',
        ]);
    }
}
