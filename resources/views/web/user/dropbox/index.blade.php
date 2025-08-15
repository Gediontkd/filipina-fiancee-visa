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
                        <h2 class="card-title">{{ __('drop-box.dropBox') }}</h2>
                    </div>
                    <div class="card-body p-3">
                        <div class="form-group dropboxfile">
                            {{ Form::open(['url' => route('drop-box.store'), 'id' => 'dropbox']) }}
                                <label for="filedropbox">
                                    <i class="fa fa-cloud-upload-alt"></i>
                                    <p class="mb-0">{{ __('drop-box.dragDropFile') }}</p>
                                </label>
                                <small>{{ __('drop-box.maximumFileSize') }}</small>
                                <input type="file" id="filedropbox" name="file" style="display:none">
                            {{ Form::close() }}
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ __('drop-box.fileName') }}</th>
                                        <th>{{ __('drop-box.dateUploaded') }}</th>
                                        <th>{{ __('drop-box.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($files) > 0)
                                        @foreach ($files as $file)
                                            <tr>
                                                <td>{{ $file->name }}</td>
                                                <td>{{ $file->created_at }}</td>
                                                <td>
                                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn-danger btnround">
                                                        {{ Form::open(['url' => route('drop-box.destroy', $file->id)]) }}
                                                            {{ method_field('DELETE') }}
                                                            <input type="hidden" name="name" value="{{ $file->name }}">
                                                            <i class="fa fa-trash deleteFile"></i>
                                                        {{ Form::close() }}
                                                    </a>
                                                    <a href="{{ route('drop-box.show', $file->id) }}" class="btn-success btnround ms-1">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="3">{{ __('drop-box.notFound') }}</td>
                                        </tr>
                                    @endif   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('customScript')
<script type="text/javascript">
    $(document).on('change', '#filedropbox', function(){
        var form = $('#dropbox')[0];
        var serializedData = new FormData(form); 
        $.ajax({
            headers: {
               'X-CSRF-Token': $('input[name="_token"]').val()
            },
            type: 'post',
            url: "{{ route('drop-box.store') }}",
            data: serializedData,
            dataType: 'json',
            processData: false,
            contentType: false,
            cache: false,  
            success: function(data) {
               if (data.status == true) {
                    toastr.options.timeOut = 10000;
                    toastr.success(data.message);
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
               }
               if (data.status == false) {
                    toastr.options.timeOut = 10000;
                    toastr.error(data.message);
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
               }
            }
        });
    });

    $('.deleteFile').click(function(event) {
        var form =  $(this).closest("form");
        event.preventDefault();
        swal({
            title: `Are you sure you want to delete this record?`,
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });
</script>
@endsection