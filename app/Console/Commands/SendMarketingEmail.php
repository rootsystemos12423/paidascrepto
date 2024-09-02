<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\EmailRemarketing;
use App\Mail\RemarketingEmailOne;
use Illuminate\Support\Facades\Mail;

class SendMarketingEmail extends Command
{
    protected $signature = 'email:marketing';
    protected $description = 'Envia e-mails de marketing';

    public function __construct()
    {
        parent::__construct();
    }

        public function handle()
    {
        $users = User::doesntHave('roles')->get();
        foreach ($users as $user) {
            $existingRecord = EmailRemarketing::where('email', $user->email)->first();

            if (!$existingRecord) {
                // Se não existir, envie o e-mail e crie um novo registro.
                Mail::to($user->email)->send(new RemarketingEmailOne($user));

                // Após enviar o e-mail, crie um registro na tabela email_remarketing.
                EmailRemarketing::create([
                    'email' => $user->email,
                    'alerted' => 1,
                ]);

                $this->info('E-mail de marketing enviado para: ' . $user->email);
            } else {
                // Verifica se o usuário já foi alertado mais de 3 vezes.
                if ($existingRecord->alerted >= 3) {
                    $this->info('Esse email: ' . $user->email . ' já foi alertado ' . $existingRecord->alerted . ' vezes.');
                } else {
                    // Se já existir e tiver sido alertado 3 vezes ou menos, reenvie o e-mail.
                    Mail::to($user->email)->send(new RemarketingEmailOne($user));
            
                    // Incrementa o valor de 'alerted' e atualiza o registro.
                    $existingRecord->increment('alerted');
            
                    $this->info('E-mail de marketing reenviado para: ' . $user->email . '. Alertado ' . $existingRecord->alerted . ' vezes.');
                }
            }            
        }
    }
}

