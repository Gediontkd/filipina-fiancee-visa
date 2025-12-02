{{-- FILE: resources/views/web/user/progress/spouse-visa.blade.php --}}
{{-- SPOUSE VISA (CR-1/IR-1) PROGRESS CARD --}}

<div class="card mb-3">
    <div class="card-header p-3 bg-primary text-white">
        <h2 class="card-title text-white mb-0">
            <i class="fa fa-heart me-2"></i>Spouse Visa Application (CR-1/IR-1)
        </h2>
    </div>
    <div class="card-body p-3">
        @php
            $spouseApp = \App\Models\SimplifiedSpouseVisaApplication::where('user_id', Auth::id())
                ->where('submitted_app_id', $activeSubmission->id)->first();
        @endphp

        @if($spouseApp)
            <div class="row mb-4">
                <div class="col-md-12">
                    <h6 class="mb-2">Application Progress</h6>
                    <div class="progress" style="height: 30px;">
                        <div class="progress-bar progress-bar-striped {{ $overAll >= 100 ? 'bg-success' : 'bg-info' }}" 
                            role="progressbar" 
                            style="width: {{ $overAll }}%" 
                            aria-valuenow="{{ $overAll }}" 
                            aria-valuemin="0" 
                            aria-valuemax="100">
                            <strong>{{ $overAll }}%</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card border-{{ $spouseApp->sponsor_first_name ? 'success' : 'secondary' }}">
                        <div class="card-body p-3 text-center">
                            <i class="fa fa-user fa-2x mb-2 text-{{ $spouseApp->sponsor_first_name ? 'success' : 'muted' }}"></i>
                            <h6>Sponsor</h6>
                            <span class="badge bg-{{ $spouseApp->sponsor_first_name ? 'success' : 'secondary' }}">
                                {{ $spouseApp->sponsor_first_name ? 'Started' : 'Not Started' }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-{{ $spouseApp->beneficiary_first_name ? 'success' : 'secondary' }}">
                        <div class="card-body p-3 text-center">
                            <i class="fa fa-user-friends fa-2x mb-2 text-{{ $spouseApp->beneficiary_first_name ? 'success' : 'muted' }}"></i>
                            <h6>Beneficiary</h6>
                            <span class="badge bg-{{ $spouseApp->beneficiary_first_name ? 'success' : 'secondary' }}">
                                {{ $spouseApp->beneficiary_first_name ? 'Started' : 'Not Started' }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-{{ $spouseApp->marriage_date ? 'success' : 'secondary' }}">
                        <div class="card-body p-3 text-center">
                            <i class="fa fa-heart fa-2x mb-2 text-{{ $spouseApp->marriage_date ? 'success' : 'muted' }}"></i>
                            <h6>Relationship</h6>
                            <span class="badge bg-{{ $spouseApp->marriage_date ? 'success' : 'secondary' }}">
                                {{ $spouseApp->marriage_date ? 'Started' : 'Not Started' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('spouse-visa-simplified.index') }}" class="btn btn-primary btn-lg">
                    <i class="fa fa-edit me-2"></i>Continue Application
                </a>
                
                @if($spouseApp->status === 'draft')
                    <p class="text-muted mt-2 mb-0">
                        <small>
                            <i class="fa fa-save me-1"></i>
                            Last saved: {{ $spouseApp->updated_at->diffForHumans() }}
                        </small>
                    </p>
                @endif
            </div>
        @else
            <div class="text-center">
                <a href="{{ route('spouse-visa-simplified.index') }}" class="btn btn-primary btn-lg">
                    <i class="fa fa-plus me-2"></i>Start Application
                </a>
            </div>
        @endif
    </div>
</div>