{{-- resources/views/admin/applications/form-data.blade.php --}}
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
                <span class="font-medium text-gray-500">Transaction ID:</span>
                <p>{{ $application->transaction_id ?? 'N/A' }}</p>
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
                    @if(isset($applicationData['sponsor']) && $applicationData['sponsor'])
                        <div class="p-6 border-b">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">U.S. Sponsor Information</h4>
                            @foreach($applicationData['sponsor'] as $stepName => $stepData)
                                <div class="mb-6">
                                    <h5 class="font-medium text-gray-700 mb-3 capitalize">{{ str_replace('_', ' ', $stepName) }}</h5>
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        @foreach($stepData as $key => $value)
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
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Alien Data -->
                    @if(isset($applicationData['alien']) && $applicationData['alien'])
                        <div class="p-6 border-b">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Alien Information</h4>
                            <div class="bg-gray-50 rounded-lg p-4">
                                @foreach($applicationData['alien'] as $key => $value)
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
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Children Data -->
                    @if(isset($applicationData['children']) && $applicationData['children'])
                        <div class="p-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Alien Children Information</h4>
                            <div class="bg-gray-50 rounded-lg p-4">
                                @foreach($applicationData['children'] as $key => $value)
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
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Spouse Visa Data -->
            @if(isset($applicationData['spouse_data']) && $applicationData['spouse_data'])
                <div class="bg-white rounded-lg shadow overflow-hidden print:shadow-none">
                    <div class="bg-purple-50 px-6 py-4 border-b">
                        <h3 class="text-xl font-semibold text-gray-900">Spouse Visa Application Data</h3>
                    </div>
                    <div class="p-6">
                        @foreach($applicationData['spouse_data'] as $stepName => $stepData)
                            <div class="mb-6">
                                <h4 class="font-medium text-gray-700 mb-3 capitalize">{{ str_replace('_', ' ', $stepName) }}</h4>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    @foreach($stepData as $key => $value)
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
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Adjustment of Status Data -->
            @if(isset($applicationData['adjustment_data']) && $applicationData['adjustment_data'])
                <div class="bg-white rounded-lg shadow overflow-hidden print:shadow-none">
                    <div class="bg-orange-50 px-6 py-4 border-b">
                        <h3 class="text-xl font-semibold text-gray-900">Adjustment of Status Application Data</h3>
                    </div>
                    <div class="p-6">
                        @foreach($applicationData['adjustment_data'] as $stepName => $stepData)
                            <div class="mb-6">
                                <h4 class="font-medium text-gray-700 mb-3 capitalize">{{ str_replace('_', ' ', $stepName) }}</h4>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    @foreach($stepData as $key => $value)
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
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
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
    function copyToClipboard() {
        const content = document.getElementById('form-data-content');
        if (!content) {
            alert('No form data to copy');
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
            console.error('Fallback: Oops, unable to copy', err);
            showNotification('Failed to copy form data', 'error');
        }

        document.body.removeChild(textArea);
    }

    function showNotification(message, type) {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg text-white z-50 ${
            type === 'success' ? 'bg-green-500' : 'bg-red-500'
        }`;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        // Remove after 3 seconds
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 3000);
    }

    // Print styles
    const printStyles = `
        <style media="print">
            @page { margin: 1in; }
            .print\\:shadow-none { box-shadow: none !important; }
            .space-y-6 > * + * { margin-top: 1rem !important; }
            .bg-gray-50 { background-color: #f9fafb !important; -webkit-print-color-adjust: exact; }
            .bg-blue-50 { background-color: #eff6ff !important; -webkit-print-color-adjust: exact; }
            .bg-purple-50 { background-color: #faf5ff !important; -webkit-print-color-adjust: exact; }
            .bg-orange-50 { background-color: #fff7ed !important; -webkit-print-color-adjust: exact; }
            .text-blue-600 { color: #2563eb !important; -webkit-print-color-adjust: exact; }
            .border { border: 1px solid #d1d5db !important; }
            .rounded-lg { border-radius: 0.5rem !important; }
        </style>
    `;
    
    document.head.insertAdjacentHTML('beforeend', printStyles);
</script>
@endpush