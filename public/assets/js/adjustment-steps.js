$(document).on('change', '.doesNotApply', function(){
    var field = $(this).data('field');
    if ($(this).is(':checked') == true) {
        $('.'+field).val('N/A');
        $('.'+field).attr('disabled','disabled');
    } else {
        $('.'+field).val('');
        $('.'+field).removeAttr('disabled');
    }
})
function datePicker()
{
    $(function(){
        $(".datePicker").datepicker();
    });

    $(function(){
        $(".dateOfBirth").datepicker({
            maxDate: new Date()
        });
    }); 

    $(function(){
        $(".disablePastDate").datepicker({
            minDate: 0
        });
    }); 
}

/* =====Visa Info Start====== */
$(document).on('click', '.addCountryBtn', function(){
    var index = $('.appendCountry > .countryForm').length + 1;
    $('.appendCountry').append(addAnotherCountry(index));
    if (index == 2) {
        $(this).addClass('d-none');
    }
});      

$(document).on('click', '.removeCountry', function(){
    var index = $('.appendCountry > .countryForm').length;
    $(this).parent().parent().remove();
    if (index <= 2) {
        $('.addCountryBtn').removeClass('d-none');
    }           
});
/* =====Visa Info End====== */

/* =====Civil Status Step Start====== */
$(document).on('change', '.priorSpouse', function(){
    if ($(this).val() == 'yes') {
        $('.priorSpouseSec').show();
        $('.appendPriorSpouse').append(priorSpouseHtml(1));
        $('.addPriorSpouse').removeClass('d-none');
    } else {
        $('.priorSpouseSec').hide();
        $('.priorSpouseForm').remove();
    }
});

$(document).on('click', '.addPriorSpouse', function(){
    var index = $('.appendPriorSpouse > .priorSpouseForm').length + 1;
    datePicker();
    $('.appendPriorSpouse').append(priorSpouseHtml(index));
    if (index == 2) {
        $(this).addClass('d-none');
    }
});

$(document).on('click', '.removePriorSpouse', function(){
    var index = $('appendPriorSpouse > .priorSpouseForm').length;
    $(this).parent().parent().remove();
    if (index <= 2) {
        $('.addPriorSpouse').removeClass('d-none');
    }
});
/* =====Civil Status Step End====== */

/* =====Child Step Start====== */
$(document).on('change', '.haveChild', function(){
    if ($(this).val() == 'yes') {
        $('.addChildernSec').show();
        $('.appendChildern').append(addChildernHtml(1));
        $('.addChildern').removeClass('d-none');
    } else {
        $('.addChildernSec').hide();
        $('.addChildernForm').remove();
    }
});

$(document).on('click', '.addChildern', function(){
    var index = $('.appendChildern > .addChildernForm').length + 1;
    datePicker();
    $('.appendChildern').append(addChildernHtml(index));
    if (index == 5) {
        $(this).addClass('d-none');
    }
});

$(document).on('click', '.removeChildern', function(){
    var index = $('appendChildern > .addChildernForm').length;
    $(this).parent().parent().remove();
    if (index <= 5) {
        $('.appendChildern').removeClass('d-none');
    }
});
/* =====Child Step End====== */

/* =====Affiliation Step Start====== */
$(document).on('change', '.affiliation', function(){
    if ($(this).val() == 'yes') {
        $('.affiliationSec').show();
        $('.appendAffiliation').append(addChildernHtml(1));
        $('.addAffiliation').removeClass('d-none');
    } else {
        $('.affiliationSec').hide();
        $('.addAffiliationForm').remove();
    }
});

$(document).on('click', '.addAffiliation', function(){
    var index = $('.appendAffiliation > .addAffiliationForm').length + 1;
    datePicker();
    $('.appendAffiliation').append(addChildernHtml(index));
    if (index == 6) {
        $(this).addClass('d-none');
    }
});

$(document).on('click', '.removeAffiliation', function(){
    var index = $('appendAffiliation > .addAffiliationForm').length;
    $(this).parent().parent().remove();
    if (index <= 6) {
        $('.addAffiliation').removeClass('d-none');
    }
});
/* =====Affiliation Step End====== */