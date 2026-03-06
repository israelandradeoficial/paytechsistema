<x-guest-layout>
    <style>
        .input-v5 {
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.15) !important;
            color: #fff !important;
            border-radius: 0.75rem !important;
            transition: all 0.2s ease-in-out !important;
            padding: 0.85rem 1.1rem !important;
            font-size: 0.95rem !important;
            width: 100%;
        }

        .input-v5:focus {
            background: rgba(255, 255, 255, 0.08) !important;
            border-color: #6366f1 !important;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.2) !important;
            outline: none !important;
        }

        .input-v5::placeholder {
            color: rgba(148, 163, 184, 0.4) !important;
        }

        .label-v5 {
            color: #94a3b8 !important;
            font-weight: 600 !important;
            font-size: 0.75rem !important;
            margin-bottom: 0.5rem !important;
            display: block;
            text-transform: uppercase;
            letter-spacing: 0.12em;
        }

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
    </style>

    <div class="mb-6 text-sm text-slate-300 leading-relaxed">
        {{ __('Esqueceu sua senha? Sem problemas. Basta nos informar seu endereço de e-mail e enviaremos um link de redefinição de senha que permitirá que você escolha uma nova.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="label-v5">{{ __('E-mail') }}</label>
            <x-text-input id="email" class="input-v5" type="email" name="email" :value="old('email')" required
                autofocus placeholder="seu@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-rose-400 text-xs font-semibold" />
        </div>

        <div class="pt-4">
            <x-primary-button class="btn-v5 w-full flex justify-center">
                {{ __('Enviar link de redefinição') }}
            </x-primary-button>
        </div>

        <div class="flex items-center justify-center pt-2">
            <a href="{{ route('login') }}" class="link-v5">
                {{ __('Voltar para o login') }}
            </a>
        </div>
    </form>
</x-guest-layout>
