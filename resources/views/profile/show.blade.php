@php
    $user = auth()->user();

    $links = [
        __('profile.github')    => $profile?->github,
        __('profile.linkedin')  => $profile?->linkedin,
        __('profile.portfolio') => $profile?->portfolio,
    ];

    // Turn "a, b, c" (or Arabic comma "،") into a clean list
    $toList = fn ($value) => collect(preg_split('/[,،]/u', (string) $value))->map(fn ($v) => trim($v))->filter()->values();
    $skills    = $toList($profile?->skills);
    $languages = $toList($profile?->languages);

    // Profile completeness (11 optional fields)
    $fields = [
        $profile?->headline, $profile?->bio, $profile?->location, $profile?->phone,
        $profile?->github, $profile?->linkedin, $profile?->portfolio,
        $profile?->skills, $profile?->education, $profile?->experience, $profile?->languages,
    ];
    $filled   = collect($fields)->filter()->count();
    $progress = (int) round($filled / count($fields) * 100);
@endphp

<x-layout>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Header card --}}
        <div class="rounded-3xl bg-gradient-to-br from-indigo-600/20 via-slate-900 to-slate-900 p-6 sm:p-8 ring-1 ring-white/10">
            <div class="flex flex-col sm:flex-row sm:items-center gap-5">

                @if (! empty($profile?->profile_photo))
                    <img src="{{ asset('storage/' . $profile->profile_photo) }}" alt="{{ $user->name }}"
                         class="h-20 w-20 shrink-0 rounded-full object-cover ring-1 ring-white/10">
                @else
                    <div class="flex h-20 w-20 shrink-0 items-center justify-center rounded-full bg-indigo-600/30 text-3xl font-bold text-indigo-200 ring-1 ring-indigo-400/30">
                        {{ strtoupper(mb_substr($user->name, 0, 1)) }}
                    </div>
                @endif

                <div class="min-w-0 flex-1">
                    <h1 class="text-2xl sm:text-3xl font-bold text-white break-words">{{ $user->name }}</h1>
                    <p class="mt-1 text-slate-300">
                        {{ $profile?->headline ?: __('profile.headline_fallback') }}
                    </p>
                    @if ($profile?->location)
                        <p class="mt-1 text-sm text-slate-400">{{ $profile->location }}</p>
                    @endif
                </div>

                <a href="{{ url('/profile/edit') }}"
                   class="inline-flex items-center justify-center rounded-full bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-indigo-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-400 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-900 transition">
                    {{ $profile ? __('profile.edit_profile') : __('profile.create_profile') }}
                </a>
            </div>
        </div>

        <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Main column --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Completeness --}}
                @if ($progress < 100)
                    <section class="rounded-2xl bg-amber-400/10 p-6 ring-1 ring-amber-400/30">
                        <div class="flex items-center justify-between text-sm">
                            <h2 class="font-semibold text-amber-200">{{ __('profile.complete_title') }}</h2>
                            <span class="font-medium text-amber-300">{{ $progress }}%</span>
                        </div>
                        <div class="mt-3 h-2 w-full overflow-hidden rounded-full bg-white/10">
                            <div class="h-full rounded-full bg-amber-400" style="width: {{ $progress }}%"></div>
                        </div>
                        <p class="mt-3 text-sm text-slate-300">{{ __('profile.complete_text') }}</p>
                    </section>
                @endif

                {{-- About --}}
                <section class="rounded-2xl bg-white/5 p-6 ring-1 ring-white/10">
                    <h2 class="text-lg font-semibold text-white">{{ __('profile.about_me') }}</h2>
                    @if ($profile?->bio)
                        <p class="mt-3 whitespace-pre-line text-sm leading-relaxed text-slate-300">{{ $profile->bio }}</p>
                    @else
                        <p class="mt-3 text-sm text-slate-400">{{ __('profile.no_bio') }}</p>
                    @endif
                </section>

                {{-- Skills --}}
                <section class="rounded-2xl bg-white/5 p-6 ring-1 ring-white/10">
                    <h2 class="text-lg font-semibold text-white">{{ __('profile.skills') }}</h2>
                    @if ($skills->isNotEmpty())
                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach ($skills as $skill)
                                <span class="rounded-full bg-indigo-400/10 px-3 py-1 text-xs font-medium text-indigo-200 ring-1 ring-indigo-400/30">{{ $skill }}</span>
                            @endforeach
                        </div>
                    @else
                        <p class="mt-3 text-sm text-slate-400">{{ __('profile.no_skills') }}</p>
                    @endif
                </section>

                {{-- Experience --}}
                <section class="rounded-2xl bg-white/5 p-6 ring-1 ring-white/10">
                    <h2 class="text-lg font-semibold text-white">{{ __('profile.experience') }}</h2>
                    @if ($profile?->experience)
                        <p class="mt-3 whitespace-pre-line text-sm leading-relaxed text-slate-300">{{ $profile->experience }}</p>
                    @else
                        <p class="mt-3 text-sm text-slate-400">{{ __('profile.no_experience') }}</p>
                    @endif
                </section>

                {{-- Education --}}
                <section class="rounded-2xl bg-white/5 p-6 ring-1 ring-white/10">
                    <h2 class="text-lg font-semibold text-white">{{ __('profile.education') }}</h2>
                    @if ($profile?->education)
                        <p class="mt-3 whitespace-pre-line text-sm leading-relaxed text-slate-300">{{ $profile->education }}</p>
                    @else
                        <p class="mt-3 text-sm text-slate-400">{{ __('profile.no_education') }}</p>
                    @endif
                </section>

                {{-- Links --}}
                <section class="rounded-2xl bg-white/5 p-6 ring-1 ring-white/10">
                    <h2 class="text-lg font-semibold text-white">{{ __('profile.links') }}</h2>
                    <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-3">
                        @foreach ($links as $label => $url)
                            @if ($url)
                                <a href="{{ $url }}" target="_blank" rel="noopener noreferrer"
                                   class="group rounded-xl bg-white/5 px-4 py-3 ring-1 ring-white/10 hover:bg-white/10 hover:ring-indigo-400/60 transition">
                                    <span class="block text-sm font-medium text-white group-hover:text-indigo-300">{{ $label }}</span>
                                    <span dir="ltr" class="block truncate text-start text-xs text-slate-400">{{ preg_replace('#^https?://(www\.)?#', '', $url) }}</span>
                                </a>
                            @else
                                <div class="rounded-xl border border-dashed border-white/10 px-4 py-3">
                                    <span class="block text-sm font-medium text-slate-500">{{ $label }}</span>
                                    <span class="block text-xs text-slate-600">{{ __('profile.not_added') }}</span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </section>
            </div>

            {{-- Sidebar --}}
            <aside class="lg:col-span-1">
                <div class="rounded-2xl bg-white/5 p-6 ring-1 ring-white/10 lg:sticky lg:top-6">
                    <h2 class="text-lg font-semibold text-white">{{ __('profile.contact_info') }}</h2>
                    <dl class="mt-4 space-y-4 text-sm">
                        <div>
                            <dt class="text-slate-500">{{ __('profile.email') }}</dt>
                            <dd class="mt-0.5 break-all text-slate-200">{{ $user->email }}</dd>
                        </div>
                        <div>
                            <dt class="text-slate-500">{{ __('profile.phone') }}</dt>
                            <dd class="mt-0.5 text-slate-200">{{ $profile?->phone ?: __('profile.not_added') }}</dd>
                        </div>
                        <div>
                            <dt class="text-slate-500">{{ __('profile.location') }}</dt>
                            <dd class="mt-0.5 text-slate-200">{{ $profile?->location ?: __('profile.not_added') }}</dd>
                        </div>
                        <div>
                            <dt class="text-slate-500">{{ __('profile.languages') }}</dt>
                            <dd class="mt-1.5">
                                @if ($languages->isNotEmpty())
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($languages as $language)
                                            <span class="rounded-full bg-white/5 px-3 py-1 text-xs font-medium text-slate-200 ring-1 ring-white/10">{{ $language }}</span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-slate-200">{{ __('profile.not_added') }}</span>
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-slate-500">{{ __('profile.member_since') }}</dt>
                            <dd class="mt-0.5 text-slate-200">{{ $user->created_at?->translatedFormat('F Y') ?? '—' }}</dd>
                        </div>
                    </dl>
                </div>
            </aside>
        </div>
    </div>
</x-layout>
