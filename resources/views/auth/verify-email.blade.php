<x-guest-layout>
    <style>
        .btn-v5 {
            background: #6366f1 !important;
            border: none !important;
            border-radius: 0.75rem !important;
            font-weight: 700 !important;
            padding: 1rem !important;
            font-size: 0.9rem !important;
            text-transform: uppercase !important;
            letter-spacing: 0.1em !important;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
            color: #fff !important;
            cursor: pointer;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
        }

        .btn-v5:hover {
            background: #4f46e5 !important;
            transform: translateY(-1px);
            box-shadow: 0 15px 25px -5px rgba(99, 102, 241, 0.4);
        }

        .btn-v5:active {
            transform: translateY(0);
        }

        .link-v5 {
            color: #818cf8;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            font-size: 0.8rem;
        }

        .link-v5:hover {
            color: #a5b4fc;
            text-decoration: underline;
        }

        .btn-ghost-v5 {
            background: transparent !important;
            color: #94a3b8 !important;
            font-size: 0.8rem !important;
            font-weight: 500 !important;
            text-decoration: underline !important;
            transition: color 0.2s ease !important;
        }

        .btn-ghost-v5:hover {
            color: #f8fafc !important;
        }
    </style>

    <div class="mb-6 text-sm text-slate-300 leading-relaxed">
        {{ __('Obrigado por se inscrever! Antes de começar, você poderia verificar seu endereço de e-mail clicando no link que acabamos de enviar para você? Se você não recebeu o e-mail, teremos o prazer de lhe enviar outro.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 font-medium text-sm text-emerald-400">
            {{ __('Um novo link de verificação foi enviado para o endereço de e-mail fornecido durante o registro.') }}
        </div>
    @endif

    <div class="mt-8 flex flex-col gap-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button class="btn-v5 w-full flex justify-center">
                {{ __('Reenviar E-mail de Verificação') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="flex justify-center">
            @csrf
            <button type="submit" class="btn-ghost-v5">
                {{ __('Sair') }}
            </button>
        </form>
    </div>
</x-guest-layout>
