<x-layout>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Hero --}}
        <section class="relative overflow-hidden py-16 sm:py-24 text-center">
            <div class="pointer-events-none absolute -top-24 left-1/2 h-64 w-[36rem] -translate-x-1/2 rounded-full bg-indigo-500/20 blur-3xl"></div>
            <div class="relative">
                <span class="inline-block rounded-full bg-indigo-600/20 px-4 py-1 text-xs font-semibold uppercase tracking-wider rtl:tracking-normal text-indigo-300 ring-1 ring-indigo-400/30">
                    {{ __('about.badge') }}
                </span>
                <h1 class="mx-auto mt-6 max-w-3xl text-3xl sm:text-5xl font-bold tracking-tight rtl:tracking-normal text-white">
                    {{ __('about.title') }}
                </h1>
                <p class="mx-auto mt-5 max-w-2xl text-base sm:text-lg text-slate-300">
                    {{ __('about.subtitle') }}
                </p>
            </div>
        </section>

        {{-- Mission --}}
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-6 pb-16">
            <div class="rounded-2xl bg-white/5 p-6 sm:p-8 ring-1 ring-white/10">
                <h2 class="text-xl font-semibold text-white">{{ __('about.mission_title') }}</h2>
                <p class="mt-3 text-sm sm:text-base leading-relaxed text-slate-300">{{ __('about.mission_text') }}</p>
            </div>
            <div class="rounded-2xl bg-white/5 p-6 sm:p-8 ring-1 ring-white/10">
                <h2 class="text-xl font-semibold text-white">{{ __('about.belief_title') }}</h2>
                <p class="mt-3 text-sm sm:text-base leading-relaxed text-slate-300">{{ __('about.belief_text') }}</p>
            </div>
        </section>

        {{-- Values --}}
        <section class="pb-16">
            <h2 class="text-center text-2xl font-bold text-white">{{ __('about.values_title') }}</h2>
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="rounded-2xl bg-indigo-400/10 p-6 ring-1 ring-indigo-400/30">
                    <h3 class="font-semibold text-indigo-200">{{ __('about.simplicity') }}</h3>
                    <p class="mt-2 text-sm text-slate-300">{{ __('about.simplicity_text') }}</p>
                </div>
                <div class="rounded-2xl bg-emerald-400/10 p-6 ring-1 ring-emerald-400/30">
                    <h3 class="font-semibold text-emerald-200">{{ __('about.transparency') }}</h3>
                    <p class="mt-2 text-sm text-slate-300">{{ __('about.transparency_text') }}</p>
                </div>
                <div class="rounded-2xl bg-amber-400/10 p-6 ring-1 ring-amber-400/30">
                    <h3 class="font-semibold text-amber-200">{{ __('about.opportunity') }}</h3>
                    <p class="mt-2 text-sm text-slate-300">{{ __('about.opportunity_text') }}</p>
                </div>
            </div>
        </section>

        {{-- How it works --}}
        <section class="pb-8">
            <h2 class="text-center text-2xl font-bold text-white">{{ __('about.how_title') }}</h2>
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">

                @foreach ([['seekers', 'seeker_steps'], ['employers', 'employer_steps']] as [$titleKey, $stepsKey])
                    <div class="rounded-2xl bg-white/5 p-6 sm:p-8 ring-1 ring-white/10">
                        <h3 class="text-lg font-semibold text-white">{{ __('about.' . $titleKey) }}</h3>
                        <ol class="mt-4 space-y-4 text-sm text-slate-300">
                            @foreach ((array) __('about.' . $stepsKey) as $step)
                                <li class="flex gap-3">
                                    <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-indigo-600/30 text-xs font-bold text-indigo-200">{{ $loop->iteration }}</span>
                                    {{ $step }}
                                </li>
                            @endforeach
                        </ol>
                    </div>
                @endforeach

            </div>
        </section>
    </div>

    {{-- Dynamic CTA (changes for guest / job seeker / employer) --}}
    <x-cta />
</x-layout>
