<x-layout>
    <div class="group mt-4 px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto pb-16">

        <div class="flex flex-col sm:flex-row items-center sm:items-end justify-between gap-4 mb-8">
            <div class="text-center sm:text-start">
                <h1 class="text-2xl md:text-5xl font-bold text-hireflow-text">{{ __('employer.my_jobs') }}</h1>
                <p class="text-hireflow-muted text-sm md:text-base mt-2">
                    {{ __('employer.my_jobs_sub') }}
                </p>
            </div>

            <a href="/employer/jobs/create"
                class="w-full sm:w-auto bg-hireflow-primary hover:bg-hireflow-primary-hover text-white font-medium rounded-lg px-5 py-2.5 text-sm sm:text-base transition text-center whitespace-nowrap">
                {{ __('employer.post_job') }}
            </a>
        </div>

        <div id="deleteModal" class="hidden fixed inset-0 z-50 items-center justify-center bg-black/60 px-4">
            <div class="w-full max-w-md rounded-2xl border border-hireflow-border bg-hireflow-surface p-6 shadow-xl">

                <h2 class="text-xl font-semibold text-hireflow-text">
                    {{ __('employer.delete_title') }}
                </h2>

                <p class="mt-2 text-sm text-hireflow-muted">
                    {{ __('employer.delete_confirm') }}
                </p>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="closeDeleteModal()"
                        class="rounded-lg border border-hireflow-border px-4 py-2 text-sm text-hireflow-muted hover:text-hireflow-text transition">
                        {{ __('employer.cancel') }}
                    </button>

                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="rounded-lg bg-hireflow-danger px-4 py-2 text-sm text-white hover:bg-red-400 transition">
                            {{ __('employer.delete') }}
                        </button>
                    </form>
                </div>

            </div>
        </div>

        @if ($jobs->isEmpty())
            <div class="bg-hireflow-surface/60 border border-hireflow-border rounded-2xl p-10 text-center">
                <p class="text-hireflow-muted text-sm sm:text-base">
                    {{ __('employer.no_jobs') }}
                </p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                @foreach ($jobs as $job)
                    <div
                        class="bg-hireflow-surface/60 backdrop-blur-md border border-hireflow-border rounded-xl p-5 sm:p-6 flex flex-col gap-3 hover:border-hireflow-primary/50 transition">

                        <div class="flex items-start justify-between gap-2">
                            <h3 class="text-hireflow-text font-semibold text-lg leading-snug">
                                {{ $job->title }}
                            </h3>
                            @if ($job->featured)
                                <span
                                    class="shrink-0 bg-hireflow-primary/15 text-hireflow-primary text-xs font-medium px-2.5 py-1 rounded-full">
                                    {{ __('employer.featured') }}
                                </span>
                            @endif
                        </div>

                        <div class="flex flex-wrap gap-x-4 gap-y-1 text-hireflow-muted text-sm">
                            <span>📍 {{ $job->location }}</span>
                            <span>💰 {{ $job->salary }}</span>
                            <span>🕒 {{ __('employer.schedule.' . $job->schedule) }}</span>
                        </div>

                        <p class="text-hireflow-muted text-sm leading-relaxed line-clamp-3">
                            {{ $job->description }}
                        </p>

                        <div class="border-t border-hireflow-border my-1"></div>

                        <div class="flex items-center justify-between gap-3">
                            @if ($job->url)
                                <a href="{{ $job->url }}" target="_blank" rel="noopener noreferrer"
                                    class="text-hireflow-primary hover:text-hireflow-primary-hover text-sm font-medium truncate">
                                    {{ __('employer.view_listing') }}
                                </a>
                            @else
                                <span></span>
                            @endif

                            <div class="flex items-center gap-3 text-xs">
                                <a href="/employer/jobs/{{ $job->id }}/edit"
                                    class="text-hireflow-muted hover:text-hireflow-text transition">
                                    {{ __('employer.edit') }}
                                </a>
                                <form method="POST" action="/employer/jobs/{{ $job->id }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="openDeleteModal({{ $job->id }})"
                                        class="text-hireflow-danger hover:text-red-400 transition">
                                        {{ __('employer.delete') }}
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif

    </div>
    <script>
        function openDeleteModal(jobId) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');

            form.action = `/employer/jobs/${jobId}`;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');

            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</x-layout>
