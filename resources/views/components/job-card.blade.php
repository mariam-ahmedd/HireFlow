@props(['title', 'company', 'location', 'type' => 'Full Time', 'href' => '', 'image' => null])

@php
    // Image can be a full URL or a path on the public storage disk
    $imageUrl = $image
        ? (\Illuminate\Support\Str::startsWith($image, ['http://', 'https://']) ? $image : asset('storage/' . $image))
        : null;

    // Fallback tile: same company always gets the same color (not random)
    $palette = [
        'bg-indigo-500/20 text-indigo-200 ring-indigo-400/30',
        'bg-emerald-500/20 text-emerald-200 ring-emerald-400/30',
        'bg-amber-500/20 text-amber-200 ring-amber-400/30',
        'bg-rose-500/20 text-rose-200 ring-rose-400/30',
        'bg-sky-500/20 text-sky-200 ring-sky-400/30',
        'bg-violet-500/20 text-violet-200 ring-violet-400/30',
    ];
    $tile = $palette[crc32((string) $company) % count($palette)];
    $initial = strtoupper(mb_substr((string) $company, 0, 1));
@endphp

<a href="{{ $href }}"
    class="group w-full flex items-center justify-between gap-4 p-4 sm:p-5 bg-hireflow-surface rounded-xl border border-white/5 hover:border-hireflow-primary/30 shadow-sm hover:shadow-md transition-all duration-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-hireflow-primary">

    <div class="flex items-center gap-x-3 min-w-0">
        <div class="shrink-0">
            @if ($imageUrl)
                <img src="{{ $imageUrl }}" alt="{{ $company }}" loading="lazy"
                    class="h-10 w-10 rounded-lg object-cover ring-1 ring-white/10">
            @else
                <div class="flex h-10 w-10 items-center justify-center rounded-lg text-base font-bold ring-1 {{ $tile }}"
                    aria-hidden="true">
                    {{ $initial }}
                </div>
            @endif
        </div>

        <div class="min-w-0 flex flex-col items-start text-start">
            <h2 class="text-hireflow-text font-semibold text-sm sm:text-base leading-tight truncate max-w-full">
                {{ $title }}
            </h2>

            <p class="text-hireflow-text/50 text-xs sm:text-sm mt-0.5 truncate max-w-full">
                {{ $company }}
            </p>

            <p class="text-hireflow-text/50 text-xs sm:text-sm flex items-center gap-1 truncate max-w-full">
                📍 {{ $location }}
            </p>

            <span
                class="inline-block mt-2 bg-hireflow-primary/10 text-hireflow-primary px-2.5 py-0.5 rounded-md text-[11px] font-medium">
                {{ \Illuminate\Support\Facades\Lang::has('messages.job_types.' . $type) ? __('messages.job_types.' . $type) : $type }}
            </span>
        </div>
    </div>

    <span
        class="shrink-0 inline-flex items-center gap-1 text-hireflow-primary group-hover:text-hireflow-primary-hover font-medium text-xs sm:text-sm whitespace-nowrap transition-colors duration-200">
        <span class="hidden sm:inline">{{ __('messages.view_job') }}</span>
        <span class="transition-transform duration-200 group-hover:translate-x-1 rtl:rotate-180 rtl:group-hover:-translate-x-1" aria-hidden="true">→</span>
    </span>
</a>
