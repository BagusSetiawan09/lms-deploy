<nav x-data="{ open: false }">
    <!-- Primary Navigation Menu -->
    <div class="px-4 sm:px-6 lg:px-8 my-4"> 
        <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex justify-between items-center h-16 px-4 sm:px-6 lg:px-8">
                    <a href="{{ route('index') }}">
                        <x-application-logo class="block h-[120px] w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-11 sm:-my-px sm:ms-10 sm:flex items-center">
                    <x-nav-link :href="route('index')" :active="request()->routeIs('index')">
                        {{ __('Home') }}
                    </x-nav-link>
                    {{-- <x-nav-link :href="route('kita')" :active="request()->routeIs('kita')">
                        {{ __('Tentang Kita') }}
                    </x-nav-link> --}}
                    @role('user')
                        <x-nav-link :href="route('materi')" :active="request()->routeIs('materi','materi.show')">
                            {{ __('Materi') }}
                        </x-nav-link>
                        <x-nav-link :href="route('tugas.index')" :active="request()->routeIs('tugas.*')">
                            {{ __('Tugas') }}
                        </x-nav-link>
                    @endrole

                    @role('pembimbing')
                        <x-nav-link :href="route('monitoring')" :active="request()->routeIs('monitoring')">
                            {{ __('Monitoring') }}
                        </x-nav-link>
                        <x-nav-link :href="route('tugas.index')" :active="request()->routeIs('tugas.*')">
                            {{ __('Tugas') }}
                        </x-nav-link>
                    @endrole

                    @role('admin')
                        <x-nav-link :href="route('monitoring')" :active="request()->routeIs('monitoring')">
                            {{ __('Monitoring') }}
                        </x-nav-link>
                        <x-nav-link :href="route('materi')" :active="request()->routeIs('materi','materi.show')">
                            {{ __('Materi') }}
                        </x-nav-link>
                        <x-nav-link :href="route('tugas.index')" :active="request()->routeIs('tugas.*')">
                            {{ __('Tugas') }}
                        </x-nav-link>
                    @endrole
                </div>

            {{-- Button Login dan Registrasi --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6 px-10 space-x-5">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div class="capitalize">{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" ...></svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="space-x-7">
                        <a href="{{ route('login') }}" class="text-sm text-white bg-[#33A1D9] py-2 px-6 rounded font-bold hover:bg-[#1b8dc2] hover:shadow-[0_0_10px_4px_#87CEEB] hover:brightness-110 transition duration-300 ease-in-out shadow-md">Login</a>
                        <a href="{{ route('register') }}" class="text-sm text-[#6B7280] bg-[#D1D5DB] py-2 px-6 font-bold rounded hover:bg-[#9CA3AF] hover:shadow-[0_0_10px_3px_#D1D5DB] transition duration-300 ease-in-out shadow-sm">Register</a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>