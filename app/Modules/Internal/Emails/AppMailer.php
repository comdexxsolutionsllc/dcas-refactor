<?php

namespace Modules\Internal\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Internal\Models\Ticket;

class AppMailer extends Mailable {

    use Queueable, SerializesModels;

    public $mailer;

    public $fromAddress = 'support@supportticket.dev';

    public $fromName = 'Support Ticket';

    public $to;

    public $subject;

    public $view;

    public $data = [];


    /**
     * Create a new message instance.
     *
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }


    /**
     * @param        $user
     * @param Ticket $ticket
     */
    public function sendTicketInformation($user, Ticket $ticket)
    {
        $this->to = $user->email;
        $this->subject = "[Ticket ID: $ticket->ticket_id] $ticket->title";
        $this->view = 'Internal::emails.ticket_info';
        $this->data = compact('user', 'ticket');

        return $this->deliver();
    }


    /**
     * @param        $ticketOwner
     * @param        $user
     * @param Ticket $ticket
     * @param        $comment
     */
    public function sendTicketComments($ticketOwner, $user, Ticket $ticket, $comment)
    {
        $this->to = $ticketOwner->email;
        $this->subject = "RE: $ticket->title (Ticket ID: $ticket->ticket_id)";
        $this->view = 'Internal::emails.ticket_comments';
        $this->data = compact('ticketOwner', 'user', 'ticket', 'comment');

        return $this->deliver();
    }


    /**
     * @param        $ticketOwner
     * @param Ticket $ticket
     */
    public function sendTicketStatusNotification($ticketOwner, Ticket $ticket)
    {
        $this->to = $ticketOwner->email;
        $this->subject = "RE: $ticket->title (Ticket ID: $ticket->ticket_id)";
        $this->view = 'Internal::emails.ticket_status';
        $this->data = compact('ticketOwner', 'ticket');

        return $this->deliver();
    }


    /**
     *
     */
    public function deliver()
    {
        $this->mailer->send($this->view, $this->data, function ($message)
        {
            $message->from($this->fromAddress, $this->fromName)->to($this->to)->subject($this->subject);
        });
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Internal::emails.ticket_info');
    }
}
