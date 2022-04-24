@if($errors->any())
    <div class="alert alert-danger">
        {{ __('common.form.has_errors') }}
    </div>
@endif