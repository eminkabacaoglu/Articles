<nav class="navbar navbar-expand-md navbar-light bg-white border-bottom sticky-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="/">
            <x-application-logo width="36" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-nav-link>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Settings Dropdown -->
                @auth
                <x-nav-link href="/articles" :active="request()->routeIs('articles')">
                    {{ __('Articles') }}
                </x-nav-link>
                <x-nav-link href="{{ route('categories.index') }}" :active="request()->routeIs('categories')">
                    {{ __('Categories') }}
                </x-nav-link>
                    <x-dropdown id="settingsDropdown">
                        <x-slot name="trigger">
                            {{ Auth::user()->name }}
                        </x-slot>

                        <x-slot name="content">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                    @else <!--biz ekledik , a??a????ya yukardaki linki ekledi--->
                    <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                        {{ __('Login') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                        {{ __('Register') }}
                    </x-nav-link>

                @endauth
            </ul>
        </div>
    </div>
</nav>