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
            // Check actual submitted steps (where form data is stored)
            $sponsorCount = \App\Models\FianceVisaSubmittedStep::where('user_id', Auth::id())
                ->where('type', 'sponsor')
                ->distinct('step')->count('step');
            
            $alienCount = \App\Models\FianceVisaSubmittedStep::where('user_id', Auth::id())
                ->where('type', 'alien')
                ->distinct('step')->count('step');
            
            $childrenCount = \App\Models\FianceVisaSubmittedStep::where('user_id', Auth::id())
                ->where('type', 'alien-children')
                ->distinct('step')->count('step');
            
            // Calculate individual section progress
            $sponsorProgress = min(100, ($sponsorCount / 10) * 100);
            $alienProgress = min(100, ($alienCount / 21) * 100);
            $childrenProgress = min(100, ($childrenCount / 5) * 100);
            
            // Get latest update timestamp
            $lastUpdate = \App\Models\FianceVisaSubmittedStep::where('user_id', Auth::id())
                ->latest('updated_at')
                ->first();
        @endphp

        <div class="row mb-4">
            <div class="col-md-12">
                <h6 class="mb-2">Application Progress</h6>
                <div class="progress" style="height: 30px;">
                    <div class="progress-bar progress-bar-striped {{ $overAll >= 100 ? 'bg-success' : 'bg-info' }}" 
                        role="progressbar" 
                        style="width: {{ number_format($overAll, 1) }}%" 
                        aria-valuenow="{{ $overAll }}" 
                        aria-valuemin="0" 
                        aria-valuemax="100">
                        <strong>{{ number_format($overAll, 1) }}%</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            {{-- Sponsor Section --}}
            <div class="col-md-4 mb-3">
                <div class="card border-{{ $sponsorCount > 0 ? 'success' : 'secondary' }} h-100">
                    <div class="card-body p-3 text-center">
                        <i class="fa fa-user fa-2x mb-2 text-{{ $sponsorCount > 0 ? 'success' : 'muted' }}"></i>
                        <h6>Sponsor (Petitioner)</h6>
                        <span class="badge bg-{{ $sponsorCount > 0 ? 'success' : 'secondary' }} mb-2">
                            {{ $sponsorCount > 0 ? 'In Progress' : 'Not Started' }}
                        </span>
                        @if($sponsorCount > 0)
                            <div class="progress mt-2" style="height: 20px;">
                                <div class="progress-bar" 
                                    role="progressbar" 
                                    style="width: {{ number_format($sponsorProgress, 1) }}%"
                                    aria-valuenow="{{ $sponsorProgress }}" 
                                    aria-valuemin="0" 
                                    aria-valuemax="100">
                                    {{ number_format($sponsorProgress, 0) }}%
                                </div>
                            </div>
                            <small class="text-muted d-block mt-1">{{ $sponsorCount }}/10 steps</small>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Alien Section --}}
            <div class="col-md-4 mb-3">
                <div class="card border-{{ $alienCount > 0 ? 'success' : 'secondary' }} h-100">
                    <div class="card-body p-3 text-center">
                        <i class="fa fa-user-friends fa-2x mb-2 text-{{ $alienCount > 0 ? 'success' : 'muted' }}"></i>
                        <h6>Alien (Beneficiary)</h6>
                        <span class="badge bg-{{ $alienCount > 0 ? 'success' : 'secondary' }} mb-2">
                            {{ $alienCount > 0 ? 'In Progress' : 'Not Started' }}
                        </span>
                        @if($alienCount > 0)
                            <div class="progress mt-2" style="height: 20px;">
                                <div class="progress-bar"
                                    role="progressbar"
                                    style="width: {{ number_format($alienProgress, 1) }}%"
                                    aria-valuenow="{{ $alienProgress }}"
                                    aria-valuemin="0"
                                    aria-valuemax="100">
                                    {{ number_format($alienProgress, 0) }}%
                                </div>
                            </div>
                            <small class="text-muted d-block mt-1">{{ $alienCount }}/21 steps</small>
                        @else
                            <small class="text-muted d-block mt-1">Available after sponsor completion</small>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Children Section --}}
            <div class="col-md-4 mb-3">
                <a href="{{ route('fianceAlienChildApplication') }}" class="text-decoration-none">
                    <div class="card border-{{ $childrenCount > 0 ? 'success' : 'secondary' }} h-100">
                        <div class="card-body p-3 text-center">
                            <i class="fa fa-child fa-2x mb-2 text-{{ $childrenCount > 0 ? 'success' : 'muted' }}"></i>
                            <h6>Children (Optional)</h6>
                            <span class="badge bg-{{ $childrenCount > 0 ? 'success' : 'secondary' }} mb-2">
                                {{ $childrenCount > 0 ? 'In Progress' : 'Not Started' }}
                            </span>
                            @if($childrenCount > 0)
                                <div class="progress mt-2" style="height: 20px;">
                                    <div class="progress-bar"
                                        role="progressbar"
                                        style="width: {{ number_format($childrenProgress, 1) }}%"
                                        aria-valuenow="{{ $childrenProgress }}"
                                        aria-valuemin="0"
                                        aria-valuemax="100">
                                        {{ number_format($childrenProgress, 0) }}%
                                    </div>
                                </div>
                                <small class="text-muted d-block mt-1">{{ $childrenCount }}/5 steps</small>
                            @else
                                <small class="text-muted d-block mt-1">Click to start</small>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="text-center">
            @if($sponsorCount < 10)
                <a href="{{ route('fianceSponsorApplication') }}" class="btn btn-primary btn-lg">
                    <i class="fa fa-edit me-2"></i>Continue Application
                </a>
            @elseif($alienCount < 21)
                <a href="{{ route('fianceAlienApplication') }}" class="btn btn-primary btn-lg">
                    <i class="fa fa-edit me-2"></i>Continue Application
                </a>
            @else
                <a href="{{ route('fianceAlienChildApplication') }}" class="btn btn-primary btn-lg">
                    <i class="fa fa-edit me-2"></i>Continue Application
                </a>
            @endif
            
            @if($lastUpdate)
                <p class="text-muted mt-2 mb-0">
                    <small>
                        <i class="fa fa-save me-1"></i>
                        Last saved: {{ $lastUpdate->updated_at->diffForHumans() }}
                    </small>
                </p>
            @endif
        </div>
    </div>
</div>