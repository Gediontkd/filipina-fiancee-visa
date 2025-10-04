{{-- resources/views/admin/applications/form-data.blade.php (Updated) --}}
@extends('admin.layouts.app')
@section('title', 'Application Form Data')
@section('page-title', 'Application Form Data for PDF Generation')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.applications.show', $application) }}"
               class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-2">
                <i class="fas fa-arrow-left mr-2"></i>Back to Application Details
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Form Data - Application #{{ $application->id }}</h1>
            <p class="text-gray-600">User: {{ $application->user->name }} | Type: {{ $application->visaApplication->name ?? 'N/A' }}</p>
        </div>
       
        <div class="flex space-x-3">
            <!-- Generate PDF Button -->
            <!-- <button onclick="generatePdf()" id="pdf-btn"
                    class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors">
                <i class="fas fa-file-pdf mr-2"></i>Generate PDF
            </button> -->
            
            <button onclick="window.print()"
                    class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors">
                <i class="fas fa-print mr-2"></i>Print Form Data
            </button>
           
            <button onclick="copyToClipboard()"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                <i class="fas fa-copy mr-2"></i>Copy Data
            </button>
        </div>
    </div>

    <!-- Application Info Summary -->
    <div class="bg-white rounded-lg shadow p-6 print:shadow-none">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Application Summary</h3>
       
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
            <div>
                <span class="font-medium text-gray-500">Applicant:</span>
                <p>{{ $application->user->name }}</p>
            </div>
            <div>
                <span class="font-medium text-gray-500">Email:</span>
                <p>{{ $application->user->email }}</p>
            </div>
            <div>
                <span class="font-medium text-gray-500">Application Type:</span>
                <p>{{ $application->visaApplication->name ?? 'N/A' }}</p>
            </div>
            <div>
                <span class="font-medium text-gray-500">Submitted Date:</span>
                <p>{{ $application->created_at->format('M j, Y') }}</p>
            </div>
            <div>
                <span class="font-medium text-gray-500">Status:</span>
                <p>{{ ucfirst(str_replace('_', ' ', $application->status)) }}</p>
            </div>
        </div>
    </div>

    <!-- Form Data Content -->
    @if($applicationData)
        <div id="form-data-content" class="space-y-6">
            <!-- Fiance Visa Data -->
            @if(isset($applicationData['sponsor']) || isset($applicationData['alien']) || isset($applicationData['children']))
                <div class="bg-white rounded-lg shadow overflow-hidden print:shadow-none">
                    <div class="bg-blue-50 px-6 py-4 border-b">
                        <h3 class="text-xl font-semibold text-gray-900">Fiance Visa Application Data</h3>
                    </div>
                   
                    <!-- Sponsor Data -->
                    @if(!empty($applicationData['sponsor']))
                        <div class="p-6 border-b">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">U.S. Sponsor Information</h4>
                            @foreach($applicationData['sponsor'] as $stepName => $stepData)
                                <div class="mb-6">
                                    <h5 class="font-medium text-gray-700 mb-3 capitalize">{{ str_replace('_', ' ', $stepName) }}</h5>
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        @if(is_array($stepData))
                                            @foreach($stepData as $key => $value)
                                                @if($key !== 'id' && $key !== '_token' && $key !== 'name' && $key !== 'next')
                                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-1">
                                                        <span class="font-medium text-gray-600 capitalize">{{ str_replace('_', ' ', $key) }}:</span>
                                                        <span class="md:col-span-2 text-gray-900">
                                                            @if(is_array($value))
                                                                {{ json_encode($value, JSON_PRETTY_PRINT) }}
                                                            @else
                                                                {{ $value ?: 'Not provided' }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            <p class="text-gray-600">{{ $stepData }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Alien Data -->
                    @if(!empty($applicationData['alien']))
                        <div class="p-6 border-b">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Alien Information</h4>
                            @foreach($applicationData['alien'] as $stepName => $stepData)
                                <div class="mb-6">
                                    <h5 class="font-medium text-gray-700 mb-3 capitalize">{{ str_replace('_', ' ', $stepName) }}</h5>
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        @if(is_array($stepData))
                                            @foreach($stepData as $key => $value)
                                                @if($key !== 'id' && $key !== '_token' && $key !== 'name' && $key !== 'next')
                                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-1">
                                                        <span class="font-medium text-gray-600 capitalize">{{ str_replace('_', ' ', $key) }}:</span>
                                                        <span class="md:col-span-2 text-gray-900">
                                                            @if(is_array($value))
                                                                {{ json_encode($value, JSON_PRETTY_PRINT) }}
                                                            @else
                                                                {{ $value ?: 'Not provided' }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Children Data -->
                    @if(!empty($applicationData['children']))
                        <div class="p-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Alien Children Information</h4>
                            @foreach($applicationData['children'] as $stepName => $stepData)
                                <div class="mb-6">
                                    <h5 class="font-medium text-gray-700 mb-3 capitalize">{{ str_replace('_', ' ', $stepName) }}</h5>
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        @if(is_array($stepData))
                                            @foreach($stepData as $key => $value)
                                                @if($key !== 'id' && $key !== '_token' && $key !== 'name' && $key !== 'next')
                                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-1">
                                                        <span class="font-medium text-gray-600 capitalize">{{ str_replace('_', ' ', $key) }}:</span>
                                                        <span class="md:col-span-2 text-gray-900">
                                                            @if(is_array($value))
                                                                {{ json_encode($value, JSON_PRETTY_PRINT) }}
                                                            @else
                                                                {{ $value ?: 'Not provided' }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif

            <!-- Spouse Visa Data -->
            @if(isset($applicationData['spouse_data']) && !empty($applicationData['spouse_data']))
                <div class="bg-white rounded-lg shadow overflow-hidden print:shadow-none">
                    <div class="bg-purple-50 px-6 py-4 border-b">
                        <h3 class="text-xl font-semibold text-gray-900">Spouse Visa Application Data</h3>
                    </div>
                    <!-- Similar structure for spouse data -->
                </div>
            @endif

            <!-- Adjustment of Status Data -->
            @if(isset($applicationData['adjustment_data']) && !empty($applicationData['adjustment_data']))
                <div class="bg-white rounded-lg shadow overflow-hidden print:shadow-none">
                    <div class="bg-orange-50 px-6 py-4 border-b">
                        <h3 class="text-xl font-semibold text-gray-900">Adjustment of Status Application Data</h3>
                    </div>
                    <!-- Similar structure for adjustment data -->
                </div>
            @endif
        </div>
    @else
        <div class="bg-white rounded-lg shadow p-8 text-center">
            <i class="fas fa-exclamation-triangle text-yellow-500 text-4xl mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No Form Data Available</h3>
            <p class="text-gray-600">No submitted form data found for this application.</p>
        </div>
    @endif
</div>
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

    function copyToClipboard() {
        const content = document.getElementById('form-data-content');
        if (!content) {
            showNotification('No form data to copy', 'error');
            return;
        }

        const textContent = content.innerText;
       
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(textContent).then(() => {
                showNotification('Form data copied to clipboard!', 'success');
            }).catch(err => {
                console.error('Failed to copy: ', err);
                fallbackCopyTextToClipboard(textContent);
            });
        } else {
            fallbackCopyTextToClipboard(textContent);
        }
    }

    function fallbackCopyTextToClipboard(text) {
        const textArea = document.createElement("textarea");
        textArea.value = text;
        textArea.style.top = "0";
        textArea.style.left = "0";
        textArea.style.position = "fixed";
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();

        try {
            const successful = document.execCommand('copy');
            if (successful) {
                showNotification('Form data copied to clipboard!', 'success');
            } else {
                showNotification('Failed to copy form data', 'error');
            }
        } catch (err) {
            console.error('Fallback: Unable to copy', err);
            showNotification('Failed to copy form data', 'error');
        }

        document.body.removeChild(textArea);
    }

    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg text-white z-50 ${
            type === 'success' ? 'bg-green-500' : 'bg-red-500'
        }`;
        notification.textContent = message;
       
        document.body.appendChild(notification);
       
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 3000);
    }
</script>
@endpush