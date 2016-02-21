// ============================================================

// summary object
// children, childIncome, adults, adultIncome = array of objects
var summary = {
  "children": [],
  "childIncome": [
    {
      "annual": 0,
      "annualEarnings": 0,
      "annualOther": 0,
      "annualOtherHousehold": 0,
      "annualSocial": 0,
      "earningsAmount": 0,
      "earningsFrequency": "",
      "otherAmount": 0,
      "otherFrequency": "",
      "otherHouseholdAmount": 0,
      "otherHouseholdFrequency": "",
      "socialAmount": 0,
      "socialFrequency": ""
    }    
  ],
  "adults": [],
  "adultIncome": [
    {
      "annual": 0,
      "annualAssistance": 0,
      "annualEarnings": 0,
      "annualPension": 0,
      "assistanceAmount": 0,
      "assistanceFrequency": "",
      "earningsAmount": 0,
      "earningsFrequency": "",
      "pensionAmount": 0,
      "pensionFrequency": ""
    }  
  ],
  "raceEthnicity": {
    "ethnicity": "",
    "race": []  
  },
  "assistance": {
    "status": "",
    "caseNumber": 0
  },
  "household": {
    "size": 2,
    "income": 0
  },
  "ssn": {
    "number": 0,
    "status": ""
  },
  "contactInfo": {},
  "date" : ""
};




// ============================================================

// current section
var currentSection = 0;



// ============================================================

// assistance & income requirements (for skip logic)
var assistanceRequirements = true;
var incomeRequirements = true;



// ============================================================

// field validation count
var fieldsToValidate = 0;
var fieldsValidated = 0;



// ============================================================

// delay function
var delayTrigger = (function() {
	var timer = 0;
	return function(callback, ms) {
		clearTimeout(timer);
		timer = setTimeout(callback, ms);
	};
})();



// ============================================================

// warning function (for when user tries to leave the page before submitting)
function formWarning(state) {

  if (state) {
    $(window).bind("beforeunload", function(){
      return "Your application has not been submitted yet.";
    });
  } else {
    $(window).unbind("beforeunload")
  };
  
}


    
// ============================================================

// help object
var help = {
  
  "init" : function(trigger) {
    var $this = $(trigger);
    $this.on("mouseenter focus", function() {
      help.show($this);
    }).on("mouseleave blur", function() {
      help.hide($this);
    }).on("click", function() {
      return false;
    }); 
    $(document).on("click", function() {
      help.hide($this);
    });
  },

  "show" : function(trigger) {
    
    var $this = $(trigger);
    var $helpText = $this.siblings(".help-text");
    var position = ($this.position());
    var triggerHeight = $this.height(); 
    var rightLimit = 0;

    // check if the label is in a table
    if ($this.parent().parent().is("th")) {
      rightLimit = 540;
    } else {
      rightLimit = 720;
    };
    
    // change position if help text is far right
    $(".help-text").hide();
      if (position.left > rightLimit) {
        $helpText.css({
          left: position.left - 332 + $this.width(),
          top: position.top + triggerHeight,
          opacity: 1
        }).fadeIn({
          queue: false, 
          duration: 120}      
        ).animate({
          top: '+=8px'
        }, 120);    
      } else {
        $helpText.css({
          left: position.left - 12,
          top: position.top + triggerHeight,
          opacity: 1
        }).fadeIn({
          queue: false, 
          duration: 120}      
        ).animate({
          top: '+=8px'
        }, 120);    
      };
              
  },
      
  "hide" : function(trigger) {
    
    $(trigger).siblings(".help-text").fadeOut({
      queue: false, 
      duration: 120}      
    ).animate({
      top: '+=8px'
    }, 120);    

  }  

};



// ============================================================

// fieldValidation object
var fieldValidation = {
    
    
    
  // method:
  // check required fields
  "required" : function(field, single) {
    
    var $this = $(field);
    var $section = $this.closest(".form__section");
    var fieldType = $(field).attr('type');
    var fieldName = $(field).attr('name');

    if ($this.is("input")) {

      switch(fieldType) {
        
        // text inputs
        case "text":
        
          // if empty, show error
          if (!($this.val())) {
            $this.addClass("input__error");
            $this.siblings(".input__error-message").show();
            $this.siblings(".input__error-message").find(".input__error-message--validation").hide();
            $this.siblings(".input__error-message").find(".input__error-message--required").fadeIn(100);
            
          // if not empty, hide error
          } else {
            $this.removeClass("input__error");
            $this.siblings(".input__error-message").hide();
            $this.siblings(".input__error-message").find(".input__error-message--validation").hide();
            $this.siblings(".input__error-message").find(".input__error-message--required").hide();
            fieldsValidated++;
            
            // if it's an input-radio pair, add required to the radio; e.g. income amount & income frequency
            if ($this.hasClass("required-pair-input-radio")) {
              if ($this.val() !== "0") {
                $this.parent().siblings("fieldset").find("input[type=radio]").addClass("required");
                fieldValidation.live();
              };
            };
          };
          break;
        
        // radio buttons
        case "radio":
        
          // if empty, show error
          if (!($("input[name=" + fieldName + "]").is(":checked"))) {
            $this.closest("fieldset").next(".input__error-message").css("display","block");
            $this.closest("fieldset").next(".input__error-message .input__error-message--required").fadeIn(100);
          // if not empty, hide error
          } else {
            $this.closest("fieldset").next(".input__error-message").hide();
            $this.closest("fieldset").next(".input__error-message .input__error-message--required").hide();
        
            // if it's an radio-input pair, add required to the input; e.g. assistance & case number
            if ($this.hasClass("required-pair-radio-input")) {
              if ($this.is(":checked")) {
                $this.parent().next().find("input").addClass("required");
                fieldValidation.live();
              };
            };
            
            fieldsValidated++;
            
          };
          break;
          
      };
    
    // dropdown menus
    } else if ($this.is("select")) {
      if (!($this.val())) {
        $this.addClass("input__error");
        $this.siblings(".input__error-message").fadeIn(100);
      } else {
        $this.removeClass("input__error");
        $this.siblings(".input__error-message").hide();
        fieldsValidated++;
      }
    };

  },


  
  // method:
  // check numbers
  "number" : function(field) {

    var $this = $(field);

    var cleanValue = Math.round(parseInt($this.val().replace(",","")));
    if (isNaN(cleanValue)) {
      $this.val(0);
      $this.removeClass("input__error");
      $this.siblings(".input__error-message").hide();
      $this.siblings(".input__error-message .input__error-message--required").hide();
      fieldsValidated++;
    } else {
      $this.val(cleanValue);    
    }
    
  },
  
  
  
  // method:
  // check ssn
  "ssn" : function(field) {

    var $this = $(field);
    var value = $this.val();

    // if user entered a value,
    if (value) {
      // and it's 4 digits long, field is validated
      if (value.length == 4) {
        $this.removeClass("input__error");
        $this.siblings(".input__error-message").hide();
        fieldsValidated++;
      // otherwise throw validation error
      } else {
        $this.addClass("input__error");
        $this.siblings(".input__error-message").show().find(".input__error-message--validation").fadeIn(100);
        $this.siblings(".input__error-message").find(".input__error-message--required").hide();
      }
    
    // otherwise throw required error
    } else {
      $this.addClass("input__error");
      $this.siblings(".input__error-message").show().find(".input__error-message--required").fadeIn(100);
      $this.siblings(".input__error-message").find(".input__error-message--validation").hide();      
    }

  },
  
  

  // method:
  // check email
  "email" : function(field) {
    
    var $this = $(field);
    var value = $this.val();
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;

    if (value) {
      // if user fills out email, validate format
      if (!(pattern.test(value))) {
        $this.addClass("input__error");
        $this.siblings(".input__error-message").show();
        $this.siblings(".input__error-message").find(".input__error-message--validation").fadeIn(100);
      } else {
        $this.removeClass("input__error");
        $this.siblings(".input__error-message").hide();
        fieldsValidated++;
      }
    } else {
      // if empty, reduce count from fieldsToValidate
      $this.removeClass("input__error");
      $this.siblings(".input__error-message").hide();
      fieldsToValidate--;
    };
    
  },
  
  
  
  // method:
  // auto-format phone number
  "phone" : function(field) {
    var $this = $(field);
    var formattedNumber = $this.val().split("-").join(""); // remove hyphens
    formattedNumber = formattedNumber.match(new RegExp('.{1,4}$|.{1,3}', 'g')).join("-");
    $this.val(formattedNumber);
  },



  // method:
  // validations on user interaction (blur, keyup, etc)
  "live" : function() {

    $(".required").unbind("blur").on("blur", function() {
      
      var fieldType = $(this).attr('type');
      fieldsToValidate = 1;
      fieldsValidated = 0;
      
      // when the focus is on a radio/checkbox option & the user selects that option, the error message is briefly flashed
      // this is because the error validation is triggered immediately on blur (before the click happens)
      // to fix this, add a slight delay before calling the validation
      if (fieldType == "radio" || fieldType == "checkbox") {
        setTimeout(function() {
          if ($(this).is(":checked")) {
            fieldValidation.required($(this), true);      
          }
        }, 1200);
      } else {
        fieldValidation.required($(this), true);      
      };

    });
    
    $(".required-pair-radio-input").on("keyup", function() {
      var $radio = $(this).parent().prev().find("input[type=radio]");
      if (!($radio.is(":checked"))) {
        $(this).parent().prev().find("input[type=radio]").attr("checked","checked");    
        $(this).addClass("required");
      };
    });
    
    $(".validate-number").on("blur", function() {
      fieldValidation.number($(this));
    });

    $(".validate-ssn").on("blur", function() {
      fieldValidation.ssn($(this));
    });

    $(".validate-email").on("blur", function() {
      fieldValidation.email($(this));
    });

    $(".validate-phone").on("keyup", function() {
      fieldValidation.phone($(this));
    });
    
  },
  
  
  
  // method:
  // check error
  "error" : function(section, number1, number2) {

/*
    console.log("all " + fieldsToValidate);
    console.log("valid " + fieldsValidated);
*/
              
    // all the fields validate if the 2 numbers match; show/hide global error msg
    if (fieldsToValidate == fieldsValidated) {
      $("#form__section--error").fadeOut(120);
      return true;
    } else {
      $("#form__section--error").fadeIn(120);
      return false;
    }
        
  }
  
}



// ============================================================

// household object
var household = {
    
    
    
  // method: 
  // calculate household size
  "calculateSize" : function() {
  
    // get children info 
    var children = [];
    for (i = 1; i < ($("#form__section-1 .child").length + 1); i++) { 
      var childEach = {};
      childEach.firstName = $("#child-first-name-" + i).val();
      childEach.middleInitial = $("#child-middle-initial-" + i).val();
      childEach.lastName = $("#child-last-name-" + i).val();
      childEach.studentStatus = $("#child-status-student-" + i + ":checked").val();
      childEach.fosterStatus = $("#child-status-foster-" + i + ":checked").val();
      childEach.headstartStatus = $("#child-status-headstart-" + i + ":checked").val();
      childEach.homelessMigrantRunawayStatus = $("#child-status-homeless-migrant-runaway-" + i + ":checked").val();
      children.push(childEach);
    };
  
    // get adult info 
    var adults = [];
    for (i = 1; i < ($("#form__section-3 .adult").length + 1); i++) { 
      var adultEach = {};
      adultEach.firstName = $("#adult-first-name-" + i).val();
      adultEach.lastName = $("#adult-last-name-" + i).val();
      adults.push(adultEach);
    };
  
    // push into summary object
    summary.children = children;
    summary.adults = adults;
  
    // calculate household size & push into summary object
    summary.household.size = summary.adults.length + summary.children.length;
  
    // update text 
    $("#total-household-members").text(summary.household.size).addClass("highlight");
    setTimeout(function() {
      $(".highlight").removeClass("highlight");        
    }, 480);

  },
  
  
  
  // method: 
  // calculate household income
  "calculateIncome" : function() {
    
    var householdIncome = 0;
    
    // get child income info 
    var childIncome = [];
    for (i=1; i<($("#form__section-3 .child-each").length + 1); i++) { 

      var childIncomeEach = {};

      childIncomeEach.earningsAmount = parseInt($("#child-income-earnings-amount-" + i).val());
      childIncomeEach.earningsFrequency = $("input[name=child-income-earnings-frequency-" + i + "]:checked").val();
      childIncomeEach.socialAmount = parseInt($("#child-income-social-amount-" + i).val());
      childIncomeEach.socialFrequency = $("input[name=child-income-social-frequency-" + i + "]:checked").val();
      childIncomeEach.otherHouseholdAmount = parseInt($("#child-income-other-household-amount-" + i).val());
      childIncomeEach.otherHouseholdFrequency = $("input[name=child-income-other-household-frequency-" + i + "]:checked").val();
      childIncomeEach.otherAmount = parseInt($("#child-income-other-amount-" + i).val());
      childIncomeEach.otherFrequency = $("input[name=child-income-other-frequency-" + i + "]:checked").val();

      switch(childIncomeEach.earningsFrequency) {
        case "Weekly":
          childIncomeEach.annualEarnings = childIncomeEach.earningsAmount * 52;
          break;
        case "Bi-Weekly":
          childIncomeEach.annualEarnings = childIncomeEach.earningsAmount * 26;
          break;
        case "2x A Month":
          childIncomeEach.annualEarnings = childIncomeEach.earningsAmount * 24;
          break;
        case "Monthly":
          childIncomeEach.annualEarnings = childIncomeEach.earningsAmount * 12;
          break;
        default:
          childIncomeEach.annualEarnings = 0;
          break;
      };

      switch(childIncomeEach.socialFrequency) {
        case "Weekly":
          childIncomeEach.annualSocial = childIncomeEach.socialAmount * 52;
          break;
        case "Bi-Weekly":
          childIncomeEach.annualSocial = childIncomeEach.socialAmount * 26;
          break;
        case "2x A Month":
          childIncomeEach.annualSocial = childIncomeEach.socialAmount * 24;
          break;
        case "Monthly":
          childIncomeEach.annualSocial = childIncomeEach.socialAmount * 12;
          break;
        default:
          childIncomeEach.annualSocial = 0;
          break;
      };

      switch(childIncomeEach.otherHouseholdFrequency) {
        case "Weekly":
          childIncomeEach.annualOtherHousehold = childIncomeEach.otherHouseholdAmount * 52;
          break;
        case "Bi-Weekly":
          childIncomeEach.annualOtherHousehold = childIncomeEach.otherHouseholdAmount * 26;
          break;
        case "2x A Month":
          childIncomeEach.annualOtherHousehold = childIncomeEach.otherHouseholdAmount * 24;
          break;
        case "Monthly":
          childIncomeEach.annualOtherHousehold = childIncomeEach.otherHouseholdAmount * 12;
          break;
        default:
          childIncomeEach.annualOtherHousehold = 0;
          break;
      };

      switch(childIncomeEach.otherFrequency) {
        case "Weekly":
          childIncomeEach.annualOther = childIncomeEach.otherAmount * 52;
          break;
        case "Bi-Weekly":
          childIncomeEach.annualOther = childIncomeEach.otherAmount * 26;
          break;
        case "2x A Month":
          childIncomeEach.annualOther = childIncomeEach.otherAmount * 24;
          break;
        case "Monthly":
          childIncomeEach.annualOther = childIncomeEach.otherAmount * 12;
          break;
        default:
          childIncomeEach.annualOther = 0;
          break;
      };
  
      childIncomeEach.annual = childIncomeEach.annualEarnings + childIncomeEach.annualSocial + childIncomeEach.annualOtherHousehold + childIncomeEach.annualOther;    
      childIncome.push(childIncomeEach);
      householdIncome += childIncomeEach.annual;

    };


  
    // get adult income info 
    var adultIncome = [];
    for (i=1; i<($("#form__section-3 .adult").length + 1); i++) { 
      
      var adultIncomeEach = {};
  
      adultIncomeEach.earningsAmount = parseInt($("#adult-income-earnings-amount-" + i).val());
      adultIncomeEach.earningsFrequency = $("input[name=adult-income-earnings-frequency-" + i + "]:checked").val();
      adultIncomeEach.assistanceAmount = parseInt($("#adult-income-assistance-amount-" + i).val());
      adultIncomeEach.assistanceFrequency = $("input[name=adult-income-assistance-frequency-" + i + "]:checked").val();
      adultIncomeEach.pensionAmount = parseInt($("#adult-income-pension-amount-" + i).val());
      adultIncomeEach.pensionFrequency = $("input[name=adult-income-pension-frequency-" + i + "]:checked").val();
  
      switch(adultIncomeEach.earningsFrequency) {
        case "Weekly":
          adultIncomeEach.annualEarnings = adultIncomeEach.earningsAmount * 52;
          break;
        case "Bi-Weekly":
          adultIncomeEach.annualEarnings = adultIncomeEach.earningsAmount * 26;
          break;
        case "2x A Month":
          adultIncomeEach.annualEarnings = adultIncomeEach.earningsAmount * 24;
          break;
        case "Monthly":
          adultIncomeEach.annualEarnings = adultIncomeEach.earningsAmount * 12;
          break;
        default:
          adultIncomeEach.annualEarnings = 0;
          break;
      };
  
      switch(adultIncomeEach.assistanceFrequency) {
        case "Weekly":
          adultIncomeEach.annualAssistance = adultIncomeEach.assistanceAmount * 52;
          break;
        case "Bi-Weekly":
          adultIncomeEach.annualAssistance = adultIncomeEach.assistanceAmount * 26;
          break;
        case "2x A Month":
          adultIncomeEach.annualAssistance = adultIncomeEach.assistanceAmount * 24;
          break;
        case "Monthly":
          adultIncomeEach.annualAssistance = adultIncomeEach.assistanceAmount * 12;
          break;
        default:
          adultIncomeEach.annualAssistance = 0;
          break;
      };
  
      switch(adultIncomeEach.pensionFrequency) {
        case "Weekly":
          adultIncomeEach.annualPension = adultIncomeEach.pensionAmount * 52;
          break;
        case "Bi-Weekly":
          adultIncomeEach.annualPension = adultIncomeEach.pensionAmount * 26;
          break;
        case "2x A Month":
          adultIncomeEach.annualPension = adultIncomeEach.pensionAmount * 24;
          break;
        case "Monthly":
          adultIncomeEach.annualPension = adultIncomeEach.pensionAmount * 12;
          break;
        default:
          adultIncomeEach.annualPension = 0;
          break;
      };
  
      adultIncomeEach.annual = adultIncomeEach.annualEarnings + adultIncomeEach.annualAssistance + adultIncomeEach.annualPension;    
      adultIncome.push(adultIncomeEach);
      householdIncome += adultIncomeEach.annual;
            
    };
  
    // push all into "summary" object
    summary.childIncome = childIncome;
    summary.adultIncome = adultIncome;
    summary.household.income = householdIncome;

    // update text 
    if (!(isNaN(summary.household.income))) {
      var householdIncomeText = summary.household.income.toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ",");
      $("#total-household-income").text(householdIncomeText).addClass("highlight");
      setTimeout(function() {
        $(".highlight").removeClass("highlight");        
      }, 480);
    } else {
      $("#total-household-income").text("0").addClass("highlight");
    };
    
  },
  
  
  
  // method: 
  // attach calculation behaviors
  "attachCalculations" : function(single) {

    if (!single) {
      $("[id^=child-income-earnings-frequency], [id^=child-income-social-frequency], [id^=child-income-other-household-frequency], [id^=child-income-other-frequency], [id^=adult-income-earnings-frequency], [id^=adult-income-assistance-frequency], [id^=adult-income-pension-frequency]"
      ).on("change", function() {
        household.calculateIncome();
        $(this).closest("fieldset").next(".input__error-message").hide();
        $(this).closest("fieldset").next(".input__error-message .input__error-message--required").hide();
      });
      $("[id^=adult-income-earnings-amount], [id^=adult-income-assistance-amount], [id^=adult-income-pension-amount], [id^=child-income-earnings-amount], [id^=child-income-social-amount], [id^=child-income-other-household-amount], [id^=child-income-other-amount]").on("keyup", function() {
        delayTrigger(function() {
          household.calculateIncome();
        }, 600);
      });
    };

  }

}



// ============================================================

// form object
var form = {
  


  // method: 
  // go to next section
  "nextSection" : function() {

    var $currentSection = $("#form__section-" + currentSection);
    var $nextSection = $("#form__section-" + (currentSection + 1));

    $nextSection.css("height", "auto").fadeIn(960);
    $nextSection.find("input[type=text]:first").focus();
    $currentSection.css("height", "80px").slideUp(480, "swing");
    window.scrollTo(0, 0);
    fieldValidation.live();
    $(".help-text").hide();
    
    // update global var
    currentSection++;    
    form.buttons(currentSection);
    
  },


  
  // method: 
  // go to previous section
  "prevSection" : function() {

    var $currentSection = $("#form__section-" + currentSection);
    var $prevSection = $("#form__section-" + (currentSection - 1));

    $prevSection.css("height", "auto").slideDown(480, "swing");
    $currentSection.fadeOut(480);
    $prevSection.find("input[type=text]:first").focus();    
    window.scrollTo(0, 0);
    $(".help-text").hide();

    // update global var
    currentSection--;
    form.buttons(currentSection);

  },



  // method: 
  // skip to section x
  "skipToSection" : function(destination, skipLink) {

    var $currentSection = $("#form__section-" + currentSection);
    var $destinationSection = $("#form__section-" + (destination));

    // "skipLink" parameter indicates if it's a shortcut link from summary page
    // (as opposed to skipping sections based on form inputs)
    if (skipLink) {

      $currentSection.hide();
      $destinationSection.css("height", "auto").fadeIn(480).delay(480);
      $destinationSection.find("input[type=text]:first").focus();
      window.scrollTo(0, 0);
                  
    } else {
      
      $destinationSection.css("height", "auto").fadeIn(480).delay(480);
      $destinationSection.find("input[type=text]:first").focus();
      $currentSection.css("height", "80px").slideUp(480, "swing")
      window.scrollTo(0, 0);
      
    }

    $(".help-text").hide();


    // update global var
    currentSection = destination;    
    form.buttons(currentSection);

  },
  
    
    
  // method: 
  // check if assistance info is required
  "checkAssistanceRequirements" : function() {

    if (assistanceRequirements) {
      $("#form__section-2 .form__section--banner").hide();
      $("#form__section--summary-assistance").hide();
      $("#form__section-2 .input__error-message").hide();  
      $("#assistance-y, #assistance-n").addClass("required");
    } else {
      $("#form__section-2 .form__section--banner").show();
      $("#form__section--summary-assistance").show();
      $("#assistance-y, #assistance-n").removeClass("required");
    };

  },



  // method: 
  // check if income info is required
  "checkIncomeRequirements" : function() {
    if (incomeRequirements) {
      $("input[name=ssn], [id^=adult-first-name], [id^=adult-last-name]").addClass("required");
      $("#form__section-3 .form__section--banner").hide();
      $("#form__section--summary-income").hide();
    } else {
      $("input[name=ssn], [id^=adult-first-name], [id^=adult-last-name]").removeClass("required");
      $("#form__section-3 .input__error-message").hide();  
      $("#form__section-3 .form__section--banner").show();
      $("#form__section--summary-income").show();
    };

  },
  
  

  // method: 
  // change buttons shown depending on where user is
  "buttons" : function(current) {
    
    // change prev/save/submit buttons
    switch(current) {
            
      case 0:
        $("#button_wrapper--navigate").hide();
        break;

      case 1:
        $("#form__previous").hide();
        $("#form__save").show();
        $("#form__submit").hide();
        break;

      case 3:
        $("#form__previous").show();
        $("#form__save").show();
        $("#form__submit").hide();
        $("#household-summary").fadeIn(120);
        break;

      case 5:
        $("#form__previous").show();
        $("#form__save").hide();
        $("#form__submit").show();
        break;
      
      default:
        $("#form__previous").show();
        $("#form__save").show();
        $("#form__submit").hide();
        $("#household-summary").fadeOut(120);
        break;
    };
    
    var indicatorBar = $("#indicator__bar");
    indicatorBar.find(".indicator__bar--active").removeClass("indicator__bar--active");
    indicatorBar.find("li:nth-child("+currentSection+")").addClass("indicator__bar--active");
  
  }
  
}



// ============================================================

// row object
var row = {
  
  
  
  // method: 
  // child new row
  "child" : function(id) {
    
    var firstName = '<td><a href="#" class="remove-row">remove</a><label for="child-first-name-' + id + '" class="label-hidden">Child First Name</label><input id="child-first-name-' + id + '" name="child-first-name-' + id + '" type="text" class="required" value=""><span class="input__error-message" role="alert"><span class="input__error-message--required">First name is required</span></span></td>';
    var middleInitial = '<td><label for="child-middle-initial-' + id + '" class="label-hidden">Child Middle Initial</label><input id="child-middle-initial-' + id + '" name="child-middle-initial-' + id + '" type="text" maxlength="1"></td>';
    var lastName = '<td><label for="child-last-name-' + id + '" class="label-hidden">Child Last Name</label><input id="child-last-name-' + id + '" name="child-last-name-' + id + '" type="text" class="required" value=""><span class="input__error-message" role="alert"><span class="input__error-message--required">Last name is required</span></span></td>';
    var studentStatus = '<td><fieldset class="usa-fieldset-inputs usa-sans"><legend class="usa-sr-only">Student Status</legend><ul class="usa-unstyled-list"><li><input id="child-status-student-' + id + '" type="checkbox" name="child-status-student-' + id + '" value="Student"><label for="child-status-student-' + id + '">Student</label></li></ul></fieldset></td>';
    var otherStatus ='<td><fieldset class="usa-fieldset-inputs usa-sans"><legend class="usa-sr-only">Other Status</legend><ul class="usa-unstyled-list"><li><input id="child-status-foster-' + id + '" type="checkbox" name="child-status-foster-' + id + '" value="Foster"><label for="child-status-foster-' + id + '">Foster</label></li><li><input id="child-status-headstart-' + id + '" type="checkbox" name="child-status-headstart-' + id + '" value="Head Start"><label for="child-status-headstart-' + id + '">Head Start</label></li><li><input id="child-status-homeless-migrant-runaway-' + id + '" type="checkbox" name="child-status-homeless-migrant-runaway-' + id + '" value="Homeless/Migrant/Runaway"><label for="child-status-homeless-migrant-runaway-' + id + '">Homeless / Migrant / Runaway</label></li></ul></fieldset></td>';    
    
    var childRow = '<tr class="child child-new">' + firstName + middleInitial + lastName + studentStatus + otherStatus + '</tr>';
    return childRow;
    
  },



  // method: 
  // child income new row
  "childIncome" : function(id) {
    
    var name = '<td>' + summary.children[i-1].firstName + ' ' + summary.children[i-1].lastName + '</td>';
    
    var earnings = '<div class="child-income-section"><label for="child-income-earnings-amount-' + id + '">Earnings from Work</label><div class="input-type-text__wrapper"><input id="child-income-earnings-amount-' + id + '" name="child-income-earnings-amount-' + id + '" type="text" value="0" class="required required-pair-input-radio validate validate-number"><span class="input-type-text__addon">$</span><span class="input__error-message" role="alert"><span class="input__error-message--required">Earnings amount is required (enter 0 if none)</span></span></div><label for="child-income-earnings-frequency-' + id + '" class="label-hidden">Earnings from Work Frequency</label><fieldset class="usa-fieldset-inputs usa-sans"><legend class="usa-sr-only">Child Earnings from Work Frequency</legend><ul class="usa-unstyled-list input-radio-styled"><li><input type="radio" name="child-income-earnings-frequency-' + id + '" id="child-income-earnings-frequency-weekly-' + id + '" value="Weekly"><label for="child-income-earnings-frequency-weekly-' + id + '">Weekly</label></li><li><input type="radio" name="child-income-earnings-frequency-' + id + '" id="child-income-earnings-frequency-biweekly-' + id + '" value="Bi-Weekly"><label for="child-income-earnings-frequency-biweekly-' + id + '">Bi-Weekly</label></li><li><input type="radio" name="child-income-earnings-frequency-' + id + '" id="child-income-earnings-frequency-twiceamonth-' + id + '" value="2x A Month"><label for="child-income-earnings-frequency-twiceamonth-' + id + '">2x A Month</label></li><li><input type="radio" name="child-income-earnings-frequency-' + id + '" id="child-income-earnings-frequency-monthly-' + id + '" value="Monthly"><label for="child-income-earnings-frequency-monthly-' + id + '">Monthly</label></li></ul></fieldset><span class="input__error-message" role="alert"><span class="input__error-message--required">Please select a frequency for earnings</span></span></div>';    

    var social = '<div class="child-income-section"><label for="child-income-social-amount-' + id + '">Social Security Benefits</label><div class="input-type-text__wrapper"><input id="child-income-social-amount-' + id + '" name="child-income-social-amount-' + id + '" type="text" value="0" class="required required-pair-input-radio validate validate-number"><span class="input-type-text__addon">$</span><span class="input__error-message" role="alert"><span class="input__error-message--required">Social Security benefits amount is required (enter 0 if none)</span></span></div><label for="child-income-social-frequency-' + id + '" class="label-hidden">Social Security Benefits Frequency</label><fieldset class="usa-fieldset-inputs usa-sans"><legend class="usa-sr-only">Social Security Benefits Frequency</legend><ul class="usa-unstyled-list input-radio-styled"><li><input type="radio" name="child-income-social-frequency-' + id + '" id="child-income-social-frequency-weekly-' + id + '" value="Weekly"><label for="child-income-social-frequency-weekly-' + id + '">Weekly</label></li><li><input type="radio" name="child-income-social-frequency-' + id + '" id="child-income-social-frequency-biweekly-' + id + '" value="Bi-Weekly"><label for="child-income-social-frequency-biweekly-' + id + '">Bi-Weekly</label></li><li><input type="radio" name="child-income-social-frequency-' + id + '" id="child-income-social-frequency-twiceamonth-' + id + '" value="2x A Month"><label for="child-income-social-frequency-twiceamonth-' + id + '">2x A Month</label></li><li><input type="radio" name="child-income-social-frequency-' + id + '" id="child-income-social-frequency-monthly-' + id + '" value="Monthly"><label for="child-income-social-frequency-monthly-' + id + '">Monthly</label></li></ul></fieldset><span class="input__error-message" role="alert"><span class="input__error-message--required">Please select a frequency for social security benefits</span></span></div>';    

    var otherHousehold = '<div class="child-income-section"><label for="child-income-other-household-amount-' + id + '">Income from Other Household</label><div class="input-type-text__wrapper"><input id="child-income-other-household-amount-' + id + '" name="child-income-other-household-amount-' + id + '" type="text" value="0" class="required required-pair-input-radio validate validate-number"><span class="input-type-text__addon">$</span><span class="input__error-message" role="alert"><span class="input__error-message--required">Income from other household income amount is required (enter 0 if none)</span></span></div><label for="child-income-other-household-frequency-' + id + '" class="label-hidden">Income from Other Household</label><fieldset class="usa-fieldset-inputs usa-sans"><legend class="usa-sr-only">Income from Other Household Frequency</legend><ul class="usa-unstyled-list input-radio-styled"><li><input type="radio" name="child-income-other-household-frequency-' + id + '" id="child-income-other-household-frequency-weekly-' + id + '" value="Weekly"><label for="child-income-other-household-frequency-weekly-' + id + '">Weekly</label></li><li><input type="radio" name="child-income-other-household-frequency-' + id + '" id="child-income-other-household-frequency-biweekly-' + id + '" value="Bi-Weekly"><label for="child-income-other-household-frequency-biweekly-' + id + '">Bi-Weekly</label></li><li><input type="radio" name="child-income-other-household-frequency-' + id + '" id="child-income-other-household-frequency-twiceamonth-' + id + '" value="2x A Month"><label for="child-income-other-household-frequency-twiceamonth-' + id + '">2x A Month</label></li><li><input type="radio" name="child-income-other-household-frequency-' + id + '" id="child-income-other-household-frequency-monthly-' + id + '" value="Monthly"><label for="child-income-other-household-frequency-monthly-' + id + '">Monthly</label></li></ul></fieldset><span class="input__error-message" role="alert"><span class="input__error-message--required">Please select a frequency for income from other household</span></span></div>';    

    var other = '<div class="child-income-section"><label for="child-income-other-amount-' + id + '">Other Income</label><div class="input-type-text__wrapper"><input id="child-income-other-amount-' + id + '" name="child-income-other-amount-' + id + '" type="text" value="0" class="required required-pair-input-radio validate validate-number"><span class="input-type-text__addon">$</span><span class="input__error-message" role="alert"><span class="input__error-message--required">Other income amount is required (enter 0 if none)</span></span></div><label for="child-income-other-frequency-' + id + '" class="label-hidden">Income from Other Household</label><fieldset class="usa-fieldset-inputs usa-sans"><legend class="usa-sr-only">Income from Other Household Frequency</legend><ul class="usa-unstyled-list input-radio-styled"><li><input type="radio" name="child-income-other-frequency-' + id + '" id="child-income-other-frequency-weekly-' + id + '" value="Weekly"><label for="child-income-other-frequency-weekly-' + id + '">Weekly</label></li><li><input type="radio" name="child-income-other-frequency-' + id + '" id="child-income-other-frequency-biweekly-' + id + '" value="Bi-Weekly"><label for="child-income-other-frequency-biweekly-' + id + '">Bi-Weekly</label></li><li><input type="radio" name="child-income-other-frequency-' + id + '" id="child-income-other-frequency-twiceamonth-' + id + '" value="2x A Month"><label for="child-income-other-frequency-twiceamonth-' + id + '">2x A Month</label></li><li><input type="radio" name="child-income-other-frequency-' + id + '" id="child-income-other-frequency-monthly-' + id + '" value="Monthly"><label for="child-income-other-frequency-monthly-' + id + '">Monthly</label></li></ul></fieldset><span class="input__error-message" role="alert"><span class="input__error-message--required">Please select a frequency for other income</span></span></div>';    
    
    var childIncomeRow = '<tr class="child-each">' + name + '<td>' + earnings + social + otherHousehold + other + '</td></tr>';
    return childIncomeRow;

  },
  
  

  // method: 
  // adult new row
  "adult" : function(id) {    
    
    var firstName = '<td><a href="#" class="remove-row">remove</a><label for="adult-first-name-' + id + '"" class="label-hidden-text">Adult First Name</label><input id="adult-first-name-' + id + '"" name="adult-first-name-' + id + '"" type="text" class="required" value=""><span class="input__error-message" role="alert"><span class="input__error-message--required">First name is required</span></span>';

    var lastName = '<td><label for="adult-last-name-' + id + '"" class="label-hidden-text">Adult Last Name</label><input id="adult-last-name-' + id + '"" name="adult-last-name-' + id + '"" type="text" class="required" value=""><span class="input__error-message" role="alert"><span class="input__error-message--required">Last name is required</span></span></td>';
    
    var earnings = '<div class="adult-income-section"><label for="adult-income-earnings-amount-' + id + '"">Earnings from Work</label><div class="input-type-text__wrapper"><input id="adult-income-earnings-amount-' + id + '"" name="adult-income-earnings-amount-' + id + '"" type="text" value="0" class="required required-pair-input-radio validate validate-number"><span class="input-type-text__addon">$</span><span class="input__error-message" role="alert"><span class="input__error-message--required">Earnings amount is required (enter 0 if none)</span></span></div><label for="adult-income-earnings-frequency-' + id + '"" class="label-hidden">Earnings from Work Frequency</label><fieldset class="usa-fieldset-inputs usa-sans"><legend class="usa-sr-only">Adult Earnings from Work Frequency</legend><ul class="usa-unstyled-list input-radio-styled"><li><input type="radio" name="adult-income-earnings-frequency-' + id + '"" id="adult-income-earnings-frequency-weekly-' + id + '"" value="Weekly"><label for="adult-income-earnings-frequency-weekly-' + id + '"">Weekly</label></li><li><input type="radio" name="adult-income-earnings-frequency-' + id + '"" id="adult-income-earnings-frequency-biweekly-' + id + '"" value="Bi-Weekly"><label for="adult-income-earnings-frequency-biweekly-' + id + '"">Bi-Weekly</label></li><li><input type="radio" name="adult-income-earnings-frequency-' + id + '"" id="adult-income-earnings-frequency-twiceamonth-' + id + '"" value="2x A Month"><label for="adult-income-earnings-frequency-twiceamonth-' + id + '"">2x A Month</label></li><li><input type="radio" name="adult-income-earnings-frequency-' + id + '"" id="adult-income-earnings-frequency-monthly-' + id + '"" value="Monthly"><label for="adult-income-earnings-frequency-monthly-' + id + '"">Monthly</label></li></ul></fieldset><span class="input__error-message" role="alert"><span class="input__error-message--required">Please select a frequency for earnings</span></span></div>';

    var assistance = '<div class="adult-income-section"><label for="adult-income-assistance-amount-' + id + '"">Public Assistance/Child Support/Alimony</label><div class="input-type-text__wrapper"><input id="adult-income-assistance-amount-' + id + '"" name="adult-income-assistance-amount-' + id + '"" type="text" value="0" class="required required-pair-input-radio validate validate-number"><span class="input-type-text__addon">$</span><span class="input__error-message" role="alert"><span class="input__error-message--required">Assistance amount is required (enter 0 if none)</span></span></div><label for="adult-income-assistance-frequency-' + id + '"" class="label-hidden">Public Assistance/Child Support/Alimony Frequency</label><fieldset class="usa-fieldset-inputs usa-sans"><legend class="usa-sr-only">Adult Public Assistance Frequency</legend><ul class="usa-unstyled-list input-radio-styled"><li><input type="radio" name="adult-income-assistance-frequency-' + id + '"" id="adult-income-assistance-frequency-weekly-' + id + '"" value="Weekly"><label for="adult-income-assistance-frequency-weekly-' + id + '"">Weekly</label></li><li><input type="radio" name="adult-income-assistance-frequency-' + id + '"" id="adult-income-assistance-frequency-biweekly-' + id + '"" value="Bi-Weekly"><label for="adult-income-assistance-frequency-biweekly-' + id + '"">Bi-Weekly</label></li><li><input type="radio" name="adult-income-assistance-frequency-' + id + '"" id="adult-income-assistance-frequency-twiceamonth-' + id + '"" value="2x A Month"><label for="adult-income-assistance-frequency-twiceamonth-' + id + '"">2x A Month</label></li><li><input type="radio" name="adult-income-assistance-frequency-' + id + '"" id="adult-income-assistance-frequency-monthly-' + id + '"" value="Monthly"><label for="adult-income-assistance-frequency-monthly-' + id + '"">Monthly</label></li></ul></fieldset><span class="input__error-message" role="alert"><span class="input__error-message--required">Please select a frequency for assistance</span></span></div>';
    
    var pension = '<div class="adult-income-section"><label for="adult-income-pension-amount-' + id + '"">Pensions/Retirement/All Other Income</label><div class="input-type-text__wrapper"><input id="adult-income-pension-amount-' + id + '"" name="adult-income-pension-amount-' + id + '"" type="text" value="0" class="required required-pair-input-radio validate validate-number"><span class="input-type-text__addon">$</span><span class="input__error-message" role="alert"><span class="input__error-message--required">Pension amount is required</span></span></div><label for="adult-income-pension-frequency-' + id + '"" class="label-hidden">Pensions/Retirement/All Other Income</label><fieldset class="usa-fieldset-inputs usa-sans"><legend class="usa-sr-only">Adult Pension Frequency</legend><ul class="usa-unstyled-list input-radio-styled"><li><input type="radio" name="adult-income-pension-frequency-' + id + '"" id="adult-income-pension-frequency-weekly-' + id + '"" value="Weekly"><label for="adult-income-pension-frequency-weekly-' + id + '"">Weekly</label></li><li><input type="radio" name="adult-income-pension-frequency-' + id + '"" id="adult-income-pension-frequency-biweekly-' + id + '"" value="Bi-Weekly"><label for="adult-income-pension-frequency-biweekly-' + id + '"">Bi-Weekly</label></li><li><input type="radio" name="adult-income-pension-frequency-' + id + '"" id="adult-income-pension-frequency-twiceamonth-' + id + '"" value="2x A Month"><label for="adult-income-pension-frequency-twiceamonth-' + id + '"">2x A Month</label></li><li><input type="radio" name="adult-income-pension-frequency-' + id + '"" id="adult-income-pension-frequency-monthly-' + id + '"" value="Monthly"><label for="adult-income-pension-frequency-monthly-' + id + '"">Monthly</label></li></ul></fieldset><span class="input__error-message" role="alert"><span class="input__error-message--required">Please select a frequency for pension</span></span>';
      
    var adultRow = '<tr class="adult adult-new">' + firstName + lastName + '<td class="adult-each">' + earnings + assistance + pension + '</td></tr>';
    return adultRow;
  
  },
  
  
  
  // method: 
  // remove row
  "remove" : function() {
  
    $(".remove-row").on("click", function() {
      $row = $(this).parents("tr");
      $row.prev().find("input:first").focus();
      $row.fadeOut(240);
      $(this).delay(240).queue(function() {
        $row.remove();
        household.calculateSize();
        household.attachCalculations();
      });
      return false;
    });
    
  }

};



// ============================================================

// on document ready,
$(document).ready(function() {
    
  // activate live validation for existing fields on the page
  fieldValidation.live();

  // calculate initial household size (assume 1 child + 1 adult)
  household.calculateSize();
  household.attachCalculations();
    
  // activate help text
  $(".help-trigger").each(function() {
    help.init($(this));    
  });  
  
  // update buttons  
  form.buttons(currentSection);  
  
  // attach prevSection() method
  $("#form__previous").on("click", function() {
    form.prevSection();
    return false;
  })
  
  // skip buttons/links
  $(".skip-to-section").on("click", function() {
    var destination = parseInt($(this).attr("href").replace("#section-",""));
    form.skipToSection(destination, true);
    return false;
  });  
  
  // write today's date
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth() + 1; 
  var yyyy = today.getFullYear();  

  if(dd < 10) {dd = "0" + dd};
  if(mm < 10) {mm = "0" + mm};

  var todaysDate = mm + "/" + dd + "/" + yyyy;
  $("#date").html(todaysDate);
  
    

  // START APPLICATION 
  $("#form__start").on("click", function() {
    
    // validation check
    var $signature = $("#signature");
    if (!($signature.val())) {
      $signature.addClass("input__error");
      $signature.siblings(".input__error-message").show();
      $signature.siblings(".input__error-message .input__error-message--required").fadeIn(100);
    } else {
      summary.contactInfo.name = $signature.val();
      form.nextSection();        
      $("#button_wrapper--navigate").show();
    };
    $(".content").css("min-height","100%");

    // pre-fill adult name in section 3
    var adultName = $signature.val().split(" ");
    $("#adult-first-name-1").val(adultName[0]);
    $("#adult-last-name-1").val(adultName[1]);

    // fill signer name in section 5
    $("#adult-signer").text(summary.contactInfo.name);

    // activate warning if user tries to leave before submitting
    formWarning(true);

    return false;
  });
  
  
  
  // SAVE APPLICATION SECTION
  $("#form__save").on("click", function() {
        


    // change functionality based on section
    switch (currentSection) {



      // PART 1 VALIDATION
      case 1:      
      
        // validate required fields
        fieldsToValidate = 0;
        fieldsValidated = 0;
        
        $("#form__section-1 .required").each(function() {
          fieldsToValidate++;
          fieldValidation.required($(this));  
        });
            
        // calculate household size
        household.calculateSize();    
    
        // get race/ethnicity info and push into summary object 
        summary.raceEthnicity.ethnicity = $("input[name=ethnicity]:checked").val();    
        var raceSelected = [];
        $.each($("input[name=race]:checked"), function() {
          raceSelected.push($(this).val());
        });    
        summary.raceEthnicity.race = raceSelected;
      
        // retrieve from object & write to income section
        if (summary.children.length > 1) {
          $("#total-children").html(summary.children.length + " children");        
        } else {
          $("#total-children").html(summary.children.length + " child");        
        };

        $("#child-income .child-each").remove();
        for (i=1; i<summary.children.length + 1; i++) {
          var childIncomeRow = row.childIncome(i);
          $("#child-income").append(childIncomeRow);
        };
        fieldValidation.live();
        household.attachCalculations();


        
        // loop through children
        var otherStatusCount = 0;
        var summaryText = "<table>";

        summaryText += '<tr><th class="summary-01">' + 'Child Name';
        summaryText += '<th class="summary-02">' + 'Student Status';
        summaryText += '<th class="summary-03">' + 'Other Status';
        summaryText += '</tr>';

        for (i=0; i<summary.children.length; i++) { 

          // check if all the students listed have foster/headstart/homeless/migrant/runaway status
          if (summary.children[i].studentStatus) {            
            if (summary.children[i].fosterStatus || summary.children[i].headstartStatus || summary.children[i].homelessMigrantRunawayStatus) { 
              otherStatusCount++;
            }
          };

          // retrieve from object & write to summary section
          summaryText += '<tr><td class="summary-01">' + summary.children[i].firstName + ' ' + summary.children[i].lastName;
          if (summary.children[i].studentStatus) {
            summaryText += '<td class="summary-02">Student</td>';
          } else {
            summaryText += '<td class="summary-02">Not a student</td>';
          };
          summaryText += '<td>';

          var otherStatusText = [];

          if (!(summary.children[i].fosterStatus === undefined)) {
            summaryText += summary.children[i].fosterStatus + "<br/>";
          };
          if (!(summary.children[i].headstartStatus === undefined)) {
            summaryText += summary.children[i].headstartStatus + "<br/>";
          };
          if (!(summary.children[i].homelessMigrantRunawayStatus === undefined)) {
            summaryText += summary.children[i].homelessMigrantRunawayStatus + "<br/>";
          };
          
          summaryText += '</td></tr>';
          
        };
            
        summaryText += '</table>';

        if (!(summary.raceEthnicity.ethnicity === undefined) || summary.raceEthnicity.race.length) {
          summaryText += '<p class="list-opener">The children in my household are:</p><ul>';
          if (!(summary.raceEthnicity.ethnicity === undefined)) {
            summaryText += '<li>' + summary.raceEthnicity.ethnicity + '</li>';
          };
          if (summary.raceEthnicity.race.length) {
            summaryText += '<li>';
            for (i=0; i<summary.raceEthnicity.race.length; i++) {
              summaryText += summary.raceEthnicity.race[i];
              if (!(i === summary.raceEthnicity.race.length - 1)) {
                summaryText += ", "
              };
            }
            summaryText += '</li>';
          };
          summaryText += '</ul>';
        }
        
        $("#form__section--summary-1").html(summaryText);
    
        // check for error
        var $section = $(this).prev(".form__section");
        var noError = fieldValidation.error($section, fieldsToValidate, fieldsValidated);
           
        if (noError) {
          
          // skip logic: if ALL students have foster/headstart/homeless/migrant/runaway status, skip to section 4 
          if (summary.children.length == otherStatusCount) {
            form.skipToSection(4);
            assistanceRequirements = false;
            incomeRequirements = false;
          } else {
            form.nextSection();
            assistanceRequirements = true;
            incomeRequirements = true;
          }
        
          form.checkAssistanceRequirements();
          form.checkIncomeRequirements();
   
        };
  
        return false;
        break;



      // PART 2 VALIDATION
      case 2:

        // validate required fields
        fieldsToValidate = 0;
        fieldsValidated = 0;
      
        $("#form__section-2 .required").each(function() {
          fieldsToValidate++;
          fieldValidation.required($(this)); 
        });    
      
        // get assistance info and push into summary object 
        var assistance = {};
        assistance.status = $("#form__section-2 input[name=assistance]:checked").val();
        assistance.caseNumber = $("#form__section-2 #case-number").val();
        summary.assistance = assistance;
      
        // retrieve from object & write to summary section
        // skip logic: if household participates in assistance programs, skip to section 4 
        var summaryText = "";
        if (assistance.status == "Assistance") {
          summaryText += "My household participates in SNAP, TANF, or FDPIR.<br/>";
          summaryText += "The case number is " + summary.assistance.caseNumber + ".";
        } else {
          summaryText += "My household does not participate in SNAP, TANF, or FDPIR.<br/>";
        }
        $("#form__section--summary-2").html(summaryText);
        $("#form__section--summary-total-household-members").text(summary.household.size);
      
        // check for error
        var $section = $(this).prev(".form__section");
        var noError = fieldValidation.error($(this), $section, fieldsToValidate, fieldsValidated);
            
        if (noError) {
          
          // if user receives assistance, skip to section 4
          if (summary.assistance.status == "Assistance") {
            assistanceRequirements = true;
            incomeRequirements = false;
            form.skipToSection(4);
          } else {
            // if incomeRequirements were set to false, based on foster/etc status, run a check again
            if (incomeRequirements == false) {
              if ($("#assistance-n").is(":checked")) {
                incomeRequirements = true;
              } else {
                incomeRequirements = false;
              }
            } else {
              incomeRequirements = true;
            };  
            form.nextSection();
          };
          
          form.checkAssistanceRequirements();
          form.checkIncomeRequirements();

        };
    
        return false;              
        break;


      
      // PART 3 VALIDATION
      case 3:
      
        // validate required fields
        fieldsToValidate = 0;
        fieldsValidated = 0;
        
        $("#form__section-3 .required").each(function() {
          fieldsToValidate++;
          fieldValidation.required($(this));  
        });    
    
        if ($("#ssn-number").hasClass("required")) {
          fieldsToValidate++;
          fieldValidation.ssn($("#ssn-number"));  
        };
    
        household.calculateSize();
        household.calculateIncome();
        
        // get ssn info and push into summary object 
        var ssn = {};
        ssn.status = $("#form__section-3 input[name=ssn]:checked").val();
        ssn.number = $("#ssn-number").val();
        summary.ssn = ssn;

        // retrieve from object & write to summary section
        
        $("#form__section--summary-total-household-members").text(summary.household.size);
        $("#form__section--summary-total-household-income").text(summary.household.income.toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ","));
        
        var childSummaryText = '<tr><th class="summary-01">Total Income Amount</th><th class="summary-02">Income Breakdown</th><th class="summary-03">Child Name</th></tr>';

        for (i=0; i<summary.childIncome.length; i++) {
          childSummaryText += '<tr>';
          childSummaryText += '<td class="summary-01">$ ' + summary.childIncome[i].annual.toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ",") + ' annually</td>';
          childSummaryText += '<td class="summary-02">';
          childSummaryText += '$ ' + summary.childIncome[i].earningsAmount;
          if (summary.childIncome[i].earningsAmount !== 0) {
            childSummaryText += ' ' + summary.childIncome[i].earningsFrequency;
          };          
          childSummaryText += ' (earnings from work)<br/>$ ' + summary.childIncome[i].socialAmount;
          if (summary.childIncome[i].socialAmount !== 0) {
            childSummaryText += ' ' + summary.childIncome[i].socialFrequency;
          };
          childSummaryText += ' (Social Security benefits)<br/>$ ' + summary.childIncome[i].otherHouseholdAmount;
          if (summary.childIncome[i].otherHouseholdAmount !== 0) {
            childSummaryText += ' ' + summary.childIncome[i].otherHouseholdFrequency;
          };
          childSummaryText += ' (income from other household)<br/>$ ' + summary.childIncome[i].otherHouseholdAmount;
          if (summary.childIncome[i].otherAmount !== 0) {
            childSummaryText += ' ' + summary.childIncome[i].otherFrequency;
          };
          childSummaryText += ' (other income)';
          childSummaryText += '</td>';
          childSummaryText += '<td class="summary-03">' + summary.children[i].firstName + ' ' + summary.children[i].lastName + '</td>';
          childSummaryText += '</tr>';
        };
        $("#form__section--summary-child-income").html(childSummaryText);


        
        var adultSummaryText = '<tr><th class="summary-01">Total Income Amount</th><th class="summary-02">Income Breakdown</th><th class="summary-03">Adult Name</th></tr>';

        for (i=0; i<summary.adultIncome.length; i++) {
          adultSummaryText += '<tr>';
          adultSummaryText += '<td class="summary-01">$ ' + summary.adultIncome[i].annual.toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ",") + ' annually</td>';
          adultSummaryText += '<td class="summary-02">';
          adultSummaryText += '$ ' + summary.adultIncome[i].earningsAmount;
          if (summary.adultIncome[i].earningsAmount !== 0) {
            adultSummaryText += ' ' + summary.adultIncome[i].earningsFrequency;
          };
          adultSummaryText += ' (earnings from work)<br/>$ ' + summary.adultIncome[i].assistanceAmount;
          if (summary.adultIncome[i].assistanceAmount !== 0) {
            adultSummaryText += ' ' + summary.adultIncome[i].assistanceFrequency;
          };
          adultSummaryText += ' (public assistance/child support/alimony)<br/>$ ' + summary.adultIncome[i].pensionAmount;
          if (summary.adultIncome[i].pensionAmount !== 0) {
            adultSummaryText += ' ' + summary.adultIncome[i].pensionFrequency;
          };
          adultSummaryText += ' (pension/retirement/all other income)';
          adultSummaryText += '</td>';
          adultSummaryText += '<td class="summary-03">' + summary.adults[i].firstName + ' ' + summary.adults[i].lastName + '</td>';
          adultSummaryText += '</tr>';
        };
        $("#form__section--summary-adult-income").html(adultSummaryText);
        
        var ssnText = "";
        if (ssn.status == "SSN") {
          ssnText += "A member of my household has a SSN. The last 4 digits of the SSN is " + summary.ssn.number + ".";
        } else {
          ssnText += "No one in my household has a SSN.<br/>";
        }
        $("#form__section--summary-ssn").html(ssnText);

        // check for error
        var $section = $(this).prev(".form__section");
        var noError = fieldValidation.error($(this), $section, fieldsToValidate, fieldsValidated);
            
        if (noError) {
          form.nextSection();        
          form.checkAssistanceRequirements();
          form.checkIncomeRequirements();
        };
            
        return false;              
        break;



      // PART 4 VALIDATION
      case 4:

        fieldsToValidate = 0;
        fieldsValidated = 0;
        
        $("#form__section-4 .required").each(function() {
          fieldsToValidate++;
          fieldValidation.required($(this));  
        });    

        $("#form__section-4 .validate-email").each(function() {
          fieldsToValidate++;
          fieldValidation.email($(this));  
        });

        
        // get contact info and push into summary object 
        var contactInfo = {};
        contactInfo.street = $("#street-address").val();
        contactInfo.apartment = $("#apartment").val();
        contactInfo.city = $("#city").val();
        contactInfo.state = $("#state").val();
        contactInfo.zip = $("#zip").val();
        contactInfo.phone = $("#phone").val();
        contactInfo.email = $("#email").val();
        contactInfo.name = $("#signature").val();
        
        summary.contactInfo = contactInfo;        
        summary.date = todaysDate;
        
        // retrieve from object & write to summary section
        var summaryText = '<p>';
        if (summary.contactInfo.street.length) {
          summaryText += summary.contactInfo.street + ' ';
          if (summary.contactInfo.apartment.length) {
            summaryText += ', Apartment ' + summary.contactInfo.apartment;
          };    
        };
        summaryText += summary.contactInfo.city + ', ';
        summaryText += summary.contactInfo.state + '&nbsp;&nbsp;';
        summaryText += summary.contactInfo.zip + '</p>';
        if (summary.contactInfo.phone.length || summary.contactInfo.email.length) {
          summaryText += '<p>';
          if (summary.contactInfo.phone.length) {
            summaryText += summary.contactInfo.phone + '<br/>';
          };
          if (summary.contactInfo.email.length) {
            summaryText += summary.contactInfo.email;
          };
          summaryText += '</p>';
        };
        
        $("#form__section--summary-4").html(summaryText);

        // check for error
        var $section = $(this).prev(".form__section");
        var noError = fieldValidation.error($(this), $section, fieldsToValidate, fieldsValidated);
            
        if (noError) {
          form.nextSection();        
        };
                
        return false;
        break;
        
        

      // PART 5 VALIDATION
      case 5:
        break;
      
      default:
        return false;
        break;  
  
    }
        
  });



  // SUBMIT APPLICATION 
  $("#form__submit").on("click", function() {
    
    $.ajax({
      url: "connect.php",
      type: "POST",
      data: {"summary": JSON.stringify(summary)}
    }).always(function(data) {
      $("#loading").fadeIn(120);
    }).fail(function() {
    }).done(function(data) {
      $("#loading").hide();
      form.nextSection();
      $("#button_wrapper--navigate").css("height", "auto").slideUp(480, "swing");
      $(".content").css("min-height","auto");
      formWarning(false);
    });
    
    return false;

  });
  
  
  
  // PART 1
  $("#child-add").on("click", function() {
    var childRowID = $("#form__section-1 .child").length + 1;    
    var childRow = row.child(childRowID);
    $("#form__section-1 table").append(childRow).find(".child-new input:first").focus();
    $(".child-new").removeClass("child-new");
    fieldValidation.live();
    household.calculateSize();
    household.attachCalculations();
    row.remove();
    return false;  
  });
  
    

  // PART 2
  // add required to case number if user selects "yes" on assistance
  $("input[name=assistance]").on("change", function() {
    if ($("#assistance-y").is(":checked")) {
      $("#case-number").addClass("required");
      fieldValidation.live();
    } else {
      $("#case-number").removeClass("required");
      fieldValidation.live();
    };
  });
  
  

  // PART 3
  // add required to ssn number if user selects "yes" on ssn
  $("input[name=ssn]").on("change", function() {
    if ($("#ssn-y").is(":checked")) {
      $("#ssn-number").addClass("required");
      fieldValidation.live();
    } else {
      $("#ssn-number").removeClass("required");
    };
  });

  $("#adult-add").on("click", function() {
    var adultRowID = $("#form__section-3 .adult").length + 1;    
    var adultRow = row.adult(adultRowID);
    $("#adult-income").append(adultRow).find(".adult-new input:first").focus();
    $(".adult-new").removeClass("adult-new");
    fieldValidation.live();
    household.calculateSize();
    household.attachCalculations();
    row.remove();
    return false;  
  });  
  
});