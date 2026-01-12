{{-- resources/views/admin/users/partials/applications-tab.blade.php --}}
<div class="bg-white rounded-xl border border-slate-200">
    <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
        <h3 class="font-semibold text-slate-800">Applications ({{ $user->userSubmittedApplications->count() }})</h3>
    </div>

    @if($user->userSubmittedApplications->count() > 0)
    <div class="divide-y divide-slate-100">
        @foreach($user->userSubmittedApplications as $application)
        <div x-data="{ expanded: false }" class="hover:bg-slate-50">
            <!-- Application Row -->
            <div class="px-6 py-4 flex items-center justify-between cursor-pointer" @click="expanded = !expanded">
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-file-lines text-blue-600"></i>
                    </div>
                    <div>
                        <p class="font-medium text-slate-800">{{ $application->visaApplication?->name ?? 'Application' }}</p>
                        <p class="text-xs text-slate-500">
                            ID: {{ $application->id }} • Submitted {{ $application->created_at->format('M j, Y') }}
                        </p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    @php
                        $statusColors = [
                            'pending' => 'bg-amber-50 text-amber-700 border-amber-200',
                            'under_review' => 'bg-blue-50 text-blue-700 border-blue-200',
                            'approved' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                            'rejected' => 'bg-red-50 text-red-700 border-red-200'
                        ];
                    @endphp
                    <span class="px-3 py-1 text-xs font-medium rounded-full border {{ $statusColors[$application->status] ?? 'bg-slate-100 text-slate-600 border-slate-200' }}">
                        {{ ucfirst(str_replace('_', ' ', $application->status ?? 'pending')) }}
                    </span>
                    <i class="fas fa-chevron-down text-slate-400 transition-transform" :class="expanded && 'rotate-180'"></i>
                </div>
            </div>

            <!-- Expanded Content -->
            <div x-show="expanded" x-collapse class="px-6 pb-6 border-t border-slate-100 bg-slate-50">
                <div class="pt-4 grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Application Details -->
                    <div class="lg:col-span-2 space-y-4">
                        <h4 class="text-sm font-medium text-slate-700">Application Details</h4>
                        <dl class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <dt class="text-slate-500">Transaction ID</dt>
                                <dd class="font-mono text-slate-800">{{ $application->transaction_id ?? 'N/A' }}</dd>
                            </div>
                            <div>
                                <dt class="text-slate-500">Submitted</dt>
                                <dd class="text-slate-800">{{ $application->created_at->format('F j, Y g:i A') }}</dd>
                            </div>
                            @if($application->reviewed_at)
                            <div>
                                <dt class="text-slate-500">Reviewed</dt>
                                <dd class="text-slate-800">{{ $application->reviewed_at->format('F j, Y') }}</dd>
                            </div>
                            <div>
                                <dt class="text-slate-500">Reviewed By</dt>
                                <dd class="text-slate-800">{{ $application->reviewer?->name ?? 'N/A' }}</dd>
                            </div>
                            @endif
                        </dl>

                        @if($application->admin_notes)
                        <div class="mt-4 p-3 bg-white rounded-lg border border-slate-200">
                            <p class="text-xs font-medium text-slate-500 mb-1">Admin Notes</p>
                            <p class="text-sm text-slate-700">{{ $application->admin_notes }}</p>
                        </div>
                        @endif
                    </div>

                    <!-- Actions Panel -->
                    <div class="space-y-4">
                        <h4 class="text-sm font-medium text-slate-700">Actions</h4>
                        
                        <!-- Status Update Form -->
                        <form method="POST" action="{{ route('admin.applications.update-status', $application) }}" class="space-y-3">
                            @csrf @method('PATCH')
                            <div>
                                <label class="block text-xs text-slate-500 mb-1">Update Status</label>
                                <select name="status" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                    <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="under_review" {{ $application->status == 'under_review' ? 'selected' : '' }}>Under Review</option>
                                    <option value="approved" {{ $application->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs text-slate-500 mb-1">Notes</label>
                                <textarea name="admin_notes" rows="2" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Add notes...">{{ $application->admin_notes }}</textarea>
                            </div>
                            <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                Update Status
                            </button>
                        </form>

                        <div class="pt-3 border-t border-slate-200 space-y-2">
                            <a href="{{ route('admin.applications.show', $application) }}" 
                               class="block w-full text-center px-4 py-2 bg-slate-100 text-slate-700 text-sm font-medium rounded-lg hover:bg-slate-200 transition-colors">
                                <i class="fas fa-eye mr-2"></i>View Full Details
                            </a>
                            <a href="{{ route('admin.applications.generate-pdf', $application) }}"
                               class="block w-full text-center px-4 py-2 bg-slate-100 text-slate-700 text-sm font-medium rounded-lg hover:bg-slate-200 transition-colors">
                                <i class="fas fa-file-pdf mr-2"></i>Generate PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="px-6 py-12 text-center">
        <div class="w-16 h-16 mx-auto mb-4 bg-slate-100 rounded-full flex items-center justify-center">
            <i class="fas fa-file-lines text-slate-400 text-2xl"></i>
        </div>
        <h3 class="text-lg font-medium text-slate-800 mb-1">No applications</h3>
        <p class="text-sm text-slate-500">This user hasn't submitted any applications yet</p>
    </div>
    @endif
</div>