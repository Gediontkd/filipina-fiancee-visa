{{-- ================================================================== --}}
{{-- resources/views/admin/partials/stat-card.blade.php --}}
{{-- ================================================================== --}}

<div class="bg-white rounded-xl border border-slate-200 p-5 hover:shadow-md transition-shadow">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm text-slate-500 font-medium">{{ $label }}</p>
            <p class="text-2xl font-bold text-slate-800 mt-1">{{ number_format($value) }}</p>
            @if(isset($sublabel))
                <p class="text-xs text-slate-400 mt-1">{{ $sublabel }}</p>
            @endif
        </div>
        <div class="w-12 h-12 rounded-xl {{ $bgColor ?? 'bg-blue-50' }} flex items-center justify-center">
            <i class="fas {{ $icon }} {{ $iconColor ?? 'text-blue-500' }} text-lg"></i>
        </div>
    </div>
    @if(isset($trend))
        <div class="mt-3 pt-3 border-t border-slate-100 flex items-center text-xs">
            <span class="{{ $trend > 0 ? 'text-emerald-600' : 'text-red-600' }}">
                <i class="fas fa-arrow-{{ $trend > 0 ? 'up' : 'down' }} mr-1"></i>{{ abs($trend) }}%
            </span>
            <span class="text-slate-400 ml-2">vs last month</span>
        </div>
    @endif
</div>