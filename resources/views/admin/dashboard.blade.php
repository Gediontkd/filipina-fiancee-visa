{{-- resources/views/admin/dashboard.blade.php --}}
@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Quick Stats -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        @include('admin.partials.stat-card', [
            'label' => 'Total Users',
            'value' => $stats['total_users'],
            'icon' => 'fa-users',
            'bgColor' => 'bg-blue-50',
            'iconColor' => 'text-blue-500'
        ])
        @include('admin.partials.stat-card', [
            'label' => 'Pending Review',
            'value' => $stats['pending_applications'],
            'icon' => 'fa-clock',
            'bgColor' => 'bg-amber-50',
            'iconColor' => 'text-amber-500',
            'sublabel' => 'Applications awaiting action'
        ])
        @include('admin.partials.stat-card', [
            'label' => 'Approved',
            'value' => $stats['approved_applications'],
            'icon' => 'fa-check-circle',
            'bgColor' => 'bg-emerald-50',
            'iconColor' => 'text-emerald-500'
        ])
        @include('admin.partials.stat-card', [
            'label' => 'Unverified Docs',
            'value' => \App\Models\DropBox::where('is_verified', false)->count(),
            'icon' => 'fa-file-circle-question',
            'bgColor' => 'bg-purple-50',
            'iconColor' => 'text-purple-500'
        ])
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <!-- Recent Users - Takes 2 columns -->
        <div class="xl:col-span-2 bg-white rounded-xl border border-slate-200">
            <div class="px-5 py-4 border-b border-slate-200 flex items-center justify-between">
                <h2 class="font-semibold text-slate-800">Recent Users</h2>
                <a href="{{ route('admin.users.index') }}" class="text-sm text-blue-600 hover:text-blue-700">
                    View all <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="divide-y divide-slate-100">
                @forelse($recent_users as $user)
                <a href="{{ route('admin.users.show', $user) }}" 
                   class="flex items-center px-5 py-4 hover:bg-slate-50 transition-colors">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-medium">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="ml-4 flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-800 truncate">{{ $user->name }}</p>
                        <p class="text-xs text-slate-500 truncate">{{ $user->email }}</p>
                    </div>
                    <div class="text-right">
                        @if($user->chosen_application)
                            <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-blue-50 text-blue-700">
                                {{ ucfirst($user->chosen_application) }}
                            </span>
                        @endif
                        <p class="text-xs text-slate-400 mt-1">{{ $user->created_at->diffForHumans() }}</p>
                    </div>
                </a>
                @empty
                <div class="px-5 py-8 text-center text-slate-500">
                    <i class="fas fa-users text-3xl mb-2 opacity-30"></i>
                    <p>No recent users</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Quick Actions & Application Distribution -->
        <div class="space-y-6">
            <!-- Quick Actions -->
            <div class="bg-white rounded-xl border border-slate-200 p-5">
                <h2 class="font-semibold text-slate-800 mb-4">Quick Actions</h2>
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('admin.applications.index', ['status' => 'pending']) }}"
                       class="flex flex-col items-center p-4 rounded-lg bg-amber-50 hover:bg-amber-100 transition-colors">
                        <i class="fas fa-clock text-amber-600 text-xl mb-2"></i>
                        <span class="text-xs font-medium text-amber-700">Pending Apps</span>
                    </a>
                    <a href="{{ route('admin.documents.uploaded.index', ['verification_status' => 'unverified']) }}"
                       class="flex flex-col items-center p-4 rounded-lg bg-purple-50 hover:bg-purple-100 transition-colors">
                        <i class="fas fa-file-circle-check text-purple-600 text-xl mb-2"></i>
                        <span class="text-xs font-medium text-purple-700">Verify Docs</span>
                    </a>
                    <a href="{{ route('admin.messages.index', ['read_status' => 'unread']) }}"
                       class="flex flex-col items-center p-4 rounded-lg bg-blue-50 hover:bg-blue-100 transition-colors">
                        <i class="fas fa-envelope text-blue-600 text-xl mb-2"></i>
                        <span class="text-xs font-medium text-blue-700">Unread Msgs</span>
                    </a>
                    <a href="{{ route('admin.monitoring.index') }}"
                       class="flex flex-col items-center p-4 rounded-lg bg-emerald-50 hover:bg-emerald-100 transition-colors">
                        <i class="fas fa-bell text-emerald-600 text-xl mb-2"></i>
                        <span class="text-xs font-medium text-emerald-700">Alerts</span>
                    </a>
                </div>
            </div>

            <!-- Application Distribution -->
            <div class="bg-white rounded-xl border border-slate-200 p-5">
                <h2 class="font-semibold text-slate-800 mb-4">Application Types</h2>
                @if(!empty($application_stats))
                    @php $total = array_sum($application_stats); @endphp
                    <div class="space-y-3">
                        @foreach($application_stats as $type => $count)
                        @php $pct = $total > 0 ? round(($count / $total) * 100) : 0; @endphp
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-slate-600">{{ ucwords($type) }}</span>
                                <span class="font-medium text-slate-800">{{ $count }}</span>
                            </div>
                            <div class="h-2 bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full bg-blue-500 rounded-full" style="width: {{ $pct }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-slate-500 text-center py-4">No data available</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Recent Applications -->
    <div class="bg-white rounded-xl border border-slate-200">
        <div class="px-5 py-4 border-b border-slate-200 flex items-center justify-between">
            <h2 class="font-semibold text-slate-800">Recent Applications</h2>
            <a href="{{ route('admin.applications.index') }}" class="text-sm text-blue-600 hover:text-blue-700">
                View all <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50 text-xs font-medium text-slate-500 uppercase">
                    <tr>
                        <th class="px-5 py-3 text-left">User</th>
                        <th class="px-5 py-3 text-left">Type</th>
                        <th class="px-5 py-3 text-left">Status</th>
                        <th class="px-5 py-3 text-left">Submitted</th>
                        <th class="px-5 py-3 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recent_applications as $app)
                    <tr class="hover:bg-slate-50">
                        <td class="px-5 py-4">
                            @if($app->user)
                                <p class="text-sm font-medium text-slate-800">{{ $app->user->name }}</p>
                                <p class="text-xs text-slate-500">{{ $app->user->email }}</p>
                            @else
                                <p class="text-sm text-slate-400 italic">Deleted User</p>
                            @endif
                        </td>
                        <td class="px-5 py-4">
                            <span class="text-sm text-slate-600">{{ $app->visaApplication?->name ?? 'N/A' }}</span>
                        </td>
                        <td class="px-5 py-4">
                            @php
                                $statusStyles = [
                                    'pending' => 'bg-amber-50 text-amber-700',
                                    'under_review' => 'bg-blue-50 text-blue-700',
                                    'approved' => 'bg-emerald-50 text-emerald-700',
                                    'rejected' => 'bg-red-50 text-red-700'
                                ];
                            @endphp
                            <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full {{ $statusStyles[$app->status] ?? 'bg-slate-100 text-slate-600' }}">
                                {{ ucfirst(str_replace('_', ' ', $app->status ?? 'pending')) }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-sm text-slate-500">{{ $app->created_at->diffForHumans() }}</td>
                        <td class="px-5 py-4 text-right">
                            <a href="{{ route('admin.applications.show', $app) }}" 
                               class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                View
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-5 py-8 text-center text-slate-500">
                            No recent applications
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection