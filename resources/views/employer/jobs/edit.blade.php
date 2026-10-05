<x-layout>
    <div class="min-h-screen bg-hireflow-bg flex items-center justify-center px-4 sm:px-6 lg:px-8 py-8 sm:py-10">

        <div class="w-full max-w-sm sm:max-w-md bg-hireflow-surface/60 backdrop-blur-md border border-hireflow-border rounded-xl sm:rounded-2xl shadow-xl p-5 sm:p-8">

            <h2 class="text-hireflow-text text-xl sm:text-2xl font-semibold mb-5 sm:mb-6 text-center">
                {{ __('employer.edit_title') }}
            </h2>

            <form method="POST" action="/employer/jobs/{{ $job->id }}" class="space-y-3 sm:space-y-4">
                @csrf
                @method('PUT')

                <x-input name="title" :placeholder="__('employer.title_ph')" type="text" required
                    value="{{ old('title', $job->title) }}"
                    class="w-full bg-hireflow-surface-hover text-hireflow-text placeholder-hireflow-muted border border-hireflow-border rounded-lg px-3 sm:px-4 py-2.5 sm:py-3 text-sm sm:text-base focus:outline-none focus:border-hireflow-primary focus:ring-2 focus:ring-hireflow-primary/20 transition" />

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                    <input name="salary" type="text" placeholder="{{ __('employer.salary_ph') }}" required
                        value="{{ old('salary', $job->salary) }}"
                        class="w-full bg-hireflow-surface-hover text-hireflow-text placeholder-hireflow-muted border border-hireflow-border rounded-lg px-3 sm:px-4 py-2.5 sm:py-3 text-sm sm:text-base focus:outline-none focus:border-hireflow-primary focus:ring-2 focus:ring-hireflow-primary/20 transition" />

                    <input name="location" type="text" placeholder="{{ __('employer.location_ph') }}" required
                        value="{{ old('location', $job->location) }}"
                        class="w-full bg-hireflow-surface-hover text-hireflow-text placeholder-hireflow-muted border border-hireflow-border rounded-lg px-3 sm:px-4 py-2.5 sm:py-3 text-sm sm:text-base focus:outline-none focus:border-hireflow-primary focus:ring-2 focus:ring-hireflow-primary/20 transition" />
                </div>

                <select name="schedule" required
                    class="w-full bg-hireflow-surface-hover text-hireflow-text border border-hireflow-border rounded-lg px-3 sm:px-4 py-2.5 sm:py-3 text-sm sm:text-base focus:outline-none focus:border-hireflow-primary focus:ring-2 focus:ring-hireflow-primary/20 transition appearance-none">
                    <option value="" disabled {{ old('schedule', $job->schedule) ? '' : 'selected' }}>{{ __('employer.select_schedule') }}</option>
                    @foreach (['full_time', 'part_time', 'contract', 'remote'] as $schedule)
                        <option value="{{ $schedule }}" {{ old('schedule', $job->schedule) == $schedule ? 'selected' : '' }}>
                            {{ __('employer.schedule.' . $schedule) }}
                        </option>
                    @endforeach
                </select>

                <textarea name="description" placeholder="{{ __('employer.description_ph') }}" rows="3" required
                    class="w-full bg-hireflow-surface-hover text-hireflow-text placeholder-hireflow-muted border border-hireflow-border rounded-lg px-3 sm:px-4 py-2.5 sm:py-3 text-sm sm:text-base focus:outline-none focus:border-hireflow-primary focus:ring-2 focus:ring-hireflow-primary/20 transition resize-none">{{ old('description', $job->description) }}</textarea>

                <x-input name="url" placeholder="https://yourcompany.com/job-post" type="url" dir="ltr"
                    value="{{ old('url', $job->url) }}"
                    class="w-full bg-hireflow-surface-hover text-hireflow-text placeholder-hireflow-muted border border-hireflow-border rounded-lg px-3 sm:px-4 py-2.5 sm:py-3 text-sm sm:text-base focus:outline-none focus:border-hireflow-primary focus:ring-2 focus:ring-hireflow-primary/20 transition text-start" />

                <label class="flex items-center gap-2 text-hireflow-text text-sm cursor-pointer">
                    <input type="hidden" name="featured" value="0" />
                    <input type="checkbox" name="featured" value="1"
                        {{ old('featured', $job->featured) ? 'checked' : '' }}
                        class="w-4 h-4 rounded bg-hireflow-surface-hover border-hireflow-border text-hireflow-primary focus:ring-2 focus:ring-hireflow-primary/20 cursor-pointer" />
                    {{ __('employer.featured_label') }}
                </label>

                <button type="submit"
                    class="w-full bg-hireflow-primary hover:bg-hireflow-primary-hover text-white font-medium rounded-lg py-2.5 sm:py-3 text-sm sm:text-base mt-2 transition">
                    {{ __('employer.update') }}
                </button>

            </form>
        </div>

    </div>
</x-layout>
