@php($status = session('status', []))

@if(!empty($status))
    @foreach($status as $type => $messages)
        @foreach(\Illuminate\Support\Arr::wrap($messages) as $message)
            <div class="alert alert-{{ $type }}">
                {{ $message }}
            </div>
        @endforeach
    @endforeach
@endif