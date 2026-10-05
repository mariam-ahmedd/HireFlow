<x-layout>
    @php
        $company = $job->employer->name;
        $initial = mb_strtoupper(mb_substr($company ?: $job->title, 0, 1));

        $btn =
            'inline-block rounded-full bg-sky-500 px-5 py-2 text-sm font-semibold text-slate-950 transition hover:bg-sky-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-400 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-900';
    @endphp

    <div class="mx-auto w-full max-w-5xl px-4 sm:px-6 lg:px-8 py-8 sm:py-12">

        {{-- Back link --}}
        <a href="{{ route('jobs.index') }}"
            class="inline-flex items-center gap-1 text-sm text-slate-400 transition hover:text-sky-400 focus:outline-none focus-visible:underline">
            <span class="inline-block rtl:rotate-180" aria-hidden="true">←</span>
            {{ __('jobs.back') }}
        </a>

        @if (session('success'))
            <div class="mt-6 rounded-lg bg-green-500/10 border border-green-500/30 px-4 py-3 text-sm text-green-400">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mt-6 rounded-lg bg-red-500/10 border border-red-500/30 px-4 py-3 text-sm text-red-400">
                {{ session('error') }}
            </div>
        @endif

        <div class="mt-4 grid grid-cols-1 gap-6 lg:grid-cols-3">

            {{-- Main column --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Header card: title + featured + location --}}
                <section class="rounded-xl border border-slate-800 bg-slate-900/40 p-5 sm:p-6">
                    <div class="flex gap-4">
                        <div class="flex h-14 w-14 sm:h-16 sm:w-16 shrink-0 items-center justify-center rounded bg-slate-800 text-xl font-semibold text-slate-300"
                            aria-hidden="true">
                            {{ $initial }}
                        </div>

                        <div class="min-w-0 flex-1">
                            <h1 class="text-xl sm:text-2xl font-bold leading-snug text-white break-words">
                                {{ $job->title }}
                            </h1>

                            @if ($company)
                                <p class="mt-1 text-sm text-slate-300 break-words">{{ $company }}</p>
                            @endif

                            @if ($job->location)
                                <p class="mt-1 text-sm text-slate-400 break-words">📍 {{ $job->location }}</p>
                            @endif

                            <p class="mt-1 text-xs text-slate-500">
                                @if ($job->featured)
                                    <span class="text-amber-300/90">⭐ {{ __('jobs.featured') }}</span>
                                    <span class="text-slate-600">·</span>
                                @endif
                                {{ __('jobs.posted', ['time' => $job->created_at?->diffForHumans()]) }}
                            </p>
                        </div>
                    </div>

                    {{-- Apply buttons --}}
                    <div class="mt-6 flex flex-wrap items-center justify-end gap-4">
                        @if ($job->url)
                            <a href="{{ $job->url }}" target="_blank" rel="noopener noreferrer"
                                class="text-sm text-sky-400 hover:underline">🔗 {{ __('jobs.original_posting') }}</a>
                        @endif

                        @guest
                            <a href="{{ route('login') }}" class="{{ $btn }}">{{ __('jobs.login_to_apply') }}</a>
                        @endguest

                        @auth
                            @if (auth()->user()->role === 'job_seeker')
                                <form action="{{ route('applications.store', $job) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="{{ $btn }}">{{ __('jobs.apply_now') }}</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </section>

                {{-- Description --}}
                <section class="rounded-xl border border-slate-800 bg-slate-900/40 p-5 sm:p-6">
                    <h2 class="text-lg font-semibold text-white">📝 {{ __('jobs.about_job') }}</h2>

                    @if ($job->description)
                        <div
                            class="mt-3 text-sm sm:text-base leading-relaxed text-slate-300 whitespace-pre-line break-words">
                            {{ $job->description }}</div>
                    @else
                        <p class="mt-3 text-sm text-slate-500">{{ __('jobs.no_description') }}</p>
                    @endif
                </section>
            </div>

            {{-- Sidebar: job overview --}}
            <aside class="lg:col-span-1">
                <section class="rounded-xl border border-slate-800 bg-slate-900/40 p-5 sm:p-6 lg:sticky lg:top-6">
                    <h2 class="text-lg font-semibold text-white">{{ __('jobs.overview') }}</h2>

                    <dl class="mt-4 space-y-4 text-sm">
                        @if ($job->location)
                            <div>
                                <dt class="text-slate-500">📍 {{ __('jobs.location') }}</dt>
                                <dd class="mt-0.5 text-slate-200 break-words">{{ $job->location }}</dd>
                            </div>
                        @endif

                        @if ($job->salary)
                            <div>
                                <dt class="text-slate-500">💰 {{ __('jobs.salary') }}</dt>
                                <dd class="mt-0.5 text-slate-200">{{ $job->salary }}</dd>
                            </div>
                        @endif

                        @if ($job->schedule)
                            <div>
                                <dt class="text-slate-500">🕒 {{ __('jobs.schedule') }}</dt>
                                <dd class="mt-0.5 text-slate-200">{{ $job->schedule }}</dd>
                            </div>
                        @endif

                        @if ($job->featured)
                            <div>
                                <dt class="text-slate-500">⭐ {{ __('jobs.status') }}</dt>
                                <dd class="mt-0.5 text-amber-300/90">{{ __('jobs.featured') }}</dd>
                            </div>
                        @endif

                        @if ($job->url)
                            <div>
                                <dt class="text-slate-500">🔗 {{ __('jobs.job_url') }}</dt>
                                <dd class="mt-0.5">
                                    <a href="{{ $job->url }}" target="_blank" rel="noopener noreferrer" dir="ltr"
                                        class="block text-start text-sky-400 hover:underline break-all">
                                        {{ parse_url($job->url, PHP_URL_HOST) ?: $job->url }}
                                    </a>
                                </dd>
                            </div>
                        @endif
                    </dl>
                </section>
            </aside>
        </div>
    </div>
</x-layout>
