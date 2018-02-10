@if (session('status'))
    <div class="alert alert-success alert-dismissable">
        {{ session('status') }}
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </div>
@endif