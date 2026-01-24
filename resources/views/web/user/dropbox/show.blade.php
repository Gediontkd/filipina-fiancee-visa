{{-- resources/views/web/user/dropbox/show.blade.php --}}
@extends('web.layout.master')

@section('content')
<section class="myaccount ptb-80 bg-lightgrey">
    {{getLanguage()}}
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-xl-3 col-xxl-3 col-md-4 mb-mob-15">
                @include('web.component.profile-sidebar')
            </div>
            
            <div class="col-lg-8 col-xl-9 col-xxl-9 col-md-9">
                <div class="card mb-3">
                    <div class="card-header p-3 d-flex justify-content-between align-items-center">
                        <h2 class="card-title mb-0">
                            <i class="fa fa-file me-2"></i>Document Viewer
                        </h2>
                        <a href="{{ route('drop-box.index') }}" class="btn btn-primary">
                            <i class="fa fa-arrow-left me-2"></i>Back to Documents
                        </a>
                    </div>
                    
                    <div class="card-body p-3">
                        {{-- Document Information --}}
                        <div class="alert alert-info mb-3">
                            <h6 class="mb-2">
                                <i class="fa fa-info-circle me-2"></i>Document Information
                            </h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Filename:</strong> {{ $file->original_filename }}<br>
                                    <strong>File Size:</strong> {{ $file->formatted_file_size }}<br>
                                    <strong>Document Type:</strong> {{ $file->document_type_label }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Category:</strong> {{ ucfirst(str_replace('_', ' ', $file->document_category)) }}<br>
                                    <strong>Uploaded:</strong> {{ $file->created_at->format('M j, Y H:i') }}<br>
                                    <strong>Status:</strong> 
                                    @if($file->is_verified)
                                        <span class="badge bg-success">
                                            <i class="fa fa-check-circle me-1"></i>Verified
                                        </span>
                                    @else
                                        <span class="badge bg-warning">
                                            <i class="fa fa-clock me-1"></i>Under Review
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            @if($file->description)
                                <div class="mt-3">
                                    <strong>Description:</strong> {{ $file->description }}
                                </div>
                            @endif
                        </div>

                        {{-- Document Actions --}}
                        <div class="mb-3">
                            <a href="{{ $file->file_url }}" 
                               target="_blank" 
                               class="btn btn-info me-2">
                                <i class="fa fa-external-link-alt me-2"></i>Open in New Tab
                            </a>
                            
                            <a href="{{ route('drop-box.download', $file->id) }}" 
                               class="btn btn-success me-2">
                                <i class="fa fa-download me-2"></i>Download
                            </a>
                            
                            <form action="{{ route('drop-box.destroy', $file->id) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to delete this document?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash me-2"></i>Delete
                                </button>
                            </form>
                        </div>

                        {{-- Document Preview --}}
                        <div class="document-preview-container">
                            @if($file->isPdf())
                                {{-- PDF Preview --}}
                                <iframe src="{{ $file->file_url }}" 
                                        style="width: 100%; height: 600px; border: 1px solid #dee2e6; border-radius: 4px;"
                                        title="{{ $file->original_filename }}">
                                </iframe>
                            @elseif($file->isImage())
                                {{-- Image Preview --}}
                                <div class="text-center">
                                    <img src="{{ $file->file_url }}" 
                                         alt="{{ $file->original_filename }}"
                                         class="img-fluid"
                                         style="max-height: 600px; border: 1px solid #dee2e6; border-radius: 4px;">
                                </div>
                            @else
                                {{-- Other file types --}}
                                <div class="alert alert-warning text-center">
                                    <i class="fa fa-file text-warning" style="font-size: 48px;"></i>
                                    <h5 class="mt-3">Preview not available for this file type</h5>
                                    <p>Please download the file to view its contents.</p>
                                    <a href="{{ route('drop-box.download', $file->id) }}" 
                                       class="btn btn-primary">
                                        <i class="fa fa-download me-2"></i>Download File
                                    </a>
                                </div>
                            @endif
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
    // Auto-refresh iframe for PDF if it fails to load
    document.addEventListener('DOMContentLoaded', function() {
        const iframe = document.querySelector('iframe');
        if (iframe) {
            iframe.addEventListener('error', function() {
                console.log('PDF failed to load, attempting reload...');
                setTimeout(() => {
                    iframe.src = iframe.src;
                }, 1000);
            });
        }
    });
</script>
@endsection