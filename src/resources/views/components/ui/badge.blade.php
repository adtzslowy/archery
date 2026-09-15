@props([
    'variant' => 'default',
    'class' => '',
])

@php
    $variants = [
        'default' => 'bg-primary text-primary-foreground',
        'secondary' => 'bg-secondary text-secondary-foreground',
        'success' => 'bg-emerald-100 text-emerald-700',
        'warning' => 'bg-amber-100 text-amber-700',
        'destructive' => 'bg-red-100 text-red-700',
        'outline' => 'border border-border bg-background text-foreground',
    ];
@endphp

<span
    {{ $attributes->merge([
        'class' => "inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {$variants[$variant]} {$class}",
    ]) }}
>
    {{ $slot }}
</span>