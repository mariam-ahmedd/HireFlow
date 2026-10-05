@php
    $input = 'mt-1.5 block w-full rounded-xl border-0 bg-white/5 px-4 py-2.5 text-sm text-white placeholder-slate-500 ring-1 ring-white/10 focus:bg-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition';

    $sections = [
        'basic' => [
            ['name' => 'headline', 'label' => __('profile.headline'), 'type' => 'text', 'placeholder' => __('profile.headline_ph')],
            ['name' => 'location', 'label' => __('profile.location'), 'type' => 'text', 'placeholder' => __('profile.location_ph')],
            ['name' => 'phone',    'label' => __('profile.phone'),    'type' => 'tel',  'placeholder' => '+20 100 000 0000'],
        ],
        'skills_languages' => [
            ['name' => 'skills',    'label' => __('profile.skills'),    'type' => 'text', 'placeholder' => __('profile.skills_ph'),    'hint' => __('profile.hint_commas')],
            ['name' => 'languages', 'label' => __('profile.languages'), 'type' => 'text', 'placeholder' => __('profile.languages_ph'), 'hint' => __('profile.hint_commas')],
        ],
        'links' => [
            ['name' => 'github',    'label' => __('profile.github'),    'type' => 'url', 'placeholder' => 'https://github.com/username'],
            ['name' => 'linkedin',  'label' => __('profile.linkedin'),  'type' => 'url', 'placeholder' => 'https://linkedin.com/in/username'],
            ['name' => 'portfolio', 'label' => __('profile.portfolio'), 'type' => 'url', 'placeholder' => 'https://yourwebsite.com'],
        ],
    ];

    $areas = [
        ['name' => 'bio',        'title' => __('profile.about_me'),   'rows' => 5, 'placeholder' => __('profile.bio_ph')],
        ['name' => 'experience', 'title' => __('profile.experience'), 'rows' => 6, 'placeholder' => __('profile.experience_ph')],
        ['name' => 'education',  'title' => __('profile.education'),  'rows' => 4, 'placeholder' => __('profile.education_ph')],
    ];
@endphp

<x-layout>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <a href="{{ url('/profile') }}"
            class="inline-flex items-center gap-1 text-sm text-slate-400 hover:text-white transition">
            <span class="inline-block rtl:rotate-180" aria-hidden="true">&larr;</span>
            {{ __('profile.back') }}
        </a>

        <div class="mt-4 mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-white">{{ __('profile.edit_profile') }}</h1>
            <p class="mt-1 text-sm text-slate-400">{{ __('profile.edit_subtitle') }}</p>
        </div>

        {{-- Validation summary --}}
        @if ($errors->any())
            <div class="mb-6 rounded-2xl bg-rose-400/10 p-4 text-sm text-rose-200 ring-1 ring-rose-400/30">
                {{ __('profile.fix_errors') }}
            </div>
        @endif

        <form method="POST" enctype="multipart/form-data" action="{{ url('/profile') }}" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Profile photo --}}
            <section class="rounded-2xl bg-white/5 p-6 ring-1 ring-white/10">
                <h2 class="text-lg font-semibold text-white">{{ __('profile.photo_title') }}</h2>

                <div class="mt-4 flex flex-col sm:flex-row sm:items-center gap-5">
                    @if (!empty($profile?->profile_photo))
                        <img id="profile_photo-preview" src="{{ asset('storage/' . $profile->profile_photo) }}" alt="{{ __('profile.photo_alt') }}"
                            class="h-24 w-24 shrink-0 rounded-full object-cover ring-1 ring-white/10">
                    @else
                        <img id="profile_photo-preview" src="" alt="{{ __('profile.photo_alt') }}"
                            class="hidden h-24 w-24 shrink-0 rounded-full object-cover ring-1 ring-white/10">
                        <div id="profile_photo-placeholder"
                            class="flex h-24 w-24 shrink-0 items-center justify-center rounded-full bg-indigo-600/30 text-3xl font-bold text-indigo-200 ring-1 ring-indigo-400/30">
                            {{ strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    @endif

                    <div class="min-w-0 flex-1">
                        <label for="profile_photo" class="block text-sm font-medium text-slate-300">{{ __('profile.choose_photo') }}</label>
                        <input id="profile_photo" name="profile_photo" type="file" accept="image/png,image/jpeg,image/webp"
                            class="mt-1.5 block w-full text-sm text-slate-400 file:me-4 file:cursor-pointer file:rounded-full file:border-0 file:bg-indigo-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-indigo-500">
                        <p class="mt-1.5 text-xs text-slate-500">{{ __('profile.photo_hint') }}</p>
                        @error('profile_photo')
                            <p class="mt-1.5 text-xs text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <script>
                    document.getElementById('profile_photo').addEventListener('change', function(e) {
                        const file = e.target.files[0];
                        if (!file) return;
                        const preview = document.getElementById('profile_photo-preview');
                        const placeholder = document.getElementById('profile_photo-placeholder');
                        preview.src = URL.createObjectURL(file);
                        preview.classList.remove('hidden');
                        if (placeholder) placeholder.classList.add('hidden');
                    });
                </script>
            </section>

            {{-- Basic info + Skills & languages + Links --}}
            @foreach ($sections as $key => $fields)
                <section class="rounded-2xl bg-white/5 p-6 ring-1 ring-white/10">
                    <h2 class="text-lg font-semibold text-white">{{ __('profile.section_' . $key) }}</h2>

                    <div class="mt-4 grid grid-cols-1 {{ in_array($key, ['basic', 'skills_languages']) ? 'sm:grid-cols-2' : '' }} gap-5">
                        @foreach ($fields as $f)
                            <div class="{{ $f['name'] === 'headline' ? 'sm:col-span-2' : '' }}">
                                <label for="{{ $f['name'] }}"
                                    class="block text-sm font-medium text-slate-300">{{ $f['label'] }}</label>
                                <input id="{{ $f['name'] }}" name="{{ $f['name'] }}" type="{{ $f['type'] }}"
                                    @if (in_array($f['type'], ['url', 'tel'])) dir="ltr" @endif
                                    value="{{ old($f['name'], $profile?->{$f['name']}) }}"
                                    placeholder="{{ $f['placeholder'] }}"
                                    class="{{ $input }} @if (in_array($f['type'], ['url', 'tel'])) text-start @endif @error($f['name']) ring-rose-400/60 @enderror">
                                @isset($f['hint'])
                                    <p class="mt-1.5 text-xs text-slate-500">{{ $f['hint'] }}</p>
                                @endisset
                                @error($f['name'])
                                    <p class="mt-1.5 text-xs text-rose-300">{{ $message }}</p>
                                @enderror
                            </div>
                        @endforeach
                    </div>
                </section>
            @endforeach

            {{-- Long text sections --}}
            @foreach ($areas as $a)
                <section class="rounded-2xl bg-white/5 p-6 ring-1 ring-white/10">
                    <label for="{{ $a['name'] }}"
                        class="text-lg font-semibold text-white">{{ $a['title'] }}</label>
                    <textarea id="{{ $a['name'] }}" name="{{ $a['name'] }}" rows="{{ $a['rows'] }}"
                        placeholder="{{ $a['placeholder'] }}" class="{{ $input }} @error($a['name']) ring-rose-400/60 @enderror">{{ old($a['name'], $profile?->{$a['name']}) }}</textarea>
                    @error($a['name'])
                        <p class="mt-1.5 text-xs text-rose-300">{{ $message }}</p>
                    @enderror
                </section>
            @endforeach

            {{-- Actions --}}
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3">
                <a href="{{ url('/profile') }}"
                    class="inline-flex items-center justify-center rounded-full px-6 py-2.5 text-sm font-semibold text-slate-200 ring-1 ring-white/20 hover:bg-white/10 transition">
                    {{ __('profile.cancel') }}
                </a>
                <button type="submit"
                    class="inline-flex items-center justify-center rounded-full bg-indigo-600 px-6 py-2.5 text-sm font-semibold text-white hover:bg-indigo-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-400 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-900 transition">
                    {{ __('profile.save') }}
                </button>
            </div>
        </form>
    </div>
</x-layout>
