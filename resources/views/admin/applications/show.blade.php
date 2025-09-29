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
            <button onclick="generatePdf()" id="pdf-btn"
                    class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors">
                <i class="fas fa-file-pdf mr-2"></i>Generate PDF
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
    function generatePdf() {
        const btn = document.getElementById('pdf-btn');
        const originalContent = btn.innerHTML;
        
        // Disable button and show loading
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Generating...';
        
        // Create a temporary form to submit the request
        window.location.href = '{{ route("admin.applications.generate-pdf", $application) }}';
        
        // Re-enable button after delay (in case download fails)
        setTimeout(() => {
            btn.disabled = false;
            btn.innerHTML = originalContent;
        }, 3000);
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