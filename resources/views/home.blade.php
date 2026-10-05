<x-layout>
    <x-hero :heading="__('messages.hero_title')" :description="__('messages.hero_description')" />
    <x-featuredjobs :jobs="$jobs" />
    <x-cta />
</x-layout>
