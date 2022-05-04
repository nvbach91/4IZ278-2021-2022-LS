@extends('templates.app')

@section('title')
    {{ __('pages.app.companies.create') }}
@endsection

@section('breadcrumbs')
    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('app.companies.create') }}
@endsection

@section('app-content')
    <div class="row">
        <div class="col">
            <form action="{{ route('app.companies.store') }}" method="post">
                @include('common.status')
                @include('common.forms.errors')
                {{ csrf_field() }}

                <div class="row g-3 mb-3">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="company-name" class="form-label">
                            {{ __('models.company.name') }}
                            @include('common.forms.required')
                        </label>
                        <input type="text" id="company-name" name="name" value="{{ old('name') }}"
                               maxlength="255" autocomplete="off"
                               class="form-control @error('name') is-invalid @enderror" required>
                        @include('common.forms.error', ['field' => 'name'])
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="company-size" class="form-label">
                            {{ __('models.company.size') }}
                        </label>
                        <select name="size" id="company-size"
                                class="form-select @error('size') is-invalid @enderror">
                            <option value="" {{ empty(old('size')) ? 'selected' : '' }}>{{ __('companies.selects.size_empty') }}</option>
                            @foreach(\App\Models\Attributes\CompanySizeAttribute::getAllSizes() as $key => $size)
                                <option value="{{ $key }}" {{ old('size') === $key ? 'selected' : '' }}>{{ $size->getTranslatedSize() }}</option>
                            @endforeach
                        </select>
                        @include('common.forms.error', ['field' => 'size'])
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="company-url" class="form-label">
                            {{ __('models.company.url') }}
                        </label>
                        <input type="url" id="company-url" name="url" value="{{ old('url') }}"
                               maxlength="255"
                               class="form-control @error('url') is-invalid @enderror">
                        @include('common.forms.error', ['field' => 'url'])
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="company-address" class="form-label">
                            {{ __('models.company.address') }}
                        </label>
                        <input type="text" id="company-address" name="address"
                               maxlength="255"
                               value="{{ old('address') }}"
                               class="form-control @error('address') is-invalid @enderror">
                        @include('common.forms.error', ['field' => 'address'])
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="company-contact-email" class="form-label">
                            {{ __('models.company.contact_email') }}
                        </label>
                        <input type="email" id="company-contact-email" name="contact_email"
                               maxlength="255"
                               value="{{ old('contact_email') }}"
                               class="form-control @error('contact_email') is-invalid @enderror">
                        @include('common.forms.error', ['field' => 'contact_email'])
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                {{ __('common.buttons.create') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection