{{-- FILE: resources/views/web/user/progress/adjustment-of-status.blade.php --}}
{{-- ADJUSTMENT OF STATUS (I-485) PROGRESS CARD --}}

<div class="card mb-3">
    <div class="card-header p-3 bg-success text-white">
        <h2 class="card-title text-white mb-0">
            <i class="fa fa-id-card me-2"></i>Adjustment of Status Application (I-485)
        </h2>
    </div>
    <div class="card-body p-3">
        @php
            $aosApp = \App\Models\SimplifiedAosApplication::where('user_id', Auth::id())
                ->where('submitted_app_id', $activeSubmission->id)->first();
        @endphp

        @if($aosApp)
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
                    <div class="card border-{{ $aosApp->applicant_first_name ? 'success' : 'secondary' }}">
                        <div class="card-body p-3 text-center">
                            <i class="fa fa-user fa-2x mb-2 text-{{ $aosApp->applicant_first_name ? 'success' : 'muted' }}"></i>
                            <h6>Applicant Info</h6>
                            <span class="badge bg-{{ $aosApp->applicant_first_name ? 'success' : 'secondary' }}">
                                {{ $aosApp->applicant_first_name ? 'Started' : 'Not Started' }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-{{ $aosApp->petitioner_first_name ? 'success' : 'secondary' }}">
                        <div class="card-body p-3 text-center">
                            <i class="fa fa-user-tie fa-2x mb-2 text-{{ $aosApp->petitioner_first_name ? 'success' : 'muted' }}"></i>
                            <h6>Petitioner (Sponsor)</h6>
                            <span class="badge bg-{{ $aosApp->petitioner_first_name ? 'success' : 'secondary' }}">
                                {{ $aosApp->petitioner_first_name ? 'Started' : 'Not Started' }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-{{ $aosApp->arrival_date ? 'success' : 'secondary' }}">
                        <div class="card-body p-3 text-center">
                            <i class="fa fa-plane-arrival fa-2x mb-2 text-{{ $aosApp->arrival_date ? 'success' : 'muted' }}"></i>
                            <h6>Entry Details</h6>
                            <span class="badge bg-{{ $aosApp->arrival_date ? 'success' : 'secondary' }}">
                                {{ $aosApp->arrival_date ? 'Started' : 'Not Started' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('aos-simplified.index') }}" class="btn btn-success btn-lg">
                    <i class="fa fa-edit me-2"></i>Continue Application
                </a>
                
                @if($aosApp->status === 'draft')
                    <p class="text-muted mt-2 mb-0">
                        <small>
                            <i class="fa fa-save me-1"></i>
                            Last saved: {{ $aosApp->updated_at->diffForHumans() }}
                        </small>
                    </p>
                @endif
            </div>
        @else
            <div class="text-center">
                <a href="{{ route('aos-simplified.index') }}" class="btn btn-success btn-lg">
                    <i class="fa fa-plus me-2"></i>Start Application
                </a>
            </div>
        @endif
    </div>
</div>