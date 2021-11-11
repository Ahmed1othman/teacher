<div class="menu">
    <div class="main-menu">
        <div class="scroll">
            <ul class="list-unstyled">
                <li class="active">
                    <a href="{{ route('home') }}">
                        <i class="iconsminds-shop-4"></i>
                        <span>{{ __('admin/app.dashboard') }}</span>
                    </a>
                </li>
                <li>
                    <a href="#users">
                         <i class="simple-icon-user-following"></i> <span class="d-inline-block">{{ __('admin/app.users') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('articles.index') }}">
                         <i class="iconsminds-newspaper"></i> <span class="d-inline-block">{{ __('admin/app.article') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('news.index') }}">
                         <i class="iconsminds-newspaper"></i> <span class="d-inline-block">{{ __('admin/app.news') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('events.index') }}">
                         <i class="simple-icon-game-controller"></i> <span class="d-inline-block">{{ __('admin/app.events') }}</span>
                    </a>
                </li>
                <li>
                    <a href="#generalSetting">
                        <i class="iconsminds-air-balloon-1"></i> {{ __('admin/app.generalSetting') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="sub-menu">
        <div class="scroll">

            <ul class="list-unstyled" data-link="users" id="users">

                <li>
                    <a href="{{ route('users.index') }}">
                        <i class="simple-icon-user-following"></i> <span class="d-inline-block">{{ __('admin/app.users') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('partners.index') }}">
                        <i class="iconsminds-digital-drawing"></i> <span class="d-inline-block">{{ __('admin/app.partners') }}</span>
                    </a>
                </li>
            </ul>
            <ul class="list-unstyled" data-link="generalSetting">
                <li>
                    <a href="{{ route('info.index') }}">
                        <i class="simple-icon-picture"></i> <span class="d-inline-block">{{ __('admin/app.website_settings') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('contacts.index') }}">
                        <i class="simple-icon-bubbles"></i> <span class="d-inline-block">{{ __('admin/app.contacts') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('countries.index') }}">
                        <i class="simple-icon-flag"></i> <span class="d-inline-block">{{ __('admin/app.countries') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('cities.index') }}">
                        <i class="simple-icon-flag"></i> <span class="d-inline-block">{{ __('admin/app.cities') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('sliders.index') }}">
                        <i class="simple-icon-picture"></i> <span class="d-inline-block">{{ __('admin/app.sliders') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('type.index') }}">
                        <i class="simple-icon-picture"></i> <span
                            class="d-inline-block">{{ __('admin/app.type') }}</span>
                    </a>
                </li>
            </ul>

        </div>
    </div>
</div>
