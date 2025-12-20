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
            <!-- PDF Download Button -->
            @php
                $pdfStatus = \App\Helpers\PdfControlHelper::checkPdfStatus($application->user_id);
            @endphp
            
            @if($pdfStatus['can_generate'])
                <button onclick="generateAdminPdf()" id="admin-pdf-btn"
                        class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors">
                    <i class="fas fa-file-pdf mr-2"></i>Generate PDF Package
                </button>
            @else
                <button disabled
                        class="inline-flex items-center px-4 py-2 bg-gray-400 text-white font-medium rounded-lg cursor-not-allowed"
                        title="{{ $pdfStatus['message'] }}">
                    <i class="fas fa-file-pdf mr-2"></i>Package Not Ready
                </button>
            @endif

            <!-- Instant Login Button -->
        <button type="button" onclick="loginAsUser({{ $application->user->id }}, '{{ $application->user->name }}')"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors">
            <i class="fas fa-user-secret mr-2"></i>Login as User
        </button>
            
            <a href="{{ route('admin.applications.form-data', $application) }}"
               class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors">
                <i class="fas fa-file-alt mr-2"></i>View Form Data
            </a>
           
            <a href="{{ route('admin.messages.conversation', [$application->user_id, $application->id]) }}"
               class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition-colors">
                <i class="fas fa-comments mr-2"></i>Messages
                @if($unreadMessageCount > 0)
                    <span class="ml-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                        {{ $unreadMessageCount }}
                    </span>
                @endif
            </a>
           
            <button onclick="showStatusModal({{ $application->id }}, '{{ $application->status }}', '{{ addslashes($application->admin_notes ?? '') }}')"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                <i class="fas fa-edit mr-2"></i>Update Status
            </button>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-file-alt text-blue-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Status</p>
                    <p class="text-lg font-bold text-gray-900">{{ ucfirst(str_replace('_', ' ', $application->status)) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-clock text-green-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Submitted</p>
                    <p class="text-lg font-bold text-gray-900">{{ $application->created_at->format('M j, Y') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-comments text-purple-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Messages</p>
                    <p class="text-lg font-bold text-gray-900">{{ $messageCount ?? 0 }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-paperclip text-yellow-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Documents</p>
                    <p class="text-lg font-bold text-gray-900">{{ $documentCount ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- User Information -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-user mr-2"></i>Applicant Information
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Full Name</label>
                            <p class="text-gray-900 font-medium">{{ $application->user->name }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Email</label>
                            <p class="text-gray-900">{{ $application->user->email }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Phone</label>
                            <p class="text-gray-900">{{ $application->user->phone ?? 'Not provided' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Registration Date</label>
                            <p class="text-gray-900">{{ $application->user->created_at->format('M j, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Application Details -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-file-alt mr-2"></i>Application Details
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Application Type</label>
                            <p class="text-gray-900 font-medium">{{ $application->visaApplication->name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Visa Category</label>
                            <p class="text-gray-900">{{ $application->visaApplication->category ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Transaction ID</label>
                            <p class="text-gray-900 font-mono text-sm">{{ $application->transaction_id ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Amount Paid</label>
                            <p class="text-gray-900 font-medium">${{ number_format($application->amount ?? 0, 2) }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Payment Status</label>
                            <p>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $application->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($application->payment_status ?? 'pending') }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Submitted Date</label>
                            <p class="text-gray-900">{{ $application->created_at->format('F j, Y g:i A') }}</p>
                        </div>
                    </div>

                    @if($application->admin_notes)
                        <div class="mt-6 pt-6 border-t">
                            <label class="text-sm font-medium text-gray-500">Admin Notes</label>
                            <p class="text-gray-900 whitespace-pre-wrap mt-2">{{ $application->admin_notes }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Documents -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-paperclip mr-2"></i>Uploaded Documents
                    </h3>
                </div>
                <div class="p-6">
                    @if($application->documents && count($application->documents) > 0)
                        <div class="space-y-3">
                            @foreach($application->documents as $document)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div class="flex items-center space-x-3">
                                        <i class="fas fa-file-pdf text-red-500 text-xl"></i>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $document['name'] ?? 'Document' }}</p>
                                            <p class="text-xs text-gray-500">{{ $document['size'] ?? 'Unknown size' }}</p>
                                        </div>
                                    </div>
                                    <a href="{{ $document['url'] ?? '#' }}" target="_blank"
                                       class="inline-flex items-center px-3 py-1 bg-blue-100 hover:bg-blue-200 text-blue-700 text-sm rounded-lg transition-colors">
                                        <i class="fas fa-download mr-1"></i>Download
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No documents uploaded yet</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Status Card -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-info-circle mr-2"></i>Status
                    </h3>
                </div>
                <div class="p-6">
                    <div class="mb-4">
                        <label class="text-sm font-medium text-gray-500">Current Status</label>
                        <p class="mt-1">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                {{ $application->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                   ($application->status === 'rejected' ? 'bg-red-100 text-red-800' : 
                                   ($application->status === 'under_review' ? 'bg-yellow-100 text-yellow-800' : 
                                   'bg-gray-100 text-gray-800')) }}">
                                {{ ucfirst(str_replace('_', ' ', $application->status)) }}
                            </span>
                        </p>
                    </div>

                    <div class="mb-4">
                        <label class="text-sm font-medium text-gray-500">Last Updated</label>
                        <p class="text-gray-900">{{ $application->updated_at->format('M j, Y g:i A') }}</p>
                    </div>

                    <button onclick="showStatusModal({{ $application->id }}, '{{ $application->status }}', '{{ addslashes($application->admin_notes ?? '') }}')"
                            class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                        <i class="fas fa-edit mr-2"></i>Update Status
                    </button>
                </div>
            </div>

            <!-- Timeline -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-history mr-2"></i>Timeline
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-check text-green-600 text-sm"></i>
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Application Submitted</p>
                                <p class="text-xs text-gray-500">{{ $application->created_at->format('M j, Y g:i A') }}</p>
                            </div>
                        </div>

                        @if($application->payment_status === 'paid')
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-dollar-sign text-green-600 text-sm"></i>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">Payment Confirmed</p>
                                    <p class="text-xs text-gray-500">{{ $application->created_at->format('M j, Y g:i A') }}</p>
                                </div>
                            </div>
                        @endif

                        @if($application->status !== 'pending')
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-eye text-blue-600 text-sm"></i>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">Status Updated</p>
                                    <p class="text-xs text-gray-500">{{ $application->updated_at->format('M j, Y g:i A') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-bolt mr-2"></i>Quick Actions
                    </h3>
                </div>
                <div class="p-6 space-y-3">
                    @php
                        $pdfStatus = \App\Helpers\PdfControlHelper::checkPdfStatus($application->user_id);
                    @endphp
                    
                    @if($pdfStatus['can_generate'])
                        <button onclick="generateAdminPdf()" id="admin-pdf-btn-2"
                                class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-100 hover:bg-red-200 text-red-700 font-medium rounded-lg transition-colors">
                            <i class="fas fa-file-pdf mr-2"></i>Generate PDF Package
                        </button>
                    @else
                        <div class="w-full px-4 py-3 bg-yellow-50 border border-yellow-200 text-yellow-800 rounded-lg text-sm">
                            <i class="fas fa-clock mr-2"></i>{{ $pdfStatus['message'] }}
                        </div>
                    @endif

                    <a href="{{ route('admin.applications.form-data', $application) }}"
                       class="w-full inline-flex items-center justify-center px-4 py-2 bg-green-100 hover:bg-green-200 text-green-700 font-medium rounded-lg transition-colors">
                        <i class="fas fa-file-alt mr-2"></i>View Form Data
                    </a>

                    <a href="{{ route('admin.messages.conversation', [$application->user_id, $application->id]) }}"
                       class="w-full inline-flex items-center justify-center px-4 py-2 bg-purple-100 hover:bg-purple-200 text-purple-700 font-medium rounded-lg transition-colors">
                        <i class="fas fa-comments mr-2"></i>Send Message
                    </a>

                    <a href="mailto:{{ $application->user->email }}"
                       class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors">
                        <i class="fas fa-envelope mr-2"></i>Email User
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Status Update Modal -->
<div id="status-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-lg bg-white">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Update Application Status</h3>
            <button onclick="closeStatusModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form id="status-form" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="status-select" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select id="status-select" name="status" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="pending">Pending</option>
                    <option value="under_review">Under Review</option>
                    <option value="additional_info_required">Additional Info Required</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="admin-notes" class="block text-sm font-medium text-gray-700 mb-2">Admin Notes</label>
                <textarea id="admin-notes" name="admin_notes" rows="4"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                          placeholder="Add notes about this status update..."></textarea>
            </div>

            <div class="flex items-center justify-end space-x-3">
                <button type="button" onclick="closeStatusModal()"
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
@endsection

@push('scripts')
<script>
    // PDF Generation function
    function generateAdminPdf() {
        const btn1 = document.getElementById('admin-pdf-btn');
        const btn2 = document.getElementById('admin-pdf-btn-2');
        
        // Store original content for both buttons
        const originalContent1 = btn1 ? btn1.innerHTML : '';
        const originalContent2 = btn2 ? btn2.innerHTML : '';
        
        // Disable both buttons and show loading
        if (btn1) {
            btn1.disabled = true;
            btn1.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Generating...';
        }
        if (btn2) {
            btn2.disabled = true;
            btn2.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Generating...';
        }
        
        // Redirect to PDF generation route
        setTimeout(() => {
            window.location.href = '{{ route("admin.applications.generate-pdf", $application) }}';
            
            // Re-enable buttons after delay
            setTimeout(() => {
                if (btn1) {
                    btn1.disabled = false;
                    btn1.innerHTML = originalContent1;
                }
                if (btn2) {
                    btn2.disabled = false;
                    btn2.innerHTML = originalContent2;
                }
            }, 3000);
        }, 500);
    }

    // Login as user function (opens in new tab)
    function loginAsUser(userId, userName) {
        if (!confirm(`Login as ${userName}?\n\nThis will open a new tab and you'll be logged in as this user.`)) {
            return;
        }

        // Create a hidden form
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/login-as-user/${userId}`;
        form.target = '_blank'; // Open in new tab
        
        // Add CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = csrfToken;
        form.appendChild(csrfInput);
        
        // Append form to body and submit
        document.body.appendChild(form);
        form.submit();
        
        // Clean up
        setTimeout(() => document.body.removeChild(form), 100);
    }

    // Status Modal functions
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