<nav aria-label="breadcrumb" class="mb-3 d-flex justify-content-between flex-column align-items-start flex-lg-row align-items-lg-center">
    <div class="d-flex">
        <a href="{{ route('landing-page') }}" class="h5 me-3 mb-0">
            {{ config('app.name') }}
        </a>
        @yield('breadcrumbs')
    </div>
    <div class="d-flex align-items-center mt-2 mt-lg-0">
        <div class="dropdown">
            <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="create-entity-dropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-plus"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="create-entity-dropdown">
                <li>
                    <a class="dropdown-item" href="{{ route('app.positions.create') }}">
                        <i class="bi bi-plus"></i> {{ __('pages.app.positions.create') }}
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('app.companies.create') }}">
                        <i class="bi bi-plus"></i> {{ __('pages.app.companies.create') }}
                    </a>
                </li>
            </ul>
        </div>
        <div class="dropdown ms-2">
            <button class="btn btn-light btn-sm dropdown-toggle d-flex-centered" type="button" id="user-dropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                <span class="max-w-125 text-truncate">{{ auth('web')->user()->full_name }}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="entity-switcher">
                <li>
                    <a class="dropdown-item logout-btn" href="#">
                        <i class="bi bi-box-arrow-left"></i> {{ __('pages.app.logout') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>