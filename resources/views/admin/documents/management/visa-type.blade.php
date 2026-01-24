{{-- resources/views/admin/documents/management/visa-type.blade.php --}}
@extends('admin.layouts.app')
@section('title', 'Manage ' . $visaTypeLabel)
@section('page-title', 'Manage: ' . $visaTypeLabel)

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.documents.management.index') }}" 
               class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-2">
                <i class="fas fa-arrow-left mr-2"></i>Back to Document Management
            </a>
            <h1 class="text-2xl font-bold text-gray-900">{{ $visaTypeLabel }}</h1>
            <p class="text-gray-600">Manage document requirements and categories</p>
        </div>
        
        <button onclick="showAddCategoryModal()" 
                class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg">
            <i class="fas fa-plus mr-2"></i>Add Category
        </button>
    </div>

    <!-- Categories List -->
    @if($categories->count() > 0)
        @foreach($categories as $category)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b flex items-center justify-between">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-900">
                            {{ $category->category_label }}
                            @if(!$category->is_active)
                                <span class="ml-2 px-2 py-1 text-xs bg-red-100 text-red-800 rounded">Inactive</span>
                            @endif
                        </h3>
                        @if($category->description)
                            <p class="text-sm text-gray-600 mt-1">{{ $category->description }}</p>
                        @endif
                        <p class="text-xs text-gray-500 mt-1">Key: <code>{{ $category->category_key }}</code></p>
                    </div>
                    
                    <div class="flex items-center space-x-2">
                        <button onclick="showEditCategoryModal({{ $category->id }}, '{{ $category->category_label }}', '{{ $category->description }}', {{ $category->sort_order }}, {{ $category->is_active ? 'true' : 'false' }})"
                                class="text-blue-600 hover:text-blue-900"
                                title="Edit Category">
                            <i class="fas fa-edit"></i>
                        </button>
                        
                        <button onclick="deleteCategory({{ $category->id }}, '{{ $category->category_label }}')"
                                class="text-red-600 hover:text-red-900"
                                title="Delete Category">
                            <i class="fas fa-trash"></i>
                        </button>
                        
                        <button onclick="showAddDocumentModal({{ $category->id }}, '{{ $category->category_label }}')"
                                class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded"
                                title="Add Document Type">
                            <i class="fas fa-plus mr-1"></i>Add Document
                        </button>
                    </div>
                </div>
                
                <!-- Document Types in this Category -->
                <div class="p-6">
                    @if($category->documentTypes->count() > 0)
                        <div class="space-y-4">
                            @foreach($category->documentTypes as $docType)
                                <div class="border border-gray-200 rounded-lg p-4 {{ !$docType->is_active ? 'bg-gray-50' : '' }}">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-2 mb-2">
                                                <h4 class="font-medium text-gray-900">{{ $docType->name }}</h4>
                                                
                                                @if($docType->is_required)
                                                    <span class="px-2 py-1 text-xs bg-red-100 text-red-800 rounded">Required</span>
                                                @else
                                                    <span class="px-2 py-1 text-xs bg-gray-100 text-gray-800 rounded">Optional</span>
                                                @endif
                                                
                                                @if($docType->allow_multiple)
                                                    <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded">Multiple Allowed</span>
                                                @endif
                                                
                                                @if(!$docType->is_active)
                                                    <span class="px-2 py-1 text-xs bg-red-100 text-red-800 rounded">Inactive</span>
                                                @endif
                                            </div>
                                            
                                            @if($docType->description)
                                                <p class="text-sm text-gray-600 mb-2">{{ $docType->description }}</p>
                                            @endif
                                            
                                            @if($docType->instructions)
                                                <p class="text-sm text-blue-600 italic mb-2">
                                                    <i class="fas fa-lightbulb mr-1"></i>{{ $docType->instructions }}
                                                </p>
                                            @endif
                                            
                                            <p class="text-xs text-gray-500">Key: <code>{{ $docType->type_key }}</code></p>
                                        </div>
                                        
                                        <div class="flex items-center space-x-2 ml-4">
                                            <button onclick="showEditDocumentModal(
                                                {{ $docType->id }},
                                                '{{ $docType->name }}',
                                                '{{ addslashes($docType->description) }}',
                                                '{{ addslashes($docType->instructions) }}',
                                                {{ $docType->is_required ? 'true' : 'false' }},
                                                {{ $docType->allow_multiple ? 'true' : 'false' }},
                                                {{ $docType->sort_order }},
                                                {{ $docType->is_active ? 'true' : 'false' }}
                                            )" 
                                                    class="text-blue-600 hover:text-blue-900"
                                                    title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            
                                            <button onclick="deleteDocumentType({{ $docType->id }}, '{{ $docType->name }}')"
                                                    class="text-red-600 hover:text-red-900"
                                                    title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">
                            No document types in this category. Click "Add Document" to create one.
                        </p>
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <div class="bg-white rounded-lg shadow p-8 text-center">
            <i class="fas fa-folder-open text-gray-400 text-5xl mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No Categories Yet</h3>
            <p class="text-gray-600 mb-4">Create your first document category for this visa type.</p>
            <button onclick="showAddCategoryModal()" 
                    class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg">
                <i class="fas fa-plus mr-2"></i>Add Category
            </button>
        </div>
    @endif
</div>

<!-- Add Category Modal -->
<div id="add-category-modal" class="fixed inset-0 z-50 hidden">
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg max-w-2xl w-full p-6">
            <h3 class="text-lg font-semibold mb-4">Add New Category</h3>
            <form action="{{ route('admin.documents.management.categories.store') }}" method="POST">
                @csrf
                <input type="hidden" name="visa_type" value="{{ $visaType }}">
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category Key *</label>
                        <input type="text" name="category_key" required 
                               placeholder="e.g., petitioner, beneficiary"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <p class="text-xs text-gray-500 mt-1">Unique identifier (lowercase, no spaces)</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category Label *</label>
                        <input type="text" name="category_label" required
                               placeholder="e.g., U.S. Petitioner Documents"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" rows="3"
                                  placeholder="Optional description..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                        <input type="number" name="sort_order" value="0"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeModal('add-category-modal')"
                            class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg">
                        <i class="fas fa-plus mr-2"></i>Add Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div id="edit-category-modal" class="fixed inset-0 z-50 hidden">
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg max-w-2xl w-full p-6">
            <h3 class="text-lg font-semibold mb-4">Edit Category</h3>
            <form id="edit-category-form" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category Label *</label>
                        <input type="text" name="category_label" id="edit_category_label" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" id="edit_category_description" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                        <input type="number" name="sort_order" id="edit_category_sort_order"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" id="edit_category_is_active" value="1"
                                   class="mr-2 rounded">
                            <span class="text-sm font-medium text-gray-700">Active</span>
                        </label>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeModal('edit-category-modal')"
                            class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                        <i class="fas fa-save mr-2"></i>Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Document Modal -->
<div id="add-document-modal" class="fixed inset-0 z-50 hidden">
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg max-w-2xl w-full p-6 max-h-[90vh] overflow-y-auto">
            <h3 class="text-lg font-semibold mb-4">Add Document Type to <span id="add_doc_category_name"></span></h3>
            <form action="{{ route('admin.documents.management.document-types.store') }}" method="POST">
                @csrf
                <input type="hidden" name="category_id" id="add_doc_category_id">
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Document Type Key *</label>
                        <input type="text" name="type_key" required
                               placeholder="e.g., petitioner_citizenship"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <p class="text-xs text-gray-500 mt-1">Unique identifier (lowercase, no spaces)</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Document Name *</label>
                        <input type="text" name="name" required
                               placeholder="e.g., U.S. Citizenship Proof"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description *</label>
                        <textarea name="description" rows="2" required
                                  placeholder="What is this document?"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Instructions (Optional)</label>
                        <textarea name="instructions" rows="2"
                                  placeholder="Helpful tips for users..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" name="is_required" value="1" checked
                                       class="mr-2 rounded">
                                <span class="text-sm font-medium text-gray-700">Required Document</span>
                            </label>
                        </div>
                        
                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" name="allow_multiple" value="1"
                                       class="mr-2 rounded">
                                <span class="text-sm font-medium text-gray-700">Allow Multiple Files</span>
                            </label>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                        <input type="number" name="sort_order" value="0"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeModal('add-document-modal')"
                            class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg">
                        <i class="fas fa-plus mr-2"></i>Add Document Type
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Document Modal -->
<div id="edit-document-modal" class="fixed inset-0 z-50 hidden">
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg max-w-2xl w-full p-6 max-h-[90vh] overflow-y-auto">
            <h3 class="text-lg font-semibold mb-4">Edit Document Type</h3>
            <form id="edit-document-form" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Document Name *</label>
                        <input type="text" name="name" id="edit_doc_name" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description *</label>
                        <textarea name="description" id="edit_doc_description" rows="2" required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Instructions</label>
                        <textarea name="instructions" id="edit_doc_instructions" rows="2"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" name="is_required" id="edit_doc_is_required" value="1"
                                       class="mr-2 rounded">
                                <span class="text-sm font-medium text-gray-700">Required</span>
                            </label>
                        </div>
                        
                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" name="allow_multiple" id="edit_doc_allow_multiple" value="1"
                                       class="mr-2 rounded">
                                <span class="text-sm font-medium text-gray-700">Multiple</span>
                            </label>
                        </div>
                        
                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" name="is_active" id="edit_doc_is_active" value="1"
                                       class="mr-2 rounded">
                                <span class="text-sm font-medium text-gray-700">Active</span>
                            </label>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                        <input type="number" name="sort_order" id="edit_doc_sort_order"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeModal('edit-document-modal')"
                            class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                        <i class="fas fa-save mr-2"></i>Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function showAddCategoryModal() {
        document.getElementById('add-category-modal').classList.remove('hidden');
    }

    function showEditCategoryModal(id, label, description, sortOrder, isActive) {
        document.getElementById('edit-category-form').action = `/admin/documents/management/categories/${id}`;
        document.getElementById('edit_category_label').value = label;
        document.getElementById('edit_category_description').value = description || '';
        document.getElementById('edit_category_sort_order').value = sortOrder;
        document.getElementById('edit_category_is_active').checked = isActive;
        document.getElementById('edit-category-modal').classList.remove('hidden');
    }

    function showAddDocumentModal(categoryId, categoryName) {
        document.getElementById('add_doc_category_id').value = categoryId;
        document.getElementById('add_doc_category_name').textContent = categoryName;
        document.getElementById('add-document-modal').classList.remove('hidden');
    }

    function showEditDocumentModal(id, name, description, instructions, isRequired, allowMultiple, sortOrder, isActive) {
        document.getElementById('edit-document-form').action = `/admin/documents/management/document-types/${id}`;
        document.getElementById('edit_doc_name').value = name;
        document.getElementById('edit_doc_description').value = description || '';
        document.getElementById('edit_doc_instructions').value = instructions || '';
        document.getElementById('edit_doc_is_required').checked = isRequired;
        document.getElementById('edit_doc_allow_multiple').checked = allowMultiple;
        document.getElementById('edit_doc_is_active').checked = isActive;
        document.getElementById('edit_doc_sort_order').value = sortOrder;
        document.getElementById('edit-document-modal').classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    function deleteCategory(id, name) {
        if (!confirm(`Delete category "${name}"?\n\nThis will also delete all document types in this category.`)) {
            return;
        }
        
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/documents/management/categories/${id}`;
        
        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = '{{ csrf_token() }}';
        
        const method = document.createElement('input');
        method.type = 'hidden';
        method.name = '_method';
        method.value = 'DELETE';
        
        form.appendChild(csrf);
        form.appendChild(method);
        document.body.appendChild(form);
        form.submit();
    }

    function deleteDocumentType(id, name) {
        if (!confirm(`Delete document type "${name}"?`)) {
            return;
        }
        
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/documents/management/document-types/${id}`;
        
        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = '{{ csrf_token() }}';
        
        const method = document.createElement('input');
        method.type = 'hidden';
        method.name = '_method';
        method.value = 'DELETE';
        
        form.appendChild(csrf);
        form.appendChild(method);
        document.body.appendChild(form);
        form.submit();
    }

    // Close modals on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal('add-category-modal');
            closeModal('edit-category-modal');
            closeModal('add-document-modal');
            closeModal('edit-document-modal');
        }
    });

    // Close modals on backdrop click
    document.querySelectorAll('[id$="-modal"]').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal(this.id);
            }
        });
    });
</script>
@endpush