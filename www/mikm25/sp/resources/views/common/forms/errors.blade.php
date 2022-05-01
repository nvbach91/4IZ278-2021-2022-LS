@if($errors->any())
    <div class="alert alert-danger">
        {{ __('common.form.has_errors') }}
    </div>
@endif

@foreach($errors->all() as $error)
    {{ $error }}
@endforeach