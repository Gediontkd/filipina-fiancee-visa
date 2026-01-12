{{-- resources/views/admin/applications/index.blade.php --}}
@extends('admin.layouts.app')
@section('title', 'Applications')
@section('page-title', 'Applications')

@section('content')
<div class="space-y-6">
    <!-- Stats Row -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        @php
            $pending = $applications->where('status', 'pending')->count();
            $review = $applications->where('status', 'under_review')->count();
            $approved = $applications->where('status', 'approved')->count();
            $rejected = $applications->where('status', 'rejected')->count();
        @endphp
        <a href="{{ route('admin.applications.index', ['status' => 'pending']) }}"
           class="bg-white rounded-xl border border-slate-200 p-4 hover:border-amber-300 hover:shadow-md transition-all {{ request('status') === 'pending' ? 'ring-2 ring-amber-400' : '' }}">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-amber-600">{{ $pending }}</p>
                    <p class="text-xs text-slate-500">Pending</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-amber-50 flex items-center justify-center">
                    <i class="fas fa-clock text-amber-500"></i>
                </div>
            </div>
        </a>
        <a href="{{ route('admin.applications.index', ['status' => 'under_review']) }}"
           class="bg-white rounded-xl border border-slate-200 p-4 hover:border-blue-300 hover:shadow-md transition-all {{ request('status') === 'under_review' ? 'ring-2 ring-blue-400' : '' }}">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-blue-600">{{ $review }}</p>
                    <p class="text-xs text-slate-500">Under Review</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">
                    <i class="fas fa-search text-blue-500"></i>
                </div>
            </div>
        </a>
        <a href="{{ route('admin.applications.index', ['status' => 'approved']) }}"
           class="bg-white rounded-xl border border-slate-200 p-4 hover:border-emerald-300 hover:shadow-md transition-all {{ request('status') === 'approved' ? 'ring-2 ring-emerald-400' : '' }}">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-emerald-600">{{ $approved }}</p>
                    <p class="text-xs text-slate-500">Approved</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-emerald-50 flex items-center justify-center">
                    <i class="fas fa-check text-emerald-500"></i>
                </div>
            </div>
        </a>
        <a href="{{ route('admin.applications.index', ['status' => 'rejected']) }}"
           class="bg-white rounded-xl border border-slate-200 p-4 hover:border-red-300 hover:shadow-md transition-all {{ request('status') === 'rejected' ? 'ring-2 ring-red-400' : '' }}">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-red-600">{{ $rejected }}</p>
                    <p class="text-xs text-slate-500">Rejected</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center">
                    <i class="fas fa-times text-red-500"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <form method="GET" action="{{ route('admin.applications.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div class="md:col-span-2">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Search user name or email..."
                           class="w-full pl-10 pr-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            <div>
                <select name="application_type" class="w-full px-3 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                    <option value="">All Visa Types</option>
                    @foreach($visa_applications as $visa)
                        <option value="{{ $visa }}" {{ request('application_type') == $visa ? 'selected' : '' }}>{{ $visa }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <select name="status" class="w-full px-3 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                    <option value="">All Statuses</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>{{ ucfirst(str_replace('_',' ',$status)) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex space-x-2">
                <button type="submit" class="flex-1 px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium">
                    <i class="fas fa-filter mr-2"></i>Filter
                </button>
                <a href="{{ route('admin.applications.index') }}" class="px-4 py-2.5 bg-slate-100 text-slate-600 rounded-lg hover:bg-slate-200 text-sm">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </form>
    </div>

    <!-- Results -->
    <div class="flex items-center justify-between">
        <p class="text-sm text-slate-500">
            Showing <span class="font-medium text-slate-700">{{ $applications->count() }}</span> of 
            <span class="font-medium text-slate-700">{{ $applications->total() }}</span> applications
        </p>
        <a href="{{ route('admin.applications.export') }}" class="text-sm text-blue-600 hover:text-blue-700">
            <i class="fas fa-download mr-1"></i>Export CSV
        </a>
    </div>

    <!-- Applications Table -->
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        @if($applications->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50 text-xs font-medium text-slate-500 uppercase">
                    <tr>
                        <th class="px-5 py-3 text-left">User</th>
                        <th class="px-5 py-3 text-left">Visa Type</th>
                        <th class="px-5 py-3 text-left">Status</th>
                        <th class="px-5 py-3 text-left">Submitted</th>
                        <th class="px-5 py-3 text-left">Reviewed</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($applications as $app)
                    <tr class="hover:bg-slate-50 group">
                        <td class="px-5 py-4">
                            @if($app->user)
                            <a href="{{ route('admin.users.show', $app->user) }}" class="flex items-center space-x-3 hover:text-blue-600">
                                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white text-sm font-medium">
                                    {{ strtoupper(substr($app->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-slate-800 group-hover:text-blue-600">{{ $app->user->name }}</p>
                                    <p class="text-xs text-slate-500">{{ $app->user->email }}</p>
                                </div>
                            </a>
                            @else
                            <div class="flex items-center space-x-3">
                                <div class="w-9 h-9 rounded-full bg-red-100 flex items-center justify-center">
                                    <i class="fas fa-user-slash text-red-500 text-xs"></i>
                                </div>
                                <span class="text-sm text-slate-400 italic">Deleted User</span>
                            </div>
                            @endif
                        </td>
                        <td class="px-5 py-4">
                            <span class="text-sm text-slate-700">{{ $app->visaApplication?->name ?? 'N/A' }}</span>
                        </td>
                        <td class="px-5 py-4">
                            @php $sc = ['pending'=>'bg-amber-50 text-amber-700','under_review'=>'bg-blue-50 text-blue-700','approved'=>'bg-emerald-50 text-emerald-700','rejected'=>'bg-red-50 text-red-700']; @endphp
                            <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full {{ $sc[$app->status] ?? 'bg-slate-100 text-slate-600' }}">
                                {{ ucfirst(str_replace('_',' ',$app->status ?? 'pending')) }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-sm text-slate-500">
                            <div>{{ $app->created_at->format('M j, Y') }}</div>
                            <div class="text-xs text-slate-400">{{ $app->created_at->diffForHumans() }}</div>
                        </td>
                        <td class="px-5 py-4 text-sm text-slate-500">
                            @if($app->reviewed_at)
                                <div>{{ $app->reviewed_at->format('M j, Y') }}</div>
                                <div class="text-xs text-slate-400">by {{ $app->reviewer?->name ?? 'Admin' }}</div>
                            @else
                                <span class="text-slate-400">—</span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.applications.show', $app) }}" 
                                   class="p-2 text-slate-400 hover:text-blue-600" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($app->user)
                                <button onclick="openStatusModal({{ $app->id }}, '{{ $app->status }}', `{{ addslashes($app->admin_notes ?? '') }}`)"
                                        class="p-2 text-slate-400 hover:text-emerald-600" title="Update Status">
                                    <i class="fas fa-edit"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($applications->hasPages())
        <div class="px-5 py-4 border-t border-slate-200">
            {{ $applications->links() }}
        </div>
        @endif
        @else
        <div class="px-6 py-12 text-center">
            <div class="w-16 h-16 mx-auto mb-4 bg-slate-100 rounded-full flex items-center justify-center">
                <i class="fas fa-file-lines text-slate-400 text-2xl"></i>
            </div>
            <h3 class="text-lg font-medium text-slate-800 mb-1">No applications found</h3>
            <p class="text-sm text-slate-500">Try adjusting your search filters</p>
        </div>
        @endif
    </div>
</div>

<!-- Status Update Modal -->
<div id="status-modal" class="fixed inset-0 z-50 hidden">
    <div class="fixed inset-0 bg-black/50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl max-w-md w-full p-6">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-edit text-blue-600"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-slate-800">Update Status</h3>
                    <p class="text-sm text-slate-500">Change application status</p>
                </div>
            </div>
            <form id="status-form" method="POST">
                @csrf @method('PATCH')
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Status</label>
                        <select id="status-select" name="status" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="pending">Pending</option>
                            <option value="under_review">Under Review</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Notes</label>
                        <textarea id="admin-notes" name="admin_notes" rows="3" 
                                  class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                                  placeholder="Add notes..."></textarea>
                    </div>
                </div>
                <div class="flex space-x-3 mt-6">
                    <button type="button" onclick="closeStatusModal()" 
                            class="flex-1 px-4 py-2.5 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 font-medium">Cancel</button>
                    <button type="submit" class="flex-1 px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function openStatusModal(id, status, notes) {
    document.getElementById('status-form').action = `/admin/applications/${id}/status`;
    document.getElementById('status-select').value = status;
    document.getElementById('admin-notes').value = notes;
    document.getElementById('status-modal').classList.remove('hidden');
}
function closeStatusModal() { document.getElementById('status-modal').classList.add('hidden'); }
document.addEventListener('keydown', e => e.key === 'Escape' && closeStatusModal());
</script>
@endpush