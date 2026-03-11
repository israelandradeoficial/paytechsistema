<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use App\Models\Taxa;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'slug',
        'status',
        'data_validade',
        'cpf_cnpj',
        'nascimento',
        'email',
        'telefone',
        'cep',
        'rua',
        'bairro',
        'numero',
        'complemento',
        'cidade',
        'estado',
    ];

    protected $casts = [
        'data_validade' => 'date',
        'nascimento'    => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($cliente) {
            if (empty($cliente->slug)) {
                $cliente->slug = Str::slug($cliente->nome);
            }
        });
    }

    public function taxas(): HasMany
    {
        return $this->hasMany(Taxa::class);
    }

    public function maquininhas(): HasMany
    {
        return $this->hasMany(Maquininha::class);
    }

    /**
     * Exibe o CPF ou CNPJ formatado com máscara.
     */
    public function getCpfCnpjFormatadoAttribute(): string
    {
        $digits = preg_replace('/[^0-9]/', '', $this->cpf_cnpj ?? '');
        if (strlen($digits) === 11) {
            return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $digits);
        }
        if (strlen($digits) === 14) {
            return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $digits);
        }
        return $this->cpf_cnpj ?? '';
    }

    /**
     * Exibe o telefone formatado com máscara.
     */
    public function getTelefoneFormatadoAttribute(): string
    {
        $digits = preg_replace('/[^0-9]/', '', $this->telefone ?? '');
        if (strlen($digits) === 11) {
            return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $digits);
        }
        if (strlen($digits) === 10) {
            return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $digits);
        }
        return $this->telefone ?? '';
    }

    /**
     * Exibe o CEP formatado com máscara.
     */
    public function getCepFormatadoAttribute(): string
    {
        $digits = preg_replace('/[^0-9]/', '', $this->cep ?? '');
        if (strlen($digits) === 8) {
            return preg_replace('/(\d{5})(\d{3})/', '$1-$2', $digits);
        }
        return $this->cep ?? '';
    }
}
