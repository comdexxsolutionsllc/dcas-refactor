@if ($ticket->status === 'Open')
    <span id="status" class="label label-success"
    >{{ $ticket->status }}</span>
@elseif ($ticket->status === 'New')
    <span id="status" class="label label-default"
    >{{ $ticket->status }}</span>
@elseif ($ticket->status === 'On Hold')
    <span id="status" class="label label-warning"
    >{{ $ticket->status }}</span>
@elseif ($ticket->status === 'Awaiting Customer Response')
    <span id="status" class="label label-primary"
    >{{ $ticket->status }}</span>
@elseif ($ticket->status === 'Escalated')
    <span id="status" class="label label-info"
    >{{ $ticket->status }}</span>
@else
    <span id="status" class="label label-danger"
    >{{ $ticket->status }}</span>
@endif