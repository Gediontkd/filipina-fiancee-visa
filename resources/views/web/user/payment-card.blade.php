@extends('web.layout.master')
@section('content')
<section class="myaccount ptb-80 bg-lightgrey">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-xl-3 col-xxl-3 col-md-4  mb-mob-15">
                @include('web.component.profile-sidebar')
            </div>
            <div class="col-lg-8 col-xl-9 col-xxl-9 col-md-9">
                <div class="card mb-3">
                    <div class="card-header p-3">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h2 class="card-title">Payment Cards </h2>
                            </div>
                            <div class="col-6 text-end">
                                <a href="javascript:void(0)" class="btn btn-tra-primary" data-bs-toggle="modal" data-bs-target="#addcardModal">Add New</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="row">
                            @foreach ($cards as $card)
                                <div class="col-lg-6 col-md-6">
                                    <div class="add-payment-card">
                                        <div class="ap-card-header mb-2">
                                            <div class="card-header-thumb">
                                                <img src="img/card.png" class="img-fluid" alt="">
                                            </div>
                                            <div class="ml-auto">
                                                <label>Expiry Date</label>
                                                <div class="card-caption">
                                                    {{ $card->month }}/{{ $card->year }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ap-card-body">
                                            <div class="ml-auto mb-3">
                                                <label>Card Number</label>
                                                <div class="card-caption">
                                                    {{ $card->card_number }}
                                                </div>
                                            </div>
                                            <div class="ap-card-footer">
                                                <div class="row">
                                                    <div class="col-9">
                                                        <div class="ml-auto">
                                                            <label>Card Holder</label>
                                                            <div class="card-caption">
                                                                {{ $card->card_holder_name }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="ml-auto">
                                                            <label>CCV</label>
                                                            <div class="card-caption">
                                                                {{ $card->cvc }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ap-card-bottom">
                                                <a href="javascript:void(0)" class="btn-delete deleteCard" data-id="{{ $card->id }}">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--- Add  Card Modal Start--->
<div class="modal fade" id="addcardModal" tabindex="-1" aria-labelledby="addcardModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Payment Card</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{ Form::open(['url' => route('addPaymentCard'), 'id' => 'paymentCard']) }}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('card_number', 'Card Number') }}
                                {{ Form::text('card_number', '', ['class' => 'form-control', 'placeholder' => 'Enter Your Card Number']) }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('card_holder_name', 'Name On Card') }}
                                {{ Form::text('card_holder_name', '', ['class' => 'form-control', 'placeholder' => 'Enter Your Name']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Month</label>
                                <select class="form-control" name="month">
                                    <option value="">--Select--</option>
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Year</label>
                                <select class="form-control" name="year">
                                    <option value="">--Select--</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('cvc', 'CVC') }}
                                {{ Form::text('cvc', '', ['class' => 'form-control', 'placeholder' => 'Enter CVC']) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{ Form::submit('Add Card', ['class' => 'btn btn-tra-primary', 'id' => 'paymentCardBtn']) }}
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<!--- Add Card  Modal End--->
<!--- Delete  Modal Start--->
<div class="modal fade deleteModal" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <i class="fa fa-times-circle"></i>
                        <h4>Are You Sure ?</h4>
                        <p>Do you really want to delete this records?. This process cannot be undone</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer br-t-none pt-0 justify-content-center">
                <button type="button" class="btn btn-tra-grey" data-bs-dismiss="modal">Cancel</button>
                <a href="" class="btn btn-tra-primary deleteCardBtn">Delete</a>
            </div>
        </div>
    </div>
</div>
<!--- Delete  Modal End--->
@endsection
@section('customScript')
<script type="text/javascript">
    $("#paymentCard").validate({    
        rules: {
            card_number: {
                required: true,
            },
            name: {
                required: true,
            },
            month: {
                required: true,
            },
            year: {
                required: true,
            },
            cvc: {
                required: true,
            }, 
        },
        messages: {
            card_number: "Please enter card number!",
            name: "Please enter last name!",      
            month: "Please choose month!",      
            year: "Please choose year!",      
            cvc: "Please enter cvc!",      
        },     
    });

    $(document).on('click', '.deleteCard', function(){
        var id = $(this).data('id');
        var url = "{{ url('delete-payment-card') }}/"+id;
        $(".deleteCardBtn").attr("href", url)
        $('#deleteModal').modal('show');
    });
</script>
@endsection