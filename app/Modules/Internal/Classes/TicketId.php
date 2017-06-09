<?php

namespace Modules\Internal\Classes;

/**
 * Class TicketId
 * @package Modules\Internal\Classes
 */
class TicketId
{
    /**
     * @param int $ticket_length | 15
     * @return string Ticket_ID
     */
    public static function Generate($ticket_length = 15)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $string = '';

        if ($ticket_length < 10) throw new \OutOfBoundsException("ticket_length must be greater than 9");
        if ($ticket_length > 40) throw new \OutOfBoundsException("ticket_length must be less than 40");

        for ($i = 0; $i < $ticket_length; $i++) {
            $string .= $characters[mt_rand(0, $max = strlen($characters) - 1)];
        }

        return strtoupper($string);
    }
}