@extends('admin.layouts.app')
@section('title', 'Document Management')
@section('page-title', 'Document Management System')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4">Manage Document Requirements by Visa Type</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
            <div class="bg-blue-50 p-4 rounded-lg">
                <div class="text-2xl font-bold text-blue-600">{{ $stats['total_categories'] }}</div>
                <div class="text-sm text-gray-600">Total Categories</div>
            </div>
            <div class="bg-green-50 p-4 rounded-lg">
                <div class="text-2xl font-bold text-green-600">{{ $stats['total_document_types'] }}</div>
                <div class="text-sm text-gray-600">Total Document Types</div>
            </div>
            <div class="bg-purple-50 p-4 rounded-lg">
                <div class="text-2xl font-bold text-purple-600">{{ $stats['total_uploads'] }}</div>
                <div class="text-sm text-gray-600">Total User Uploads</div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($visaTypes as $key => $label)
                <a href="{{ route('admin.documents.management.visa-type', $key) }}" 
                   class="block p-6 bg-white border-2 border-gray-200 rounded-lg hover:border-blue-500 hover:shadow-lg transition-all">
                    <h4 class="font-semibold text-lg mb-2">{{ $label }}</h4>
                    <p class="text-sm text-gray-600">Manage requirements for this visa type</p>
                    <div class="mt-4 flex items-center text-blue-600">
                        <span class="text-sm">Manage →</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection