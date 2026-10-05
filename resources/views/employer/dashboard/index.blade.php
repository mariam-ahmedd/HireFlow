<x-layout>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-white">{{ __('employer_dashboard.title') }}</h1>
                <p class="mt-1 text-sm text-slate-400">
                    {{ __('employer_dashboard.welcome', ['name' => auth()->user()->name]) }}
                </p>
            </div>
            <a href="{{ url('/employer/jobs/create') }}"
               class="inline-flex items-center justify-center rounded-full bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-indigo-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-400 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-900">
                {{ __('employer_dashboard.post_job') }}
            </a>
        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-2 lg:grid-cols-5 gap-4">

            <div class="col-span-2 lg:col-span-1 rounded-2xl bg-white/5 p-5 ring-1 ring-white/10">
                <p class="text-sm font-medium text-slate-400">{{ __('employer_dashboard.total_jobs') }}</p>
                <p class="mt-2 text-3xl font-bold text-white">{{ $totalJobs }}</p>
            </div>

            <div class="col-span-2 lg:col-span-1 rounded-2xl bg-white/5 p-5 ring-1 ring-white/10">
                <p class="text-sm font-medium text-slate-400">{{ __('employer_dashboard.applications') }}</p>
                <p class="mt-2 text-3xl font-bold text-white">{{ $totalApplications }}</p>
            </div>

            <div class="rounded-2xl bg-amber-400/10 p-5 ring-1 ring-amber-400/30">
                <p class="text-sm font-medium text-amber-300">{{ __('employer_dashboard.pending') }}</p>
                <p class="mt-2 text-3xl font-bold text-amber-200">{{ $totalPending }}</p>
            </div>

            <div class="rounded-2xl bg-emerald-400/10 p-5 ring-1 ring-emerald-400/30">
                <p class="text-sm font-medium text-emerald-300">{{ __('employer_dashboard.accepted') }}</p>
                <p class="mt-2 text-3xl font-bold text-emerald-200">{{ $totalAccepted }}</p>
            </div>

            <div class="col-span-2 lg:col-span-1 rounded-2xl bg-rose-400/10 p-5 ring-1 ring-rose-400/30">
                <p class="text-sm font-medium text-rose-300">{{ __('employer_dashboard.rejected') }}</p>
                <p class="mt-2 text-3xl font-bold text-rose-200">{{ $totalRejected }}</p>
            </div>
        </div>

        {{-- Quick actions --}}
        <h2 class="mt-10 mb-4 text-lg font-semibold text-white">{{ __('employer_dashboard.quick_actions') }}</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

            <a href="{{ url('/employer/jobs') }}"
               class="group rounded-2xl bg-white/5 p-5 ring-1 ring-white/10 hover:bg-white/10 hover:ring-indigo-400/60 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-400">
                <h3 class="font-semibold text-white group-hover:text-indigo-300">{{ __('employer_dashboard.manage_jobs') }}</h3>
                <p class="mt-1 text-sm text-slate-400">{{ __('employer_dashboard.manage_jobs_text') }}</p>
            </a>

            <a href="{{ url('/employer/applications') }}"
               class="group rounded-2xl bg-white/5 p-5 ring-1 ring-white/10 hover:bg-white/10 hover:ring-indigo-400/60 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-400">
                <h3 class="font-semibold text-white group-hover:text-indigo-300">{{ __('employer_dashboard.view_applications') }}</h3>
                <p class="mt-1 text-sm text-slate-400">
                    @if ($totalPending > 0)
                        {{ __('employer_dashboard.waiting_review', ['count' => $totalPending]) }}
                    @else
                        {{ __('employer_dashboard.nothing_waiting') }}
                    @endif
                </p>
            </a>

            <a href="{{ url('/employer/jobs/create') }}"
               class="group rounded-2xl bg-white/5 p-5 ring-1 ring-white/10 hover:bg-white/10 hover:ring-indigo-400/60 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-400">
                <h3 class="font-semibold text-white group-hover:text-indigo-300">{{ __('employer_dashboard.post_a_job') }}</h3>
                <p class="mt-1 text-sm text-slate-400">{{ __('employer_dashboard.post_a_job_text') }}</p>
            </a>
        </div>
    </div>
</x-layout>
