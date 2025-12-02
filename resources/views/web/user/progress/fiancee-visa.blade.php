{{-- FILE: resources/views/web/user/progress/fiancee-visa.blade.php --}}
{{-- FIANCÉE VISA (K-1) PROGRESS CARD --}}

<div class="card mb-3">
    <div class="card-header p-3 bg-primary text-white">
        <h2 class="card-title text-white mb-0">
            <i class="fa fa-heart me-2"></i>Fiancée Visa Application (K-1)
        </h2>
    </div>
    <div class="card-body p-3">
        @php
            $fianceeSponsor = \App\Models\FianceVisaStep::where('user_id', Auth::id())->first();
            $fianceeAlien = \App\Models\FianceAlien::where('user_id', Auth::id())->first();
            $fianceeChildren = \App\Models\FianceAlienChildren::where('user_id', Auth::id())->first();
        @endphp

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
                <div class="card border-{{ $fianceeSponsor ? 'success' : 'secondary' }}">
                    <div class="card-body p-3 text-center">
                        <i class="fa fa-user fa-2x mb-2 text-{{ $fianceeSponsor ? 'success' : 'muted' }}"></i>
                        <h6>Sponsor (Petitioner)</h6>
                        <span class="badge bg-{{ $fianceeSponsor ? 'success' : 'secondary' }}">
                            {{ $fianceeSponsor ? 'Started' : 'Not Started' }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-{{ $fianceeAlien ? 'success' : 'secondary' }}">
                    <div class="card-body p-3 text-center">
                        <i class="fa fa-user-friends fa-2x mb-2 text-{{ $fianceeAlien ? 'success' : 'muted' }}"></i>
                        <h6>Alien (Beneficiary)</h6>
                        <span class="badge bg-{{ $fianceeAlien ? 'success' : 'secondary' }}">
                            {{ $fianceeAlien ? 'Started' : 'Not Started' }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-{{ $fianceeChildren ? 'success' : 'secondary' }}">
                    <div class="card-body p-3 text-center">
                        <i class="fa fa-child fa-2x mb-2 text-{{ $fianceeChildren ? 'success' : 'muted' }}"></i>
                        <h6>Children (Optional)</h6>
                        <span class="badge bg-{{ $fianceeChildren ? 'success' : 'secondary' }}">
                            {{ $fianceeChildren ? 'Started' : 'Not Started' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <a href="{{ route('fianceSponsorApplication') }}" class="btn btn-primary btn-lg">
                <i class="fa fa-edit me-2"></i>Continue Application
            </a>
            
            @if($fianceeSponsor && $fianceeSponsor->updated_at)
                <p class="text-muted mt-2 mb-0">
                    <small>
                        <i class="fa fa-save me-1"></i>
                        Last saved: {{ $fianceeSponsor->updated_at->diffForHumans() }}
                    </small>
                </p>
            @endif
        </div>
    </div>
</div>