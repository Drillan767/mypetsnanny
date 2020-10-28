<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class Contact extends Notification
{
    use Queueable;

    protected $contact;

    /**
     * Create a new notification instance.
     *
     * @param array $contact
     *
     * @return void
     */
    public function __construct($contact)
    {
        $this->contact = $contact;
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
    public function toMail($notifiable)
    {
        $fullname = $this->contact['first_name'] . ' ' . $this->contact['last_name'];
        return (new MailMessage)
            ->from('noreply@mypetsnanny.fr', "My Pet's Nanny")
            ->subject('Nouveau contact depuis le site !')
            ->greeting('Bonjour !')
            ->line('Un visiteur du site vous a envoyé un message, en voici les détails :')
            ->line(new HtmlString('<b>Prénom, nom :</b>'))
            ->line($fullname)
            ->line(new HtmlString('<b>Objet : </b>'))
            ->line('"' . $this->contact['subject'] . '"')
            ->line(new HtmlString('<b>Message :</b>'))
            ->line(new HtmlString(nl2br($this->contact['message'])))
            ->action("Répondre à $fullname", 'mailto:' . $this->contact['email'])
            ->salutation(new HtmlString('Cordialement, <br />' . config('app.name')));
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
