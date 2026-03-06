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
    </style>

    <div class="mb-8">
        <h2 class="text-xl font-bold text-slate-100 tracking-tight">Redefinir sua senha</h2>
        <p class="text-sm text-slate-400 mt-2">Crie uma nova credencial de acesso para sua conta.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <label for="email" class="label-v5">{{ __('E-mail') }}</label>
            <x-text-input id="email" class="input-v5" type="email" name="email" :value="old('email', $request->email)" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-rose-400 text-xs font-semibold" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="label-v5">{{ __('Nova Senha') }}</label>
            <x-text-input id="password" class="input-v5" type="password" name="password" required
                autocomplete="new-password" placeholder="••••••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-rose-400 text-xs font-semibold" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="label-v5">{{ __('Confirmar Nova Senha') }}</label>
            <x-text-input id="password_confirmation" class="input-v5" type="password" name="password_confirmation"
                required autocomplete="new-password" placeholder="••••••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-rose-400 text-xs font-semibold" />
        </div>

        <div class="pt-4">
            <x-primary-button class="btn-v5 w-full flex justify-center">
                {{ __('Redefinir Senha') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
