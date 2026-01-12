{{-- resources/views/admin/documents/management/index.blade.php --}}
@extends('admin.layouts.app')
@section('title', 'Document Requirements')
@section('page-title', 'Document Requirements')

@section('content')
<div class="space-y-6">
    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white rounded-xl border border-slate-200 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-slate-800">{{ $stats['total_categories'] }}</p>
                    <p class="text-sm text-slate-500">Categories</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center">
                    <i class="fas fa-folder text-blue-500 text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-slate-800">{{ $stats['total_document_types'] }}</p>
                    <p class="text-sm text-slate-500">Document Types</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center">
                    <i class="fas fa-file-lines text-emerald-500 text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-slate-800">{{ $stats['total_uploads'] }}</p>
                    <p class="text-sm text-slate-500">User Uploads</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center">
                    <i class="fas fa-cloud-arrow-up text-purple-500 text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Description -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100 rounded-xl p-5">
        <div class="flex items-start space-x-4">
            <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-info-circle text-blue-600"></i>
            </div>
            <div>
                <h3 class="font-medium text-blue-900">Document Requirements Configuration</h3>
                <p class="text-sm text-blue-700 mt-1">
                    Configure which documents are required for each visa type. Users will see these requirements 
                    in their document upload section and can upload files accordingly.
                </p>
            </div>
        </div>
    </div>

    <!-- Visa Type Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($visaTypes as $key => $label)
        @php
            $typeStats = [
                'categories' => \App\Models\DocumentCategory::where('visa_type', $key)->count(),
                'documents' => \App\Models\DocumentType::whereHas('category', fn($q) => $q->where('visa_type', $key))->count()
            ];
        @endphp
        <a href="{{ route('admin.documents.management.visa-type', $key) }}" 
           class="bg-white rounded-xl border border-slate-200 overflow-hidden hover:border-blue-300 hover:shadow-lg transition-all group">
            <!-- Card Header -->
            <div class="p-6">
                <div class="flex items-center space-x-4">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-passport text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-slate-800 group-hover:text-blue-600 transition-colors">{{ $label }}</h3>
                        <p class="text-sm text-slate-500">{{ $key }}</p>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 grid grid-cols-2 gap-4">
                <div>
                    <p class="text-xl font-bold text-slate-800">{{ $typeStats['categories'] }}</p>
                    <p class="text-xs text-slate-500">Categories</p>
                </div>
                <div>
                    <p class="text-xl font-bold text-slate-800">{{ $typeStats['documents'] }}</p>
                    <p class="text-xs text-slate-500">Documents</p>
                </div>
            </div>

            <!-- Action -->
            <div class="px-6 py-3 border-t border-slate-100 flex items-center justify-between text-sm">
                <span class="text-blue-600 font-medium group-hover:text-blue-700">Manage Requirements</span>
                <i class="fas fa-arrow-right text-blue-400 group-hover:text-blue-600 group-hover:translate-x-1 transition-all"></i>
            </div>
        </a>
        @endforeach
    </div>

    <!-- Quick Tips -->
    <div class="bg-white rounded-xl border border-slate-200 p-6">
        <h3 class="font-semibold text-slate-800 mb-4">
            <i class="fas fa-lightbulb text-amber-500 mr-2"></i>Quick Tips
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="flex items-start space-x-3 p-3 bg-slate-50 rounded-lg">
                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                    <span class="text-blue-600 font-medium text-sm">1</span>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-700">Organize by Category</p>
                    <p class="text-xs text-slate-500 mt-0.5">Group related documents together for easier navigation</p>
                </div>
            </div>
            <div class="flex items-start space-x-3 p-3 bg-slate-50 rounded-lg">
                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                    <span class="text-blue-600 font-medium text-sm">2</span>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-700">Mark Required Docs</p>
                    <p class="text-xs text-slate-500 mt-0.5">Set documents as required to ensure users complete all uploads</p>
                </div>
            </div>
            <div class="flex items-start space-x-3 p-3 bg-slate-50 rounded-lg">
                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                    <span class="text-blue-600 font-medium text-sm">3</span>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-700">Add Descriptions</p>
                    <p class="text-xs text-slate-500 mt-0.5">Help users understand what documents they need to provide</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection