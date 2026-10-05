<footer class="bg-slate-900 w-full px-6 mt-5  py-8">
    <div class="flex flex-col  sm:flex-row justify-between max-w-6xl mx-auto font-bold mb-3 gap-4 sm:gap-0">
        <a href="/">HireFlow</a>
        <a href="/jobs">{{ __('messages.for_job_seekers') }}</a>
        <a href="/company-profile">{{ __('messages.for_employers') }}</a>
        <a href="/about">{{ __('messages.company') }}</a>
    </div>

    <x-divider />

    <div class="flex flex-col sm:flex-row  justify-between px-4 text-sm text-slate-500 mt-3 gap-2 sm:gap-0">
        <a href="">© 2026 HireFlow</a>
        <a href="">{{ __('messages.all_rights_reserved') }}</a>
    </div>
</footer>
