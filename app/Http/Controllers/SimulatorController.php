<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class SimulatorController extends Controller
{
    public function index(Request $request)
    {
        // Verifica se o cliente já está logado via cookie
        $clienteId = $request->cookie('simulator_client_id');

        if ($clienteId) {
            $cliente = Cliente::where('id', $clienteId)->with('taxas')->first();
            if ($cliente) {
                return $this->checkClienteAccess($cliente) ?? view('simulator', compact('cliente'));
            }
        }

        // Sem cookie válido → exibe tela de login
        return view('simulator.login');
    }

    public function access(Request $request)
    {
        $request->validate([
            'identificacao' => 'required|string',
        ]);

        $input = $request->identificacao;

        // Remove máscara de CPF/CNPJ se necessário
        $cleanInput = preg_replace('/[^0-9]/', '', $input);

        $cliente = Cliente::where(function ($query) use ($input, $cleanInput) {
            $query->where('email', $input)
                ->orWhere('cpf_cnpj', $input)
                ->orWhere('cpf_cnpj', $cleanInput);
        })->first();

        if (!$cliente) {
            return redirect()->back()->with('error', 'Dados não encontrados. Verifique o CPF, CNPJ ou E-mail informado.');
        }

        // Verifica status e validade antes de criar sessão
        $blocked = $this->checkClienteAccess($cliente);
        if ($blocked) return $blocked;

        // Salva o ID do cliente num cookie criptografado por 30 dias
        $cookie = Cookie::make('simulator_client_id', $cliente->id, 60 * 24 * 30, '/', null, false, true);

        return redirect()->route('simulator.index')->withCookie($cookie);
    }

    /**
     * Verifica se o cliente pode acessar o simulador.
     * Retorna uma Response se bloqueado, ou null se liberado.
     */
    protected function checkClienteAccess(Cliente $cliente)
    {
        if ($cliente->status === 'inativo') {
            return view('simulator.blocked', compact('cliente'));
        }

        if ($cliente->data_validade && $cliente->data_validade->toDateString() < today()->toDateString()) {
            return view('simulator.expired', compact('cliente'));
        }

        return null;
    }

    public function logout()
    {
        $cookie = Cookie::forget('simulator_client_id');
        return redirect()->route('simulator.index')->withCookie($cookie);
    }
}
