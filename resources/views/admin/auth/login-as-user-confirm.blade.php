@extends('admin.layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-4">Login as User</h2>
        <p class="mb-4">Are you sure you want to login as <strong>{{ $user->name }}</strong>?</p>
        
        <form method="POST" action="{{ route('admin.login-as-user', $user->id) }}">
            @csrf
            <div class="flex gap-3">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    Confirm Login
                </button>
                <a href="{{ route('admin.users.show', $user) }}" 
                   class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection