{{-- resources/views/admin/monitoring/index.blade.php --}}
@extends('admin.layouts.app')
@section('title', 'Monitoring')
@section('page-title', 'Change Monitoring')

@section('content')
<div class="space-y-6">
    <!-- Action Buttons -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-lg font-semibold text-slate-800">System Monitoring</h2>
            <p class="text-sm text-slate-500">Track changes to USCIS forms and medical fees</p>
        </div>
        <div class="flex items-center space-x-3">
            <form method="POST" action="{{ route('admin.monitoring.check-uscis') }}" class="inline">
                @csrf
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium transition-colors">
                    <i class="fas fa-sync-alt mr-2"></i>Check USCIS
                </button>
            </form>
            <form method="POST" action="{{ route('admin.monitoring.check-medical') }}" class="inline">
                @csrf
                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 text-sm font-medium transition-colors">
                    <i class="fas fa-stethoscope mr-2"></i>Check Medical
                </button>
            </form>
            @if($changes->where('is_read', false)->count() > 0)
            <a href="{{ route('admin.monitoring.mark-all-read') }}" 
               class="px-4 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 text-sm font-medium transition-colors">
                <i class="fas fa-check-double mr-2"></i>Mark All Read
            </a>
            @endif
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-slate-800">{{ $changes->count() }}</p>
                    <p class="text-xs text-slate-500">Total Alerts</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">
                    <i class="fas fa-bell text-blue-500"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-amber-600">{{ $changes->where('is_read', false)->count() }}</p>
                    <p class="text-xs text-slate-500">Unread</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-amber-50 flex items-center justify-center">
                    <i class="fas fa-exclamation-circle text-amber-500"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-slate-800">{{ $changes->where('type', 'uscis')->count() }}</p>
                    <p class="text-xs text-slate-500">USCIS Changes</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-purple-50 flex items-center justify-center">
                    <i class="fas fa-file-alt text-purple-500"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-slate-800">{{ $changes->where('type', 'medical')->count() }}</p>
                    <p class="text-xs text-slate-500">Medical Changes</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-emerald-50 flex items-center justify-center">
                    <i class="fas fa-stethoscope text-emerald-500"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Changes List -->
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200">
            <h3 class="font-semibold text-slate-800">Recent Changes</h3>
        </div>

        @if($changes->count() > 0)
        <div class="divide-y divide-slate-100">
            @foreach($changes as $change)
            <div class="p-5 hover:bg-slate-50 {{ !$change->is_read ? 'bg-blue-50/50' : '' }}">
                <div class="flex items-start justify-between">
                    <div class="flex items-start space-x-4">
                        <!-- Icon -->
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0 {{ $change->type === 'uscis' ? 'bg-purple-100' : 'bg-emerald-100' }}">
                            <i class="fas {{ $change->type === 'uscis' ? 'fa-file-alt text-purple-600' : 'fa-stethoscope text-emerald-600' }}"></i>
                        </div>

                        <!-- Content -->
                        <div>
                            <div class="flex items-center space-x-2 mb-1">
                                <h4 class="font-medium text-slate-800">{{ $change->title }}</h4>
                                @if(!$change->is_read)
                                    <span class="px-1.5 py-0.5 text-xs bg-amber-100 text-amber-700 rounded">New</span>
                                @endif
                            </div>
                            <p class="text-sm text-slate-600">{{ $change->description }}</p>
                            
                            @if($change->details)
                            <div class="mt-3 p-3 bg-slate-50 rounded-lg text-sm">
                                <pre class="text-slate-600 whitespace-pre-wrap">{{ is_array($change->details) ? json_encode($change->details, JSON_PRETTY_PRINT) : $change->details }}</pre>
                            </div>
                            @endif
                            
                            <p class="text-xs text-slate-400 mt-2">
                                <i class="far fa-clock mr-1"></i>{{ $change->created_at->format('M j, Y g:i A') }}
                                <span class="mx-2">•</span>
                                {{ $change->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>

                    <!-- Actions -->
                    @if(!$change->is_read)
                    <form method="POST" action="{{ route('admin.monitoring.mark-read', $change) }}">
                        @csrf
                        <button type="submit" class="px-3 py-1.5 bg-slate-100 text-slate-600 rounded-lg text-sm font-medium hover:bg-slate-200 transition-colors">
                            <i class="fas fa-check mr-1"></i>Mark Read
                        </button>
                    </form>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="px-6 py-12 text-center">
            <div class="w-16 h-16 mx-auto mb-4 bg-slate-100 rounded-full flex items-center justify-center">
                <i class="fas fa-bell-slash text-slate-400 text-2xl"></i>
            </div>
            <h3 class="text-lg font-medium text-slate-800 mb-1">No changes detected</h3>
            <p class="text-sm text-slate-500">Run a check to scan for updates</p>
        </div>
        @endif
    </div>
</div>
@endsection