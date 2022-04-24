@php($status = session('status', []))

@if(!empty($status))
@foreach($status as $type => $message)
    <div class="alert alert-{{ $type }}">
        {{ $message }}
    </div>
@endforeach
@endif