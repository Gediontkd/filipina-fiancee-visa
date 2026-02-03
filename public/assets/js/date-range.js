// Set global defaults for all datepickers
$.datepicker.setDefaults({
    changeMonth: true,
    changeYear: true,
    yearRange: "c-100:c+10",
    showButtonPanel: true
});

// Date Picker
$(function () {
    $(".datePicker").datepicker();
});

// Date of Birth
$(function () {
    $(".dateOfBirth").datepicker({
        changeYear: true,
        yearRange: "c-100:c+0",
        maxDate: new Date()
    });
});

// Expire Date Picker
$(function () {
    $(".disablePastDate").datepicker({
        minDate: 0
    });
}); 