<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Taxa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TaxaController extends Controller
{
    public function index(Cliente $cliente)
    {
        Gate::authorize('manage_rates');
        return response()->json($cliente->taxas()->orderBy('bandeira')->orderBy('parcela')->get());
    }

    public function store(Request $request, Cliente $cliente)
    {
        Gate::authorize('manage_rates');
        $request->validate([
            'bandeira' => 'required|string',
            'taxas'    => 'required|array',
            'taxas.*'  => 'required|numeric|min:0|max:100',
        ]);

        // Remove taxas existentes da mesma bandeira para evitar duplicidade ao re-salvar em lote
        $cliente->taxas()->where('bandeira', $request->bandeira)->delete();

        foreach ($request->taxas as $index => $valor) {
            $cliente->taxas()->create([
                'bandeira' => $request->bandeira,
                'parcela'  => $index + 1,
                'valor'    => $valor,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Taxas atualizadas com sucesso!',
        ]);
    }

    public function storeSingle(Request $request, Cliente $cliente)
    {
        Gate::authorize('manage_rates');
        $request->validate([
            'bandeira' => 'required|string',
            'parcela'  => 'required|integer|min:1',
            'valor'    => 'required|numeric|min:0|max:100',
        ]);

        // Evita duplicidade para a mesma parcela e bandeira
        $cliente->taxas()->where('bandeira', $request->bandeira)
            ->where('parcela', $request->parcela)
            ->delete();

        $taxa = $cliente->taxas()->create([
            'bandeira' => $request->bandeira,
            'parcela'  => $request->parcela,
            'valor'    => $request->valor,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Taxa adicionada com sucesso!',
            'taxa' => $taxa
        ]);
    }

    public function update(Request $request, Taxa $taxa)
    {
        Gate::authorize('manage_rates');
        $request->validate([
            'valor' => 'required|numeric|min:0|max:100',
        ]);

        $taxa->update([
            'valor' => $request->valor,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Taxa atualizada com sucesso!',
        ]);
    }

    public function updateMany(Request $request)
    {
        Gate::authorize('manage_rates');
        $request->validate([
            'taxas' => 'required|array',
            'taxas.*.id' => 'required|exists:taxas,id',
            'taxas.*.valor' => 'required|numeric|min:0|max:100',
        ]);

        foreach ($request->taxas as $item) {
            Taxa::where('id', $item['id'])->update(['valor' => $item['valor']]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Todas as taxas foram atualizadas!',
        ]);
    }

    public function destroy(Taxa $taxa)
    {
        Gate::authorize('manage_rates');
        $taxa->delete();

        return response()->json([
            'success' => true,
            'message' => 'Taxa removida com sucesso!',
        ]);
    }
}
