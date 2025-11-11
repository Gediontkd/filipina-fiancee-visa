{{-- 
    FILE: resources/views/components/apt-suite-floor.blade.php
    Reusable Apt/Suite/Floor Component matching USCIS I-130 layout
    
    Usage: @include('components.apt-suite-floor', [
        'name' => 'sponsor_mailing_apt',
        'value' => optional($application)->sponsor_mailing_apt,
        'required' => false
    ])
--}}

@php
    // Parse existing value (format: "Apt:2B" or "Ste:123" or "Flr:5A")
    $aptType = '';
    $aptNumber = '';
    
    if (!empty($value) && $value !== 'N/A') {
        $parts = explode(':', $value);
        if (count($parts) === 2) {
            $aptType = $parts[0]; // "Apt", "Ste", or "Flr"
            $aptNumber = $parts[1];
        }
    }
    
    // Generate unique IDs
    $uniqueId = str_replace(['[', ']'], ['_', ''], $name);
@endphp

<div class="form-group mb-3">
    {{ Form::label($name, 'Apt/Suite/Floor') }}
    @if($required ?? false)
        <span class="text-danger">*</span>
    @endif
    
    {{-- Checkboxes for Apt/Ste/Flr --}}
    <div class="d-flex gap-3 mb-2 apt-checkboxes" data-target="{{ $uniqueId }}">
        <div class="form-check">
            <input type="checkbox" 
                class="form-check-input apt-type-checkbox" 
                id="{{ $uniqueId }}_apt" 
                value="Apt"
                {{ $aptType === 'Apt' ? 'checked' : '' }}>
            <label class="form-check-label" for="{{ $uniqueId }}_apt">Apt.</label>
        </div>
        
        <div class="form-check">
            <input type="checkbox" 
                class="form-check-input apt-type-checkbox" 
                id="{{ $uniqueId }}_ste" 
                value="Ste"
                {{ $aptType === 'Ste' ? 'checked' : '' }}>
            <label class="form-check-label" for="{{ $uniqueId }}_ste">Ste.</label>
        </div>
        
        <div class="form-check">
            <input type="checkbox" 
                class="form-check-input apt-type-checkbox" 
                id="{{ $uniqueId }}_flr" 
                value="Flr"
                {{ $aptType === 'Flr' ? 'checked' : '' }}>
            <label class="form-check-label" for="{{ $uniqueId }}_flr">Flr.</label>
        </div>
    </div>
    
    {{-- Hidden input for apartment/suite/floor number (max 6 chars, alphanumeric only) --}}
    <div class="apt-number-container" 
        id="{{ $uniqueId }}_container" 
        style="display: {{ !empty($aptType) ? 'block' : 'none' }};">
        <input type="text" 
            class="form-control apt-number-input" 
            id="{{ $uniqueId }}_number" 
            placeholder="Enter number (max 6 chars)"
            value="{{ $aptNumber }}"
            maxlength="6"
            style="max-width: 150px;">
        <small class="form-text text-muted">Letters and numbers only, no spaces</small>
    </div>
    
    {{-- Hidden field to store combined value (Apt:2B format) --}}
    <input type="hidden" name="{{ $name }}" id="{{ $uniqueId }}_hidden" value="{{ $value ?? '' }}">
</div>

<script>
(function() {
    const uniqueId = '{{ $uniqueId }}';
    const container = document.querySelector('[data-target="' + uniqueId + '"]');
    
    if (!container) return; // Already initialized
    
    const checkboxes = container.querySelectorAll('.apt-type-checkbox');
    const numberContainer = document.getElementById(uniqueId + '_container');
    const numberInput = document.getElementById(uniqueId + '_number');
    const hiddenInput = document.getElementById(uniqueId + '_hidden');
    
    // Handle checkbox selection (only one can be selected at a time)
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                // Uncheck other checkboxes
                checkboxes.forEach(cb => {
                    if (cb !== this) cb.checked = false;
                });
                
                // Show input field
                numberContainer.style.display = 'block';
                numberInput.focus();
            } else {
                // If unchecking and no others checked, hide input
                const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
                if (!anyChecked) {
                    numberContainer.style.display = 'none';
                    numberInput.value = '';
                    hiddenInput.value = '';
                }
            }
            
            updateHiddenValue();
        });
    });
    
    // Validate and restrict input to alphanumeric only
    numberInput.addEventListener('input', function(e) {
        // Remove any non-alphanumeric characters
        this.value = this.value.replace(/[^A-Za-z0-9]/g, '');
        
        // Limit to 6 characters
        if (this.value.length > 6) {
            this.value = this.value.substring(0, 6);
        }
        
        updateHiddenValue();
    });
    
    // Prevent paste of invalid characters
    numberInput.addEventListener('paste', function(e) {
        e.preventDefault();
        const pastedText = (e.clipboardData || window.clipboardData).getData('text');
        const cleanedText = pastedText.replace(/[^A-Za-z0-9]/g, '').substring(0, 6);
        this.value = cleanedText;
        updateHiddenValue();
    });
    
    // Prevent keyboard entry of invalid characters
    numberInput.addEventListener('keypress', function(e) {
        const char = String.fromCharCode(e.which);
        if (!/[A-Za-z0-9]/.test(char)) {
            e.preventDefault();
        }
    });
    
    // Update hidden field with format "Apt:2B" or "Ste:123" or "Flr:5A"
    function updateHiddenValue() {
        const selectedCheckbox = Array.from(checkboxes).find(cb => cb.checked);
        const numberValue = numberInput.value.trim();
        
        if (selectedCheckbox && numberValue) {
            hiddenInput.value = selectedCheckbox.value + ':' + numberValue;
        } else {
            hiddenInput.value = '';
        }
    }
})();
</script>