// Date Picker
$(function(){
    $(".datePicker").datepicker();
});

// Date of Birth
$(function(){
    $(".dateOfBirth").datepicker({
        maxDate: new Date()
    });
}); 

// Expire Date Picker
$(function(){
    $(".disablePastDate").datepicker({
        minDate: 0
    });
}); 