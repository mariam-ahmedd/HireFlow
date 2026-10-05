@props(['width' => 50])

<img
    src="https://picsum.photos/seed/{{ rand(0,1000) }}/{{ $width }}"
    alt="Company logo"
    class="rounded-lg object-cover"
/>
