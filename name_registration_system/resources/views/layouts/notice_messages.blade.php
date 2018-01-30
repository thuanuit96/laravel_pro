@if ($errors->any() || session()->has('message') || session()->has('error'))
    <div style="margin-bottom: 10px" class="alert alert-dismissible {{ session()->has('message') ? 'alert-success' : 'alert-danger' }}" id="alert-message">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        @foreach ($errors->all() as $message)
            <p>{{ $message }}</p>
        @endforeach
        @if (session()->has('message'))
            <p>{{ session('message') }}</p>
        @endif
        @if (session()->has('error'))
            <p>{{ session('error') }}</p>
        @endif
    </div>
@endif

@if (!empty($pendingName = \App\Services\DomainService::getPendingDomain()))
    <div style="margin-bottom: 10px" class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p>
            Yes! "{{ $pendingName }}" is still available.
            <a href="{{ action('Dashboard\NameManagementController@create') }}" class="">Continue Registration</a>
        </p>
    </div>
@endif

<div id="alert-message">
</div>
<div id="register-domain">
</div>