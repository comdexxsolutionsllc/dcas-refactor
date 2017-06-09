@if ($ticket->status === 'Open')
    <span class="label label-success"
          style="width: 200px;">{{ $ticket->status }}</span>
@elseif ($ticket->status === 'New')
    <span class="label label-default"
          style="width: 200px;">{{ $ticket->status }}</span>
@elseif ($ticket->status === 'On Hold')
    <span class="label label-warning"
          style="width: 200px;">{{ $ticket->status }}</span>
@elseif ($ticket->status === 'Awaiting Customer Response')
    <span class="label label-primary"
          style="width: 200px;">{{ $ticket->status }}</span>
@elseif ($ticket->status === 'Escalated')
    <span class="label label-info"
          style="width: 200px;">{{ $ticket->status }}</span>
@else
    <span class="label label-danger"
          style="width: 200px;">{{ $ticket->status }}</span>
@endif