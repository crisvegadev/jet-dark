<button {{ $attributes->merge(['type' => 'submit', 'class' => 'jd-button']) }}>
    {{ $slot }}
</button>
