{{-- resources/views/admin/applications/show.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Application Details')
@section('page-title', 'Application Details')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.applications.index') }}" 
               class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-2">
                <i class="fas fa-arrow-left mr-2"></i>Back to Applications
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Application #{{ $application->id }}</h1>
        </div>
        
        <div class="flex space-x-3">
            <button onclick="showStatusModal({{ $application->id }}, '{{ $application->status }}', '{{ addslashes($application->admin_notes ?? '') }}')" 
                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                <i class="fas fa-edit mr-2"></i>Update Status
            </button>
        </div>
    </div>

    <!-- Application Overview -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- User Information -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">User Information</h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Full Name</label>
                        <p class="text-gray-900 font-medium">{{ $application->user->name }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Email Address</label>
                        <p class="text-gray-900">{{ $application->user->email }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Registration Date</label>
                        <p class="text-gray-900">{{ $application->user->created_at->format('M j, Y') }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Chosen Application</label>
                        <p class="text-gray-900">{{ $application->user->chosen_application ?? 'Not selected' }}</p>
                    </div>
                </div>
                
                <div class="mt-4 pt-4 border-t">
                    <a href="{{ route('admin.users.show', $application->user) }}" 
                       class="inline-flex items-center text-blue-600 hover:text-blue-800">
                        <i class="fas fa-user mr-2"></i>View Full User Profile
                    </a>
                </div>
            </div>

            <!-- Application Details -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Application Details</h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Application Type</label>
                        <p class="text-gray-900 font-medium">{{ $application->visaApplication->name ?? 'N/A' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Transaction ID</label>
                        <p class="text-gray-900 font-mono text-sm">{{ $application->transaction_id ?? 'N/A' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Submission Date</label>
                        <p class="text-gray-900">{{ $application->created_at->format('M j, Y H:i') }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Last Updated</label>
                        <p class="text-gray-900">{{ $application->updated_at->format('M j, Y H:i') }}</p>
                    </div>
                </div>

                @if($application->admin_notes)
                    <div class="mt-4 pt-4 border-t">
                        <label class="block text-sm font-medium text-gray-500 mb-2">Admin Notes</label>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-gray-700 whitespace-pre-wrap">{{ $application->admin_notes }}</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Related Data -->
            @if($application_data)
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Related Application Data</h3>
                    
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-gray-600 text-sm mb-2">Application form data is available for this user.</p>
                        <p class="text-gray-500 text-xs">
                            This includes form submissions, step completions, and other application-specific information 
                            based on their chosen visa type ({{ $application->user->chosen_application }}).
                        </p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Status Card -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Status</h3>
                
                @php
                    $status_colors = [
                        'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                        'under_review' => 'bg-blue-100 text-blue-800 border-blue-200',
                        'approved' => 'bg-green-100 text-green-800 border-green-200',
                        'rejected' => 'bg-red-100 text-red-800 border-red-200'
                    ];
                    $status = $application->status ?? 'pending';
                @endphp
                
                <div class="mb-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border {{ $status_colors[$status] ?? 'bg-gray-100 text-gray-800 border-gray-200' }}">
                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                    </span>
                </div>
                
                @if($application->reviewed_at)
                    <div class="text-sm text-gray-600">
                        <p><strong>Reviewed:</strong> {{ $application->reviewed_at->format('M j, Y H:i') }}</p>
                        @if($application->reviewer)
                            <p><strong>Reviewed by:</strong> {{ $application->reviewer->name }}</p>
                        @endif
                    </div>
                @else
                    <p class="text-sm text-gray-500">Not yet reviewed</p>
                @endif
            </div>

            <!-- Timeline -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Timeline</h3>
                
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-3 h-3 bg-blue-500 rounded-full mt-1"></div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Application Submitted</p>
                            <p class="text-xs text-gray-500">{{ $application->created_at->format('M j, Y H:i') }}</p>
                        </div>
                    </div>
                    
                    @if($application->reviewed_at)
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-3 h-3 bg-green-500 rounded-full mt-1"></div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Status Updated</p>
                                <p class="text-xs text-gray-500">{{ $application->reviewed_at->format('M j, Y H:i') }}</p>
                                <p class="text-xs text-gray-500">by {{ $application->reviewer->name ?? 'Admin' }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                
                <div class="space-y-3">
                    <a href="{{ route('admin.users.show', $application->user) }}" 
                       class="block w-full text-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                        <i class="fas fa-user mr-2"></i>View User Profile
                    </a>
                    
                    <button onclick="showStatusModal({{ $application->id }}, '{{ $application->status }}', '{{ addslashes($application->admin_notes ?? '') }}')" 
                            class="block w-full text-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                        <i class="fas fa-edit mr-2"></i>Update Status
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Status Update Modal -->
<div id="status-modal" class="fixed inset-0 z-50 hidden">
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg max-w-md w-full p-6">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                    <i class="fas fa-edit text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Update Application Status</h3>
                    <p class="text-sm text-gray-500">Change status and add notes</p>
                </div>
            </div>
            
            <form id="status-form" method="POST">
                @csrf
                @method('PATCH')
                
                <div class="mb-4">
                    <label for="status-select" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select id="status-select" 
                            name="status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="pending">Pending</option>
                        <option value="under_review">Under Review</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
                
                <div class="mb-6">
                    <label for="admin-notes" class="block text-sm font-medium text-gray-700 mb-2">Admin Notes</label>
                    <textarea id="admin-notes" 
                              name="admin_notes" 
                              rows="4" 
                              placeholder="Add any notes about this application..."
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            onclick="closeStatusModal()" 
                            class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                        Cancel
                    </button>
                    
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                        Update Status
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function showStatusModal(applicationId, currentStatus, currentNotes) {
        document.getElementById('status-form').action = `/admin/applications/${applicationId}/status`;
        document.getElementById('status-select').value = currentStatus;
        document.getElementById('admin-notes').value = currentNotes;
        document.getElementById('status-modal').classList.remove('hidden');
    }

    function closeStatusModal() {
        document.getElementById('status-modal').classList.add('hidden');
    }

    // Close modal on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeStatusModal();
        }
    });

    // Close modal on backdrop click
    document.getElementById('status-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeStatusModal();
        }
    });
</script>
@endpush