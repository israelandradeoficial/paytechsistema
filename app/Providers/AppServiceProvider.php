<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\Permission;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Customizar e-mail de verificação
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Verifique seu endereço de e-mail')
                ->greeting('Olá!')
                ->line('Clique no botão abaixo para verificar o seu endereço de e-mail.')
                ->action('Verificar E-mail', $url)
                ->line('Se você não criou uma conta, ignore este e-mail.');
        });

        // Customizar e-mail de redefinição de senha
        ResetPassword::toMailUsing(function ($notifiable, $token) {
            $url = url(route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));

            return (new MailMessage)
                ->subject('Notificação de Redefinição de Senha')
                ->greeting('Olá!')
                ->line('Você está recebendo este e-mail porque recebemos um pedido de redefinição de senha para sua conta.')
                ->action('Redefinir Senha', $url)
                ->line('Este link de redefinição de senha expirará em 60 minutos.')
                ->line('Se você não solicitou uma redefinição de senha, nenhuma ação adicional é necessária.');
        });

        // Registrar Gates de Permissões dinamicamente
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('permissions')) {
                foreach (Permission::all() as $permission) {
                    Gate::define($permission->slug, function ($user) use ($permission) {
                        return $user->hasPermission($permission->slug);
                    });
                }
            }
        } catch (\Exception $e) {
            // Silencioso se a tabela ainda não existir (ex: durante migrações)
        }
    }
}
