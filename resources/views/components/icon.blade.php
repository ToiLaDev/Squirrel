<svg
        xmlns="http://www.w3.org/2000/svg"
        width="{{ $width }}"
        height="{{ $height }}"
        viewBox="0 0 {{ $viewBox }}"
        fill="{{ $fill }}"
        stroke="currentColor"
        stroke-width="{{ $strokeWidth }}"
        stroke-linecap="round"
        stroke-linejoin="round"
        id="{{ $id }}"
        {{ $attributes->merge(['class' => "feather feather-$icon $class"]) }}
>
    @includeIf("icons.$icon")
</svg>