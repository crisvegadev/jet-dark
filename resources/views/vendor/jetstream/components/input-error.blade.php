@props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => 'jd-input-error']) }}>{{ $message }}</p>
@enderror
