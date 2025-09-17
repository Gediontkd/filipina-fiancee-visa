{{-- resources/views/web/messages/index.blade.php --}}
@extends('web.layout.master')

@section('content')
<section class="myaccount ptb-80 bg-lightgrey">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-xl-3 col-xxl-3 col-md-4 mb-mob-15">
                @include('web.component.profile-sidebar')
            </div>
            <div class="col-lg-8 col-xl-9 col-xxl-9 col-md-9">
                <!-- Header with Stats -->
                <div class="card mb-3">
                    <div class="card-header p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="card-title mb-0">Messages</h2>
                            <a href="{{ route('messages.compose') }}" class="btn btn-tra-primary">
                                <i class="fa fa-plus me-2"></i>New Message
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="row text-center">
                            <div class="col-md-3">
                                <div class="border-end pe-3">
                                    <h4 class="text-primary mb-1">{{ $stats['total_messages'] }}</h4>
                                    <small class="text-muted">Total Messages</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="border-end pe-3">
                                    <h4 class="text-warning mb-1">{{ $stats['unread_messages'] }}</h4>
                                    <small class="text-muted">Unread</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="border-end pe-3">
                                    <h4 class="text-success mb-1">{{ $stats['from_admin'] }}</h4>
                                    <small class="text-muted">From Support</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <h4 class="text-info mb-1">{{ $applications->count() }}</h4>
                                <small class="text-muted">Applications</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="card mb-3">
                    <div class="card-body p-3">
                        <form method="GET" action="{{ route('messages.index') }}" class="row align-items-end">
                            <div class="col-md-4">
                                <label for="application_id" class="form-label small">Filter by Application</label>
                                <select id="application_id" name="application_id" class="form-select">
                                    <option value="">All Applications</option>
                                    @foreach($applications as $app)
                                        <option value="{{ $app->id }}" {{ request('application_id') == $app->id ? 'selected' : '' }}>
                                            {{ $app->visaApplication->name ?? 'Application' }} #{{ $app->id }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="read_status" class="form-label small">Status</label>
                                <select id="read_status" name="read_status" class="form-select">
                                    <option value="">All Messages</option>
                                    <option value="unread" {{ request('read_status') == 'unread' ? 'selected' : '' }}>Unread</option>
                                    <option value="read" {{ request('read_status') == 'read' ? 'selected' : '' }}>Read</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-outline-primary">
                                        <i class="fa fa-filter me-1"></i>Filter
                                    </button>
                                    <a href="{{ route('messages.index') }}" class="btn btn-outline-secondary">
                                        <i class="fa fa-times me-1"></i>Clear
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Messages List -->
                <div class="card">
                    <div class="card-body p-0">
                        @if($messages->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Subject</th>
                                            <th>Application</th>
                                            <th>From</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($messages as $message)
                                            <tr class="{{ $message->isRead() ? '' : 'table-info' }}">
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if(!$message->isRead())
                                                            <span class="badge bg-warning me-2">New</span>
                                                        @endif
                                                        @if($message->is_important)
                                                            <i class="fa fa-exclamation-triangle text-danger me-2" title="Important"></i>
                                                        @endif
                                                        <div>
                                                            <h6 class="mb-1">{{ $message->subject }}</h6>
                                                            <small class="text-muted">{{ Str::limit($message->message, 80) }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-primary">
                                                        {{ $message->application->visaApplication->name ?? 'N/A' }}
                                                    </span>
                                                    <br>
                                                    <small class="text-muted">#{{ $message->application_id }}</small>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if($message->isFromAdmin())
                                                            <i class="fa fa-user-shield text-purple me-2"></i>
                                                            <span class="text-success">Support Team</span>
                                                        @else
                                                            <i class="fa fa-user text-blue me-2"></i>
                                                            <span>You</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        {{ $message->created_at->format('M j, Y') }}
                                                        <br>
                                                        <small class="text-muted">{{ $message->created_at->format('g:i A') }}</small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        @if($message->hasAttachments())
                                                            <small class="text-info">
                                                                <i class="fa fa-paperclip me-1"></i>{{ $message->attachment_count }} files
                                                            </small>
                                                        @endif
                                                        <span class="badge {{ $message->priority === 'high' ? 'bg-danger' : ($message->priority === 'normal' ? 'bg-info' : 'bg-secondary') }}">
                                                            {{ ucfirst($message->priority) }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <a href="{{ route('messages.conversation', $message->application_id) }}" 
                                                           class="btn btn-sm btn-outline-primary" title="View Conversation">
                                                            <i class="fa fa-comments"></i>
                                                        </a>
                                                        @if(!$message->isRead())
                                                            <button onclick="markAsRead({{ $message->id }})" 
                                                                    class="btn btn-sm btn-outline-success" title="Mark as Read">
                                                                <i class="fa fa-check"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            @if($messages->hasPages())
                                <div class="p-3 border-top">
                                    {{ $messages->appends(request()->query())->links() }}
                                </div>
                            @endif
                        @else
                            <div class="text-center py-5">
                                <i class="fa fa-inbox fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">No Messages Found</h5>
                                <p class="text-muted mb-3">You don't have any messages yet.</p>
                                <a href="{{ route('messages.compose') }}" class="btn btn-tra-primary">
                                    <i class="fa fa-plus me-2"></i>Send Your First Message
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customScript')
<script>
    function markAsRead(messageId) {
        fetch(`/messages/${messageId}/mark-read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to mark message as read');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to mark message as read');
        });
    }

    // Auto-refresh unread count every 30 seconds
    setInterval(() => {
        fetch('/messages/unread-count')
            .then(response => response.json())
            .then(data => {
                // Update any unread count badges in the UI
                const badges = document.querySelectorAll('.unread-count');
                badges.forEach(badge => {
                    badge.textContent = data.unread_count;
                    badge.style.display = data.unread_count > 0 ? 'inline' : 'none';
                });
            })
            .catch(error => console.error('Error fetching unread count:', error));
    }, 30000);
</script>
@endsection