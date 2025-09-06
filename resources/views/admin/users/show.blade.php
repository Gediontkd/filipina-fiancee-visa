{{-- resources/views/admin/users/show.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'User Details')
@section('page-title', 'User Details')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.users.index') }}" 
               class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-2">
                <i class="fas fa-arrow-left mr-2"></i>Back to Users
            </a>
            <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
        </div>
        
        <div class="flex space-x-3">
            <a href="{{ route('admin.users.edit', $user) }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                <i class="fas fa-edit mr-2"></i>Edit User
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- User Information -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">User Information</h3>
                
                <div class="flex items-center mb-6">
                    <div class="flex-shrink-0">
                        @if($user->image)
                            <img class="h-16 w-16 rounded-full object-cover" 
                                 src="{{ asset('storage/' . $user->image) }}" 
                                 alt="{{ $user->name }}">
                        @else
                            <div class="h-16 w-16 rounded-full bg-gray-200 flex items-center justify-center">
                                <span class="text-xl font-medium text-gray-600">
                                    {{ substr($user->name, 0, 2) }}
                                </span>
                            </div>
                        @endif
                    </div>
                    <div class="ml-6">
                        <h2 class="text-xl font-bold text-gray-900">{{ $user->name }}</h2>
                        <p class="text-gray-500">{{ $user->email }}</p>
                        <p class="text-sm text-gray-400">User ID: {{ $user->id }}</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Email Address</label>
                        <p class="text-gray-900">{{ $user->email }}</p>
                        @if($user->email_verified_at)
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 mt-1">
                                <i class="fas fa-check-circle mr-1"></i>Verified
                            </span>
                        @else
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 mt-1">
                                <i class="fas fa-clock mr-1"></i>Unverified
                            </span>
                        @endif
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Registration Date</label>
                        <p class="text-gray-900">{{ $user->created_at->format('M j, Y H:i') }}</p>
                        <p class="text-xs text-gray-500">{{ $user->created_at->diffForHumans() }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Chosen Application</label>
                        @if($user->chosen_application)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ ucfirst($user->chosen_application) }}
                            </span>
                        @else
                            <span class="text-gray-400">Not selected</span>
                        @endif
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Application Route</label>
                        <p class="text-gray-900 text-sm font-mono">{{ $user->application_route ?? 'N/A' }}</p>
                    </div>
                    
                    @if($user->stripe_customer_id)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Stripe Customer ID</label>
                            <p class="text-gray-900 font-mono text-sm">{{ $user->stripe_customer_id }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Submitted Applications -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Submitted Applications</h3>
                    <span class="text-sm text-gray-500">{{ $user->userSubmittedApplications->count() }} total</span>
                </div>
                
                @if($user->userSubmittedApplications->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Application</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Submitted</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($user->userSubmittedApplications as $application)
                                    <tr>
                                        <td class="px-4 py-2 text-sm">
                                            <span class="font-medium text-gray-900">
                                                {{ $application->visaApplication->name ?? 'N/A' }}
                                            </span>
                                            @if($application->transaction_id)
                                                <div class="text-xs text-gray-500 font-mono">
                                                    {{ substr($application->transaction_id, 0, 15) }}...
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 text-sm">
                                            @php
                                                $status_colors = [
                                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                                    'under_review' => 'bg-blue-100 text-blue-800',
                                                    'approved' => 'bg-green-100 text-green-800',
                                                    'rejected' => 'bg-red-100 text-red-800'
                                                ];
                                                $status = $application->status ?? 'pending';
                                            @endphp
                                            
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $status_colors[$status] ?? 'bg-gray-100 text-gray-800' }}">
                                                {{ ucfirst(str_replace('_', ' ', $status)) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2 text-sm text-gray-500">
                                            {{ $application->created_at->format('M j, Y') }}
                                        </td>
                                        <td class="px-4 py-2 text-sm">
                                            <a href="{{ route('admin.applications.show', $application) }}" 
                                               class="text-blue-600 hover:text-blue-800">
                                                <i class="fas fa-eye mr-1"></i>View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-file-alt text-3xl mb-2"></i>
                        <p>No applications submitted yet</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Account Status -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Account Status</h3>
                
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500">Status:</span>
                        <span class="text-sm font-medium text-green-600">Active</span>
                    </div>
                    
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500">Email Verified:</span>
                        <span class="text-sm font-medium {{ $user->email_verified_at ? 'text-green-600' : 'text-yellow-600' }}">
                            {{ $user->email_verified_at ? 'Yes' : 'No' }}
                        </span>
                    </div>
                    
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500">Applications:</span>
                        <span class="text-sm font-medium text-gray-900">{{ $user->userSubmittedApplications->count() }}</span>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistics</h3>
                
                <div class="space-y-4">
                    @php
                        $applications = $user->userSubmittedApplications;
                        $pending = $applications->where('status', 'pending')->count();
                        $approved = $applications->where('status', 'approved')->count();
                        $rejected = $applications->where('status', 'rejected')->count();
                    @endphp
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Pending</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            {{ $pending }}
                        </span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Approved</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            {{ $approved }}
                        </span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Rejected</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            {{ $rejected }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                
                <div class="space-y-3">
                    <a href="{{ route('admin.users.edit', $user) }}" 
                       class="block w-full text-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                        <i class="fas fa-edit mr-2"></i>Edit User
                    </a>
                    
                    @if($user->userSubmittedApplications->count() == 0)
                        <button onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}')" 
                                class="block w-full text-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                            <i class="fas fa-trash mr-2"></i>Delete User
                        </button>
                    @else
                        <div class="text-xs text-gray-500 text-center">
                            Cannot delete user with submitted applications
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="delete-modal" class="fixed inset-0 z-50 hidden">
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg max-w-md w-full p-6">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Delete User</h3>
                    <p class="text-sm text-gray-500">This action cannot be undone</p>
                </div>
            </div>
            
            <p class="text-gray-700 mb-6">Are you sure you want to delete <strong id="delete-user-name"></strong>?</p>
            
            <div class="flex justify-end space-x-3">
                <button onclick="closeDeleteModal()" 
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                    Cancel
                </button>
                
                <form id="delete-form" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                        Delete User
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function confirmDelete(userId, userName) {
        document.getElementById('delete-user-name').textContent = userName;
        document.getElementById('delete-form').action = `/admin/users/${userId}`;
        document.getElementById('delete-modal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('delete-modal').classList.add('hidden');
    }

    // Close modal on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeleteModal();
        }
    });

    // Close modal on backdrop click
    document.getElementById('delete-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });
</script>
@endpush