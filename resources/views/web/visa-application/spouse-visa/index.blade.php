<!-- resources\views\web\visa-application\spouse-visa\index.blade.php -->
@extends('web.layout.master')
@section('content')
<section class="mypetition myaccount ptb-80 bg-lightgrey">
    <div class="container">
        <div class="row">
            <div class="col-md-6 section-title mb-0">
                <h3 class="fs-3 mb-0">Spouse Visa Application (CR-1/IR-1)</h3>
            </div>
            <div class="col-md-6 text-start text-md-end">
                <a href="{{ route('user.page', 'progress') }}" class="btn btn-tra-primary">Back To Profile</a>
            </div>
            <div class="col-md-12">
                <p class="jumbotron">
                    <strong>Sponsor:</strong> U.S. Citizen or Green Card Holder | 
                    <strong>Beneficiary:</strong> Foreign Spouse
                </p>
            </div>
            <div class="col-lg-12 mt-4">
                <div class="card p-0">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-4 col-lg-3 br-r-1 pe-0">
                                <ul id="progressbar" class="progessbar2 mb-0">
                                    @if($section === 'sponsor')
                                        <!-- SPONSOR SECTION ONLY -->
                                        <li class="section-header">
                                            <strong class="text-primary">SPONSOR SECTION</strong>
                                        </li>
                                        
                                        <li class="spousePreviousOrContinue sponsor-name {{ @$step == 'name' ? 'active' : '' }}" 
                                            data-section="sponsor" 
                                            data-form="name">
                                            <span><img src='{{ asset("assets/img/stepicon1.png") }}'/></span>
                                            <strong>Name</strong>
                                        </li>
                                        <li class="spousePreviousOrContinue sponsor-contact {{ @$step == 'contact' ? 'active' : '' }}" 
                                            data-section="sponsor" 
                                            data-form="contact">
                                            <span><img src='{{ asset("assets/img/stepicon2.png") }}'/></span>
                                            <strong>Contact</strong>
                                        </li>
                                        <li class="spousePreviousOrContinue sponsor-address {{ @$step == 'address' ? 'active' : '' }}" 
                                            data-section="sponsor" 
                                            data-form="address">
                                            <span><img src='{{ asset("assets/img/stepicon3.png") }}'/></span>
                                            <strong>Address</strong>
                                        </li>
                                        <li class="spousePreviousOrContinue sponsor-place-of-birth {{ @$step == 'place-of-birth' ? 'active' : '' }}" 
                                            data-section="sponsor" 
                                            data-form="place-of-birth">
                                            <span><img src='{{ asset("assets/img/stepicon4.png") }}'/></span>
                                            <strong>Place of Birth</strong>
                                        </li>
                                        <li class="spousePreviousOrContinue sponsor-status {{ @$step == 'status' ? 'active' : '' }}" 
                                            data-section="sponsor" 
                                            data-form="status">
                                            <span><img src='{{ asset("assets/img/stepicon5.png") }}'/></span>
                                            <strong>Status</strong>
                                        </li>
                                        <li class="spousePreviousOrContinue sponsor-marital-status {{ @$step == 'marital-status' ? 'active' : '' }}" 
                                            data-section="sponsor" 
                                            data-form="marital-status">
                                            <span><img src='{{ asset("assets/img/stepicon6.png") }}'/></span>
                                            <strong>Marital Status</strong>
                                        </li>
                                        <li class="spousePreviousOrContinue sponsor-other-filings {{ @$step == 'other-filings' ? 'active' : '' }}" 
                                            data-section="sponsor" 
                                            data-form="other-filings">
                                            <span><img src='{{ asset("assets/img/stepicon7.png") }}'/></span>
                                            <strong>Other Filings</strong>
                                        </li>
                                        <li class="spousePreviousOrContinue sponsor-military-convictions {{ @$step == 'military-convictions' ? 'active' : '' }}" 
                                            data-section="sponsor" 
                                            data-form="military-convictions">
                                            <span><img src='{{ asset("assets/img/stepicon8.png") }}'/></span>
                                            <strong>Military</strong>
                                        </li>
                                        <li class="spousePreviousOrContinue sponsor-employment {{ @$step == 'employment' ? 'active' : '' }}" 
                                            data-section="sponsor" 
                                            data-form="employment">
                                            <span><img src='{{ asset("assets/img/stepicon9.png") }}'/></span>
                                            <strong>Employment</strong>
                                        </li>

                                    @elseif($section === 'beneficiary')
                                        <!-- BENEFICIARY SECTION ONLY -->
                                        <li class="section-header">
                                            <strong class="text-success">BENEFICIARY SECTION</strong>
                                        </li>
                                        
                                        <li class="spousePreviousOrContinue beneficiary-name {{ @$step == 'name' ? 'active' : '' }}" 
                                            data-section="beneficiary" 
                                            data-form="name">
                                            <span><img src='{{ asset("assets/img/stepicon1.png") }}'/></span>
                                            <strong>Name</strong>
                                        </li>
                                        <li class="spousePreviousOrContinue beneficiary-contact {{ @$step == 'contact' ? 'active' : '' }}" 
                                            data-section="beneficiary" 
                                            data-form="contact">
                                            <span><img src='{{ asset("assets/img/stepicon2.png") }}'/></span>
                                            <strong>Contact</strong>
                                        </li>
                                        <li class="spousePreviousOrContinue beneficiary-address {{ @$step == 'address' ? 'active' : '' }}" 
                                            data-section="beneficiary" 
                                            data-form="address">
                                            <span><img src='{{ asset("assets/img/stepicon3.png") }}'/></span>
                                            <strong>Address</strong>
                                        </li>
                                        <li class="spousePreviousOrContinue beneficiary-place-of-birth {{ @$step == 'place-of-birth' ? 'active' : '' }}" 
                                            data-section="beneficiary" 
                                            data-form="place-of-birth">
                                            <span><img src='{{ asset("assets/img/stepicon4.png") }}'/></span>
                                            <strong>Place of Birth</strong>
                                        </li>
                                        <li class="spousePreviousOrContinue beneficiary-status {{ @$step == 'status' ? 'active' : '' }}" 
                                            data-section="beneficiary" 
                                            data-form="status">
                                            <span><img src='{{ asset("assets/img/stepicon5.png") }}'/></span>
                                            <strong>Status</strong>
                                        </li>
                                        <li class="spousePreviousOrContinue beneficiary-marital-status {{ @$step == 'marital-status' ? 'active' : '' }}" 
                                            data-section="beneficiary" 
                                            data-form="marital-status">
                                            <span><img src='{{ asset("assets/img/stepicon6.png") }}'/></span>
                                            <strong>Marital Status</strong>
                                        </li>
                                        <li class="spousePreviousOrContinue beneficiary-employment {{ @$step == 'employment' ? 'active' : '' }}" 
                                            data-section="beneficiary" 
                                            data-form="employment">
                                            <span><img src='{{ asset("assets/img/stepicon9.png") }}'/></span>
                                            <strong>Employment</strong>
                                        </li>

                                    @else
                                        <!-- SHARED SECTION (Relationship) -->
                                        <li class="section-header">
                                            <strong class="text-warning">SHARED</strong>
                                        </li>
                                        <li class="spousePreviousOrContinue relationship {{ @$step == 'relationship' ? 'active' : '' }}" 
                                            data-section="shared" 
                                            data-form="relationship">
                                            <span><img src='{{ asset("assets/img/stepicon10.png") }}'/></span>
                                            <strong>Marriage</strong>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="col-md-8 col-lg-9 spouseVisaForm">
    @if (isset($step) && isset($section))
        @if($section === 'shared')
            {{-- Shared views are directly in spouse-visa folder --}}
            @include('web.visa-application.spouse-visa.'.$step, compact('step'))
        @else
            {{-- Sponsor/Beneficiary views are in subfolders --}}
            @include('web.visa-application.spouse-visa.'.$section.'.'.$step, compact('step'))
        @endif
    @elseif(isset($step))
        @include('web.visa-application.spouse-visa.'.$step, compact('step'))
    @else
        <div class="text-center p-5">
            <h4>Welcome to CR-1/IR-1 Spouse Visa Application</h4>
            <p class="text-muted">Click on any step on the left to begin.</p>
        </div>
    @endif
</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customScript')
<script src="{{ asset('assets/js/spouse-steps.js') }}"></script>
<script type="text/javascript">
    $(document).on('click', '.spousePreviousOrContinue', function(){
        var section = $(this).data('section');
        var form = $(this).data('form');
        
        // Don't process if it's a section header
        if ($(this).hasClass('section-header')) {
            return false;
        }
        
        // Show loading
        var $btn = $(this);
        var originalHtml = $btn.find('strong').html();
        $btn.find('strong').html('Loading...');
        
        $.ajax({
            headers: {
               'X-CSRF-Token': $('input[name="_token"]').val()
            },
            type: 'post',
            url: "{{ route('spouseNavigate') }}",
            data: { 
                section: section,
                form: form 
            },
            dataType: 'json',
            success: function(data) {
                if (data.status) {
                    // Remove active from all items
                    $('#progressbar li:not(.section-header)').removeClass('active');
                    
                    // Add active to the clicked item
                    $btn.addClass('active');
                    
                    // Load the form content
                    $('.spouseVisaForm').html(data.step);
                    
                    // Scroll to top of form
                    $('html, body').animate({
                        scrollTop: $('.spouseVisaForm').offset().top - 100
                    }, 300);
                } else {
                    toastr.error(data.message || 'Failed to load form');
                    console.error('Navigation failed:', data);
                }
            },
            error: function(xhr, status, error) {
                console.error('Navigation error:', xhr.responseJSON);
                var errorMsg = xhr.responseJSON?.message || 'Failed to load section. Please try again.';
                toastr.error(errorMsg);
            },
            complete: function() {
                $btn.find('strong').html(originalHtml);
            }
        });
        
        return false;
    });

    // Handle form submissions and update progress
    $(document).on('submit', 'form[id$="Name"], form[id$="Contact"], form[id$="Address"]', function(e) {
        e.preventDefault();
        // Form submission will be handled by individual form scripts
        // After successful save, the response will update the view
    });
</script>
<style>
    .section-header {
        padding: 15px 20px !important;
        background: #f8f9fa;
        border-top: 2px solid #dee2e6;
        border-bottom: 2px solid #dee2e6;
        margin: 10px 0 !important;
        cursor: default !important;
        pointer-events: none;
    }
    .section-header:hover {
        background: #f8f9fa !important;
        cursor: default !important;
    }
    .section-header strong {
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }
</style>
@endsection