{{-- ================================================================== --}}
{{-- resources/views/admin/partials/flash-messages.blade.php --}}
{{-- ================================================================== --}}

@if(session('success'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
     class="mb-4 flex items-center p-4 bg-emerald-50 border border-emerald-200 rounded-lg">
    <i class="fas fa-check-circle text-emerald-500 mr-3"></i>
    <span class="text-sm text-emerald-700">{{ session('success') }}</span>
    <button @click="show = false" class="ml-auto text-emerald-500 hover:text-emerald-700">
        <i class="fas fa-times"></i>
    </button>
</div>
@endif

@if(session('error'))
<div x-data="{ show: true }" x-show="show"
     class="mb-4 flex items-center p-4 bg-red-50 border border-red-200 rounded-lg">
    <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
    <span class="text-sm text-red-700">{{ session('error') }}</span>
    <button @click="show = false" class="ml-auto text-red-500 hover:text-red-700">
        <i class="fas fa-times"></i>
    </button>
</div>
@endif

@if($errors->any())
<div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
    <div class="flex items-center mb-2">
        <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
        <span class="text-sm font-medium text-red-700">Please fix the following errors:</span>
    </div>
    <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif