<li>
    <a href="{{ route($route, $options ?? []) }}" @if(Route::currentRouteName() == $route) class="link_active" @endif>
        <i class="fas fa-{{ $icon }}"></i> {{ $label }}
    </a>
</li>
