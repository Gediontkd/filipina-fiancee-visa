{{-- resources/views/web/user/dropbox/index.blade.php --}}
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
                {{-- Document Completion Progress --}}
                <div class="card mb-3">
                    <div class="card-header p-3 bg-primary text-white">
                        <h2 class="card-title text-white mb-0">
                            <i class="fa fa-cloud-upload-alt me-2"></i>Document Upload Center
                        </h2>
                    </div>
                    <div class="card-body p-3">
                        <div class="alert alert-info mb-3">
                            <h6 class="mb-2">
                                <i class="fa fa-info-circle me-2"></i>Visa Type: 
                                <strong>{{ $availableVisaTypes[$visaType] ?? ucfirst($visaType) }}</strong>
                            </h6>
                            <p class="mb-0">Upload the required documents below. Documents marked as "Required" must be uploaded before submission.</p>
                        </div>

                        {{-- Overall Progress --}}
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">Overall Progress</h6>
                                <span class="badge {{ $completionStats['overall_percentage'] >= 100 ? 'bg-success' : 'bg-warning' }}">
                                    {{ $completionStats['total_uploaded'] }} / {{ $completionStats['total_required'] }} Required Documents
                                </span>
                            </div>
                            <div class="progress" style="height: 25px;">
                                <div class="progress-bar {{ $completionStats['overall_percentage'] >= 100 ? 'bg-success' : '' }}" 
                                     role="progressbar" 
                                     style="width: {{ $completionStats['overall_percentage'] }}%"
                                     aria-valuenow="{{ $completionStats['overall_percentage'] }}" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100">
                                    <strong>{{ $completionStats['overall_percentage'] }}%</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Document Requirements by Category --}}
                @foreach($requirements as $categoryKey => $category)
                    <div class="card mb-3">
                        <div class="card-header p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <i class="fa fa-folder-open me-2"></i>{{ $category['label'] }}
                                </h5>
                                @if(isset($completionStats['categories'][$categoryKey]))
                                    <span class="badge {{ $completionStats['categories'][$categoryKey]['percentage'] >= 100 ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $completionStats['categories'][$categoryKey]['uploaded'] }} / 
                                        {{ $completionStats['categories'][$categoryKey]['required'] }} Complete
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="35%">Document Type</th>
                                            <th width="35%">Description</th>
                                            <th width="15%" class="text-center">Status</th>
                                            <th width="15%" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($category['documents'] as $doc)
                                            @php
                                                $uploadedDocs = isset($uploadedDocuments[$categoryKey]) 
                                                    ? $uploadedDocuments[$categoryKey]->where('document_type', $doc['id'])
                                                    : collect();
                                                $isUploaded = $uploadedDocs->count() > 0;
                                            @endphp
                                            <tr>
                                                <td>
                                                    <strong>{{ $doc['name'] }}</strong>
                                                    @if($doc['required'])
                                                        <span class="badge bg-danger ms-2">Required</span>
                                                    @else
                                                        <span class="badge bg-secondary ms-2">Optional</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <small class="text-muted">{{ $doc['description'] }}</small>
                                                </td>
                                                <td class="text-center">
                                                    @if($isUploaded)
                                                        <span class="badge bg-success">
                                                            <i class="fa fa-check me-1"></i>Uploaded
                                                        </span>
                                                        <div class="mt-1">
                                                            <small class="text-muted">{{ $uploadedDocs->count() }} file(s)</small>
                                                        </div>
                                                    @else
                                                        <span class="badge bg-warning">
                                                            <i class="fa fa-clock me-1"></i>Pending
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($isUploaded)
                                                        <button type="button" 
                                                                class="btn btn-sm btn-info" 
                                                                onclick="viewUploadedDocuments('{{ $categoryKey }}', '{{ $doc['id'] }}', '{{ $doc['name'] }}')">
                                                            <i class="fa fa-eye"></i> View
                                                        </button>
                                                    @endif
                                                    <button type="button" 
                                                            class="btn btn-sm btn-primary" 
                                                            onclick="openUploadModal('{{ $visaType }}', '{{ $categoryKey }}', '{{ $doc['id'] }}', '{{ $doc['name'] }}', {{ $doc['multiple'] ? 'true' : 'false' }})">
                                                        <i class="fa fa-upload"></i> Upload
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- Information Card --}}
                <div class="card mb-3">
                    <div class="card-header p-3 bg-info text-white">
                        <h5 class="mb-0 text-white">
                            <i class="fa fa-info-circle me-2"></i>Important Information
                        </h5>
                    </div>
                    <div class="card-body p-3">
                        <ul class="mb-0">
                            <li>Maximum file size: <strong>10MB (10,240KB)</strong></li>
                            <li>Accepted formats: <strong>PDF, DOC, DOCX, JPG, JPEG, PNG, TXT</strong></li>
                            <li>All documents must be clearly labeled and easy to read</li>
                            <li>For documents not in English, please provide certified translations</li>
                            <li>You can upload multiple files for documents marked as "multiple allowed"</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Upload Modal --}}
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">
                    <i class="fa fa-cloud-upload-alt me-2"></i>Upload Document
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="uploadForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="upload_visa_type" name="visa_type">
                    <input type="hidden" id="upload_document_category" name="document_category">
                    <input type="hidden" id="upload_document_type" name="document_type">
                    
                    <div class="mb-3">
                        <label class="form-label"><strong>Document Type:</strong></label>
                        <p id="upload_document_name" class="text-muted mb-0"></p>
                    </div>
                    
                    <div class="mb-3">
                        <label for="file" class="form-label">
                            Select File <span class="text-danger">*</span>
                        </label>
                        <input type="file" 
                               class="form-control" 
                               id="file" 
                               name="file" 
                               accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.txt"
                               required>
                        <small class="text-muted">Max size: 10MB. Formats: PDF, DOC, DOCX, JPG, PNG, TXT</small>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description (Optional)</label>
                        <textarea class="form-control" 
                                  id="description" 
                                  name="description" 
                                  rows="3" 
                                  placeholder="Add any notes about this document..."></textarea>
                    </div>
                    
                    <div id="upload_progress" class="d-none">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" 
                                 role="progressbar" 
                                 style="width: 100%"></div>
                        </div>
                        <small class="text-muted">Uploading...</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="uploadBtn">
                        <i class="fa fa-upload me-2"></i>Upload Document
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- View Uploaded Documents Modal --}}
<div class="modal fade" id="viewDocumentsModal" tabindex="-1" aria-labelledby="viewDocumentsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewDocumentsModalLabel">
                    <i class="fa fa-eye me-2"></i>Uploaded Documents
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="viewDocumentsContent">
                <div class="text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('customScript')
<script type="text/javascript">
    let uploadModal = null;
    let viewDocumentsModal = null;
    
    document.addEventListener('DOMContentLoaded', function() {
        uploadModal = new bootstrap.Modal(document.getElementById('uploadModal'));
        viewDocumentsModal = new bootstrap.Modal(document.getElementById('viewDocumentsModal'));
    });

    function openUploadModal(visaType, category, docType, docName, allowMultiple) {
        document.getElementById('upload_visa_type').value = visaType;
        document.getElementById('upload_document_category').value = category;
        document.getElementById('upload_document_type').value = docType;
        document.getElementById('upload_document_name').textContent = docName;
        
        // Reset form
        document.getElementById('uploadForm').reset();
        document.getElementById('upload_progress').classList.add('d-none');
        
        uploadModal.show();
    }

    document.getElementById('uploadForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const form = this;
        const formData = new FormData(form);
        const uploadBtn = document.getElementById('uploadBtn');
        const progressDiv = document.getElementById('upload_progress');
        
        // Disable button and show progress
        uploadBtn.disabled = true;
        uploadBtn.innerHTML = '<i class="fa fa-spinner fa-spin me-2"></i>Uploading...';
        progressDiv.classList.remove('d-none');
        
        fetch('{{ route("drop-box.store") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                toastr.success(data.message);
                setTimeout(() => {
                    location.reload();
                }, 1500);
            } else {
                toastr.error(data.message);
                uploadBtn.disabled = false;
                uploadBtn.innerHTML = '<i class="fa fa-upload me-2"></i>Upload Document';
                progressDiv.classList.add('d-none');
            }
        })
        .catch(error => {
            console.error('Upload error:', error);
            toastr.error('Upload failed. Please try again.');
            uploadBtn.disabled = false;
            uploadBtn.innerHTML = '<i class="fa fa-upload me-2"></i>Upload Document';
            progressDiv.classList.add('d-none');
        });
    });

    function viewUploadedDocuments(category, docType, docName) {
        const uploadedDocs = @json($uploadedDocuments);
        const categoryDocs = uploadedDocs[category] || [];
        const filteredDocs = categoryDocs.filter(doc => doc.document_type === docType);
        
        let html = `<h6 class="mb-3">${docName}</h6>`;
        
        if (filteredDocs.length === 0) {
            html += '<p class="text-muted">No documents found.</p>';
        } else {
            html += '<div class="list-group">';
            filteredDocs.forEach(doc => {
                html += `
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <h6 class="mb-1">
                                    <i class="fa ${getFileIcon(doc.name)} me-2"></i>${doc.original_filename}
                                </h6>
                                <small class="text-muted">
                                    Size: ${doc.formatted_file_size} | 
                                    Uploaded: ${formatDate(doc.created_at)}
                                </small>
                                ${doc.description ? `<p class="mb-0 mt-2"><small>${doc.description}</small></p>` : ''}
                            </div>
                            <div class="btn-group" role="group">
                                <a href="${doc.file_url}" target="_blank" class="btn btn-sm btn-info" title="View">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <button onclick="deleteDocument(${doc.id}, '${doc.original_filename}')" 
                                        class="btn btn-sm btn-danger" 
                                        title="Delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            });
            html += '</div>';
        }
        
        document.getElementById('viewDocumentsContent').innerHTML = html;
        viewDocumentsModal.show();
    }

    function deleteDocument(id, filename) {
        if (!confirm(`Are you sure you want to delete "${filename}"?`)) {
            return;
        }
        
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/drop-box/${id}`;
        
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        
        form.appendChild(csrfInput);
        form.appendChild(methodInput);
        document.body.appendChild(form);
        form.submit();
    }

    function getFileIcon(filename) {
        const ext = filename.split('.').pop().toLowerCase();
        const iconMap = {
            'pdf': 'fa-file-pdf text-danger',
            'doc': 'fa-file-word text-primary',
            'docx': 'fa-file-word text-primary',
            'jpg': 'fa-file-image text-info',
            'jpeg': 'fa-file-image text-info',
            'png': 'fa-file-image text-info',
            'txt': 'fa-file-alt text-secondary'
        };
        return iconMap[ext] || 'fa-file text-secondary';
    }

    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
    }
</script>
@endsection