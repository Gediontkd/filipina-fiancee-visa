{{-- resources/views/admin/pdf-store/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'User PDF Store')
@section('page-title', 'User PDF Management')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">User PDF Store</h1>
            <p class="text-gray-600 mt-1">Upload and manage PDF files for users</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-file-pdf text-blue-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total PDF Files</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_files']) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-folder text-green-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">User Folders</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['user_folders']) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-hdd text-purple-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Storage</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_size_formatted'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- User Selection & Upload -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-semibold text-gray-900">Select User</h3>
        </div>
        <div class="p-6">
            <div class="mb-6">
                <label for="user-select" class="block text-sm font-medium text-gray-700 mb-2">
                    Choose user to manage PDFs
                </label>
                <select id="user-select" 
                        class="w-full md:w-1/2 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Select a user --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $selectedUserId == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Upload Area (Hidden until user selected) -->
            <div id="upload-area" class="hidden">
                <!-- Folder Warning (if folder doesn't exist) -->
                <div id="folder-warning" class="hidden mb-4">
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-triangle text-yellow-600 text-xl mr-3 mt-1"></i>
                            <div>
                                <h4 class="text-yellow-800 font-medium mb-1">User Folder Not Found</h4>
                                <p class="text-yellow-700 text-sm">
                                    The PDF folder for this user does not exist yet. 
                                    The folder should have been created during registration.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="upload-zone" class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-blue-500 transition-colors">
                    <input type="file" id="pdf-files" accept=".pdf" multiple class="hidden">
                    <i class="fas fa-cloud-upload-alt text-5xl text-gray-400 mb-4"></i>
                    <p class="text-lg font-medium text-gray-700 mb-2">Drop PDF files here or click to browse</p>
                    <p class="text-sm text-gray-500 mb-4">You can upload multiple PDF files at once (Max 100MB per file)</p>
                    <button type="button" onclick="document.getElementById('pdf-files').click()" 
                            class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                        <i class="fas fa-upload mr-2"></i>Select Files
                    </button>
                </div>

                <!-- Upload Progress -->
                <div id="upload-progress" class="hidden mt-4">
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <i class="fas fa-spinner fa-spin text-blue-600 mr-3"></i>
                            <span class="text-blue-800">Uploading files...</span>
                        </div>
                        <div class="mt-2 bg-gray-200 rounded-full h-2">
                            <div id="progress-bar" class="bg-blue-600 h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PDF Files List -->
    <div id="pdf-list-container" class="hidden">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">PDF Files</h3>
                    <p class="text-sm text-gray-500" id="user-info"></p>
                </div>
                <span id="file-count" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800"></span>
            </div>
            <div class="p-6">
                <div id="pdf-list" class="space-y-3"></div>
                <div id="no-files" class="hidden text-center py-8 text-gray-500">
                    <i class="fas fa-folder-open text-4xl mb-3"></i>
                    <p>No PDF files found for this user</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="delete-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-lg bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full mb-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 text-center mb-2">Delete PDF File</h3>
            <p class="text-sm text-gray-500 text-center mb-4">
                Are you sure you want to delete <strong id="delete-filename"></strong>?
                <br>This action cannot be undone.
            </p>
            <div class="flex items-center justify-center space-x-3">
                <button onclick="closeDeleteModal()" 
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                    Cancel
                </button>
                <button onclick="confirmDelete()" 
                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let selectedUserId = {{ $selectedUserId ?? 'null' }};
    let fileToDelete = null;

    // User selection change
    document.getElementById('user-select').addEventListener('change', function() {
        selectedUserId = this.value;
        
        if (selectedUserId) {
            loadUserPdfs(selectedUserId);
            document.getElementById('upload-area').classList.remove('hidden');
        } else {
            document.getElementById('upload-area').classList.add('hidden');
            document.getElementById('pdf-list-container').classList.add('hidden');
        }
    });

    // Load user PDFs
    function loadUserPdfs(userId) {
        fetch(`/admin/user-pdf-store/user/${userId}/pdfs`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.folder_exists) {
                        // Folder exists - show upload area and PDFs
                        document.getElementById('folder-warning').classList.add('hidden');
                        document.getElementById('upload-zone').classList.remove('hidden');
                        displayPdfList(data.pdfs, data.user);
                    } else {
                        // Folder doesn't exist - show warning and hide upload
                        document.getElementById('folder-warning').classList.remove('hidden');
                        document.getElementById('upload-zone').classList.add('hidden');
                        document.getElementById('pdf-list-container').classList.add('hidden');
                    }
                }
            })
            .catch(error => {
                console.error('Error loading PDFs:', error);
                showNotification('Failed to load PDFs', 'error');
            });
    }

    // Display PDF list
    function displayPdfList(pdfs, user) {
        const container = document.getElementById('pdf-list-container');
        const list = document.getElementById('pdf-list');
        const noFiles = document.getElementById('no-files');
        const fileCount = document.getElementById('file-count');
        const userInfo = document.getElementById('user-info');

        container.classList.remove('hidden');
        userInfo.textContent = `for ${user.name}`;
        fileCount.textContent = `${pdfs.length} file(s)`;

        if (pdfs.length === 0) {
            list.classList.add('hidden');
            noFiles.classList.remove('hidden');
            return;
        }

        list.classList.remove('hidden');
        noFiles.classList.add('hidden');
        
        list.innerHTML = pdfs.map(pdf => `
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                <div class="flex items-center space-x-4 flex-1">
                    <i class="fas fa-file-pdf text-red-500 text-2xl"></i>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">${pdf.name}</p>
                        <p class="text-xs text-gray-500">
                            ${pdf.size_formatted} • Modified ${pdf.modified_formatted}
                        </p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <a href="/admin/user-pdf-store/download/${selectedUserId}/${encodeURIComponent(pdf.name)}" 
                       class="inline-flex items-center px-3 py-1 bg-blue-100 hover:bg-blue-200 text-blue-700 text-sm rounded-lg transition-colors"
                       title="Download">
                        <i class="fas fa-download"></i>
                    </a>
                    <button onclick="showDeleteModal('${pdf.name}')" 
                            class="inline-flex items-center px-3 py-1 bg-red-100 hover:bg-red-200 text-red-700 text-sm rounded-lg transition-colors"
                            title="Delete">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `).join('');
    }

    // File upload handling
    const fileInput = document.getElementById('pdf-files');
    const dropZone = document.getElementById('upload-zone');

    fileInput.addEventListener('change', function() {
        if (this.files.length > 0) {
            uploadFiles(this.files);
        }
    });

    // Drag and drop
    if (dropZone) {
        dropZone.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('border-blue-500', 'bg-blue-50');
        });

        dropZone.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('border-blue-500', 'bg-blue-50');
        });

        dropZone.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('border-blue-500', 'bg-blue-50');
            
            const files = Array.from(e.dataTransfer.files).filter(file => file.type === 'application/pdf');
            if (files.length > 0) {
                uploadFiles(files);
            } else {
                showNotification('Please drop only PDF files', 'error');
            }
        });
    }

    // Upload files
    function uploadFiles(files) {
        if (!selectedUserId) {
            showNotification('Please select a user first', 'error');
            return;
        }

        // Check if folder warning is visible (folder doesn't exist)
        if (!document.getElementById('folder-warning').classList.contains('hidden')) {
            showNotification('Cannot upload - user folder does not exist', 'error');
            return;
        }

        const formData = new FormData();
        formData.append('user_id', selectedUserId);
        
        Array.from(files).forEach(file => {
            formData.append('pdf_files[]', file);
        });

        const progressDiv = document.getElementById('upload-progress');
        const progressBar = document.getElementById('progress-bar');
        
        progressDiv.classList.remove('hidden');
        progressBar.style.width = '0%';

        fetch('/admin/user-pdf-store/upload', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            progressBar.style.width = '100%';
            
            setTimeout(() => {
                progressDiv.classList.add('hidden');
                
                if (data.success) {
                    showNotification(data.message, 'success');
                    displayPdfList(data.pdfs, { name: document.getElementById('user-select').selectedOptions[0].text.split('(')[0].trim() });
                    fileInput.value = '';
                } else {
                    showNotification(data.message || 'Upload failed', 'error');
                }
            }, 500);
        })
        .catch(error => {
            console.error('Upload error:', error);
            progressDiv.classList.add('hidden');
            showNotification('Upload failed', 'error');
        });
    }

    // Delete modal
    function showDeleteModal(filename) {
        fileToDelete = filename;
        document.getElementById('delete-filename').textContent = filename;
        document.getElementById('delete-modal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('delete-modal').classList.add('hidden');
        fileToDelete = null;
    }

    function confirmDelete() {
        if (!fileToDelete || !selectedUserId) return;

        fetch('/admin/user-pdf-store/delete', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                user_id: selectedUserId,
                filename: fileToDelete
            })
        })
        .then(response => response.json())
        .then(data => {
            closeDeleteModal();
            
            if (data.success) {
                showNotification(data.message, 'success');
                displayPdfList(data.pdfs, { name: document.getElementById('user-select').selectedOptions[0].text.split('(')[0].trim() });
            } else {
                showNotification(data.message || 'Deletion failed', 'error');
            }
        })
        .catch(error => {
            console.error('Delete error:', error);
            closeDeleteModal();
            showNotification('Deletion failed', 'error');
        });
    }

    // Notification
    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg text-white shadow-lg ${
            type === 'success' ? 'bg-green-500' : 'bg-red-500'
        }`;
        notification.innerHTML = `
            <div class="flex items-center">
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} mr-2"></i>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }

    // Load PDFs on page load if user is selected
    if (selectedUserId) {
        loadUserPdfs(selectedUserId);
    }
</script>
@endpush