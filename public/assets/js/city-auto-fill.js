/**
 * FILE: public/assets/js/city-auto-fill.js
 * 
 * Automatic Province/Country logic for Philippine cities
 * - Manila → Province: Metro Manila (locked), Country: Philippines
 * - Cebu → Auto-corrects to "Cebu City", Province: Cebu (locked), Country: Philippines
 * 
 * UPDATED: Simplified initialization to ensure it always runs
 */

(function($) {
    'use strict';

    // Only run if jQuery is available
    if (typeof $ === 'undefined') {
        console.error('City auto-fill requires jQuery');
        return;
    }

    /**
     * City configuration mapping
     */
    const CITY_CONFIG = {
        'manila': {
            cityName: 'Manila',
            province: 'Metro Manila',
            country: 'Philippines',
            lockProvince: true
        },
        'cebu': {
            cityName: 'Cebu City',
            province: 'Cebu',
            country: 'Philippines',
            lockProvince: true
        },
        'cebu city': {
            cityName: 'Cebu City',
            province: 'Cebu',
            country: 'Philippines',
            lockProvince: true
        }
    };

    /**
     * Apply auto-fill logic to a city field
     */
    function applyCityAutoFill(cityField, provinceField, countryField) {
        if (!cityField || !provinceField || !countryField) {
            return;
        }

        const cityValue = $(cityField).val().trim().toLowerCase();
        const config = CITY_CONFIG[cityValue];

        if (config) {
            console.log('City auto-fill triggered for:', cityValue, '→', config.cityName);

            // Auto-correct city name if needed
            if ($(cityField).val().trim() !== config.cityName) {
                $(cityField).val(config.cityName);
            }

            // Set province and lock if specified
            $(provinceField).val(config.province);
            if (config.lockProvince) {
                $(provinceField).prop('readonly', true)
                    .css('background-color', '#e9ecef')
                    .attr('title', 'Auto-filled and locked for ' + config.cityName);
            }

            // Set country (remains editable)
            if (countryField.tagName === 'SELECT') {
                // For select dropdowns, find and select the Philippines option
                $(countryField).find('option').each(function() {
                    const optionText = $(this).text().toLowerCase();
                    const optionValue = $(this).val().toLowerCase();
                    if (optionText.includes('philippines') || 
                        optionValue.includes('ph') || 
                        optionValue === 'philippines') {
                        $(countryField).val($(this).val());
                        return false; // break loop
                    }
                });
            } else {
                $(countryField).val(config.country);
            }

            // Add visual indicator
            $(cityField).css({
                'border-left': '3px solid #28a745'
            }).attr('title', 'Auto-filled province and country');

        } else {
            // Unlock province field if city doesn't match
            $(provinceField).prop('readonly', false)
                .css('background-color', '')
                .attr('title', '');
            $(cityField).css('border-left', '').attr('title', '');
        }
    }

    /**
     * Attach blur event to a city field
     */
    function attachCityBlurEvent(citySelector, provinceSelector, countrySelector) {
        const cityField = $(citySelector);
        const provinceField = $(provinceSelector);
        const countryField = $(countrySelector);

        if (cityField.length && provinceField.length && countryField.length) {
            // Remove existing handler to prevent duplicates
            cityField.off('blur.cityautofill');
            
            // Attach new handler
            cityField.on('blur.cityautofill', function() {
                applyCityAutoFill(this, provinceField[0], countryField[0]);
            });

            // Check on initialization if field already has a value
            if (cityField.val().trim()) {
                applyCityAutoFill(cityField[0], provinceField[0], countryField[0]);
            }

            console.log('City auto-fill attached to:', citySelector);
        }
    }

    /**
     * Initialize static fields
     */
    function initializeStaticFields() {
        console.log('Initializing static city auto-fill fields...');

        // Sponsor mailing address
        attachCityBlurEvent(
            'input[name="sponsor_mailing_city"]',
            'input[name="sponsor_mailing_state"]',
            'select[name="sponsor_mailing_country"]'
        );

        // Sponsor physical address
        attachCityBlurEvent(
            'input[name="sponsor_city"]',
            'input[name="sponsor_state"]',
            'select[name="sponsor_country"]'
        );

        // Beneficiary mailing address
        attachCityBlurEvent(
            'input[name="beneficiary_mailing_city"]',
            'input[name="beneficiary_mailing_state"]',
            'select[name="beneficiary_mailing_country"]'
        );

        // Beneficiary physical address
        attachCityBlurEvent(
            'input[name="beneficiary_city"]',
            'input[name="beneficiary_state"]',
            'select[name="beneficiary_country"]'
        );

        // Marriage location
        attachCityBlurEvent(
            'input[name="marriage_location_city"]',
            'input[name="marriage_location_province"]',
            'select[name="marriage_location_country"]'
        );
    }

    /**
     * Initialize dynamic address history fields
     */
    function initializeDynamicFields(person) {
        console.log('Initializing dynamic fields for:', person);

        const container = $('#' + person + '_address_history_container');
        if (!container.length) return;

        container.find('.address-history-item').each(function() {
            const index = $(this).data('index');
            
            attachCityBlurEvent(
                'input[name="' + person + '_address_history[' + index + '][city]"]',
                'input[name="' + person + '_address_history[' + index + '][state]"]',
                'select[name="' + person + '_address_history[' + index + '][country]"]'
            );
        });
    }

    /**
     * Public function to reinitialize dynamic fields
     */
    window.reinitializeCityAutoFill = function(person) {
        console.log('Reinitializing city auto-fill for:', person);
        initializeDynamicFields(person);
    };

    /**
     * Initialize everything
     */
    function initialize() {
        console.log('City auto-fill module initializing...');
        
        initializeStaticFields();
        initializeDynamicFields('sponsor');
        initializeDynamicFields('beneficiary');
        
        console.log('City auto-fill initialization complete!');
    }

    // Initialize when document is ready
    $(document).ready(function() {
        initialize();
    });

})(jQuery);