<x-layout>
    <div class="mx-auto w-full max-w-5xl px-4 sm:px-6 lg:px-8 py-8 sm:py-12">

        {{-- Header --}}
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-white">{{ __('employer_applications.title') }}</h1>
            <p class="mt-1 text-sm text-slate-400">
                {{ __('employer_applications.subtitle') }}
            </p>
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

        @php
            $total = $jobs->sum(fn($j) => $j->applications->count());
        @endphp

        @if ($total > 0)
            <div class="mt-6 space-y-8">
                @foreach ($jobs as $job)
                    @if ($job->applications->count())
                        <section>
                            {{-- Job heading --}}
                            <div class="flex items-center justify-between gap-3">
                                <h2 class="min-w-0 text-lg font-semibold text-white break-words">
                                    {{ $job->title }}
                                </h2>
                                <span
                                    class="shrink-0 rounded-full border border-slate-800 bg-slate-900/40 px-3 py-1 text-xs text-slate-400">
                                    {{ trans_choice('employer_applications.applicants', $job->applications->count()) }}
                                </span>
                            </div>

                            <div class="mt-3 space-y-3">
                                @foreach ($job->applications as $application)
                                    @php
                                        $applicant = $application->user;
                                        $initial = mb_strtoupper(mb_substr($applicant?->name ?? '?', 0, 1));
                                        $status = strtolower($application->status ?? 'pending');

                                        $badge = match ($status) {
                                            'accepted' => 'bg-green-500/10 text-green-400 border-green-500/30',
                                            'rejected' => 'bg-red-500/10 text-red-400 border-red-500/30',
                                            default => 'bg-amber-500/10 text-amber-300 border-amber-500/30',
                                        };

                                        $dot = match ($status) {
                                            'accepted' => 'bg-green-400',
                                            'rejected' => 'bg-red-400',
                                            default => 'bg-amber-300',
                                        };
                                    @endphp

                                    <article
                                        class="rounded-xl border border-slate-800 bg-slate-900/40 p-5 transition hover:border-slate-700">
                                        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                                            {{-- Applicant info --}}
                                            <div class="flex min-w-0 gap-4">
                                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-slate-800 text-lg font-semibold text-slate-300"
                                                    aria-hidden="true">
                                                    {{ $initial }}
                                                </div>

                                                <div class="min-w-0">
                                                    <p class="text-base font-semibold text-white break-words">
                                                        {{ $applicant?->name ?? __('employer_applications.deleted_user') }}
                                                    </p>

                                                    @if ($applicant?->email)
                                                        <a href="mailto:{{ $applicant->email }}" dir="ltr"
                                                            class="block text-start text-sm text-sky-400 hover:underline break-all">
                                                            ✉️ {{ $applicant->email }}
                                                        </a>
                                                    @endif

                                                    <p class="mt-1 text-xs text-slate-500">
                                                        🗓️ {{ __('employer_applications.applied', [
                                                            'date' => $application->created_at?->translatedFormat('d M Y'),
                                                            'ago' => $application->created_at?->diffForHumans(),
                                                        ]) }}
                                                    </p>
                                                </div>
                                            </div>

                                            {{-- Status + actions --}}
                                            <div
                                                class="flex flex-col gap-3 border-t border-slate-800 pt-4 sm:flex-row sm:items-center sm:justify-between lg:flex-col lg:items-end lg:border-t-0 lg:pt-0">
                                                <span
                                                    class="inline-flex w-fit items-center gap-2 rounded-full border px-3 py-1 text-xs font-semibold {{ $badge }}">
                                                    <span class="h-1.5 w-1.5 rounded-full {{ $dot }}"></span>
                                                    {{ __('employer_applications.status.' . $status) }}
                                                </span>

                                                @if ($status === 'pending')
                                                    <div class="flex items-center gap-2">
                                                        <form
                                                            action="{{ route('employer.applications.update', $application) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="accepted">
                                                            <button type="submit"
                                                                class="rounded-full bg-green-500 px-4 py-1.5 text-sm font-semibold text-slate-950 transition hover:bg-green-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-green-400 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-900">
                                                                {{ __('employer_applications.accept') }}
                                                            </button>
                                                        </form>

                                                        <form
                                                            action="{{ route('employer.applications.update', $application) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="rejected">
                                                            <button type="submit"
                                                                class="rounded-full border border-red-500/40 bg-red-500/10 px-4 py-1.5 text-sm font-semibold text-red-400 transition hover:bg-red-500/20 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-400 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-900">
                                                                {{ __('employer_applications.reject') }}
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </section>
                    @endif
                @endforeach
            </div>
        @else
            {{-- Empty state --}}
            <div class="mt-8 rounded-xl border border-dashed border-slate-800 bg-slate-900/40 px-6 py-14 text-center">
                <div class="text-4xl" aria-hidden="true">📭</div>
                <h2 class="mt-3 text-lg font-semibold text-white">{{ __('employer_applications.empty_title') }}</h2>
                <p class="mt-1 text-sm text-slate-400">{{ __('employer_applications.empty_text') }}</p>
            </div>
        @endif
    </div>
</x-layout>
