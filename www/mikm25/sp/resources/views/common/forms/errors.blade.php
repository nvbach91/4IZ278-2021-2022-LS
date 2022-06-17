@isset($name)
    <div class="form-errors">
        @if($errors->{$name}->any())
            <div class="alert alert-danger">
                <p>{{ __('common.form.has_errors') }}</p>
                <ul class="mb-0">
                    @foreach($errors->{$name}->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@else
    <div class="form-errors">
        @if($errors->any())
            <div class="alert alert-danger">
                {{ __('common.form.has_errors') }}
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endisset