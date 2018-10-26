@if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
@endif
@if(Session::has('warning'))
    <p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('warning') }}</p>
@endif
@if(Session::has('error'))
    <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error') }}</p></div>
@endif
@foreach ($errors as $error)
    <div>{{ $error }}</div>
@endforeach
