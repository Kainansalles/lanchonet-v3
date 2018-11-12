<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordResetRequest extends Notification
{
    use Queueable;
    protected $token;
    protected $user;
    /**
    * Create a new notification instance.
    *
    * @return void
    */
    public function __construct($token, $user)
    {
        $this->user = $user;
        $this->token = base64_encode($this->user['email'] . "#" . $token);
    }
    /**
    * Get the notification's delivery channels.
    *
    * @param  mixed  $notifiable
    * @return array
    */
    public function via($notifiable)
    {
        return ['mail'];
    }
     /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
     public function toMail($notifiable){
        $url = url('/api/password/reset/redirectapp/' . $this->token);
        $name = $this->user['name'];
        return (new MailMessage)
            ->greeting("$name, precisa da sua senha? É pra já!")
            ->subject('LanchoNET - Recuperação da conta')
            ->line('Você está recebendo este e-mail porque recebemos uma solicitação de redefinição de senha para sua conta.')
            ->action('Recuperar conta', url($url))
            ->line('Se você não solicitou uma redefinição de senha, nenhuma outra ação será necessária.');
    }
    /**
    * Get the array representation of the notification.
    *
    * @param  mixed  $notifiable
    * @return array
    */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
