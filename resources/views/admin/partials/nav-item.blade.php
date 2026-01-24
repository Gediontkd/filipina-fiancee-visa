{{-- resources/views/admin/partials/nav-item.blade.php --}}
@php
    $classes = $active 
        ? 'bg-sidebar-active text-white' 
        : 'text-slate-300 hover:bg-sidebar-hover hover:text-white';
@endphp

<a href="{{ route($route) }}" 
   class="flex items-center justify-between px-3 py-2.5 rounded-lg transition-colors {{ $classes }}">
    <div class="flex items-center space-x-3">
        <i class="fas {{ $icon }} w-5 text-center"></i>
        <span class="text-sm font-medium">{{ $label }}</span>
    </div>
    @if(isset($badge) && $badge)
        <span class="px-2 py-0.5 text-xs font-semibold bg-red-500 text-white rounded-full">{{ $badge }}</span>
    @endif
</a>