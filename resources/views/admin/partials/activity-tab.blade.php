{{-- resources/views/admin/users/partials/activity-tab.blade.php --}}
@php
    // Build activity timeline from various sources
    $activities = collect();
    
    // Registration
    $activities->push([
        'type' => 'registration',
        'icon' => 'fa-user-plus',
        'color' => 'bg-emerald-100 text-emerald-600',
        'title' => 'Account Created',
        'description' => 'User registered for an account',
        'date' => $user->created_at
    ]);
    
    // Application selection
    if($user->chosen_application) {
        $activities->push([
            'type' => 'selection',
            'icon' => 'fa-hand-pointer',
            'color' => 'bg-blue-100 text-blue-600',
            'title' => 'Selected Application Type',
            'description' => 'Chose ' . ucfirst($user->chosen_application) . ' application',
            'date' => $user->created_at->addMinutes(1)
        ]);
    }
    
    // Applications
    foreach($user->userSubmittedApplications as $app) {
        $activities->push([
            'type' => 'application',
            'icon' => 'fa-file-lines',
            'color' => 'bg-purple-100 text-purple-600',
            'title' => 'Application Submitted',
            'description' => ($app->visaApplication?->name ?? 'Application') . ' - Status: ' . ucfirst(str_replace('_',' ',$app->status)),
            'date' => $app->created_at,
            'link' => route('admin.applications.show', $app)
        ]);
        
        if($app->reviewed_at) {
            $activities->push([
                'type' => 'review',
                'icon' => 'fa-clipboard-check',
                'color' => $app->status === 'approved' ? 'bg-emerald-100 text-emerald-600' : ($app->status === 'rejected' ? 'bg-red-100 text-red-600' : 'bg-blue-100 text-blue-600'),
                'title' => 'Application Reviewed',
                'description' => 'Status changed to ' . ucfirst(str_replace('_',' ',$app->status)) . ' by ' . ($app->reviewer?->name ?? 'Admin'),
                'date' => $app->reviewed_at
            ]);
        }
    }
    
    // Documents
    foreach($user->dropboxFiles as $doc) {
        $activities->push([
            'type' => 'document',
            'icon' => 'fa-cloud-arrow-up',
            'color' => 'bg-amber-100 text-amber-600',
            'title' => 'Document Uploaded',
            'description' => $doc->original_filename,
            'date' => $doc->created_at
        ]);
        
        if($doc->is_verified && $doc->verified_at) {
            $activities->push([
                'type' => 'verification',
                'icon' => 'fa-circle-check',
                'color' => 'bg-emerald-100 text-emerald-600',
                'title' => 'Document Verified',
                'description' => $doc->original_filename . ' was verified',
                'date' => $doc->verified_at
            ]);
        }
    }
    
    // Messages sent by user
    foreach($user->messages->where('sender_type', 'user') as $msg) {
        $activities->push([
            'type' => 'message',
            'icon' => 'fa-envelope',
            'color' => 'bg-sky-100 text-sky-600',
            'title' => 'Message Sent',
            'description' => $msg->subject,
            'date' => $msg->created_at
        ]);
    }
    
    // Sort by date descending
    $activities = $activities->sortByDesc('date')->values();
@endphp

<div class="bg-white rounded-xl border border-slate-200">
    <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
        <h3 class="font-semibold text-slate-800">Activity Timeline</h3>
        <span class="text-sm text-slate-500">{{ $activities->count() }} events</span>
    </div>

    @if($activities->count() > 0)
    <div class="p-6">
        <div class="relative">
            <!-- Timeline line -->
            <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-slate-200"></div>

            <!-- Timeline items -->
            <div class="space-y-6">
                @foreach($activities as $activity)
                <div class="relative flex items-start space-x-4 pl-2">
                    <!-- Icon -->
                    <div class="relative z-10 flex-shrink-0 w-8 h-8 rounded-full {{ $activity['color'] }} flex items-center justify-center ring-4 ring-white">
                        <i class="fas {{ $activity['icon'] }} text-xs"></i>
                    </div>

                    <!-- Content -->
                    <div class="flex-1 min-w-0 pt-0.5">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-slate-800">{{ $activity['title'] }}</p>
                            <time class="text-xs text-slate-400">{{ $activity['date']->format('M j, Y') }}</time>
                        </div>
                        <p class="text-sm text-slate-600 mt-0.5">{{ $activity['description'] }}</p>
                        @if(isset($activity['link']))
                            <a href="{{ $activity['link'] }}" class="inline-flex items-center text-xs text-blue-600 hover:text-blue-700 mt-1">
                                View details <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        @endif
                        <p class="text-xs text-slate-400 mt-1">{{ $activity['date']->diffForHumans() }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @else
    <div class="px-6 py-12 text-center">
        <div class="w-16 h-16 mx-auto mb-4 bg-slate-100 rounded-full flex items-center justify-center">
            <i class="fas fa-clock-rotate-left text-slate-400 text-2xl"></i>
        </div>
        <h3 class="text-lg font-medium text-slate-800 mb-1">No activity</h3>
        <p class="text-sm text-slate-500">No recorded activity for this user yet</p>
    </div>
    @endif
</div>