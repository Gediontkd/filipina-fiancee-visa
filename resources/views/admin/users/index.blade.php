{{-- resources/views/admin/users/index.blade.php --}}
@extends('admin.layouts.app')
@section('title', 'Users')
@section('page-title', 'Users')

@section('content')
<div class="space-y-6">
    <!-- Search & Filters -->
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <form method="GET" action="{{ route('admin.users.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Search -->
                <div class="md:col-span-2">
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Search by name or email..."
                               class="w-full pl-10 pr-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                
                <!-- Application Type -->
                <div>
                    <select name="application_type" 
                            class="w-full px-3 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                        <option value="">All Application Types</option>
                        @foreach($application_types as $type)
                            <option value="{{ $type }}" {{ request('application_type') == $type ? 'selected' : '' }}>
                                {{ ucfirst($type) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Actions -->
                <div class="flex items-center space-x-2">
                    <button type="submit" class="flex-1 px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium">
                        <i class="fas fa-search mr-2"></i>Search
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="px-4 py-2.5 bg-slate-100 text-slate-600 rounded-lg hover:bg-slate-200 transition-colors text-sm">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
            </div>
            
            <!-- Expandable Filters -->
            <details class="group">
                <summary class="text-sm text-slate-500 cursor-pointer hover:text-slate-700 list-none flex items-center">
                    <i class="fas fa-sliders mr-2"></i>Advanced Filters
                    <i class="fas fa-chevron-down ml-auto group-open:rotate-180 transition-transform"></i>
                </summary>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4 pt-4 border-t border-slate-200">
                    <div>
                        <label class="block text-xs font-medium text-slate-500 mb-1">From Date</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}"
                               class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-500 mb-1">To Date</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}"
                               class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-500 mb-1">Sort By</label>
                        <select name="sort" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A-Z</option>
                        </select>
                    </div>
                </div>
            </details>
        </form>
    </div>

    <!-- Results Header -->
    <div class="flex items-center justify-between">
        <p class="text-sm text-slate-500">
            Showing <span class="font-medium text-slate-700">{{ $users->count() }}</span> of 
            <span class="font-medium text-slate-700">{{ $users->total() }}</span> users
        </p>
    </div>

    <!-- Users Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        @forelse($users as $user)
        <div class="bg-white rounded-xl border border-slate-200 hover:border-blue-300 hover:shadow-md transition-all group">
            <div class="p-5">
                <div class="flex items-start space-x-4">
                    <!-- Avatar -->
                    <div class="flex-shrink-0">
                        @if($user->image)
                            <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}"
                                 class="w-14 h-14 rounded-full object-cover">
                        @else
                            <div class="w-14 h-14 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white text-lg font-semibold">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    
                    <!-- Info -->
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-slate-800 truncate">{{ $user->name }}</h3>
                        <p class="text-sm text-slate-500 truncate">{{ $user->email }}</p>
                        
                        <div class="flex flex-wrap gap-2 mt-3">
                            @if($user->chosen_application)
                                <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-blue-50 text-blue-700">
                                    {{ ucfirst($user->chosen_application) }}
                                </span>
                            @endif
                            <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-slate-100 text-slate-600">
                                {{ $user->user_submitted_applications_count }} apps
                            </span>
                        </div>
                    </div>
                </div>
                
                <!-- Meta -->
                <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400">
                    <span><i class="far fa-calendar mr-1"></i>{{ $user->created_at->format('M j, Y') }}</span>
                    <span>{{ $user->created_at->diffForHumans() }}</span>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="px-5 py-3 bg-slate-50 rounded-b-xl border-t border-slate-100 flex items-center justify-between">
                <a href="{{ route('admin.users.show', $user) }}" 
                   class="text-sm font-medium text-blue-600 hover:text-blue-700">
                    <i class="fas fa-folder-open mr-1"></i>Open Workspace
                </a>
                <div class="flex items-center space-x-2">
                    <form method="POST" action="{{ route('admin.login-as-user', $user) }}" class="inline">
                        @csrf
                        <button type="submit" class="p-2 text-slate-400 hover:text-blue-600" title="Login as user">
                            <i class="fas fa-right-to-bracket"></i>
                        </button>
                    </form>
                    <button onclick="confirmDelete({{ $user->id }}, '{{ addslashes($user->name) }}')"
                            class="p-2 text-slate-400 hover:text-red-600" title="Delete user">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-white rounded-xl border border-slate-200 p-12 text-center">
            <div class="w-16 h-16 mx-auto mb-4 bg-slate-100 rounded-full flex items-center justify-center">
                <i class="fas fa-users text-slate-400 text-2xl"></i>
            </div>
            <h3 class="text-lg font-medium text-slate-800 mb-1">No users found</h3>
            <p class="text-sm text-slate-500">Try adjusting your search filters</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($users->hasPages())
    <div class="flex justify-center">
        {{ $users->links() }}
    </div>
    @endif
</div>

<!-- Delete Modal -->
<div id="delete-modal" class="fixed inset-0 z-50 hidden" x-data>
    <div class="fixed inset-0 bg-black/50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl max-w-md w-full p-6">
            <div class="text-center mb-6">
                <div class="w-14 h-14 mx-auto mb-4 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-slate-800">Delete User</h3>
                <p class="text-sm text-slate-500 mt-1">
                    Are you sure you want to delete <strong id="delete-user-name"></strong>? This cannot be undone.
                </p>
            </div>
            <div class="flex space-x-3">
                <button onclick="closeDeleteModal()" 
                        class="flex-1 px-4 py-2.5 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 font-medium">
                    Cancel
                </button>
                <form id="delete-form" method="POST" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full px-4 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmDelete(id, name) {
    document.getElementById('delete-user-name').textContent = name;
    document.getElementById('delete-form').action = `/admin/users/${id}`;
    document.getElementById('delete-modal').classList.remove('hidden');
}
function closeDeleteModal() {
    document.getElementById('delete-modal').classList.add('hidden');
}
document.addEventListener('keydown', e => e.key === 'Escape' && closeDeleteModal());
</script>
@endpush