<nav id="app-nav">
    <ul class="nav flex-column d-grid gap-1">
        @foreach($pages as $route => $page)
            @if($page === \App\View\Composers\SidebarViewComposer::DIVIDER)
                <hr>
                @continue
            @endif

            <li class="nav-item">
                <a class="nav-link rounded-2 {{ ($page['activeRoute'] ?? $route) === $currentRoute ? 'active' : '' }}" href="{{ route($route) }}">
                    <i class="{{ $page['icon'] }}"></i> {{ $page['text'] }}
                </a>
            </li>
        @endforeach

        <li class="nav-item">
            <a class="nav-link rounded-2" href="#" id="logout-btn">
                <i class="bi bi-box-arrow-left"></i> {{ __('pages.app.logout') }}
            </a>
        </li>
    </ul>

    <form action="{{ route('auth.logout') }}" method="post" class="d-none" id="logout-form">
        {{ csrf_field() }}
    </form>
</nav>