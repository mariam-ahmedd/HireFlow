<x-layout>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Company Header --}}
        <div class="rounded-2xl bg-white/5 p-6 ring-1 ring-white/10">

            <div class="flex flex-col sm:flex-row sm:items-center gap-5">

                {{-- Logo --}}
                @if ($employer->logo)
                    <img
                        src="{{ asset('storage/' . $employer->logo) }}"
                        alt="{{ __('companies.logo_alt', ['name' => $employer->name]) }}"
                        class="h-20 w-20 shrink-0 rounded-2xl object-cover ring-1 ring-white/10"
                    >
                @else
                    <div
                        class="flex h-20 w-20 shrink-0 items-center justify-center rounded-2xl bg-indigo-600/30 text-2xl font-bold text-indigo-200 ring-1 ring-indigo-400/30"
                    >
                        {{ strtoupper(mb_substr($employer->name, 0, 1)) }}
                    </div>
                @endif

                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-white">
                        {{ $employer->name }}
                    </h1>

                    @if ($employer->website)
                        <a
                            href="{{ $employer->website }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="mt-2 inline-block text-sm text-indigo-300 hover:text-indigo-200"
                        >
                            {{ __('companies.visit_website') }}
                        </a>
                    @endif
                </div>

            </div>

            {{-- Description --}}
            @if ($employer->description)
                <p class="mt-6 max-w-3xl text-sm leading-6 text-slate-300">
                    {{ $employer->description }}
                </p>
            @endif

        </div>

        {{-- Jobs --}}
        <div class="mt-10">

            <div class="mb-5">
                <h2 class="text-xl font-bold text-white">
                    {{ __('companies.open_jobs') }}
                </h2>

                <p class="mt-1 text-sm text-slate-400">
                    {{ __('companies.explore', ['name' => $employer->name]) }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                @forelse ($employer->jobs as $job)

                    <a
                        href="{{ route('jobs.show', $job) }}"
                        class="group rounded-2xl bg-white/5 p-5 ring-1 ring-white/10 hover:bg-white/10 hover:ring-indigo-400/60 transition"
                    >
                        <h3 class="font-semibold text-white group-hover:text-indigo-300">
                            {{ $job->title }}
                        </h3>

                        <div class="mt-3 flex flex-wrap gap-2 text-sm text-slate-400">
                            <span>{{ $job->location }}</span>
                            <span>•</span>
                            <span>{{ __('employer.schedule.' . $job->schedule) }}</span>
                            <span>•</span>
                            <span>{{ $job->salary }}</span>
                        </div>

                        <p class="mt-3 text-sm text-slate-400 line-clamp-2">
                            {{ $job->description }}
                        </p>

                        <div class="mt-4 text-sm font-medium text-indigo-300 group-hover:text-indigo-200">
                            {{ __('companies.view_job') }}
                        </div>
                    </a>

                @empty

                    <div class="col-span-full rounded-2xl bg-white/5 px-6 py-12 text-center ring-1 ring-white/10">

                        <h3 class="font-semibold text-white">
                            {{ __('companies.no_open_jobs_title') }}
                        </h3>

                        <p class="mt-1 text-sm text-slate-400">
                            {{ __('companies.no_open_jobs_text') }}
                        </p>

                    </div>

                @endforelse

            </div>
        </div>

    </div>
</x-layout>
