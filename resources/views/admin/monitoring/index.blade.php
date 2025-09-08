{{-- resources/views/admin/monitoring/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Change Monitoring')
@section('page-title', 'USCIS & Medical Fee Monitoring')

@section('content')
<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
        <!-- Total Changes -->
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-chart-line text-blue-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Changes</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_changes']) }}</p>
                </div>
            </div>
        </div>

        <!-- Unread Changes -->
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-bell text-red-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Unread</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['unread_changes']) }}</p>
                </div>
            </div>
        </div>

        <!-- USCIS Changes -->
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-file-alt text-blue-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">USCIS Forms</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['uscis_changes']) }}</p>
                </div>
            </div>
        </div>

        <!-- Medical Changes -->
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-md text-green-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Medical Fees</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['medical_changes']) }}</p>
                </div>
            </div>
        </div>

        <!-- Recent Changes -->
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-clock text-purple-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">This Week</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['recent_changes']) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Manual Check Section -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Manual Checks</h3>
            <div class="flex items-center space-x-2 text-sm text-gray-500">
                <i class="fas fa-info-circle"></i>
                <span>Click to manually check for changes</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- USCIS Forms Check -->
            <div class="border border-gray-200 rounded-lg p-4">
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <h4 class="font-medium text-gray-900">USCIS Forms</h4>
                        <p class="text-sm text-gray-500">Monitor I-129F, I-130, I-485, I-864</p>
                    </div>
                    <i class="fas fa-flag-usa text-2xl text-blue-500"></i>
                </div>
                
                <div class="mb-3">
                    <p class="text-xs text-gray-500">
                        Last Check: 
                        @if($lastChecks['uscis_forms'])
                            {{ $lastChecks['uscis_forms']->diffForHumans() }}
                        @else
                            Never
                        @endif
                    </p>
                </div>
                
                <button onclick="checkUscisChanges()" 
                        id="uscis-check-btn"
                        class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                    <i class="fas fa-sync mr-2"></i>Check USCIS Forms
                </button>
            </div>

            <!-- Medical Fees Check -->
            <div class="border border-gray-200 rounded-lg p-4">
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <h4 class="font-medium text-gray-900">St. Luke's Medical Fees</h4>
                        <p class="text-sm text-gray-500">Monitor medical examination fees</p>
                    </div>
                    <i class="fas fa-hospital text-2xl text-green-500"></i>
                </div>
                
                <div class="mb-3">
                    <p class="text-xs text-gray-500">
                        Last Check: 
                        @if($lastChecks['st_lukes_medical'])
                            {{ $lastChecks['st_lukes_medical']->diffForHumans() }}
                        @else
                            Never
                        @endif
                    </p>
                </div>
                
                <button onclick="checkMedicalFees()" 
                        id="medical-check-btn"
                        class="w-full px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors">
                    <i class="fas fa-sync mr-2"></i>Check Medical Fees
                </button>
            </div>
        </div>
    </div>

    <!-- Filters and Actions -->
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
            <div>
                <h3 class="text-lg font-medium text-gray-900">Recent Changes</h3>
                <p class="text-sm text-gray-500 mt-1">{{ $changes->total() }} total changes detected</p>
            </div>
            
            @if($stats['unread_changes'] > 0)
                <div class="flex space-x-3 mt-4 sm:mt-0">
                    <a href="{{ route('admin.monitoring.mark-all-read') }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                        <i class="fas fa-check-double mr-2"></i>Mark All Read
                    </a>
                </div>
            @endif
        </div>

        <!-- Filter Form -->
        <form method="GET" class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-6">
            <!-- Source Filter -->
            <div>
                <label for="source" class="block text-sm font-medium text-gray-700 mb-1">Source</label>
                <select name="source" id="source" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">All Sources</option>
                    <option value="uscis_forms" {{ request('source') == 'uscis_forms' ? 'selected' : '' }}>USCIS Forms</option>
                    <option value="st_lukes_medical" {{ request('source') == 'st_lukes_medical' ? 'selected' : '' }}>St. Luke's Medical</option>
                </select>
            </div>

            <!-- Type Filter -->
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                <select name="type" id="type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">All Types</option>
                    <option value="fee_change" {{ request('type') == 'fee_change' ? 'selected' : '' }}>Fee Changes</option>
                    <option value="form_update" {{ request('type') == 'form_update' ? 'selected' : '' }}>Form Updates</option>
                    <option value="content_change" {{ request('type') == 'content_change' ? 'selected' : '' }}>Content Changes</option>
                </select>
            </div>

            <!-- Status Filter -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">All</option>
                    <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Unread</option>
                    <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Read</option>
                </select>
            </div>

            <!-- Actions -->
            <div class="flex items-end">
                <button type="submit" class="w-full px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors">
                    <i class="fas fa-filter mr-2"></i>Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Changes List -->
    <div class="bg-white rounded-lg shadow">
        @if($changes->count() > 0)
            <div class="divide-y divide-gray-200">
                @foreach($changes as $change)
                    <div class="p-6 {{ !$change->is_read ? 'bg-blue-50' : '' }}">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $change->badge_color }}">
                                        {{ ucfirst(str_replace('_', ' ', $change->type)) }}
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        {{ $change->source_display }}
                                    </span>
                                    @if(!$change->is_read)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            New
                                        </span>
                                    @endif
                                </div>
                                
                                <h4 class="text-lg font-medium text-gray-900 mb-2">{{ $change->title }}</h4>
                                <p class="text-gray-600 mb-3">{{ $change->description }}</p>
                                
                                <div class="flex items-center space-x-6 text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <i class="fas fa-clock mr-2"></i>
                                        {{ $change->detected_at->format('M j, Y H:i') }}
                                    </div>
                                    @if($change->url)
                                        <a href="{{ $change->url }}" target="_blank" 
                                           class="flex items-center text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-external-link-alt mr-2"></i>
                                            View Source
                                        </a>
                                    @endif
                                </div>

                                @if($change->old_data || $change->new_data)
                                    <div class="mt-4 p-3 bg-gray-50 rounded-lg">
                                        <button onclick="toggleDetails({{ $change->id }})" 
                                                class="text-sm text-gray-600 hover:text-gray-800">
                                            <i class="fas fa-chevron-down mr-2"></i>Show Details
                                        </button>
                                        <div id="details-{{ $change->id }}" class="hidden mt-3 text-sm">
                                            @if($change->old_data)
                                                <div class="mb-2">
                                                    <strong>Previous:</strong>
                                                    <pre class="mt-1 text-xs bg-white p-2 rounded">{{ json_encode($change->old_data, JSON_PRETTY_PRINT) }}</pre>
                                                </div>
                                            @endif
                                            @if($change->new_data)
                                                <div>
                                                    <strong>Current:</strong>
                                                    <pre class="mt-1 text-xs bg-white p-2 rounded">{{ json_encode($change->new_data, JSON_PRETTY_PRINT) }}</pre>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                            
                            @if(!$change->is_read)
                                <div class="ml-4">
                                    <button onclick="markAsRead({{ $change->id }})" 
                                            class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded transition-colors">
                                        Mark Read
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($changes->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $changes->links() }}
                </div>
            @endif
        @else
            <div class="p-8 text-center text-gray-500">
                <i class="fas fa-search text-4xl mb-4"></i>
                <p class="text-lg mb-2">No changes detected</p>
                <p class="text-sm">Run manual checks or adjust your filters to see monitoring results</p>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Check USCIS changes
    function checkUscisChanges() {
        const btn = document.getElementById('uscis-check-btn');
        const originalText = btn.innerHTML;
        
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Checking...';
        
        fetch('{{ route("admin.monitoring.check-uscis") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('success', data.message);
                if (data.changes_detected > 0) {
                    setTimeout(() => location.reload(), 2000);
                }
            } else {
                showAlert('error', data.message);
            }
        })
        .catch(error => {
            showAlert('error', 'Error checking USCIS forms');
            console.error('Error:', error);
        })
        .finally(() => {
            btn.disabled = false;
            btn.innerHTML = originalText;
        });
    }

    // Check medical fees
    function checkMedicalFees() {
        const btn = document.getElementById('medical-check-btn');
        const originalText = btn.innerHTML;
        
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Checking...';
        
        fetch('{{ route("admin.monitoring.check-medical") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('success', data.message);
                if (data.changes_detected > 0) {
                    setTimeout(() => location.reload(), 2000);
                }
            } else {
                showAlert('error', data.message);
            }
        })
        .catch(error => {
            showAlert('error', 'Error checking medical fees');
            console.error('Error:', error);
        })
        .finally(() => {
            btn.disabled = false;
            btn.innerHTML = originalText;
        });
    }

    // Mark change as read
    function markAsRead(changeId) {
        fetch(`/admin/monitoring/changes/${changeId}/mark-read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    // Toggle change details
    function toggleDetails(changeId) {
        const details = document.getElementById(`details-${changeId}`);
        details.classList.toggle('hidden');
    }

    // Show alert message
    function showAlert(type, message) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `fixed top-4 right-4 z-50 px-4 py-3 rounded-lg shadow-lg ${type === 'success' ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200'}`;
        alertDiv.innerHTML = `
            <div class="flex items-center">
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} mr-2"></i>
                <span>${message}</span>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-lg">&times;</button>
            </div>
        `;
        
        document.body.appendChild(alertDiv);
        
        setTimeout(() => {
            alertDiv.remove();
        }, 5000);
    }
</script>
@endpush