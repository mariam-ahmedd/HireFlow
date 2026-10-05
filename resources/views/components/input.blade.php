@props(['placeholder' => '', 'type' => 'text', 'name', 'value' => null])

<input
    type="{{ $type }}"
    placeholder="{{ $placeholder }}"
    name="{{ $name }}"
    value="{{ old($name, $value) }}"
    {{ $attributes->merge(['class' => 'w-full p-2 rounded-xl bg-hireflow-surface border border-transparent']) }}
>
