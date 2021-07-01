<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class notifCommande extends Notification
{
    use Queueable;
    public $commandess;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($commandess)
    {
        $this->commandess = $commandess;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        
        return[
            //'commande'=>$this->commande
            
            
            'text'=>$this->commandess->nom_client."a passé une commande de ".$this->commandess->montant." Dhs"
        ];
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