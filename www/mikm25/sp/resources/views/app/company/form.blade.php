@php

use App\Models\Company;

/**
 * @var Company|null $company
 */

$company = $company ?? null;

$companyName = old('name', isset($company) ? $company->name : null);
$companySize = old('size', isset($company) && ! empty($company->size) ? $company->size->getSize() : null);
$companyUrl = old('url', isset($company) ? $company->url : null);
$companyAddress = old('address', isset($company) ? $company->address : null);
$companyContactEmail = old('contact_email', isset($company) ? $company->contact_email : null);

@endphp

<form action="{{ isset($company) ? route('app.companies.update', ['company' => $company->id]) : route('app.companies.store') }}"
      method="post">
    @include('common.forms.errors')
    {{ csrf_field() }}

    @isset($company)
        @method('patch')
    @endisset

    <h2>{{ __('companies.sections.general') }}</h2>
    <div class="row g-3 mb-3">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <label for="company-name" class="form-label">
                {{ __('models.company.name') }}
                @include('common.forms.required')
            </label>
            <input type="text" id="company-name" name="name" value="{{ $companyName }}"
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
                <option value="" {{ empty($companySize) ? 'selected' : '' }}>{{ __('companies.selects.size_empty') }}</option>
                @foreach(\App\Models\Attributes\CompanySizeAttribute::getAllSizes() as $key => $size)
                    <option value="{{ $key }}" {{ $companySize === $key ? 'selected' : '' }}>{{ $size->getTranslatedSize() }}</option>
                @endforeach
            </select>
            @include('common.forms.error', ['field' => 'size'])
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <label for="company-url" class="form-label">
                {{ __('models.company.url') }}
            </label>
            <input type="url" id="company-url" name="url" value="{{ $companyUrl }}"
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
                   value="{{ $companyAddress }}"
                   class="form-control @error('address') is-invalid @enderror">
            @include('common.forms.error', ['field' => 'address'])
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <label for="company-contact-email" class="form-label">
                {{ __('models.company.contact_email') }}
            </label>
            <input type="email" id="company-contact-email" name="contact_email"
                   maxlength="255"
                   value="{{ $companyContactEmail }}"
                   class="form-control @error('contact_email') is-invalid @enderror">
            @include('common.forms.error', ['field' => 'contact_email'])
        </div>
    </div>

    <div class="row">
        <div class="col">
            @if(isset($company))
                <div class="d-flex justify-content-between">
                    <a href="{{ route('app.companies.show', ['company' => $company->id]) }}" class="btn btn-light">
                        {{ __('common.buttons.detail') }}
                    </a>
                    <button type="submit" class="btn btn-primary">
                        {{ __('common.buttons.save') }}
                    </button>
                </div>
            @else
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        {{ __('common.buttons.create') }}
                    </button>
                </div>
            @endif
        </div>
    </div>
</form>