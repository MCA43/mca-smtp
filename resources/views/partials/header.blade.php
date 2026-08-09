@php
    $np = config('smtp.routes.web.name_prefix', 'mca.smtp.');
@endphp
<header class="mca-ui-shell" id="mcaUiShell">
    <div class="mca-ui-shell__wrap">
        <div class="mca-ui-shell__inner">
            <a href="{{ route($np.'index') }}" class="mca-ui-brand">
                <span class="mca-ui-brand__mark" aria-hidden="true">
                    @include('mca-smtp::partials.icon', ['name' => 'mail'])
                </span>
                <span>{{ $mcaSmtpTitle ?? mca_smtp_t('app.brand') }}</span>
            </a>

            <button type="button"
                    class="mca-ui-menu-btn"
                    id="mcaUiMenuBtn"
                    aria-expanded="false"
                    aria-controls="mcaUiNav"
                    aria-label="{{ mca_smtp_t('app.nav_aria') }}">
                @include('mca-smtp::partials.icon', ['name' => 'menu'])
            </button>
        </div>

        <nav class="mca-ui-nav" id="mcaUiNav" aria-label="{{ mca_smtp_t('app.nav_aria') }}">
            @if(Route::has('mca.hub.index'))
                <a href="{{ route('mca.hub.index') }}" class="mca-ui-nav__link">
                    @include('mca-smtp::partials.icon', ['name' => 'grid', 'class' => 'mca-ui-icon mca-ui-icon--sm'])
                    {{ mca_smtp_t('nav.back_mca') }}
                </a>
            @endif

            <a href="{{ route($np.'index') }}" class="mca-ui-nav__link mca-ui-nav__link--active">
                {{ mca_smtp_t('nav.settings') }}
            </a>
        </nav>
    </div>
</header>
