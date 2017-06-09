@extends('Internal::layouts.master')

@section('title', $ticket->title)

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    #{{ $ticket->ticket_id }} - {{ $ticket->title }}
                </div>

                <div class="panel-body">
                    @include('Internal::includes.flash')


                    <div class="ticket-info">
                        <p>Category: &nbsp; {{ $category->name }}</p>
                        <div style="float: left; width: auto;">
                            Status: @include('Internal::partials.ticket_status')
                        </div>
                        <p style="clear: both"></p>
                        <p>Created on: {{ $ticket->created_at->diffForHumans() }}</p>
                        <p style="padding-top: 25px">{{ $ticket->message }}</p>
                    </div>

                    <hr>

                    @if (count($ticket['comments']))
                        <div class="comments">
                            @foreach ($ticket['comments'] as $comment)
                                <div class="panel panel-@if($ticket->user->id === $comment->user_id) {{"default"}}@else{{"success"}}@endif">
                                    <div class="panel panel-heading">
                                        {{ $comment->user->name }}
                                        <span class="pull-right">{{ $comment->created_at->format('Y-m-d') }}</span>
                                    </div>

                                    <div class="panel panel-body">
                                        {{ $comment->comment }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="comment-form">
                        <form action="{{ url('internal/comment') }}" method="POST" class="form">
                            {!! csrf_field() !!}

                            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                            <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                <textarea rows="10" id="comment" class="form-control" name="comment"></textarea>

                                @if ($errors->has('comment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a class="btn btn-warning" style="float: right" href="/internal/my_tickets">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="panel">
                <ul style="list-style-type:none">
                    @foreach($ticket['comments'] as $comments)
                        @foreach($comments->revisionHistory as $history)
                            @if($history->key == 'created_at' && !$history->old_value)
                                <li>{{ $history->userResponsible()->name }} created this resource
                                    at {{ $history->newValue() }}</li>
                            @else
                                <li>{{ $history->userResponsible()->name }} changed {{ $history->fieldName() }}
                                    from {{ $history->oldValue() }} to {{ $history->newValue() }}</li>
                            @endif
                        @endforeach
                    @endforeach
                </ul>
            </div>

        </div>
@endsection