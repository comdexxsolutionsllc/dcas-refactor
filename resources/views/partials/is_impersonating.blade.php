@if(\Auth::user()->isImpersonating())
    <div class="container">
        <div class="row">
            <div id="alert" class="alert alert-danger" role="alert">You are currently impersonating a user.</div>
        </div>
    </div>
@endif