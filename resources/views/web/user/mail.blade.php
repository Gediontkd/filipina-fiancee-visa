@extends('web.layout.master')
@section('content')
<section class="myaccount ptb-80 bg-lightgrey">
    {{getLanguage()}}
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
                                <h2 class="card-title">{{ __('mail.mail') }}({{ count($mails) }})</h2>
                            </div>
                            <div class="col-6 text-end">
                                <a href="javascript:void(0)" class="btn btn-tra-primary ms-2" data-bs-toggle="modal" data-bs-target="#addmailModal">{{ __('mail.compose') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="row align-items-center  mb-3">
                            <div class="col-6">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteMailModal" class="btn btn-tra-grey btn-tra-grey2">{{ __('mail.delete') }}</a>
                            </div>
                            <div class="col-6 text-end">
                                <ul class="unstyled inbox-pagination">
                                    <li><span class="fs-13">1-50 of 234</span></li>
                                    <li>
                                        <a class="np-btn" href="javascript:void(0)"><i class="fa fa-angle-right pagination-right"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="table-responsive">
                            <table class="table table-striped mailtable">
                                <tbody>
                                    @foreach ($mails as $mail)
                                        <tr class="mail_{{ $mail->id }}">
                                            <td> 
                                                <label class="custom-control custom-checkbox mb-0 ">
                                                    <input
                                                        type="checkbox"
                                                        class="custom-control-input mailId"
                                                        name="mail_id"
                                                        value="{{ $mail->id }}"
                                                    >
                                                    <span class="custom-control-label"></span>
                                                </label>
                                            </td>
                                            <td class="clickable-row" data-href="mail-detail.html">
                                                <b>{{ $mail->to }}</b>
                                            </td>
                                            <td class="clickable-row" data-href="mail-detail.html">
                                                {{ $mail->subject }}
                                            </td>
                                            <td class="clickable-row text-end" data-href="mail-detail.html">
                                                {{ date('H:i a', strtotime($mail->created_at)) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="addmailModal" tabindex="-1" aria-labelledby="addmailModalLabel" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{ Form::open(['url' => route('sendMail'), 'id' => 'sendMail']) }}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('to', 'To') }}
                            {{ Form::text('to', '', ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('subject', 'Subject') }}
                            {{ Form::text('subject', '', ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('message', 'Message') }}
                            {!! Form::textarea('body',null,['class'=>'form-control', 'rows' => 2, 'cols' => 40]) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{ Form::submit('Send Message', ['class' => 'btn btn-tra-primary', 'id' => '']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<div class="modal fade deleteMailModal" id="deleteMailModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                <button type="button" class="btn btn-tra-primary deleteMailBtn" data-bs-dismiss="modal">Delete</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('customScript')
<script type="text/javascript">
    $("#sendMail").validate({    
        rules: {
            to: {
                required: true,
            },
            subject: {
                required: true,
            },
            body: {
                required: true,
            }, 
        },
        messages: {
            to: "Please enter email!",
            subject: "Please enter subject!",      
            body: "Please enter body!",      
        },     
    });

    $(document).on('click', '.deleteMailBtn', function(){     
        var ids = $('input[name="mail_id"]:checked').map(function(){
          return $(this).val();
        }).toArray();
        $.ajax({
            headers: {
               'X-CSRF-Token': $('input[name="_token"]').val()
            },
            type: 'post',
            url: "{{ route('deleteMail') }}",
            data: {
                ids: ids
            },
            success: function(data) {
               if (data.status == true) {
                    $('input[name="mail_id"]:checked').map(function(){
                      $('.mail_'+$(this).val()).addClass('d-none');
                    });
                    toastr.options.timeOut = 10000;
                    toastr.success(data.message);
                    setTimeout(function() {
                        location.reload();
                    }, 3000);
               }
               if (data.status == false) {
                    toastr.options.timeOut = 10000;
                    toastr.error(data.message);
                    setTimeout(function() {
                        location.reload();
                    }, 3000);
               }
            }
        });
    });
</script>
@endsection