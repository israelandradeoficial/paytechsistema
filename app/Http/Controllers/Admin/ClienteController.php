<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    public function pdf(Cliente $cliente)
    {
        Gate::authorize('manage_clients');

        $settings = Setting::all()->pluck('value', 'key');
        $logoBase64 = null;

        $logoPath = $settings['logo_pdf'] ?? $settings['logo_system'] ?? null;

        if ($logoPath && Storage::disk('public')->exists($logoPath)) {
            $path = Storage::disk('public')->path($logoPath);
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $logoBase64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        }

        $pdf = Pdf::loadView('admin.clientes.pdf', compact('cliente', 'settings', 'logoBase64'));

        return $pdf->stream('cliente-' . $cliente->slug . '.pdf');
    }

    public function index(Request $request)
    {
        Gate::authorize('manage_clients');

        if ($request->ajax() && $request->has('draw')) {
            $query = Cliente::query();

            // Search logic
            if ($request->has('search') && !empty($request->search['value'])) {
                $search = $request->search['value'];
                $query->where(function ($q) use ($search) {
                    $q->where('nome', 'like', "%{$search}%")
                        ->orWhere('cpf_cnpj', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('telefone', 'like', "%{$search}%");
                });
            }

            $totalRecords = Cliente::count();
            $filteredRecords = $query->count();

            // Order logic
            if ($request->has('order')) {
                $columns = ['nome', 'cpf_cnpj', 'email', 'telefone', 'status', 'data_validade'];
                $columnIndex = $request->order[0]['column'];
                $columnName = $columns[$columnIndex] ?? 'created_at';
                $columnSortOrder = $request->order[0]['dir'];
                $query->orderBy($columnName, $columnSortOrder);
            } else {
                $query->latest();
            }

            // Pagination logic
            $start = $request->start;
            $length = $request->length;
            $clientes = $query->offset($start)->limit($length)->get();

            $data = [];
            foreach ($clientes as $cliente) {
                $statusHtml = $cliente->status === 'ativo'
                    ? '<span class="badge bg-success-subtle text-success border border-success-subtle">Ativo</span>'
                    : '<span class="badge bg-danger-subtle text-danger border border-danger-subtle">Inativo</span>';

                $validadeHtml = '<span class="text-muted small">—</span>';
                if ($cliente->data_validade) {
                    if ($cliente->data_validade->lt(today())) {
                        $validadeHtml = '<span class="badge bg-warning-subtle text-warning border border-warning-subtle"><i class="bi bi-clock-history me-1"></i>' . $cliente->data_validade->format('d/m/Y') . '</span>';
                    } else {
                        $validadeHtml = '<span class="text-muted small">' . $cliente->data_validade->format('d/m/Y') . '</span>';
                    }
                }

                $actionsHtml = view('admin.clientes._actions', compact('cliente'))->render();

                $data[] = [
                    'nome' => '<div class="fw-bold">' . $cliente->nome . '</div>',
                    'cpf_cnpj' => $cliente->cpf_cnpj_formatado,
                    'email' => $cliente->email,
                    'telefone' => $cliente->telefone_formatado,
                    'status' => $statusHtml,
                    'data_validade' => $validadeHtml,
                    'actions' => $actionsHtml,
                    'id' => $cliente->id // For row ID
                ];
            }

            return response()->json([
                "draw" => intval($request->draw),
                "recordsTotal" => $totalRecords,
                "recordsFiltered" => $filteredRecords,
                "data" => $data
            ]);
        }

        $clientesCount = Cliente::count();
        return view('admin.clientes.index', compact('clientesCount'));
    }

    public function create()
    {
        return view('admin.clientes.index');
    }

    public function store(Request $request)
    {
        Gate::authorize('manage_clients');
        $validated = $request->validate([
            'nome'          => 'required|string|max:255',
            'cpf_cnpj'      => 'required|string|max:20|unique:clientes',
            'email'         => 'required|email|max:255|unique:clientes',
            'telefone'      => 'required|string|max:20',
            'cep'           => 'required|string|max:10',
            'rua'           => 'required|string|max:255',
            'bairro'        => 'required|string|max:255',
            'numero'        => 'required|string|max:20',
            'cidade'        => 'required|string|max:255',
            'estado'        => 'required|string|max:2',
            'nascimento'    => 'nullable|date',
            'complemento'   => 'nullable|string',
            'status'        => 'required|in:ativo,inativo',
            'data_validade' => 'nullable|date',
        ]);

        $validated['slug'] = Str::slug($request->nome) . '-' . Str::random(6);

        // Remove máscaras antes de salvar
        $validated['cpf_cnpj'] = preg_replace('/[^0-9]/', '', $validated['cpf_cnpj']);
        $validated['telefone'] = preg_replace('/[^0-9]/', '', $validated['telefone']);
        $validated['cep']      = preg_replace('/[^0-9]/', '', $validated['cep']);

        $cliente = Cliente::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Cliente <strong>' . $cliente->nome . '</strong> cadastrado com sucesso!',
            'cliente' => $cliente,
        ]);
    }

    public function edit(Cliente $cliente)
    {
        return response()->json($cliente);
    }

    public function update(Request $request, Cliente $cliente)
    {
        Gate::authorize('manage_clients');
        $validated = $request->validate([
            'nome'          => 'required|string|max:255',
            'cpf_cnpj'      => 'required|string|max:20|unique:clientes,cpf_cnpj,' . $cliente->id,
            'email'         => 'required|email|max:255|unique:clientes,email,' . $cliente->id,
            'telefone'      => 'required|string|max:20',
            'cep'           => 'required|string|max:10',
            'rua'           => 'required|string|max:255',
            'bairro'        => 'required|string|max:255',
            'numero'        => 'required|string|max:20',
            'cidade'        => 'required|string|max:255',
            'estado'        => 'required|string|max:2',
            'nascimento'    => 'nullable|date',
            'complemento'   => 'nullable|string',
            'status'        => 'required|in:ativo,inativo',
            'data_validade' => 'nullable|date',
        ]);

        $validated['slug'] = Str::slug($request->nome) . '-' . Str::random(6);

        // Remove máscaras antes de salvar
        $validated['cpf_cnpj'] = preg_replace('/[^0-9]/', '', $validated['cpf_cnpj']);
        $validated['telefone'] = preg_replace('/[^0-9]/', '', $validated['telefone']);
        $validated['cep']      = preg_replace('/[^0-9]/', '', $validated['cep']);

        $cliente->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Cliente <strong>' . $cliente->fresh()->nome . '</strong> atualizado com sucesso!',
            'cliente' => $cliente->fresh(),
        ]);
    }

    public function destroy(Cliente $cliente)
    {
        Gate::authorize('manage_clients');
        $nome = $cliente->nome;
        $cliente->taxas()->delete();
        $cliente->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cliente <strong>' . $nome . '</strong> removido com sucesso!',
        ]);
    }
}
