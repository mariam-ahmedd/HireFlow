@props(['jobs'])
<div class="mb-10 sm:mb-0">
    <div class="text-center mb-8">
        <h2 class="font-bold text-2xl md:text-4xl">{{ __('messages.featured_jobs') }}</h2>
        <p class="text-hireflow-text-secondary text-sm md:text-base mt-2">
            {{ __('messages.featured_subtitle') }}
        </p>
    </div>

    <div class="flex flex-wrap justify-center gap-4 max-w-6xl mx-auto px-4">

        @forelse ($jobs as $job)
            <div class="w-full md:w-[calc(50%-0.5rem)] xl:w-[calc(33.333%-0.7rem)]">
                <x-job-card
                    :title="$job->title"
                    :company="$job->employer->name"
                    :location="$job->location"
                    :type="$job->type ?? 'Full Time'"
                    :image="$job->image ?? $job->employer->logo"
                    :href="url('/jobs/' . $job->id)"
                />
            </div>
        @empty
            <p class="text-sm text-hireflow-text-secondary">{{ __('messages.no_jobs') }}</p>
        @endforelse

    </div>
</div>
