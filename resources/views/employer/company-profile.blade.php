<x-layout>
    <div class="min-h-screen bg-hireflow-bg flex items-center justify-center px-4 sm:px-6 lg:px-8 py-8 sm:py-10">

        <div class="w-full max-w-sm sm:max-w-md bg-hireflow-surface/60 backdrop-blur-md border border-hireflow-border rounded-xl sm:rounded-2xl shadow-xl p-5 sm:p-8">

            <h2 class="text-hireflow-text text-xl sm:text-2xl font-semibold mb-5 sm:mb-6 text-center">
                {{ __('company.create_title') }}
            </h2>

            <form method="POST" action="/company-profile" enctype="multipart/form-data" class="space-y-3 sm:space-y-4">
                @csrf

                <x-input
                    name="name"
                    :placeholder="__('company.name_ph')"
                    type="text"
                    required
                    class="w-full bg-hireflow-surface-hover text-hireflow-text placeholder-hireflow-muted border border-hireflow-border rounded-lg px-3 sm:px-4 py-2.5 sm:py-3 text-sm sm:text-base focus:outline-none focus:border-hireflow-primary focus:ring-2 focus:ring-hireflow-primary/20 transition"
                />

                <div>
                    <label for="logo" class="block text-hireflow-muted text-xs sm:text-sm mb-1.5">
                        {{ __('company.logo') }}
                    </label>
                    <input
                        id="logo"
                        name="logo"
                        type="file"
                        accept="image/*"
                        class="w-full bg-hireflow-surface-hover text-hireflow-muted border border-hireflow-border rounded-lg px-3 sm:px-4 py-2.5 sm:py-3 text-sm sm:text-base focus:outline-none focus:border-hireflow-primary focus:ring-2 focus:ring-hireflow-primary/20 transition file:me-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:bg-hireflow-primary file:text-white file:text-xs sm:file:text-sm file:cursor-pointer hover:file:bg-hireflow-primary-hover"
                    />
                </div>

                <textarea
                    name="description"
                    placeholder="{{ __('company.description_ph') }}"
                    rows="3"
                    class="w-full bg-hireflow-surface-hover text-hireflow-text placeholder-hireflow-muted border border-hireflow-border rounded-lg px-3 sm:px-4 py-2.5 sm:py-3 text-sm sm:text-base focus:outline-none focus:border-hireflow-primary focus:ring-2 focus:ring-hireflow-primary/20 transition resize-none"
                ></textarea>

                <x-input
                    name="website"
                    placeholder="https://yourcompany.com"
                    type="url"
                    dir="ltr"
                    class="w-full bg-hireflow-surface-hover text-hireflow-text placeholder-hireflow-muted border border-hireflow-border rounded-lg px-3 sm:px-4 py-2.5 sm:py-3 text-sm sm:text-base focus:outline-none focus:border-hireflow-primary focus:ring-2 focus:ring-hireflow-primary/20 transition text-start"
                />

                <button
                    type="submit"
                    class="w-full bg-hireflow-primary hover:bg-hireflow-primary-hover text-white font-medium rounded-lg py-2.5 sm:py-3 text-sm sm:text-base mt-2 transition"
                >
                    {{ __('company.create') }}
                </button>

            </form>
        </div>

    </div>
</x-layout>
