@props(['active' => false])

<a aria-current="{{ $active ? 'page' : 'false' }}"
    {{ $attributes->merge([
        'class' => $active
            ? 'bg-hireflow-primary/20 px-3 py-1 rounded-lg text-hireflow-text'
            : 'px-3 py-1 rounded-lg text-hireflow-text-secondary hover:bg-hireflow-primary/10 hover:text-hireflow-text',
    ]) }}>{{ $slot }}</a>
