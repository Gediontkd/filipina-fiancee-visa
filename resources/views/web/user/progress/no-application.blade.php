{{-- FILE: resources/views/web/user/progress/no-application.blade.php --}}
{{-- NO APPLICATION - User hasn't started yet --}}

<div class="card">
    <div class="card-body p-4 text-center">
        <i class="fa fa-exclamation-circle fa-3x text-warning mb-3"></i>
        <h4>No Application in Progress</h4>
        <p class="text-muted">You haven't started an application yet.</p>
        <a href="{{ route('service') }}" class="btn btn-primary mt-3">
            <i class="fa fa-plus me-2"></i>Start New Application
        </a>
    </div>
</div>