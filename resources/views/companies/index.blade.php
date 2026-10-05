<x-layout>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-white">
                {{ __('companies.title') }}
            </h1>

            <p class="mt-1 text-sm text-slate-400">
                {{ __('companies.subtitle') }}

                @if ($employers->count())
                    <span class="text-slate-500">
                        &middot;
                        {{ trans_choice('companies.count', $employers->count()) }}
                    </span>
                @endif
            </p>
        </div>

        {{-- Company Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

            @forelse ($employers as $employer)

                <a href="{{ route('companies.show', $employer) }}"
                   class="group flex flex-col rounded-2xl bg-white/5 p-5 ring-1 ring-white/10 hover:bg-white/10 hover:ring-indigo-400/60 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-400">

                    <div class="flex items-center gap-4">

                        {{-- Logo or Initial --}}
                        @if ($employer->logo)
                            <img
                                src="{{ asset('storage/' . $employer->logo) }}"
                                alt="{{ __('companies.logo_alt', ['name' => $employer->name]) }}"
                                class="h-12 w-12 shrink-0 rounded-xl object-cover ring-1 ring-white/10"
                            >
                        @else
                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-indigo-600/30 text-lg font-bold text-indigo-200 ring-1 ring-indigo-400/30"
                            >
                                {{ strtoupper(mb_substr($employer->name, 0, 1)) }}
                            </div>
                        @endif

                        <div class="min-w-0">
                            <h3 class="truncate font-semibold text-white group-hover:text-indigo-300">
                                {{ $employer->name }}
                            </h3>
                        </div>

                    </div>

                    {{-- Description --}}
                    <p class="mt-4 line-clamp-3 text-sm text-slate-400">
                        {{ $employer->description ?? __('companies.no_description') }}
                    </p>

                    {{-- Jobs Count --}}
                    <div class="mt-auto flex items-center justify-between pt-5">

                        <span class="rounded-full bg-emerald-400/10 px-3 py-1 text-xs font-medium text-emerald-300 ring-1 ring-emerald-400/30">
                            {{ trans_choice('companies.open_jobs_count', $employer->jobs_count) }}
                        </span>

                        <span class="text-sm font-medium text-indigo-300 group-hover:text-indigo-200">
                            {{ __('companies.view') }}
                        </span>

                    </div>

                </a>

            @empty

                <div class="col-span-full rounded-2xl bg-white/5 px-6 py-14 text-center ring-1 ring-white/10">

                    <h3 class="font-semibold text-white">
                        {{ __('companies.empty_title') }}
                    </h3>

                    <p class="mt-1 text-sm text-slate-400">
                        {{ __('companies.empty_text') }}
                    </p>

                </div>

            @endforelse

        </div>
    </div>
</x-layout>
