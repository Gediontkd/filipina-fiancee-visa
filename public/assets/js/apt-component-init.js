/**
 * FILE: public/assets/js/apt-component-init.js
 * CRITICAL: Global initialization for apt-suite-floor components
 */

(function() {
    'use strict';
    
    /**
     * Setup a single apt component
     */
    function setupAptComponent(container) {
        const hiddenFieldName = container.dataset.targetField;
        const checkboxes = container.querySelectorAll('.apt-type-checkbox');
        const numberContainer = container.querySelector('.apt-number-container');
        const numberInput = container.querySelector('.apt-number-input');
        const hiddenInput = document.querySelector('input[name="' + hiddenFieldName + '"]');
        
        // Validate all required elements exist
        if (!checkboxes.length || !numberContainer || !numberInput || !hiddenInput) {
            console.warn('Apt component missing elements:', hiddenFieldName);
            return;
        }
        
        // Prevent duplicate initialization
        if (container.dataset.initialized === 'true') {
            return;
        }
        container.dataset.initialized = 'true';
        
        // Parse existing value (format: "Apt:2B" or "Ste:123" or "Flr:5A")
        const existingValue = hiddenInput.value;
        if (existingValue && existingValue !== 'N/A') {
            const parts = existingValue.split(':');
            if (parts.length === 2) {
                const aptType = parts[0];
                const aptNumber = parts[1];
                
                // Check the correct checkbox
                checkboxes.forEach(cb => {
                    if (cb.value === aptType) {
                        cb.checked = true;
                        numberContainer.style.display = 'block';
                        numberInput.value = aptNumber;
                    }
                });
            }
        }
        
        // Checkbox change handler
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    // Uncheck all other checkboxes
                    checkboxes.forEach(cb => {
                        if (cb !== this) cb.checked = false;
                    });
                    
                    // Show number input and focus
                    numberContainer.style.display = 'block';
                    numberInput.focus();
                } else {
                    // If unchecking, hide if no others checked
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
        
        // Number input handler - alphanumeric only, max 6 chars
        numberInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^A-Za-z0-9]/g, '').substring(0, 6);
            updateHiddenValue();
        });
        
        // Paste handler
        numberInput.addEventListener('paste', function(e) {
            e.preventDefault();
            const text = (e.clipboardData || window.clipboardData).getData('text');
            this.value = text.replace(/[^A-Za-z0-9]/g, '').substring(0, 6);
            updateHiddenValue();
        });
        
        // Keypress validation
        numberInput.addEventListener('keypress', function(e) {
            const char = String.fromCharCode(e.which || e.keyCode);
            if (!/[A-Za-z0-9]/.test(char)) {
                e.preventDefault();
            }
        });
        
        /**
         * Update hidden field value
         */
        function updateHiddenValue() {
            const selectedCheckbox = Array.from(checkboxes).find(cb => cb.checked);
            const num = numberInput.value.trim();
            
            if (selectedCheckbox && num) {
                hiddenInput.value = selectedCheckbox.value + ':' + num;
            } else {
                hiddenInput.value = '';
            }
            
            console.log('Apt updated:', hiddenFieldName, '=', hiddenInput.value);
        }
    }
    
    /**
     * Initialize all apt components on page
     */
    function initAllAptComponents() {
        const components = document.querySelectorAll('.apt-suite-floor-component[data-target-field]');
        
        console.log('Initializing', components.length, 'apt components');
        
        components.forEach(function(container) {
            setupAptComponent(container);
        });
    }
    
    // Initialize on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAllAptComponents);
    } else {
        initAllAptComponents();
    }
    
    // Re-initialize when new content is added (for dynamic history sections)
    if (typeof jQuery !== 'undefined') {
        $(document).on('click', '#addSponsorAddress, #addBeneficiaryAddress', function() {
            setTimeout(initAllAptComponents, 100);
        });
    }
    
    // Export for manual calls if needed
    window.initAptComponents = initAllAptComponents;
    window.setupSingleAptComponent = setupAptComponent;
    
})();


(function() {
    'use strict';
    
    /**
     * Handle "Present" checkboxes for address/employment history
     * FIXED: Use readonly instead of disabled so values are submitted
     */
    $(document).on('change', '.present-checkbox', function() {
        const targetInput = $($(this).data('target'));
        
        if ($(this).is(':checked')) {
            // Save previous value
            targetInput.data('previous-value', targetInput.val());
            
            // CRITICAL FIX: Use readonly instead of disabled
            // Readonly fields ARE submitted, disabled fields are NOT
            targetInput.val('Present')
                .prop('readonly', true)
                .css({
                    'background-color': '#e9ecef',
                    'cursor': 'not-allowed'
                });
        } else {
            // Restore previous value
            const prevValue = targetInput.data('previous-value') || '';
            targetInput.val(prevValue)
                .prop('readonly', false)
                .css({
                    'background-color': '',
                    'cursor': ''
                });
        }
    });
    
    /**
     * Handle "Does Not Apply" checkboxes
     * FIXED: More robust handler with better targeting
     */
    $(document).on('change', '.does-not-apply-checkbox', function() {
        const targetSelector = $(this).data('target');
        const targetInput = $(targetSelector);
        
        if (targetInput.length === 0) {
            console.error('Does not apply checkbox target not found:', targetSelector);
            return;
        }
        
        if ($(this).is(':checked')) {
            // Save previous value
            targetInput.data('previous-value', targetInput.val());
            
            // Set to N/A and make readonly
            targetInput.val('N/A')
                .prop('readonly', true)
                .css({
                    'background-color': '#e9ecef',
                    'cursor': 'not-allowed'
                });
        } else {
            // Restore previous value
            const prevValue = targetInput.data('previous-value') || '';
            targetInput.val(prevValue)
                .prop('readonly', false)
                .css({
                    'background-color': '',
                    'cursor': ''
                });
        }
    });
    
    /**
     * Initialize checkboxes on page load
     */
    function initCheckboxes() {
        // Initialize Present checkboxes that are already checked
        $('.present-checkbox:checked').each(function() {
            const targetInput = $($(this).data('target'));
            if (targetInput.val() === 'Present' || targetInput.val() === 'present') {
                targetInput.prop('readonly', true)
                    .css({
                        'background-color': '#e9ecef',
                        'cursor': 'not-allowed'
                    });
            }
        });
        
        // Initialize "Does Not Apply" checkboxes that are already checked
        $('.does-not-apply-checkbox:checked').each(function() {
            const targetInput = $($(this).data('target'));
            if (targetInput.val() === 'N/A') {
                targetInput.prop('readonly', true)
                    .css({
                        'background-color': '#e9ecef',
                        'cursor': 'not-allowed'
                    });
            }
        });
    }
    
    // Initialize on DOM ready
    $(document).ready(function() {
        initCheckboxes();
        
        console.log('Form handlers initialized');
        console.log('Present checkboxes:', $('.present-checkbox').length);
        console.log('Does not apply checkboxes:', $('.does-not-apply-checkbox').length);
    });
    
})();