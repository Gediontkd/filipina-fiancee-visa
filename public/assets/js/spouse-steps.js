// public\assets\js\spouse-steps.js
$(document).on("change", ".applyUnkown", function () {
  var field = $(this).data("field");
  // console.log($('.'+field).attr('type'));
  if ($("." + field).attr("type") == "text") {
    if ($(this).is(":checked") == true) {
      $("." + field).val("Unkown");
      $("." + field).attr("disabled", true);
    } else {
      $("." + field).val("");
      $("." + field).attr("disabled", false);
    }
  } else {
    if ($(this).is(":checked") == true) {
      $("." + field).attr("disabled", true);
      $("." + field).prepend('<option selected value="Unkown">Unkown</option>');
    } else {
      $("." + field).attr("disabled", false);
      $("." + field + ' option[value="Unkown"]').remove();
    }
  }
});

$(document).on("change", ".doesNotApplySelect", function () {
  var field = $(this).data("field");
  var subfield = $(this).data("subfield");

  if ($(this).is(":checked") == true) {
    $("." + field).prepend('<option selected value="N/A">N/A</option>');
    $("." + field).prop("disabled", true);
    $("." + subfield).val("N/A");
    $("." + subfield).attr("readonly", true);
  } else {
    $("." + subfield).val("");
    $("." + subfield).attr("readonly", false);
    $("." + field + ' option[value="N/A"]').remove();
    $("." + field).prop("disabled", false);
  }
});

$(document).on("change", ".doesNotApply", function () {
  var field = $(this).data("field");
  // console.log($('.'+field).attr('type'));
  if ($("." + field).attr("type") == "text") {
    if ($(this).is(":checked") == true) {
      $("." + field).val("N/A");
      $("." + field).attr("readonly", true);
      $("." + field).datepicker("option", "disabled", true);
    } else {
      $("." + field).val("");
      $("." + field).attr("readonly", false);
      $("." + field).datepicker("option", "disabled", false);
    }
  } else {
    if ($(this).is(":checked") == true) {
      $("." + field).prepend('<option selected value="N/A">N/A</option>');
      $("." + field).attr("readonly", true);
    } else {
      $("." + field + ' option[value="N/A"]').remove();
      $("." + field).attr("readonly", false);
    }
  }
});
function datePicker() {
  $(function () {
    $(".datePicker").datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "c-100:c+10"
    });
  });

  $(function () {
    $(".dateOfBirth").datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "c-100:c+0",
      maxDate: new Date(),
    });
  });

  $(function () {
    $(".disablePastDate").datepicker({
      minDate: 0,
    });
  });
}

/* =====VisitedUS Step Start====== */
$(document).on("click", ".addVisitedUS", function () {
  var index = $(".appendVisitedUS > .visitedUSForm").length + 1;
  datePicker();
  $(".appendVisitedUS").append(visitedPlaceForm(index));
  if (index == 3) {
    $(this).addClass("d-none");
  }
});

$(document).on("click", ".removeVisitedUS", function () {
  var index = $(".appendVisitedUS > .visitedUSForm").length;
  $(this).parent().parent().remove();
  if (index <= 3) {
    $(".addVisitedUS").removeClass("d-none");
  }
});
/* =====VisitedUS Step End====== */

/* =====Marital Status Step Start====== */
// Proir Spouse section
$(document).on("change", ".priorSpouse", function () {
  if ($(this).val() == "yes") {
    $(".priorSpouseSec").show();
    $(".appendPriorSpouse").append(priorSpouseHtml(1));
    $(".addPriorSpouse").removeClass("d-none");
  } else {
    $(".priorSpouseSec").hide();
    $(".priorSpouseForm").remove();
  }
});

$(document).on("click", ".addPriorSpouse", function () {
  var index = $(".appendPriorSpouse > .priorSpouseForm").length + 1;
  datePicker();
  $(".appendPriorSpouse").append(priorSpouseHtml(index));
  if (index == 5) {
    $(this).addClass("d-none");
  }
});

$(document).on("click", ".removePriorSpouse", function () {
  var index = $("appendPriorSpouse > .priorSpouseForm").length;
  $(this).parent().parent().remove();
  if (index <= 5) {
    $(".addPriorSpouse").removeClass("d-none");
  }
});

/* =====School Step Start====== */
$(document).on("click", ".addSchoolBtn", function () {
  var index = $(".appendSchool > .schoolForm").length + 1;
  datePicker();
  $(".appendSchool").append(schoolForm(index));
  if (index == 4) {
    $(this).addClass("d-none");
  }
});

$(document).on("click", ".removeSchoolSec", function () {
  var index = $(".appendSchool > .schoolForm").length;
  $(this).parent().parent().remove();
  if (index <= 4) {
    $(".addSchoolBtn").removeClass("d-none");
  }
});
$(document).on("click", ".addSkill", function () {
  var index = $(".appendSkill > .skillForm").length + 1;
  datePicker();
  $(".appendSkill").append(occupationalSkillForm(index));
  if (index == 3) {
    $(this).addClass("d-none");
  }
});

$(document).on("click", ".removeSkill", function () {
  var index = $(".appendSkill > .skillForm").length;
  $(this).parent().parent().remove();
  if (index <= 3) {
    $(".addSkill").removeClass("d-none");
  }
});
/* =====School Step End====== */

// BiologicalChild section
$(document).on("change", ".biologicalChild", function () {
  if ($(this).val() == "yes") {
    $(".biologicalChildSec").show();
    $(".appendbiologicalChild").append(biologicalChildHtml(1));
    $(".addbiologicalChild").removeClass("d-none");
  } else {
    $(".biologicalChildSec").hide();
    $(".biologicalChildForm").remove();
  }
});

$(document).on("click", ".addbiologicalChild", function () {
  var index = $(".appendbiologicalChild > .biologicalChildForm").length + 1;
  datePicker();
  $(".appendbiologicalChild").append(biologicalChildHtml(index));
  if (index == 9) {
    $(this).addClass("d-none");
  }
});

$(document).on("click", ".removebiologicalChild", function () {
  var index = $("appendbiologicalChild > .biologicalChildForm").length;
  $(this).parent().parent().remove();
  if (index <= 9) {
    $(".addbiologicalChild").removeClass("d-none");
  }
});

/* =====Merital Status (Fiance Sponsor) End====== */
$(document).on("click", ".addChildern", function () {
  var index = $(".appendChildern > .addChildernForm").length + 1;
  datePicker();
  $(".appendChildern").append(addChildernHtml(index));
  if (index == 9) {
    $(this).addClass("d-none");
  }
});

$(document).on("click", ".removeChildern", function () {
  var index = $("appendChildern > .addChildernForm").length;
  $(this).parent().parent().remove();
  if (index <= 9) {
    $(".appendChildern").removeClass("d-none");
  }
});
/* =====Merital Status End====== */

/* =====Other Filings Step Start====== */
// Filed Petition section
$(document).on("change", ".filedPetition", function () {
  if ($(this).val() == "yes") {
    $(".filedPetitionSec").show();
    $(".appendfiledPetition").append(filedPetitionHtml(1));
    $(".addfiledPetition").removeClass("d-none");
  } else {
    $(".filedPetitionSec").hide();
    $(".filedPetitionForm").remove();
  }
});

$(document).on("click", ".addFiledPetition", function () {
  var index = $(".appendfiledPetition > .filedPetitionForm").length + 1;
  datePicker();
  $(".appendfiledPetition").append(filedPetitionHtml(index));
  if (index == 3) {
    $(this).addClass("d-none");
  }
});

$(document).on("click", ".removefiledPetition", function () {
  var index = $("appendfiledPetition > .filedPetitionForm").length;
  $(this).parent().parent().remove();
  if (index <= 3) {
    $(".addFiledPetition").removeClass("d-none");
  }
});

// Relative section
$(document).on("change", ".relative", function () {
  if ($(this).val() == "yes") {
    $(".relativeSec").show();
    $(".appendRelative").append(relativeHtml(1));
    $(".addRelative").removeClass("d-none");
  } else {
    $(".relativeSec").hide();
    $(".relativeForm").remove();
  }
});

$(document).on("click", ".addRelative", function () {
  var index = $(".appendRelative > .relativeForm").length + 1;
  datePicker();
  $(".appendRelative").append(relativeHtml(index));
  if (index == 5) {
    $(this).addClass("d-none");
  }
});

$(document).on("click", ".removeRelative", function () {
  var index = $("appendRelative > .relativeForm").length;
  $(this).parent().parent().remove();
  if (index <= 5) {
    $(".addRelative").removeClass("d-none");
  }
});
/* =====Other Filings Step End====== */

/* =====Address Step End====== */
$(document).on("click", ".addCountryBtn", function () {
  var index = $(".appendCountry > .countryForm").length + 1;
  $(".appendCountry").append(addAnotherCountry(index));
  if (index == 10) {
    $(this).addClass("d-none");
  }
});

$(document).on("click", ".removeCountry", function () {
  var index = $(".appendCountry > .countryForm").length;
  $(this).parent().parent().remove();
  if (index <= 10) {
    $(".addCountryBtn").removeClass("d-none");
  }
});

$(document).on("click", ".addResidedCounBtn", function () {
  var index = $(".appendResidedCounReg > .residedCounReg").length + 1;
  $(".appendResidedCounReg").append(addResidedCountry(index));
  if (index == 5) {
    $(this).addClass("d-none");
  }
});

/* =====Language Step Start====== */
$(document).on("click", ".addLanguageBtn", function () {
  var index = $(".appendLanguage > .language").length + 1;
  $(".appendLanguage").append(languageField(index));
  if (index == 5) {
    $(this).addClass("d-none");
  }
});
$(document).on("click", ".removeLanguage", function () {
  var index = $(".appendLanguage > .language").length;
  $(this).parent().parent().remove();
  if (index <= 5) {
    $(".addLanguageBtn").removeClass("d-none");
  }
});
/* =====Language Step End====== */

$(document).on("click", ".removeResidedCounReg", function () {
  var index = $(".appendResidedCounReg > .residedCounReg").length;
  $(this).parent().parent().remove();
  if (index <= 5) {
    $(".addResidedCounBtn").removeClass("d-none");
  }
});
/* =====Address Step End====== */
function calculateDurationMinus5Years(startDate, endDate) {
  console.log("startDate", startDate);
  console.log("endDate", endDate);
  var startDateObj = new Date(startDate);
  var endDateObj = new Date(endDate);

  // Subtract 5 years from the end date.
  endDateObj.setFullYear(endDateObj.getFullYear() - 5);

  // Calculate the difference in years, months, and days.
  var yearsDiff = endDateObj.getFullYear() - startDateObj.getFullYear();
  var monthsDiff = endDateObj.getMonth() - startDateObj.getMonth();
  var daysDiff = endDateObj.getDate() - startDateObj.getDate();

  // Adjust for negative values in months and days.
  if (daysDiff < 0) {
    monthsDiff--;
    daysDiff += new Date(
      endDateObj.getFullYear(),
      endDateObj.getMonth() + 1,
      0
    ).getDate();
  }
  if (monthsDiff < 0) {
    yearsDiff--;
    monthsDiff += 12;
  }

  // Return the duration in years and months as a string.
  return yearsDiff + " years, " + monthsDiff + " months";
}

// Prevent form buttons from triggering form submission
$(document).on('click', '.spousePreviousOrContinue', function (e) {
  e.preventDefault();
  e.stopPropagation();

  var section = $(this).data('section');
  var form = $(this).data('form');

  // Don't process if it's a section header
  if ($(this).hasClass('section-header')) {
    return false;
  }

  // Validate section and form exist
  if (!section || !form) {
    toastr.error('Navigation error: missing section or form data');
    return false;
  }

  // Show loading
  var $btn = $(this);
  var originalHtml = $btn.html();
  $btn.html('Loading...').prop('disabled', true);

  $.ajax({
    headers: {
      'X-CSRF-Token': $('input[name="_token"]').val()
    },
    type: 'post',
    url: '/spouse-visa/navigate',
    data: {
      section: section,
      form: form
    },
    dataType: 'json',
    success: function (data) {
      if (data.status) {
        // Remove active from all items
        $('#progressbar li:not(.section-header)').removeClass('active');

        // Add active to the target
        $('.' + section + '-' + form).addClass('active');

        // Load the form content
        $('.spouseVisaForm').html(data.step);

        // Scroll to top of form
        $('html, body').animate({
          scrollTop: $('.spouseVisaForm').offset().top - 100
        }, 300);
      } else {
        toastr.error(data.message || 'Failed to load form');
      }
    },
    error: function (xhr) {
      var errorMsg = xhr.responseJSON?.message || 'Failed to load section. Please try again.';
      toastr.error(errorMsg);
      console.error('Navigation error:', xhr.responseJSON);
    },
    complete: function () {
      $btn.html(originalHtml).prop('disabled', false);
    }
  });

  return false;
});