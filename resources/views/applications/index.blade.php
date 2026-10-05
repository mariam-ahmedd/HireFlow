<x-layout>
    <div class="mx-auto w-full max-w-5xl px-4 sm:px-6 lg:px-8 py-8 sm:py-12">

        {{-- Header --}}
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-white">{{ __('my_applications.title') }}</h1>
                <p class="mt-1 text-sm text-slate-400">
                    {{ __('my_applications.subtitle') }}
                </p>
            </div>

            <a href="{{ route('jobs.index') }}"
                class="inline-flex items-center gap-1 text-sm text-slate-400 transition hover:text-sky-400 focus:outline-none focus-visible:underline">
                {{ __('my_applications.browse_more') }}
            </a>
        </div>

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

        @if ($applications->count())
            <div class="mt-6 space-y-4">
                @foreach ($applications as $application)
                    @php
                        $job = $application->job;
                        $company = $job?->employer?->name;
                        $initial = mb_strtoupper(mb_substr($company ?: ($job?->title ?? '?'), 0, 1));

                        $status = strtolower($application->status ?? 'pending');
                        $statusKey = 'my_applications.status.' . $status;
                        $statusLabel = \Illuminate\Support\Facades\Lang::has($statusKey) ? __($statusKey) : ucfirst($status);

                        $badge = match ($status) {
                            'accepted', 'approved', 'hired' => 'bg-green-500/10 text-green-400 border-green-500/30',
                            'rejected', 'declined' => 'bg-red-500/10 text-red-400 border-red-500/30',
                            'reviewed', 'shortlisted', 'interview' => 'bg-sky-500/10 text-sky-400 border-sky-500/30',
                            default => 'bg-amber-500/10 text-amber-300 border-amber-500/30',
                        };

                        $dot = match ($status) {
                            'accepted', 'approved', 'hired' => 'bg-green-400',
                            'rejected', 'declined' => 'bg-red-400',
                            'reviewed', 'shortlisted', 'interview' => 'bg-sky-400',
                            default => 'bg-amber-300',
                        };
                    @endphp

                    <article
                        class="rounded-xl border border-slate-800 bg-slate-900/40 p-5 transition hover:border-slate-700 sm:p-6">
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                            {{-- Job info --}}
                            <div class="flex min-w-0 gap-4">
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded bg-slate-800 text-lg font-semibold text-slate-300"
                                    aria-hidden="true">
                                    {{ $initial }}
                                </div>

                                <div class="min-w-0">
                                    @if ($job)
                                        <a href="{{ route('jobs.show', $job) }}"
                                            class="block text-base sm:text-lg font-semibold text-white break-words transition hover:text-sky-400 focus:outline-none focus-visible:underline">
                                            {{ $job->title }}
                                        </a>
                                    @else
                                        <p class="text-base font-semibold text-slate-400">{{ __('my_applications.job_unavailable') }}</p>
                                    @endif

                                    @if ($company)
                                        <p class="mt-0.5 text-sm text-slate-300 break-words">{{ $company }}</p>
                                    @endif

                                    <div class="mt-1 flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-slate-500">
                                        @if ($job?->location)
                                            <span>📍 {{ $job->location }}</span>
                                        @endif
                                        <span>🗓️ {{ __('my_applications.applied', ['ago' => $application->created_at?->diffForHumans()]) }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Status + action --}}
                            <div
                                class="flex items-center justify-between gap-3 border-t border-slate-800 pt-4 sm:flex-col sm:items-end sm:border-t-0 sm:pt-0">
                                <span
                                    class="inline-flex items-center gap-2 rounded-full border px-3 py-1 text-xs font-semibold {{ $badge }}">
                                    <span class="h-1.5 w-1.5 rounded-full {{ $dot }}"></span>
                                    {{ $statusLabel }}
                                </span>

                                @if ($job)
                                    <a href="{{ route('jobs.show', $job) }}"
                                        class="text-sm text-sky-400 hover:underline focus:outline-none focus-visible:underline">
                                        {{ __('my_applications.view_job') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- Pagination (works only if $applications is paginated) --}}
            @if (method_exists($applications, 'links'))
                <div class="mt-8">
                    {{ $applications->links() }}
                </div>
            @endif
        @else
            {{-- Empty state --}}
            <div class="mt-8 rounded-xl border border-dashed border-slate-800 bg-slate-900/40 px-6 py-14 text-center">
                <div class="text-4xl" aria-hidden="true">📭</div>
                <h2 class="mt-3 text-lg font-semibold text-white">{{ __('my_applications.empty_title') }}</h2>
                <p class="mt-1 text-sm text-slate-400">{{ __('my_applications.empty_text') }}</p>
                <a href="{{ route('jobs.index') }}"
                    class="mt-5 inline-block rounded-full bg-sky-500 px-5 py-2 text-sm font-semibold text-slate-950 transition hover:bg-sky-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-400 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-900">
                    {{ __('my_applications.browse_jobs') }}
                </a>
            </div>
        @endif
    </div>
</x-layout>
