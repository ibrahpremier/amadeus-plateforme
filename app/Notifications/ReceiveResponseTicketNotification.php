<?php

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ReceiveResponseTicketNotification extends Notification
{
    use Queueable;
    protected $ticket;
    protected $changes;
    /**
     * Create a new notification instance.
     */
    public function __construct(Ticket $ticket, array $changes)
    {
        $this->ticket = $ticket;
        $this->changes = $changes;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject('Mise à jour de votre demande de réservation')
        ->view('emails.reponse-ticket', ['ticket' => $this->ticket,
                'changes' => $this->changes]);

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'ticket_id' => $this->ticket->id,
            'status' => $this->ticket->status,
            'reponse_ville_depart' => $this->ticket->reponse_ville_depart,
            'reponse_ville_destination' => $this->ticket->reponse_ville_destination,
            'reponse_date_depart' => $this->ticket->reponse_date_depart,
            'reponse_date_retour' => $this->ticket->reponse_date_retour,
            'prix' => $this->ticket->prix,
            'commentaire' => $this->ticket->response_commentaire,
            'reponse_file' => $this->ticket->reponse_file,
        ];
    }
}
