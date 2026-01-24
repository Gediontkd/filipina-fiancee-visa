{{-- resources/views/admin/applications/show.blade.php --}}
@extends('admin.layouts.app')
@section('title', 'Application #' . $application->id)
@section('page-title')
    <div class="flex items-center space-x-3">
        <a href="{{ route('admin.applications.index') }}" class="text-slate-400 hover:text-slate-600">
            <i class="fas fa-arrow-left"></i>
        </a>
        <span>Application Details</span>
    </div>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header Card -->
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <div class="p-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div class="flex items-center space-x-4">
                    @if($application->user)
                    <a href="{{ route('admin.users.show', $application->user) }}" class="flex items-center space-x-4 hover:opacity-80">
                        <div class="w-14 h-14 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white text-xl font-bold">
                            {{ strtoupper(substr($application->user->name, 0, 1)) }}
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-slate-800">{{ $application->user->name }}</h2>
                            <p class="text-slate-500">{{ $application->user->email }}</p>
                        </div>
                    </a>
                    @else
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 rounded-full bg-red-100 flex items-center justify-center">
                            <i class="fas fa-user-slash text-red-500 text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-slate-400">Deleted User</h2>
                            <p class="text-slate-400">User ID: {{ $application->user_id }}</p>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="flex items-center space-x-3">
                    @php $sc = ['pending'=>'bg-amber-50 text-amber-700 border-amber-200','under_review'=>'bg-blue-50 text-blue-700 border-blue-200','approved'=>'bg-emerald-50 text-emerald-700 border-emerald-200','rejected'=>'bg-red-50 text-red-700 border-red-200']; @endphp
                    <span class="px-4 py-2 text-sm font-medium rounded-full border {{ $sc[$application->status] ?? 'bg-slate-100 text-slate-600 border-slate-200' }}">
                        {{ ucfirst(str_replace('_', ' ', $application->status ?? 'pending')) }}
                    </span>
                    <a href="{{ route('admin.applications.generate-pdf', $application) }}"
                       class="px-4 py-2 bg-red-50 text-red-700 rounded-lg text-sm font-medium hover:bg-red-100 transition-colors">
                        <i class="fas fa-file-pdf mr-2"></i>Generate PDF
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Info Bar -->
        <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-slate-200 border-t border-slate-200 bg-slate-50">
            <div class="px-6 py-4">
                <p class="text-xs text-slate-500">Visa Type</p>
                <p class="font-medium text-slate-800">{{ $application->visaApplication?->name ?? 'N/A' }}</p>
            </div>
            <div class="px-6 py-4">
                <p class="text-xs text-slate-500">Submitted</p>
                <p class="font-medium text-slate-800">{{ $application->created_at->format('M j, Y') }}</p>
            </div>
            <div class="px-6 py-4">
                <p class="text-xs text-slate-500">Transaction ID</p>
                <p class="font-mono text-sm text-slate-800">{{ $application->transaction_id ?? 'N/A' }}</p>
            </div>
            <div class="px-6 py-4">
                <p class="text-xs text-slate-500">Reviewed By</p>
                <p class="font-medium text-slate-800">{{ $application->reviewer?->name ?? '—' }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Form Data -->
            <div class="bg-white rounded-xl border border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
                    <h3 class="font-semibold text-slate-800">Application Data</h3>
                    <a href="{{ route('admin.applications.form-data', $application) }}" 
                       class="text-sm text-blue-600 hover:text-blue-700">View Full Data</a>
                </div>
                <div class="p-6">
                    @if($application->formData)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($application->formData->take(8) as $field => $value)
                        <div class="p-3 bg-slate-50 rounded-lg">
                            <p class="text-xs text-slate-500">{{ ucwords(str_replace('_', ' ', $field)) }}</p>
                            <p class="text-sm font-medium text-slate-800 truncate">
                                {{ is_array($value) ? json_encode($value) : $value }}
                            </p>
                        </div>
                        @endforeach
                    </div>
                    @if(count($application->formData) > 8)
                    <p class="text-sm text-slate-500 mt-4 text-center">
                        + {{ count($application->formData) - 8 }} more fields
                    </p>
                    @endif
                    @else
                    <p class="text-sm text-slate-500 text-center py-8">No form data available</p>
                    @endif
                </div>
            </div>

            <!-- Admin Notes -->
            @if($application->admin_notes)
            <div class="bg-white rounded-xl border border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200">
                    <h3 class="font-semibold text-slate-800">Admin Notes</h3>
                </div>
                <div class="p-6">
                    <p class="text-slate-700 whitespace-pre-wrap">{{ $application->admin_notes }}</p>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Update Status -->
            <div class="bg-white rounded-xl border border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200">
                    <h3 class="font-semibold text-slate-800">Update Status</h3>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.applications.update-status', $application) }}" class="space-y-4">
                        @csrf @method('PATCH')
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Status</label>
                            <select name="status" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="under_review" {{ $application->status == 'under_review' ? 'selected' : '' }}>Under Review</option>
                                <option value="approved" {{ $application->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Notes</label>
                            <textarea name="admin_notes" rows="4" 
                                      class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                                      placeholder="Add notes...">{{ $application->admin_notes }}</textarea>
                        </div>
                        <button type="submit" class="w-full px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                            Update Status
                        </button>
                    </form>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl border border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200">
                    <h3 class="font-semibold text-slate-800">Quick Actions</h3>
                </div>
                <div class="p-4 space-y-2">
                    @if($application->user)
                    <a href="{{ route('admin.users.show', $application->user) }}" 
                       class="flex items-center px-4 py-3 rounded-lg bg-slate-50 hover:bg-slate-100 transition-colors">
                        <i class="fas fa-user text-blue-500 w-6"></i>
                        <span class="text-sm font-medium text-slate-700">View User Workspace</span>
                    </a>
                    <a href="{{ route('admin.messages.conversation', [$application->user_id, $application->id]) }}"
                       class="flex items-center px-4 py-3 rounded-lg bg-slate-50 hover:bg-slate-100 transition-colors">
                        <i class="fas fa-envelope text-emerald-500 w-6"></i>
                        <span class="text-sm font-medium text-slate-700">Send Message</span>
                    </a>
                    @endif
                    <a href="{{ route('admin.applications.generate-pdf', $application) }}"
                       class="flex items-center px-4 py-3 rounded-lg bg-slate-50 hover:bg-slate-100 transition-colors">
                        <i class="fas fa-file-pdf text-red-500 w-6"></i>
                        <span class="text-sm font-medium text-slate-700">Generate PDF</span>
                    </a>
                </div>
            </div>

            <!-- Timeline -->
            <div class="bg-white rounded-xl border border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200">
                    <h3 class="font-semibold text-slate-800">Timeline</h3>
                </div>
                <div class="p-6">
                    <div class="relative space-y-4">
                        <div class="absolute left-3 top-0 bottom-0 w-0.5 bg-slate-200"></div>
                        
                        <div class="relative flex items-start space-x-4 pl-1">
                            <div class="w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center ring-4 ring-white">
                                <i class="fas fa-check text-emerald-600 text-xs"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-800">Submitted</p>
                                <p class="text-xs text-slate-500">{{ $application->created_at->format('M j, Y g:i A') }}</p>
                            </div>
                        </div>

                        @if($application->reviewed_at)
                        <div class="relative flex items-start space-x-4 pl-1">
                            <div class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center ring-4 ring-white">
                                <i class="fas fa-eye text-blue-600 text-xs"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-800">Reviewed</p>
                                <p class="text-xs text-slate-500">{{ $application->reviewed_at->format('M j, Y g:i A') }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection