@php
    $profile_photo = auth()->check() ? auth()->user()->profile?->profile_photo : null;

    // Language switcher: always offer the *other* language
    $isArabic    = app()->getLocale() === 'ar';
    $otherLocale = $isArabic ? 'en' : 'ar';
    $otherLabel  = $isArabic ? 'English' : 'العربية';
@endphp

<nav class="sticky top-0 z-50 border-b border-white/10 bg-slate-950/60 backdrop-blur-sm">

    <div class="relative flex justify-between items-center text-hireflow-text-secondary px-5 py-3">

        {{-- Logo --}}
        <div class="logo">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="HireFlow" class="w-24 md:w-35">
            </a>
        </div>

        {{-- Desktop Navigation --}}
        <div class="hidden md:flex items-center gap-6 absolute left-1/2 -translate-x-1/2">

            <x-nav-link href="/jobs" :active="request()->is('jobs*')">
                {{ __('messages.jobs') }}
            </x-nav-link>

            @auth
                @if (auth()->user()->role === 'job_seeker')

                    <x-nav-link href="/job-seeker/dashboard"
                        :active="request()->is('job-seeker/dashboard*')">
                        {{ __('messages.dashboard') }}
                    </x-nav-link>

                    <x-nav-link href="/applications"
                        :active="request()->is('applications*')">
                        {{ __('messages.applications') }}
                    </x-nav-link>

                @elseif (auth()->user()->role === 'employer')

                    <x-nav-link href="/employer/dashboard"
                        :active="request()->is('employer/dashboard*')">
                        {{ __('messages.dashboard') }}
                    </x-nav-link>

                    <x-nav-link href="/employer/jobs"
                        :active="request()->is('employer/jobs*')">
                        {{ __('messages.my_jobs') }}
                    </x-nav-link>

                    <x-nav-link href="/employer/applications"
                        :active="request()->is('employer/applications*')">
                        {{ __('messages.employer_applications') }}
                    </x-nav-link>

                @endif
            @endauth

            <x-nav-link href="/companies"
                :active="request()->is('companies*')">
                {{ __('messages.companies') }}
            </x-nav-link>

            <x-nav-link href="/about"
                :active="request()->is('about')">
                {{ __('messages.about') }}
            </x-nav-link>

        </div>

        {{-- Desktop: language + account --}}
        <div class="hidden md:flex items-center gap-4 ms-auto">

            {{-- Language switcher --}}
            <a href="{{ url('/language/' . $otherLocale) }}"
               hreflang="{{ $otherLocale }}"
               class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-sm ring-1 ring-white/10 hover:bg-white/10 hover:text-hireflow-text transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-4 w-4"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     aria-hidden="true">

                    <circle cx="12" cy="12" r="9" stroke-width="1.8" />

                    <path stroke-width="1.8"
                          stroke-linecap="round"
                          d="M3 12h18M12 3c2.5 2.7 3.8 5.7 3.8 9s-1.3 6.3-3.8 9c-2.5-2.7-3.8-6.3-3.8-9S9.5 5.7 12 3z" />

                </svg>

                <span>{{ $otherLabel }}</span>

            </a>

            @guest

                <a href="/login"
                   class="hover:text-hireflow-text transition">
                    {{ __('messages.login') }}
                </a>

                <a href="/register"
                   class="hover:text-hireflow-text transition">
                    {{ __('messages.sign_up') }}
                </a>

            @else

                {{-- Account dropdown --}}
                <div class="relative">

                    <button id="account-toggle"
                        type="button"
                        class="flex items-center gap-2 hover:text-hireflow-text transition"
                        aria-haspopup="true"
                        aria-expanded="false">

                        @if ($profile_photo)

                            <img src="{{ asset('storage/' . $profile_photo) }}"
                                 alt="{{ auth()->user()->name }}"
                                 class="w-8 h-8 rounded-full object-cover">

                        @else

                            <div class="w-8 h-8 rounded-full bg-hireflow-primary/20 flex items-center justify-center">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5 text-hireflow-primary"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8 8 0 0115 0"/>

                                </svg>

                            </div>

                        @endif

                        {{-- User name --}}
                        <a href="/profile"
                           class="hover:text-hireflow-text transition">
                            {{ auth()->user()->name }}
                        </a>

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-4 h-4"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M19 9l-7 7-7-7"/>

                        </svg>

                    </button>

                    <div id="account-dropdown"
                         class="hidden absolute end-0 mt-2 w-48 bg-slate-900 border border-white/10 rounded-lg shadow-lg overflow-hidden">

                        @if (auth()->user()->role === 'job_seeker')

                            <a href="/profile"
                               class="block px-4 py-3 hover:bg-white/5 transition">
                                {{ __('messages.my_profile') }}
                            </a>

                        @endif

                        <form method="POST" action="/logout">

                            @csrf

                            <button type="submit"
                                class="w-full text-start px-4 py-3 hover:bg-white/5 transition">
                                {{ __('messages.logout') }}
                            </button>

                        </form>

                    </div>

                </div>

            @endguest

        </div>

        {{-- Mobile Toggle --}}
        <button id="menu-toggle"
            type="button"
            class="md:hidden text-hireflow-text text-2xl"
            aria-label="{{ __('messages.toggle_menu') }}"
            aria-expanded="false"
            aria-controls="mobile-menu">

            ☰

        </button>

    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu"
         class="hidden md:hidden px-5 pb-4 border-t border-white/10 bg-slate-950/40">

        <div class="flex flex-col gap-3 pt-4">

            <x-nav-link href="/jobs"
                :active="request()->is('jobs*')">
                {{ __('messages.jobs') }}
            </x-nav-link>

            <x-nav-link href="/companies"
                :active="request()->is('companies*')">
                {{ __('messages.companies') }}
            </x-nav-link>

            <x-nav-link href="/about"
                :active="request()->is('about')">
                {{ __('messages.about') }}
            </x-nav-link>

            @auth

                @if (auth()->user()->role === 'job_seeker')

                    <x-nav-link href="/job-seeker/dashboard"
                        :active="request()->is('job-seeker/dashboard*')">
                        {{ __('messages.dashboard') }}
                    </x-nav-link>

                    <x-nav-link href="/applications"
                        :active="request()->is('applications*')">
                        {{ __('messages.applications') }}
                    </x-nav-link>

                    <x-nav-link href="/profile"
                        :active="request()->is('profile*')">
                        {{ __('messages.my_profile') }}
                    </x-nav-link>

                @elseif (auth()->user()->role === 'employer')

                    <x-nav-link href="/employer/dashboard"
                        :active="request()->is('employer/dashboard*')">
                        {{ __('messages.dashboard') }}
                    </x-nav-link>

                    <x-nav-link href="/employer/jobs"
                        :active="request()->is('employer/jobs*')">
                        {{ __('messages.my_jobs') }}
                    </x-nav-link>

                    <x-nav-link href="/employer/applications"
                        :active="request()->is('employer/applications*')">
                        {{ __('messages.employer_applications') }}
                    </x-nav-link>

                @endif

            @endauth

            {{-- Language switcher (mobile) --}}
            <a href="{{ url('/language/' . $otherLocale) }}"
               hreflang="{{ $otherLocale }}"
               class="inline-flex w-fit items-center gap-1.5 rounded-full px-3 py-1.5 text-sm ring-1 ring-white/10 hover:bg-white/10 hover:text-hireflow-text transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-4 w-4"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     aria-hidden="true">

                    <circle cx="12" cy="12" r="9" stroke-width="1.8" />

                    <path stroke-width="1.8"
                          stroke-linecap="round"
                          d="M3 12h18M12 3c2.5 2.7 3.8 5.7 3.8 9s-1.3 6.3-3.8 9c-2.5-2.7-3.8-6.3-3.8-9S9.5 5.7 12 3z" />

                </svg>

                <span>{{ $otherLabel }}</span>

            </a>

            @auth

                {{-- Mobile Account --}}
                <div class="border-t border-white/10 pt-3 mt-1">

                    <div class="flex items-center gap-2 mb-3">

                        @if ($profile_photo)

                            <img src="{{ asset('storage/' . $profile_photo) }}"
                                 alt="{{ auth()->user()->name }}"
                                 class="w-8 h-8 rounded-full object-cover">

                        @else

                            <div class="w-8 h-8 rounded-full bg-hireflow-primary/20 flex items-center justify-center">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5 text-hireflow-primary"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8 8 0 0115 0"/>

                                </svg>

                            </div>

                        @endif

                        <div class="min-w-0">

                            {{-- Mobile user name --}}
                            <a href="/profile"
                               class="text-hireflow-text font-medium truncate hover:text-hireflow-text transition">
                                {{ auth()->user()->name }}
                            </a>

                            <p class="text-xs text-hireflow-text-secondary truncate">
                                {{ auth()->user()->email }}
                            </p>

                        </div>

                    </div>

                    <form method="POST" action="/logout">

                        @csrf

                        <button type="submit"
                            class="w-full text-start hover:text-hireflow-text transition">
                            {{ __('messages.logout') }}
                        </button>

                    </form>

                </div>

            @else

                {{-- Guest Mobile --}}
                <div class="border-t border-white/10 pt-3 mt-1 flex flex-col gap-3">

                    <a href="/login"
                       class="hover:text-hireflow-text transition">
                        {{ __('messages.login') }}
                    </a>

                    <a href="/register"
                       class="hover:text-hireflow-text transition">
                        {{ __('messages.sign_up') }}
                    </a>

                </div>

            @endauth

        </div>

    </div>

</nav>

<script>
    (function () {

        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        if (menuToggle && mobileMenu) {

            menuToggle.addEventListener('click', () => {

                const open = mobileMenu.classList.toggle('hidden') === false;

                menuToggle.setAttribute('aria-expanded', open);

            });

        }

        const accountToggle = document.getElementById('account-toggle');
        const accountDropdown = document.getElementById('account-dropdown');

        if (accountToggle && accountDropdown) {

            const setOpen = (open) => {

                accountDropdown.classList.toggle('hidden', !open);

                accountToggle.setAttribute('aria-expanded', open);

            };

            accountToggle.addEventListener('click', () =>
                setOpen(accountDropdown.classList.contains('hidden'))
            );

            document.addEventListener('click', (e) => {

                if (
                    !accountToggle.contains(e.target) &&
                    !accountDropdown.contains(e.target)
                ) {
                    setOpen(false);
                }

            });

            document.addEventListener('keydown', (e) => {

                if (e.key === 'Escape') {
                    setOpen(false);
                }

            });

        }

    })();
</script>
