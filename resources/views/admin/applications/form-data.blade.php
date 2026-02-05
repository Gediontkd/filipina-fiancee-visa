{{-- resources/views/admin/applications/form-data.blade.php (FULLY FIXED) --}}
@extends('admin.layouts.app')
@section('title', 'Application Form Data')
@section('page-title', 'Application Form Data')

@php
    /**
     * Helper function to safely display any value
     */
    function displayValue($value) {
        if (is_null($value) || $value === '') {
            return 'Not provided';
        }
        if (is_array($value)) {
            return json_encode($value, JSON_PRETTY_PRINT);
        }
        if (is_bool($value)) {
            return $value ? 'Yes' : 'No';
        }

        // Handle file paths (specifically waiver documents)
        if (is_string($value) && (strpos($value, 'waiver_documents/') === 0 || preg_match('/\.(pdf|jpg|jpeg|png|doc|docx)$/i', $value))) {
            $url = asset('storage/' . $value);
            $icon = 'fa-file';
            if (strpos($value, '.pdf') !== false) $icon = 'fa-file-pdf';
            if (preg_match('/\.(jpg|jpeg|png)$/i', $value)) $icon = 'fa-file-image';
            
            return '<a href="' . $url . '" target="_blank" class="inline-flex items-center px-3 py-1 bg-blue-50 text-blue-700 hover:bg-blue-100 rounded border border-blue-200 transition-colors no-print">
                        <i class="fas ' . $icon . ' mr-2"></i>
                        <span>View Document (' . basename($value) . ')</span>
                    </a>
                    <span class="hidden print:inline text-gray-500 italic">[Document: ' . basename($value) . ']</span>';
        }

        return $value;
    }
@endphp

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between no-print">
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
                <span class="font-medium text-gray-500">Status:</span>
                <p>{{ ucfirst(str_replace('_', ' ', $application->status)) }}</p>
            </div>
        </div>
    </div>

    <!-- Form Data Content -->
    @if(!empty($applicationData))
        <div id="form-data-content" class="space-y-6">
            
            {{-- SPOUSE VISA DATA --}}
            @if(isset($applicationData['beneficiary']))
                <div class="bg-white rounded-lg shadow overflow-hidden print:shadow-none">
                    <div class="bg-purple-50 px-6 py-4 border-b">
                        <h3 class="text-xl font-semibold text-gray-900">
                            <i class="fas fa-heart mr-2"></i>Spouse Visa Application (CR-1/IR-1)
                        </h3>
                    </div>
                   
                    <!-- Sponsor Information -->
                    @if(isset($applicationData['sponsor']))
                        <div class="p-6 border-b">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">
                                <i class="fas fa-user mr-2"></i>U.S. Sponsor Information
                            </h4>
                            
                            @foreach($applicationData['sponsor'] as $sectionName => $sectionData)
                                @if($sectionName === 'parents')
                                    {{-- Handle Parents Section --}}
                                    <div class="mb-6">
                                        <h5 class="font-medium text-gray-700 mb-3">Parents Information</h5>
                                        
                                        @if(is_array($sectionData))
                                            @foreach($sectionData as $parentKey => $parentData)
                                                <div class="bg-gray-50 rounded-lg p-4 mb-4">
                                                    <h6 class="font-medium text-gray-800 mb-2">{{ ucfirst(str_replace('_', ' ', $parentKey)) }}</h6>
                                                    @if(is_array($parentData))
                                                        @foreach($parentData as $key => $value)
                                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-2 border-b border-gray-200 last:border-0">
                                                                <span class="font-medium text-gray-600 capitalize">{{ str_replace('_', ' ', $key) }}:</span>
                                                                <span class="md:col-span-2 text-gray-900">{!! displayValue($value) !!}</span>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    
                                @elseif($sectionName === 'address_history')
                                    {{-- Handle Address History --}}
                                    <div class="mb-6">
                                        <h5 class="font-medium text-gray-700 mb-3">Address History</h5>
                                        
                                        @if(is_array($sectionData) && count($sectionData) > 0)
                                            @foreach($sectionData as $index => $address)
                                                <div class="bg-gray-50 rounded-lg p-4 mb-3">
                                                    <h6 class="font-medium text-gray-800 mb-2">Address {{ $index + 1 }}</h6>
                                                    @if(is_array($address))
                                                        @foreach($address as $key => $value)
                                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-2 border-b border-gray-200 last:border-0">
                                                                <span class="font-medium text-gray-600 capitalize">{{ str_replace('_', ' ', $key) }}:</span>
                                                                <span class="md:col-span-2 text-gray-900">{!! displayValue($value) !!}</span>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="text-gray-500 italic">No address history provided</p>
                                        @endif
                                    </div>
                                    
                                @elseif($sectionName === 'employment_history')
                                    {{-- Handle Employment History --}}
                                    <div class="mb-6">
                                        <h5 class="font-medium text-gray-700 mb-3">Employment History</h5>
                                        
                                        @if(is_array($sectionData) && count($sectionData) > 0)
                                            @foreach($sectionData as $index => $job)
                                                <div class="bg-gray-50 rounded-lg p-4 mb-3">
                                                    <h6 class="font-medium text-gray-800 mb-2">Employment {{ $index + 1 }}</h6>
                                                    @if(is_array($job))
                                                        @foreach($job as $key => $value)
                                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-2 border-b border-gray-200 last:border-0">
                                                                <span class="font-medium text-gray-600 capitalize">{{ str_replace('_', ' ', $key) }}:</span>
                                                                <span class="md:col-span-2 text-gray-900">{!! displayValue($value) !!}</span>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="text-gray-500 italic">No employment history provided</p>
                                        @endif
                                    </div>
                                    
                                @else
                                    {{-- Handle Regular Sections --}}
                                    <div class="mb-6">
                                        <h5 class="font-medium text-gray-700 mb-3 capitalize">{{ str_replace('_', ' ', $sectionName) }}</h5>
                                        <div class="bg-gray-50 rounded-lg p-4">
                                            @if(is_array($sectionData))
                                                @foreach($sectionData as $key => $value)
                                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-2 border-b border-gray-200 last:border-0">
                                                        <span class="font-medium text-gray-600 capitalize">{{ str_replace('_', ' ', $key) }}:</span>
                                                        <span class="md:col-span-2 text-gray-900">
                                                            @if(is_array($value))
                                                                <pre class="text-xs bg-gray-100 p-2 rounded overflow-x-auto">{!! displayValue($value) !!}</pre>
                                                            @else
                                                                {!! displayValue($value) !!}
                                                            @endif
                                                        </span>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p class="text-gray-600">{!! displayValue($sectionData) !!}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif

                    <!-- Beneficiary Information -->
                    @if(isset($applicationData['beneficiary']))
                        <div class="p-6 border-b">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">
                                <i class="fas fa-user-friends mr-2"></i>Beneficiary (Foreign Spouse) Information
                            </h4>
                            
                            @foreach($applicationData['beneficiary'] as $sectionName => $sectionData)
                                @if($sectionName === 'parents')
                                    {{-- Handle Parents Section --}}
                                    <div class="mb-6">
                                        <h5 class="font-medium text-gray-700 mb-3">Parents Information</h5>
                                        
                                        @if(is_array($sectionData))
                                            @foreach($sectionData as $parentKey => $parentData)
                                                <div class="bg-gray-50 rounded-lg p-4 mb-4">
                                                    <h6 class="font-medium text-gray-800 mb-2">{{ ucfirst(str_replace('_', ' ', $parentKey)) }}</h6>
                                                    @if(is_array($parentData))
                                                        @foreach($parentData as $key => $value)
                                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-2 border-b border-gray-200 last:border-0">
                                                                <span class="font-medium text-gray-600 capitalize">{{ str_replace('_', ' ', $key) }}:</span>
                                                                <span class="md:col-span-2 text-gray-900">{!! displayValue($value) !!}</span>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    
                                @elseif($sectionName === 'address_history')
                                    {{-- Handle Address History --}}
                                    <div class="mb-6">
                                        <h5 class="font-medium text-gray-700 mb-3">Address History</h5>
                                        
                                        @if(is_array($sectionData) && count($sectionData) > 0)
                                            @foreach($sectionData as $index => $address)
                                                <div class="bg-gray-50 rounded-lg p-4 mb-3">
                                                    <h6 class="font-medium text-gray-800 mb-2">Address {{ $index + 1 }}</h6>
                                                    @if(is_array($address))
                                                        @foreach($address as $key => $value)
                                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-2 border-b border-gray-200 last:border-0">
                                                                <span class="font-medium text-gray-600 capitalize">{{ str_replace('_', ' ', $key) }}:</span>
                                                                <span class="md:col-span-2 text-gray-900">{!! displayValue($value) !!}</span>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="text-gray-500 italic">No address history provided</p>
                                        @endif
                                    </div>
                                    
                                @elseif($sectionName === 'employment_history')
                                    {{-- Handle Employment History --}}
                                    <div class="mb-6">
                                        <h5 class="font-medium text-gray-700 mb-3">Employment History</h5>
                                        
                                        @if(is_array($sectionData) && count($sectionData) > 0)
                                            @foreach($sectionData as $index => $job)
                                                <div class="bg-gray-50 rounded-lg p-4 mb-3">
                                                    <h6 class="font-medium text-gray-800 mb-2">Employment {{ $index + 1 }}</h6>
                                                    @if(is_array($job))
                                                        @foreach($job as $key => $value)
                                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-2 border-b border-gray-200 last:border-0">
                                                                <span class="font-medium text-gray-600 capitalize">{{ str_replace('_', ' ', $key) }}:</span>
                                                                <span class="md:col-span-2 text-gray-900">{!! displayValue($value) !!}</span>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="text-gray-500 italic">No employment history provided</p>
                                        @endif
                                    </div>
                                    
                                @else
                                    {{-- Handle Regular Sections --}}
                                    <div class="mb-6">
                                        <h5 class="font-medium text-gray-700 mb-3 capitalize">{{ str_replace('_', ' ', $sectionName) }}</h5>
                                        <div class="bg-gray-50 rounded-lg p-4">
                                            @if(is_array($sectionData))
                                                @foreach($sectionData as $key => $value)
                                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-2 border-b border-gray-200 last:border-0">
                                                        <span class="font-medium text-gray-600 capitalize">{{ str_replace('_', ' ', $key) }}:</span>
                                                        <span class="md:col-span-2 text-gray-900">
                                                            @if(is_array($value))
                                                                <pre class="text-xs bg-gray-100 p-2 rounded overflow-x-auto">{!! displayValue($value) !!}</pre>
                                                            @else
                                                                {!! displayValue($value) !!}
                                                            @endif
                                                        </span>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p class="text-gray-600">{!! displayValue($sectionData) !!}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif

                    <!-- Relationship Information -->
                    @if(isset($applicationData['relationship']))
                        <div class="p-6 border-b">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">
                                <i class="fas fa-heart mr-2"></i>Relationship Information
                            </h4>
                            
                            @foreach($applicationData['relationship'] as $sectionName => $sectionData)
                                <div class="mb-6">
                                    <h5 class="font-medium text-gray-700 mb-3 capitalize">{{ str_replace('_', ' ', $sectionName) }}</h5>
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        @if(is_array($sectionData))
                                            @foreach($sectionData as $key => $value)
                                                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-2 border-b border-gray-200 last:border-0">
                                                    <span class="font-medium text-gray-600 capitalize">{{ str_replace('_', ' ', $key) }}:</span>
                                                    <span class="md:col-span-2 text-gray-900">
                                                        @if(is_array($value))
                                                            <pre class="text-xs bg-gray-100 p-2 rounded overflow-x-auto">{!! displayValue($value) !!}</pre>
                                                        @else
                                                            {!! displayValue($value) !!}
                                                        @endif
                                                    </span>
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="text-gray-600">{!! displayValue($sectionData) !!}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Metadata -->
                    @if(isset($applicationData['metadata']))
                        <div class="p-6 bg-gray-50">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">
                                <i class="fas fa-info-circle mr-2"></i>Application Metadata
                            </h4>
                            
                            <div class="bg-white rounded-lg p-4">
                                @foreach($applicationData['metadata'] as $key => $value)
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-2 border-b border-gray-200 last:border-0">
                                        <span class="font-medium text-gray-600 capitalize">{{ str_replace('_', ' ', $key) }}:</span>
                                        <span class="md:col-span-2 text-gray-900">{!! displayValue($value) !!}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @endif

            {{-- ADJUSTMENT OF STATUS DATA --}}
            @if(isset($applicationData['applicant']))
                <div class="bg-white rounded-lg shadow overflow-hidden print:shadow-none">
                    <div class="bg-orange-50 px-6 py-4 border-b">
                        <h3 class="text-xl font-semibold text-gray-900">
                            <i class="fas fa-id-card mr-2"></i>Adjustment of Status Application (I-485)
                        </h3>
                    </div>
                   
                    <!-- Applicant Information -->
                    @if(isset($applicationData['applicant']))
                        <div class="p-6 border-b">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">
                                <i class="fas fa-user mr-2"></i>Applicant Information
                            </h4>
                            
                            @foreach($applicationData['applicant'] as $sectionName => $sectionData)
                                <div class="mb-6">
                                    <h5 class="font-medium text-gray-700 mb-3 capitalize">{{ str_replace('_', ' ', $sectionName) }}</h5>
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        @if(is_array($sectionData))
                                            @foreach($sectionData as $key => $value)
                                                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-2 border-b border-gray-200 last:border-0">
                                                    <span class="font-medium text-gray-600 capitalize">{{ str_replace('_', ' ', $key) }}:</span>
                                                    <span class="md:col-span-2 text-gray-900">{!! displayValue($value) !!}</span>
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="text-gray-600">{!! displayValue($sectionData) !!}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Immigration Status -->
                    @if(isset($applicationData['immigration_status']))
                        <div class="p-6 border-b">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">
                                <i class="fas fa-passport mr-2"></i>Immigration Status
                            </h4>
                            
                            @foreach($applicationData['immigration_status'] as $sectionName => $sectionData)
                                <div class="mb-6">
                                    <h5 class="font-medium text-gray-700 mb-3 capitalize">{{ str_replace('_', ' ', $sectionName) }}</h5>
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        @if(is_array($sectionData))
                                            @foreach($sectionData as $key => $value)
                                                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-2 border-b border-gray-200 last:border-0">
                                                    <span class="font-medium text-gray-600 capitalize">{{ str_replace('_', ' ', $key) }}:</span>
                                                    <span class="md:col-span-2 text-gray-900">{!! displayValue($value) !!}</span>
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="text-gray-600">{!! displayValue($sectionData) !!}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Sponsor Information (AOS) -->
                    @if(isset($applicationData['sponsor']) && !isset($applicationData['beneficiary']))
                        <div class="p-6 border-b">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">
                                <i class="fas fa-users mr-2"></i>Sponsor/Petitioner Information
                            </h4>
                            
                            @foreach($applicationData['sponsor'] as $sectionName => $sectionData)
                                <div class="mb-6">
                                    <h5 class="font-medium text-gray-700 mb-3 capitalize">{{ str_replace('_', ' ', $sectionName) }}</h5>
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        @if(is_array($sectionData))
                                            @foreach($sectionData as $key => $value)
                                                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-2 border-b border-gray-200 last:border-0">
                                                    <span class="font-medium text-gray-600 capitalize">{{ str_replace('_', ' ', $key) }}:</span>
                                                    <span class="md:col-span-2 text-gray-900">{!! displayValue($value) !!}</span>
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="text-gray-600">{!! displayValue($sectionData) !!}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Background Questions -->
                    @if(isset($applicationData['background_questions']))
                        <div class="p-6 border-b">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">
                                <i class="fas fa-clipboard-check mr-2"></i>Background Questions
                            </h4>
                            
                            <div class="bg-gray-50 rounded-lg p-4">
                                @foreach($applicationData['background_questions'] as $key => $value)
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-2 border-b border-gray-200 last:border-0">
                                        <span class="font-medium text-gray-600 capitalize">{{ str_replace('_', ' ', $key) }}:</span>
                                        <span class="md:col-span-2 text-gray-900">
                                            @if($key === 'explanation' && $value)
                                                <div class="whitespace-pre-wrap">{!! displayValue($value) !!}</div>
                                            @else
                                                {!! displayValue($value) !!}
                                            @endif
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Metadata -->
                    @if(isset($applicationData['metadata']))
                        <div class="p-6 bg-gray-50">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">
                                <i class="fas fa-info-circle mr-2"></i>Application Metadata
                            </h4>
                            
                            <div class="bg-white rounded-lg p-4">
                                @foreach($applicationData['metadata'] as $key => $value)
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-2 border-b border-gray-200 last:border-0">
                                        <span class="font-medium text-gray-600 capitalize">{{ str_replace('_', ' ', $key) }}:</span>
                                        <span class="md:col-span-2 text-gray-900">{!! displayValue($value) !!}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @endif

            {{-- FIANCE VISA DATA (OLD SYSTEM) --}}
            @if(isset($applicationData['alien']) || (isset($applicationData['sponsor']) && !isset($applicationData['beneficiary']) && !isset($applicationData['applicant'])))
                <div class="bg-white rounded-lg shadow overflow-hidden print:shadow-none">
                    <div class="bg-blue-50 px-6 py-4 border-b">
                        <h3 class="text-xl font-semibold text-gray-900">
                            <i class="fas fa-ring mr-2"></i>Fiance Visa Application (K-1)
                        </h3>
                    </div>
                   
                    <!-- Sponsor Data -->
                    @if(!empty($applicationData['sponsor']))
                        <div class="p-6 border-b">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">
                                <i class="fas fa-user mr-2"></i>U.S. Sponsor Information
                            </h4>
                            @foreach($applicationData['sponsor'] as $stepName => $stepData)
                                <div class="mb-6">
                                    <h5 class="font-medium text-gray-700 mb-3 capitalize">{{ str_replace('_', ' ', $stepName) }}</h5>
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        @if(is_array($stepData))
                                            @foreach($stepData as $key => $value)
                                                @if(!in_array($key, ['id', '_token', 'name', 'next']))
                                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-2 border-b border-gray-200 last:border-0">
                                                        <span class="font-medium text-gray-600 capitalize">{{ str_replace('_', ' ', $key) }}:</span>
                                                        <span class="md:col-span-2 text-gray-900">{!! displayValue($value) !!}</span>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            <p class="text-gray-600">{!! displayValue($stepData) !!}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Alien Data -->
                    @if(!empty($applicationData['alien']))
                        <div class="p-6 border-b">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">
                                <i class="fas fa-user-tag mr-2"></i>Alien (Fiancé/Fiancée) Information
                            </h4>
                            @foreach($applicationData['alien'] as $stepName => $stepData)
                                <div class="mb-6">
                                    <h5 class="font-medium text-gray-700 mb-3 capitalize">{{ str_replace('_', ' ', $stepName) }}</h5>
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        @if(is_array($stepData))
                                            @foreach($stepData as $key => $value)
                                                @if(!in_array($key, ['id', '_token', 'name', 'next']))
                                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-2 border-b border-gray-200 last:border-0">
                                                        <span class="font-medium text-gray-600 capitalize">{{ str_replace('_', ' ', $key) }}:</span>
                                                        <span class="md:col-span-2 text-gray-900">{!! displayValue($value) !!}</span>
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
                            <h4 class="text-lg font-medium text-gray-900 mb-4">
                                <i class="fas fa-child mr-2"></i>Alien Children Information
                            </h4>
                            @foreach($applicationData['children'] as $stepName => $stepData)
                                <div class="mb-6">
                                    <h5 class="font-medium text-gray-700 mb-3 capitalize">{{ str_replace('_', ' ', $stepName) }}</h5>
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        @if(is_array($stepData))
                                            @foreach($stepData as $key => $value)
                                                @if(!in_array($key, ['id', '_token', 'name', 'next']))
                                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-2 border-b border-gray-200 last:border-0">
                                                        <span class="font-medium text-gray-600 capitalize">{{ str_replace('_', ' ', $key) }}:</span>
                                                        <span class="md:col-span-2 text-gray-900">{!! displayValue($value) !!}</span>
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
            type === 'success' ? 'bg-green-500' : 
            type === 'info' ? 'bg-blue-500' : 'bg-red-500'
        }`;
        notification.textContent = message;
       
        document.body.appendChild(notification);
       
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 3000);
    }
</script>
@endpush