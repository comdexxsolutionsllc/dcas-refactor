<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Internal\Models\Ticket;

class TicketPolicy
{
    use HandlesAuthorization;

    /**
     * @param \App\User $user
     * @param \Modules\Internal\Models\Ticket $ticket
     * @return boolean
     */
    public function before($user, $ability)
    {
        if ($user->isAdministrator()) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the ticket.
     *
     * @param  \App\User $user
     * @param  \Modules\Internal\Models\Ticket $ticket
     * @return boolean
     */
    public function view(User $user, Ticket $ticket)
    {
        return $user->isAdministrator();
    }

    /**
     * Determine whether the user can create tickets.
     *
     * @param  \App\User $user
     * @return boolean
     */
    public function create(User $user)
    {
        // TODO:  Change this
        return true;
    }

    /**
     * Determine whether the user can update the ticket.
     *
     * @param  \App\User $user
     * @param  \Modules\Internal\Models\Ticket $ticket
     * @return boolean
     */
    public function update(User $user, Ticket $ticket)
    {
        return $user->id === $ticket->user_id;
    }

    /**
     * Determine whether the user can delete the ticket.
     *
     * @param  \App\User $user
     * @param \Modules\Internal\Models\Ticket $ticket
     * @return boolean
     */
    public function delete(User $user, Ticket $ticket)
    {
        return $user->isAdministrator();
    }

    /**
     * @param \App\User $user
     * @param \Modules\Internal\Models\Ticket $ticket
     * @return boolean
     */
    public function close(User $user, Ticket $ticket)
    {
        return $user->isAdministrator();
    }
}
