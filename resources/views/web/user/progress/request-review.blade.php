{{-- FILE: resources/views/web/user/progress/request-review.blade.php --}}
{{-- REQUEST REVIEW SECTION - ALWAYS VISIBLE --}}

<div class="card mb-3 border-primary">
    <div class="card-header p-3 bg-light">
        <h3 class="card-title mb-0">
            <i class="fa fa-paper-plane me-2 text-primary"></i>Ready to Submit?
        </h3>
    </div>
    <div class="card-body p-4">
        <div class="row mb-4">
            <div class="col-md-12">
                <h5 class="mb-3">Overall Progress</h5>
                <div class="progress" style="height: 35px;">
                    <div class="progress-bar progress-bar-striped {{ $isComplete ? 'bg-success' : 'bg-warning' }}" 
                        role="progressbar" 
                        style="width: {{ $overAll }}%" 
                        aria-valuenow="{{ $overAll }}" 
                        aria-valuemin="0" 
                        aria-valuemax="100">
                        <strong style="font-size: 16px;">{{ number_format($overAll, 0) }}% Complete</strong>
                    </div>
                </div>
                
                @if(!$isComplete)
                    <p class="text-muted mt-2 mb-0">
                        <i class="fa fa-info-circle me-1"></i>
                        - Complete all sections to request review
                    </p>
                @endif
            </div>
        </div>

        <div class="text-center">
            {{-- ALWAYS VISIBLE BUTTON --}}
            <button 
                type="button" 
                id="requestReviewBtn"
                class="btn btn-lg {{ $isComplete ? 'btn-success' : 'btn-secondary' }}"
                {{ !$isComplete ? 'disabled' : '' }}
                onclick="{{ $isComplete ? 'showPaymentModal()' : 'showIncompleteMessage()' }}"
                style="min-width: 280px; padding: 15px 30px; font-size: 18px;">
                <i class="fa fa-{{ $isComplete ? 'check-circle' : 'lock' }} me-2"></i>
                Request Review
            </button>
            
            @if($isComplete)
                <p class="text-success mt-3 mb-0">
                    <i class="fa fa-check-circle me-1"></i>
                    <strong>Great! Your application is complete and ready to submit.</strong>
                </p>
            @else
                <p class="text-muted mt-3 mb-0">
                    Complete all required sections above to unlock this button
                </p>
            @endif
        </div>
    </div>
</div>