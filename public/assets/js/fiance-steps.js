$(document).on('change', '.doesNotApply', function(){
    var field = $(this).data('field');
    console.log(field);
    if ($(this).is(':checked') == true) {
        $('.'+field).val('N/A');
        $('.'+field).attr('disabled', true);
    } else {
        $('.'+field).val('');
        $('.'+field).attr('disabled', false);
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

/* =====Marital Status Step Start====== */
$(document).on('change', '.priorSpouse', function(){
    if ($(this).val() == 'widowed' || $(this).val() == 'divorced' || $(this).val() == 'annulled') {
        $('.priorSpouseSec').show();
        $('.appendPriorSpouse').append(priorSpouseHtml(1));
        $('.addPriorSpouse').removeClass('d-none');
    } else {
        $('.priorSpouseSec').hide();
        $('.priorSpouseForm').remove();
    }
    if ($(this).val() == 'married') {
        $('.peragraph').show();
    } else {
        $('.peragraph').hide();
    }
});

$(document).on('click', '.addPriorSpouse', function(){
    var index = $('.appendPriorSpouse > .priorSpouseForm').length + 1;
    datePicker();
    $('.appendPriorSpouse').append(priorSpouseHtml(index));
    if (index == 5) {
        $(this).addClass('d-none');
    }
});

$(document).on('click', '.removePriorSpouse', function(){
    var index = $('appendPriorSpouse > .priorSpouseForm').length;
    $(this).parent().parent().remove();
    if (index <= 5) {
        $('.addPriorSpouse').removeClass('d-none');
    }
});
/* =====Marital Status Step End====== */

/* =====VisitedUS Step Start====== */
$(document).on('click', '.addVisitedUS', function(){
    var index = $('.appendVisitedUS > .visitedUSForm').length + 1;
    datePicker();
    $('.appendVisitedUS').append(visitedPlaceForm(index));
    if (index == 3) {
        $(this).addClass('d-none');
    }
});

$(document).on('click', '.removeVisitedUS', function(){
    var index = $('.appendVisitedUS > .visitedUSForm').length;
    $(this).parent().parent().remove();
    if (index <= 3) {
        $('.addVisitedUS').removeClass('d-none');
    }
});
/* =====VisitedUS Step End====== */

/* =====School Step Start====== */
$(document).on('click', '.addSchoolBtn', function(){
    var index = $('.appendSchool > .schoolForm').length + 1;
    datePicker();
    $('.appendSchool').append(schoolForm(index));
    if (index == 4) {
        $(this).addClass('d-none');
    }
});        

$(document).on('click', '.removeSchoolSec', function(){
    var index = $('.appendSchool > .schoolForm').length;
    $(this).parent().parent().remove();
    if (index <= 4) {
        $('.addSchoolBtn').removeClass('d-none');
    }
});  
$(document).on('click', '.addSkill', function(){
    var index = $('.appendSkill > .skillForm').length + 1;
    datePicker();
    $('.appendSkill').append(occupationalSkillForm(index));
    if (index == 3) {
        $(this).addClass('d-none');
    }
});

$(document).on('click', '.removeSkill', function(){
    var index = $('.appendSkill > .skillForm').length;
    $(this).parent().parent().remove();
    if (index <= 3) {
        $('.addSkill').removeClass('d-none');
    }
});  
/* =====School Step End====== */

/* =====Travel Step Start====== */
$(document).on('click', '.addCountryBtn', function(){
    var index = $('.appendCountry > .countryForm').length + 1;
    $('.appendCountry').append(addAnotherCountry(index));
    if (index == 5) {
        $(this).addClass('d-none');
    }
});      

$(document).on('click', '.removeCountry', function(){
    var index = $('.appendCountry > .countryForm').length;
    $(this).parent().parent().remove();
    if (index <= 5) {
        $('.addCountryBtn').removeClass('d-none');
    }           
});

$(document).on('click', '.addResidedCounBtn', function(){
    var index = $('.appendResidedCounReg > .residedCounReg').length + 1;
    $('.appendResidedCounReg').append(addResidedCountry(index));
    if (index == 5) {
        $(this).addClass('d-none');
    }
});

$(document).on('click', '.removeResidedCounReg', function(){
    var index = $('.appendResidedCounReg > .residedCounReg').length;
    $(this).parent().parent().remove();
    if (index <= 5) {
        $('.addResidedCounBtn').removeClass('d-none');
    }
});
/* =====Travel Step End====== */

/* =====Military Step Start====== */
$(document).on('click', '.servedMilitarySecBtn', function(){
    var index = $('.appendMilitarySec > .servedMilitaryForm').length + 1;
    datePicker();
    $('.appendMilitarySec').append(militaryService(index));
    if (index == 2) {
        $(this).addClass('d-none');
    }
});
$(document).on('click', '.removeMilitaryBtn', function(){
    var index = $('.appendMilitarySec > .servedMilitaryForm').length;
    $(this).parent().parent().remove();
    if (index <= 2) {
        $('.servedMilitarySecBtn').removeClass('d-none');
    }
});
/* =====Military Step End====== */

/* =====Activity Step Start====== */
$(document).on('click', '.addOrganizationBtn', function(){
    var index = $('.orgName').length + 1;
    $('.appendOrg').append(organizationDrop(index));
    if (index == 5) {
        $(this).addClass('d-none');
    }
});
$(document).on('click', '.removeOrgName', function(){
    var index = $('.orgName').length;
    $(this).parent().parent().remove();
    if (index <= 5) {
        $('.addOrganizationBtn').removeClass('d-none');
    }
});
/* =====Activity Step End====== */

/* =====Language Step Start====== */
$(document).on('click', '.addLanguageBtn', function(){
    var index = $('.appendLanguage > .language').length + 1;
    $('.appendLanguage').append(languageField(index));
    if (index == 5) {
        $(this).addClass('d-none');
    }
});
$(document).on('click', '.removeLanguage', function(){
    var index = $('.appendLanguage > .language').length;
    $(this).parent().parent().remove();
    if (index <= 5) {
        $('.addLanguageBtn').removeClass('d-none');
    }
});
/* =====Language Step End====== */

/* =====Relatives Step Start====== */
$(document).on('click', '.addRelativeBtn', function(){
    var index = $('.appendRelative > .appendRelativeForm').length + 1;
    $('.appendRelative').append(relativeForm(index));
    if (index == 5) {
        $(this).addClass('d-none');
    }
});
$(document).on('click', '.removeRelativeBtn', function(){
    var index = $('.appendRelative > .appendRelativeForm').length;
    $(this).parent().parent().remove();
    if (index <= 5) {
        $('.addRelativeBtn').removeClass('d-none');
    }
});
/* =====Relatives Step End====== */
