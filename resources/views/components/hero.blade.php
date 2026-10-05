@props(['heading', 'description'])

<div class="flex flex-col items-center text-center px-4 pt-12 pb-6 md:pt-20 md:pb-10">

    <h1 class="text-hireflow-text text-4xl md:text-6xl font-bold">
        {{ $heading }}
    </h1>

    <p class="text-hireflow-text-secondary text-base md:text-lg mt-4 max-w-2xl">
        {{ $description }}
    </p>

    <form
        action="/jobs"
        method="GET"
        class="flex flex-col md:flex-row gap-3 w-full max-w-4xl mt-8"
    >

        <div class="flex-1">
            <x-input
                type="text"
                :placeholder="__('messages.search_placeholder')"
                name="search"
            />
        </div>

        <div class="flex-1">
            <x-input
                type="text"
                :placeholder="__('messages.location_placeholder')"
                name="location"
            />
        </div>

        <button
            type="submit"
            class="w-full md:w-40 bg-hireflow-primary hover:bg-hireflow-primary-hover text-white rounded-xl px-6 py-2 transition"
        >
            {{ __('messages.search_jobs') }}
        </button>

    </form>

</div>
