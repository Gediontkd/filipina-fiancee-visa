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
                    <div class="card-header p-3 d-flex justify-content-between">
                        <h2 class="card-title">File</h2>
                        <a href="{{ route('drop-box.index') }}" class="btn btn-primary">Back</a>
                    </div>
                    <iframe src="{{ $file->file_url }}" style="width: 100%;height: 500px;border: none;"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('customScript')
<script type="text/javascript">
    
</script>
@endsection