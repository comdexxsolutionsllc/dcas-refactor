@extends('Internal::layouts.master')

@section('title', 'All Tickets')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-ticket"> Tickets</i>
                </div>

                <div class="panel-body">
                    @if ($tickets->isEmpty())
                        <p>There are currently no tickets.</p>
                    @else
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Category</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Last Updated</th>
                                <th style="text-align:center" colspan="2">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($tickets as $ticket)
                                <tr>
                                    <td>
                                        @foreach ($categories as $category)
                                            @if ($category->id === $ticket->category_id)
                                                {{ $category->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ url('internal/tickets/'. $ticket->ticket_id) }}">
                                            #{{ $ticket->ticket_id }} - {{ $ticket->title }}
                                        </a>
                                    </td>
                                    <td>
                                        @include('Internal::partials.ticket_status')
                                    </td>
                                    <td>{{ $ticket->updated_at->diffForHumans() }}</td>
                                    @if(!$ticket->isClosed($ticket, false))
                                    <td>
                                        <a href="{{ url('internal/tickets/' . $ticket->ticket_id) }}" class="btn btn-primary btn-xs">Comment</a>
                                    </td>
                                    @else
                                        <td>
                                            <a class="btn btn-primary btn-xs" disabled>Open to Comment</a>
                                        </td>
                                    @endif
                                    <td>
                                        <form action="{{ url('/internal/admin/'.$ticket->isClosed($ticket)[1].'_ticket/' . $ticket->ticket_id) }}"
                                              method="POST">
                                            {!! csrf_field() !!}
                                            <button type="submit" class="{{$ticket->isClosed($ticket)[2]}}">{{$ticket->isClosed($ticket)[0]}}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $tickets->render() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection