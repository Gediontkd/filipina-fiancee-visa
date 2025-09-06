{{-- resources/views/admin/users/edit.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Edit User')
@section('page-title', 'Edit User')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.users.show', $user) }}" 
               class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-2">
                <i class="fas fa-arrow-left mr-2"></i>Back to User Details
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Edit User: {{ $user->name }}</h1>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Full Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $user->name) }}" 
                           required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email Address <span class="text-red-500">*</span>
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email', $user->email) }}" 
                           required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Chosen Application -->
                <div>
                    <label for="chosen_application" class="block text-sm font-medium text-gray-700 mb-2">
                        Chosen Application
                    </label>
                    <select id="chosen_application" 
                            name="chosen_application"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('chosen_application') border-red-500 @enderror">
                        <option value="">Not Selected</option>
                        <option value="fiance" {{ old('chosen_application', $user->chosen_application) == 'fiance' ? 'selected' : '' }}>
                            Fiancé Visa
                        </option>
                        <option value="spouse" {{ old('chosen_application', $user->chosen_application) == 'spouse' ? 'selected' : '' }}>
                            Spouse Visa
                        </option>
                        <option value="adjustment" {{ old('chosen_application', $user->chosen_application) == 'adjustment' ? 'selected' : '' }}>
                            Adjustment of Status
                        </option>
                    </select>
                    @error('chosen_application')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Application Route -->
                <div>
                    <label for="application_route" class="block text-sm font-medium text-gray-700 mb-2">
                        Application Route
                    </label>
                    <input type="text" 
                           id="application_route" 
                           name="application_route" 
                           value="{{ old('application_route', $user->application_route) }}"
                           placeholder="e.g. fiancee.visa, spouse.visa"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('application_route') border-red-500 @enderror">
                    @error('application_route')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Password Section -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Change Password (Optional)</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- New Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            New Password
                        </label>
                        <input type="password" 
                               id="password" 
                               name="password"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror">
                        <p class="mt-1 text-xs text-gray-500">Leave blank to keep current password</p>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Confirm New Password
                        </label>
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Additional Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Stripe Customer ID -->
                    <div>
                        <label for="stripe_customer_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Stripe Customer ID
                        </label>
                        <input type="text" 
                               id="stripe_customer_id" 
                               name="stripe_customer_id" 
                               value="{{ old('stripe_customer_id', $user->stripe_customer_id) }}"
                               readonly
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-500 font-mono text-sm">
                        <p class="mt-1 text-xs text-gray-500">This field is read-only and managed by Stripe</p>
                    </div>

                    <!-- Registration Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Registration Date
                        </label>
                        <div class="px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-500">
                            {{ $user->created_at->format('M j, Y H:i') }} ({{ $user->created_at->diffForHumans() }})
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.users.show', $user) }}" 
                   class="px-6 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                    <i class="fas fa-save mr-2"></i>Save Changes
                </button>
            </div>
        </form>
    </div>

    <!-- User Statistics -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">User Statistics</h3>
        
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
            <div class="text-center">
                <div class="text-2xl font-bold text-blue-600">{{ $user->userSubmittedApplications->count() }}</div>
                <div class="text-sm text-gray-500">Total Applications</div>
            </div>
            
            @php
                $applications = $user->userSubmittedApplications;
                $pending = $applications->where('status', 'pending')->count();
                $approved = $applications->where('status', 'approved')->count();
                $rejected = $applications->where('status', 'rejected')->count();
            @endphp
            
            <div class="text-center">
                <div class="text-2xl font-bold text-yellow-600">{{ $pending }}</div>
                <div class="text-sm text-gray-500">Pending</div>
            </div>
            
            <div class="text-center">
                <div class="text-2xl font-bold text-green-600">{{ $approved }}</div>
                <div class="text-sm text-gray-500">Approved</div>
            </div>
            
            <div class="text-center">
                <div class="text-2xl font-bold text-red-600">{{ $rejected }}</div>
                <div class="text-sm text-gray-500">Rejected</div>
            </div>
        </div>
    </div>
</div>
@endsection