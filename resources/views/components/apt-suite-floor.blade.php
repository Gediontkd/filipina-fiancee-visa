{{-- 
    FILE: resources/views/components/apt-suite-floor.blade.php
    FIXED: Added data-target-field attribute and removed inline script conflicts
    
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
    
    {{-- CRITICAL: Added data-target-field attribute for parent initialization --}}
    <div class="apt-suite-floor-component" data-target-field="{{ $name }}">
        {{-- Checkboxes for Apt/Ste/Flr --}}
        <div class="d-flex gap-3 mb-2">
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
            style="display: {{ !empty($aptType) ? 'block' : 'none' }};">
            <input type="text" 
                class="form-control apt-number-input" 
                placeholder="Enter number (max 6 chars)"
                value="{{ $aptNumber }}"
                maxlength="6"
                style="max-width: 150px;">
            <small class="form-text text-muted">Letters and numbers only, no spaces</small>
        </div>
    </div>
    
    {{-- Hidden field to store combined value (Apt:2B format) --}}
    <input type="hidden" name="{{ $name }}" value="{{ $value ?? '' }}">
</div>