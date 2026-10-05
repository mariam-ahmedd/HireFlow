<x-layout>
    <div class="mx-auto w-full max-w-3xl px-4 sm:px-6 lg:px-8 py-8 sm:py-12">

        {{-- Header --}}
        <div class="text-center">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white">
                {{ __('jobs.title') }}
            </h2>
            <p class="mt-2 text-xs sm:text-sm md:text-base text-slate-400">
                {{ __('jobs.subtitle') }}
            </p>
        </div>

        @if ($jobs->count())
            <div
                class="mt-8 sm:mt-10 rounded-xl border border-slate-800 bg-slate-900/40 divide-y divide-slate-800 overflow-hidden">
                @foreach ($jobs as $job)
                    @php
                        $company = $job->employer?->name;
                        $initial = mb_strtoupper(mb_substr($company ?: $job->title, 0, 1));
                        $meta = collect([$job->salary, $job->schedule])
                            ->filter()
                            ->implode(' · ');
                    @endphp

                    <article class="relative flex gap-3 sm:gap-4 px-4 py-4 sm:px-5 transition hover:bg-slate-800/40">

                        {{-- Logo --}}
                        <div class="flex h-12 w-12 sm:h-14 sm:w-14 shrink-0 items-center justify-center rounded bg-slate-800 text-lg font-semibold text-slate-300"
                            aria-hidden="true">
                            {{ $initial }}
                        </div>

                        <div class="min-w-0 flex-1">

                            {{-- Title (whole card is clickable) --}}
                            <h3 class="text-base font-semibold leading-snug text-sky-400">
                                <a href="{{ route('jobs.show', $job) }}"
                                    class="hover:underline focus:outline-none focus-visible:underline after:absolute after:inset-0 after:content-['']">
                                    {{ $job->title }}
                                </a>
                            </h3>

                            {{-- Company / location --}}
                            <p class="mt-0.5 text-sm text-slate-300 break-words">
                                @if ($company)
                                    {{ $company }}
                                @endif
                                @if ($company && $job->location)
                                    <span class="text-slate-600">·</span>
                                @endif
                                @if ($job->location)
                                    <span class="text-slate-400">{{ $job->location }}</span>
                                @endif
                            </p>

                            {{-- Salary · schedule --}}
                            @if ($meta)
                                <p class="mt-0.5 text-sm text-slate-400">{{ $meta }}</p>
                            @endif

                            {{-- Description --}}
                            @if ($job->description)
                                <p class="mt-2 text-sm text-slate-500 line-clamp-2">
                                    {{ $job->description }}
                                </p>
                            @endif

                            <div class="mt-3 flex items-center justify-between gap-3 text-xs text-slate-500">
                                <p>
                                    @if ($job->featured)
                                        <span class="text-amber-300/90">⭐ {{ __('jobs.featured') }}</span>
                                        <span class="text-slate-600">·</span>
                                    @endif
                                    {{ $job->created_at?->diffForHumans() }}
                                </p>

                                <div class="relative z-10 flex shrink-0 items-center gap-2">
                                    <a href="{{ route('jobs.show', $job) }}"
                                        class="rounded-full border border-slate-600 px-4 py-1 text-sm font-medium text-slate-200 transition hover:border-sky-400 hover:text-sky-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-400">
                                        {{ __('messages.view_job') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            @if (method_exists($jobs, 'links'))
                <div class="mt-8">
                    {{ $jobs->links() }}
                </div>
            @endif
        @else
            <div class="mt-10 rounded-xl border border-dashed border-slate-700 p-10 text-center">
                <p class="font-medium text-white">{{ __('jobs.empty_title') }}</p>
                <p class="mt-1 text-sm text-slate-400">{{ __('jobs.empty_text') }}</p>
            </div>
        @endif

    </div>
</x-layout>
