<nav x-data="{ open: false }" class="bg-blue-400 shadow-xl">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo and Branding (Tranquil Connect) -->
                <div class="shrink-0 flex items-center text-black text-xl font-extrabold tracking-widest">
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <!-- NOTE: Your x-application-mark component will need internal styling to render the logo in a color visible on blue -->
                        <x-application-mark class="block h-9 w-auto text-black" />
                        <span class="ml-2 hidden sm:block">Tranquil Connect</span>
                    </a>
                </div>

                <!-- Navigation Links (Tab-like style matching the image) -->
                <!-- Text is black for visibility over the blue background -->
                <div class="hidden space-x-2 sm:-my-px sm:ms-10 sm:flex h-full">
                    
                    <!-- Inicio -->
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="!text-black hover:bg-blue-500/75 transition-colors duration-150 rounded-lg h-full flex items-center px-4">
                        {{ __('Inicio') }}
                    </x-nav-link>
                    
                    <!-- Usuarios (ANTES Grupos) -->
                    <!-- NOTA: El fondo azul más oscuro en el botón 'Usuarios' indica el estado activo -->
                    <x-nav-link href="{{ route('user.index') }}" :active="request()->routeIs('user.index')" class="!text-black hover:bg-blue-500/75 transition-colors duration-150 rounded-lg h-full flex items-center px-4">
                        {{ __('Usuarios') }}
                    </x-nav-link>

                    <!-- Formulario (ANTES Configuración) -->
                    <x-nav-link href="{{ route('formulario.especial') }}" :active="request()->routeIs('formulario.especial')" class="!text-black hover:bg-blue-500/75 transition-colors duration-150 rounded-lg h-full flex items-center px-4">
                        {{ __('Formulario') }}
                    </x-nav-link>
            <!-- Right Side: Login/Registro Buttons & Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-3">
                
                <!-- NEW: Login & Registro Buttons (Visible only when not authenticated) -->
                @guest
                    <!-- Login Button (Green) -->
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition ease-in-out duration-150">
                        {{ __('Login') }}
                    </a>

                    <!-- Registro Button (Orange) -->
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-orange-500 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition ease-in-out duration-150">
                        {{ __('Registro') }}
                    </a>
                @endguest


                <!-- Authenticated User Dropdowns -->
                @auth
                    <!-- Teams Dropdown (Unchanged logic, updated styling for blue background) -->
                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <div class="relative">
                            <x-dropdown align="right" width="60">
                                <x-slot name="trigger">
                                    <span class="inline-flex rounded-md">
                                        <!-- Button background is blue-500, darker than the nav bar -->
                                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-black bg-blue-500 hover:bg-blue-400 focus:outline-none focus:bg-blue-400 active:bg-blue-400 transition ease-in-out duration-150">
                                            {{ Auth::user()->currentTeam->name }}
                                            <svg class="ms-2 -me-0.5 size-4 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                            </svg>
                                        </button>
                                    </span>
                                </x-slot>

                                <x-slot name="content">
                                    <div class="w-60">
                                        <!-- Team Management (Unchanged) -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Manage Team') }}
                                        </div>
                                        <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                            {{ __('Team Settings') }}
                                        </x-dropdown-link>
                                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                            <x-dropdown-link href="{{ route('teams.create') }}">
                                                {{ __('Create New Team') }}
                                            </x-dropdown-link>
                                        @endcan
                                        <!-- Team Switcher (Unchanged) -->
                                        @if (Auth::user()->allTeams()->count() > 1)
                                            <div class="border-t border-gray-200"></div>
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('Switch Teams') }}
                                            </div>
                                            @foreach (Auth::user()->allTeams() as $team)
                                                <x-switchable-team :team="$team" />
                                            @endforeach
                                        @endif
                                    </div>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @endif

                    <!-- Settings Dropdown (The "Tatiana" button style) -->
                    <div class="relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="size-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    </button>
                                @else
                                    <!-- Custom Button Style for the User Name (Tatiana look) -->
                                    <span class="inline-flex rounded-md">
                                        <!-- Button background is blue-500, darker than the nav bar -->
                                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-black bg-blue-500 hover:bg-blue-400 focus:outline-none focus:bg-blue-400 active:bg-blue-400 transition ease-in-out duration-150">
                                            {{ Auth::user()->name }}

                                            <svg class="ms-2 -me-0.5 size-4 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                                @endif
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management Content (Unchanged) -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Account') }}
                                </div>
                                <x-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                        {{ __('API Tokens') }}
                                    </x-dropdown-link>
                                @endif
                                <div class="border-t border-gray-200"></div>
                                <!-- Authentication (Unchanged) -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <x-dropdown-link href="{{ route('logout') }}"
                                            @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endauth
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-black hover:text-gray-700 hover:bg-blue-500 focus:outline-none focus:bg-blue-500 focus:text-gray-700 transition duration-150 ease-in-out">
                    <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-blue-600">
        <div class="pt-2 pb-3 space-y-1">
            
            <!-- Mobile Links -->
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="text-black hover:bg-blue-500">
                {{ __('Inicio') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('user.index') }}" :active="request()->routeIs('user.index')" class="text-black hover:bg-blue-500">
                {{ __('Usuarios') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('formulario.especial') }}" :active="request()->routeIs('formulario.especial')" class="text-black hover:bg-blue-500">
                {{ __('Formulario') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('some.other.route')" class="text-black hover:bg-blue-500">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <!-- Mobile Login/Registro Buttons (Visible only when not authenticated) -->
            @guest
                <x-responsive-nav-link href="{{ route('login') }}" class="text-green-500 hover:bg-blue-500">
                    {{ __('Login') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('register') }}" class="text-orange-500 hover:bg-blue-500">
                    {{ __('Registro') }}
                </x-responsive-nav-link>
            @endguest
        </div>

        <!-- Responsive Settings Options (Authenticated User) -->
        <div class="pt-4 pb-1 border-t border-blue-400">
            @auth
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 me-3">
                        <img class="size-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-black">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-700">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management (Unchanged logic, updated mobile styles) -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')" class="text-black hover:bg-blue-500">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')" class="text-black hover:bg-blue-500">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <x-responsive-nav-link href="{{ route('logout') }}"
                            @click.prevent="$root.submit();" class="text-black hover:bg-blue-500">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

                <!-- Team Management (Unchanged logic, updated mobile styles) -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-blue-400"></div>

                    <div class="block px-4 py-2 text-xs text-gray-700">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')" class="text-black hover:bg-blue-500">
                        {{ __('Team Settings') }}
                    </x-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')" class="text-black hover:bg-blue-500">
                            {{ __('Create New Team') }}
                        </x-responsive-nav-link>
                    @endcan

                    <!-- Team Switcher -->
                    @if (Auth::user()->allTeams()->count() > 1)
                        <div class="border-t border-blue-400"></div>

                        <div class="block px-4 py-2 text-xs text-gray-700">
                            {{ __('Switch Teams') }}
                        </div>

                        @foreach (Auth::user()->allTeams() as $team)
                            <x-switchable-team :team="$team" component="responsive-nav-link" />
                        @endforeach
                    @endif
                @endif
            </div>
            @endauth
        </div>
    </div>
</nav>