<script>
    @if(\Auth::user())
        window.App = {!! json_encode(['signedIn'  => \Auth::check(), 'user'      => ['id' => \Auth::user()->id, 'name' => \Auth::user()->name]]) !!};
    @else
        window.App = {!! json_encode(['signedIn'  => \Auth::check(), 'user'      => null]) !!};
    @endif
</script>
