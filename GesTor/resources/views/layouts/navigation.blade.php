    <nav x-data="{ open: false }" class="bg-black/80 border-b border-green-400/20 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">

                <!-- LEFT -->
                <div class="flex items-center">

                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('dashboard') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-green-400" />
                        </a>
                    </div>

                    <!-- Links -->
                    <div class="hidden sm:flex space-x-8 ms-10">

                        <a href="{{ route('dashboard') }}"
                           class="text-green-400 border-b-2 border-green-400 pb-1">
                            Proyectos
                        </a>

                        <a href="#"
                           class="text-gray-300 hover:text-green-400 transition">
                            Tareas
                        </a>

                        <a href="#"
                           class="text-gray-300 hover:text-green-400 transition">
                            Usuarios
                        </a>

                    </div>
                </div>

                <!-- RIGHT -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">

                        <!-- Trigger -->
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-300 hover:text-green-400 transition">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <!-- Dropdown -->
                        <x-slot name="content">
                            <div class="bg-black border border-green-400/20 rounded-md shadow-lg">

                                <x-dropdown-link 
                                    :href="route('profile.edit')" 
                                    class="text-gray-300 hover:text-green-400 hover:bg-green-400/10">
                                    Profile
                                </x-dropdown-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link 
                                        :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="text-gray-300 hover:text-green-400 hover:bg-green-400/10">
                                        Log Out
                                    </x-dropdown-link>
                                </form>

                            </div>
                        </x-slot>

                    </x-dropdown>
                </div>

                <!-- MOBILE BUTTON -->
                <div class="flex items-center sm:hidden">
                    <button @click="open = ! open"
                        class="p-2 rounded-md text-gray-400 hover:text-green-400 hover:bg-green-400/10 transition">
                        
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }"
                                class="inline-flex" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            
                            <path :class="{'hidden': ! open, 'inline-flex': open }"
                                class="hidden" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>

                    </button>
                </div>

            </div>
        </div>

        <!-- MOBILE MENU -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-black border-t border-green-400/20">
            
            <div class="pt-2 pb-3 space-y-1">

                <a href="{{ route('dashboard') }}" class="block px-4 text-green-400">
                    Proyectos
                </a>

                <a href="#" class="block px-4 text-gray-300 hover:text-green-400">
                    Tareas
                </a>

                <a href="#" class="block px-4 text-gray-300 hover:text-green-400">
                    Usuarios
                </a>

            </div>

            <div class="pt-4 pb-1 border-t border-green-400/20">
                <div class="px-4">
                    <div class="text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="text-sm text-gray-400">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">

                    <a href="{{ route('profile.edit') }}" class="block px-4 text-gray-300 hover:text-green-400">
                        Profile
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); this.closest('form').submit();"
                           class="block px-4 text-gray-300 hover:text-green-400">
                            Log Out
                        </a>
                    </form>

                </div>
            </div>
        </div>
    </nav>