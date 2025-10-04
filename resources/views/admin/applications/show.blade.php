{{-- resources/views/admin/applications/show.blade.php (Updated with PDF button) --}}
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
            <!-- PDF Generation Button -->
            <!-- <button onclick="generatePdf()" id="pdf-btn"
                    class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors">
                <i class="fas fa-file-pdf mr-2"></i>Generate PDF
            </button> -->
            
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

    <!-- Rest of your existing content remains the same -->
    <!-- Quick Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Your existing stats cards -->
    </div>

    <!-- Application Overview -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Your existing main information and sidebar content -->
    </div>
</div>

<!-- Status Update Modal (existing) -->
<!-- ... your existing modal code ... -->

@endsection

@push('scripts')
<script>
    // PDF Generation function
    // Replace the existing generatePdf() function with this:
function generatePdf() {
    const btn = document.getElementById('pdf-btn');
    const originalContent = btn.innerHTML;
    
    // First, CHECK if PDFs are available for this user
    const applicationId = {{ $application->id }};
    const userId = {{ $application->user_id }};
    
    // Disable button temporarily
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Checking...';
    
    // Check PDF status via AJAX
    fetch('/admin/check-pdf-status?user_id=' + userId)
        .then(response => response.json())
        .then(data => {
            console.log('PDF Status:', data);
            
            if (!data.can_generate) {
                // PDFs not ready
                showNotification(data.message, 'error');
                btn.disabled = false;
                btn.innerHTML = originalContent;
                return;
            }
            
            // PDFs are ready - proceed
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Generating PDF...';
            showNotification('Generating ' + data.pdf_count + ' PDF file(s)...', 'info');
            
            // Redirect to generate
            window.location.href = '{{ route("admin.applications.generate-pdf", $application) }}';
            
            // Re-enable after delay
            setTimeout(() => {
                btn.disabled = false;
                btn.innerHTML = originalContent;
            }, 3000);
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Error checking PDF status', 'error');
            btn.disabled = false;
            btn.innerHTML = originalContent;
        });
}

    // Your existing status modal functions
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