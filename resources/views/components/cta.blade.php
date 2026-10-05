@php
    $user = auth()->user();

    if (! $user) {
        // Guest
        $heading   = __('messages.cta_guest_title');
        $text      = __('messages.cta_guest_text');
        $primary   = ['label' => __('messages.create_account'), 'url' => url('/register')];
        $secondary = ['label' => __('messages.browse_jobs'), 'url' => url('/jobs')];
    } elseif ($user->role === 'employer') {
        // Employer
        $heading   = __('messages.cta_employer_title');
        $text      = __('messages.cta_employer_text');
        $primary   = ['label' => __('messages.post_job'), 'url' => url('/employer/jobs/create')];
        $secondary = ['label' => __('messages.go_to_dashboard'), 'url' => url('/employer/dashboard')];
    } else {
        // Job seeker
        $heading   = __('messages.cta_seeker_title');
        $text      = __('messages.cta_seeker_text');
        $primary   = ['label' => __('messages.browse_jobs'), 'url' => url('/jobs')];
        $secondary = ['label' => __('messages.my_applications'), 'url' => url('/applications')];
    }
@endphp

<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-600/30 via-slate-900 to-slate-900 px-6 py-14 sm:px-12 sm:py-20 text-center ring-1 ring-white/10">

        {{-- soft glow --}}
        <div class="pointer-events-none absolute -top-24 left-1/2 h-64 w-[36rem] -translate-x-1/2 rounded-full bg-indigo-500/20 blur-3xl"></div>

        <div class="relative">
            <h2 class="mx-auto max-w-2xl text-3xl sm:text-4xl font-bold tracking-tight text-white">
                {{ $heading }}
            </h2>
            <p class="mx-auto mt-4 max-w-xl text-base sm:text-lg text-slate-300">
                {{ $text }}
            </p>

            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4">
                <a href="{{ $primary['url'] }}"
                   class="w-full sm:w-auto inline-flex items-center justify-center rounded-full bg-indigo-600 px-7 py-3 text-sm font-semibold text-white hover:bg-indigo-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-400 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-900 transition">
                    {{ $primary['label'] }}
                </a>
                <a href="{{ $secondary['url'] }}"
                   class="w-full sm:w-auto inline-flex items-center justify-center rounded-full px-7 py-3 text-sm font-semibold text-slate-200 ring-1 ring-white/20 hover:bg-white/10 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-400 transition">
                    {{ $secondary['label'] }}
                </a>
            </div>
        </div>
    </div>
</section>
