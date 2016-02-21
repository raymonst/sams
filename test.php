<!DOCTYPE html>

<html>
  
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EAT UX</title>
    <link href="css/reset.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/eat-ux.css" rel="stylesheet">
    <script type="text/javascript" src="js/vendor/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/eat-ux.min.js"></script>
  </head>
  
  <body>
    
<!--
  
    --- MIT license
    --- popover issue
    --- mobile
    --- "share income and expenses"
    --- clean css
    --- clean & minify js
    --- buy icon (thenounproject)
    --- take name from siggy and put into adult table
    --- database/export
    --- number validation (ssn) -- need to block if less than 4 digits
    --- url-able sections? (for back button), or maybe warning modal
    --- warning when form is not done
    --- link to snap, etc
    --- assistance req fulfilled, go back to sec 2 from summary, then change to no. sec 3 should not have the notification banner.
    --- When households apply for school meal benefits, if they are approved, then the school sends a letter to the household notifying them of their benefit eligibility.
    --- live validation performance
    --- foster req fulfilled, go back to sec 2 from summary, then save & continue. sec 3 should still have the notification banner.
    --- foster req fulfilled, go back to sec 1 from summary, change foster status, go to section 2 & pick "no". sec 3 should not have the notification banner.
    --- signature?    
    --- check ux tips
    --- include legalese
    --- check requirements, text, etc
    --- url-able sections?
    --- email validation - should stop if doesnt validate
    --- help text position logic/issue
    --- animations for button changes?
    --- "sticky" income?
    --- move sig to first page
    --- open/close screen
    --- split child income
    --- page indicator
    --- "back to summary" link is buggy when there's an error //removed back to summary, too complex with validation etc
    --- save on "back to summary"
    --- jquery ui for transitions?
    --- another visual styling pass - bump up size, remove shadow
    --- back to summary after editing
    --- notification for skip logic -- fix for when user is jumping around
    --- skip logic (deal with summary & req fields)
    --- required field check on blur - problematic on text
    --- fix frequency error
    --- summary section
    --- field level help
    --- text/number validation
    --- add line item


Personal touches & prefatory statements - Adding a personal touch, such as a name, or using an introductory statement could provide a level of comfort or familiarity with the questions and/or language being used.

Promote positive expectations & provide reassurance that applying carries no risk - Reminding respondents of the benefit of completing the application, and communicating that there is no risk in doing so, could help increase access and participation.

Yes, a household could participate in more than one of the assistance programs (with the exception of participating in both SNAP and FDPIR). There is no priority on which case number should be provided, but the household should only provide one case number on their application.


-->
      
        
    
    <div class="content usa-grid">

      <form action="connect.php" method="post">

  

      <!-- PART 0 -->
      <section class="form__section form__section-intro" id="form__section-0">
        <div class="form__section--intro-logo">
          <img src="img/logo.png" alt="Springfield Academy">
        </div>
        <h1>Application for Free and Reduced Price School Meals</h1>
        <div class="form__section--intro-text">
          <p>Welcome to the free and reduced price school meals application for <strong>Springfield Academy</strong>.</p>
          <p>This application has 4 sections to fill out, but the system may automatically skip sections based on the answers you give. It takes approximately 10 minutes to complete and you will have the chance to review before submitting. <strong>Submitting this application carries no risk to you, regardless of the final outcome.</strong></p>
          <p>If you have questions, please contact John Doe at 123-456-7890 or <a class="link-reverse" href="mailto:john.doe@springfield.edu">john.doe@springfield.edu</a>.</p>
          <p>To get started, please sign your first &amp; last name below.</p>

          <div class="input__wrapper">
            <label for="signature" class="label-hidden">Signature of adult completing this form <span class="required-marker">*</span></label>
            <input id="signature" name="signature" type="text" class="required" value="John Doe" autofocus>
            <span class="input__error-message" role="alert"><span class="input__error-message--required">This field is required</span></span>
          </div>

          <p class="small">The person signing is furnishing true information and to advise that person that the application is being made in connection with the receipt of Federal funds; School officials may verify the information on the application; and Deliberate misrepresentation of the information may subject the applicant to prosecution under State and Federal statutes.</p>

          <div class="button_wrapper">
            <button id="form__start">START MY APPLICATION</button>
          </div>

        </div>

        <section id="footer"><a class="link-reverse" href="statements.php" target="_blank">USDA Non-Discrimination Statement</a><br/><a class="link-reverse" href="statements.php" target="_blank">Use of Information Statement</a></section>
                
      </section>
      

      <!-- PART 1 -->
      
      <section class="form__section" id="form__section-1">
      
        <section class="form__section--header">      
          <h2>Part 1: Children Information</h2>
          <h3>List all <span>
            <a href="#" class="help-trigger">household members</a>
            <div class="help-text"><p>Anyone who is living with you and shares income and expenses, <em>even if not related.</em></p></div>
          </span>
 who are infants, <span>
            <a href="#" class="help-trigger">children</a>
            <div class="help-text"><p>Anyone age 18 or under and are supported with the household&rsquo;s income; or in your care under a foster arrangement, or qualify as homeless, migrant, or runaway youth; or students attending high school grade 12 or under, regardless of age.</p>
            </div>
            , and students up to and including grade 12 
          </h3>
        </section>
        
        <section class="form__section--body">
          <section class="form__section--sub">
            <p class="small"><em>Fields marked with <span class="required-marker">*</span> are required</em></p>
            <div class="form__section--instruction">
              <p>Migrant status is used only to determine eligibility for free or reduced price meals. We do <strong>not</strong> use this information for other purposes.</p>
            </div>
            <table>
              <tr> 
                <th id="child-column-first-name">Child&rsquo;s First Name <span class="required-marker">*</span></th>
                <th id="child-column-middle-initial">Middle Initial</th>
                <th id="child-column-last-name">Last Name <span class="required-marker">*</span></th>
                <th id="child-column-student-status">Student Status</th>
                <th id="child-column-other-status">
                  Other Status (check all that apply)<br/>
                  <span>
                    <a href="#" class="help-trigger">Foster</a>
                    <div class="help-text">
                      <p>A child who is formally placed by a court or a State child welfare agency.</p>
                    </div>
                  ,&nbsp;
                  </span>         
                  <span>
                    <a href="#" class="help-trigger">Head Start</a>
                    <div class="help-text">
                      <p>A child that is enrolled in a Federal Head Start or State-funded pre-kindergarten program that uses eligibility criteria that is identical or more stringent than Federal Head Start</p>
                    </div>
                  ,&nbsp;
                  </span>                  
                  <span>
                    <a href="#" class="help-trigger">Homeless / Migrant / Runaway</a>
                    <div class="help-text">
                    <ul>
                      <li><strong>Homeless</strong>: A child identified by the Local Education Agency (LEA) homeless liaison or by an official of a homeless shelter as lacking a fixed, regular, and adequate nighttime residence.</li>
                      <li><strong>Migrant</strong>: A child identified as a migrant by the State or local Migrant Education Program coordinator or the local educational liaison, or other individual identified by FNS (Food and Nutrition Service).</li>
                      <li><strong>Runaway</strong>: A child identified as a runaway receiving assistance under a program under the Runaway and Homeless Youth Act, by the local educational liaison, or other individual in accordance with guidance issued by FNS.</li>
                    </ul>
                    </div>
                  </span>                  
                </th>
              </tr>
              <tr class="child">
                <td>
                  <label for="child-first-name-1" class="label-hidden">Child First Name</label>
                  <input id="child-first-name-1" name="child-first-name-1" type="text" class="required" value="a">
                  <span class="input__error-message" role="alert"><span class="input__error-message--required">First name is required</span></span>
                </td>
                <td>
                  <label for="child-middle-initial-1" class="label-hidden">Child Middle Initial</label>
                  <input id="child-middle-initial-1" name="child-middle-initial-1" type="text" maxlength="1">
                </td>
                <td>
                  <label for="child-last-name-1" class="label-hidden">Child Last Name</label>
                  <input id="child-last-name-1" name="child-last-name-1" type="text" class="required" value="s">
                  <span class="input__error-message" role="alert"><span class="input__error-message--required">Last name is required</span></span>
                </td>
                <td>
                  <fieldset class="usa-fieldset-inputs usa-sans">
                    <legend class="usa-sr-only">Student Status</legend>
                    <ul class="usa-unstyled-list">
                      <li>
                        <input id="child-status-student-1" type="checkbox" name="child-status-student-1" value="Student">
                        <label for="child-status-student-1">Student</label>
                      </li>
                    </ul>
                  </fieldset>
                </td>
                <td>
                  <fieldset class="usa-fieldset-inputs usa-sans">
                    <legend class="usa-sr-only">Other Status</legend>
                    <ul class="usa-unstyled-list">
                      <li>
                        <input id="child-status-foster-1" type="checkbox" name="child-status-foster-1" value="Foster">
                        <label for="child-status-foster-1">Foster</label>
                      </li>
                      <li>
                        <input id="child-status-headstart-1" type="checkbox" name="child-status-headstart-1" value="Head Start" checked>
                        <label for="child-status-headstart-1">Head Start</label>
                      </li>
                      <li>
                        <input id="child-status-homeless-migrant-runaway-1" type="checkbox" name="child-status-homeless-migrant-runaway-1" value="Homeless/Migrant/Runaway">
                        <label for="child-status-homeless-migrant-runaway-1">Homeless / Migrant / Runaway</label>
                      </li>
                    </ul>
                  </fieldset>
                </td>
              </tr>
            </table>
            <div class="button_wrapper">
              <button class="usa-button-outline" id="child-add">+ Add Another Child</button>
            </div>
            <div class="form__section--instruction form__section--instruction-mobile">
              <ul>
                <li><strong>Foster</strong>: A child who is formally placed by a court or a State child welfare agency.</li>
                <li><strong>Head Start</strong>: A child that is enrolled in a Federal Head Start or State-funded pre-kindergarten program that uses eligibility criteria that is identical or more stringent than Federal Head Start.</li>
                <li><strong>Homeless</strong>: A child identified by the Local Education Agency (LEA) homeless liaison or by an official of a homeless shelter as lacking a fixed, regular, and adequate nighttime residence.</li>
                <li><strong>Migrant</strong>: A child identified as a migrant by the State or local Migrant Education Program coordinator or the local educational liaison, or other individual identified by FNS (Food and Nutrition Service).</li>
                <li><strong>Runaway</strong>: A child identified as a runaway receiving assistance under a program under the Runaway and Homeless Youth Act, by the local educational liaison, or other individual in accordance with guidance issued by FNS.</li>
              </ul>
            </div>
            
          </section>

          <section class="form__section--sub">
            <h4>CHILDREN&rsquo;S RACIAL & ETHNIC IDENTITIES</h4>
            <div class="form__section--instruction">
              <p>Responding to this section is <strong>optional</strong> and does not affect your children&rsquo;s eligibility for free or reduced price meals.</p>
              <p>We are required to ask for information about your children&rsquo;s race and ethnicity to make sure we are fully serving our community.</p>
            </div>
            
            <div class="input__wrapper">
              <p><strong>Ethnicity (check one)</strong></p>
              <fieldset class="usa-fieldset-inputs usa-sans">          
                <legend class="usa-sr-only">Ethnicity</legend>
                <ul class="usa-unstyled-list">
                  <li>
                    <input id="ethnicity-hispanic-y" type="radio" name="ethnicity" value="Hispanic or Latino">
                    <label for="ethnicity-hispanic-y">Hispanic or Latino</label>
                  </li>
                  <li>
                    <input id="ethnicity-hispanic-n" type="radio" name="ethnicity" value="Not Hispanic or Latino">
                    <label for="ethnicity-hispanic-n">Not Hispanic or Latino</label>
                  </li>
                </ul>
              </fieldset>
            </div>
  
            <div class="input__wrapper">
              <p><strong>Race (check all that apply)</strong></p>
              <fieldset class="usa-fieldset-inputs usa-sans">
                <legend class="usa-sr-only">Race</legend>
                <ul class="usa-unstyled-list">
                  <li>
                    <input id="race-native" type="checkbox" name="race" value="American Indian or Alaskan Native">
                    <label for="race-native">American Indian or Alaskan Native</label>
                  </li>
                  <li>
                    <input id="race-asian" type="checkbox" name="race" value="Asian">
                    <label for="race-asian">Asian</label>
                  </li>
                  <li>
                    <input id="race-black" type="checkbox" name="race" value="Black or African American">
                    <label for="race-black">Black or African American</label>
                  </li>
                  <li>
                    <input id="race-pacificislander" type="checkbox" name="race" value="Native Hawaiian or Other Pacific Islander">
                    <label for="race-pacificislander">Native Hawaiian or Other Pacific Islander</label>
                  </li>
                  <li>
                    <input id="race-white" type="checkbox" name="race" value="White">
                    <label for="race-white">White</label>
                  </li>
                </ul>
              </fieldset>
            </div>
              
          </section>

        </section>
        
      </section>
       
  
  
      <!-- PART 2 -->
      
      <section class="form__section" id="form__section-2">
      
        <section class="form__section--header">   
          <h2>Part 2: Assistance Programs</h2>
          <h3>Indicate below if anyone in your household currently participates in <a href="#" class="help-trigger">SNAP, TANF, or FDPIR</a>
            <div class="help-text">
              <ul>
                <li><strong>SNAP</strong>: Supplemental Nutrition Assistance Program (formerly known as food stamps)</li>
                <li><strong>TANF</strong>: Temporary Assistance for Needy Families</li>
                <li><strong>FDPIR</strong>: Food Distribution Program on Indian Reservations</li>
            </div>
          </h3>

        </section>

        <section class="form__section--banner">Based on the information you provided, you are not required to complete this section.</section>
        
        <section class="form__section--body">
          <section class="form__section--sub">
            <div class="form__section--instruction">
              <p>If your household participates in more than one assistance programs, please include only <strong>one</strong> of the case numbers below. It does not matter which one you choose to include.</p>
            </div>
            <fieldset class="usa-fieldset-inputs usa-sans">          
              <legend class="usa-sr-only">Assistance Programs</legend>
              <ul class="usa-unstyled-list">
                <li>
                  <input id="assistance-y" type="radio" name="assistance" value="Assistance" class="required required-pair-radio-input">
                  <label for="assistance-y">Yes, at least one member of my household participates in SNAP, TANF, or FDPIR</label>
                </li>
                <li class="input-indent">
                  <label for="case-number">Case Number <span class="required-marker">*</span></label>
                  <input id="case-number" name="case-number" type="text" class="required-pair-radio-input">
                  <span class="input__error-message" role="alert">Since you indicated that you receive assistance, we need your case number</span>
                </li>
                <li>
                  <input id="assistance-n" type="radio" name="assistance" value="No Assistance" class="required required-pair-radio-input" checked>
                  <label for="assistance-n">No, my household does not participate in assistance programs</label>
                </li>
              </ul>
            </fieldset>
            <span class="input__error-message" role="alert"><span class="input__error-message--required">This field is required</span></span>
          </section>
          
        </section>
  
      </section>



      <!-- PART 3 -->
      
      <section class="form__section" id="form__section-3">
      
        <section class="form__section--header">      
          <h2>Part 3: Household Income</h2>
          <h3>Report income for all household members (adults and children)</h3>
        </section>

        <section class="form__section--banner">Based on the information you provided, you are not required to complete this section.</section>
        
        <section class="form__section--body">

          <section class="form__section--sub">
            <h4>
              <a href="#" class="help-trigger">CHILD INCOME</a>
              <div class="help-text">
                <p>Money received from outside your household that is paid directly to your children. Many households do not have any child income.</p>
              </div>
            </h4>
            <div class="form__section--instruction">
              <p>In <a href="#section-1" class="skip-to-section">part 1</a>, you listed <span id="total-children">1 child</span> in your household.</p>
              <p>For each child listed, if they receive income, report <strong>gross</strong> total income for each source in whole dollars only (before taxes and deductions). If there is no income to report, leave the amount at 0.</p>
              <p>Bi-Weekly = every two weeks (26 paychecks a year).<br/>2x A Month = twice a month (24 paychecks a year).</p>
            </div>
            

            
<!--
            <div class="">
              <label for="child-income-amount">Total Child Income <span class="required-marker">*</span></label>
              <div class="input-type-text__wrapper">
                <input id="child-income-amount" name="child-income-amount" type="text" value="0" class="required required-pair-input-radio validate validate-number">
                <span class="input-type-text__addon">$</span>
                <span class="input__error-message" role="alert"><span class="input__error-message--required">Child income amount is required (enter 0 if none)</span></span>
              </div>
              <label for="child-income-frequency" class="label-hidden">Child Income Frequency</label>
              <fieldset class="usa-fieldset-inputs usa-sans">          
                <legend class="usa-sr-only">Child Income Frequency</legend>
                <ul class="usa-unstyled-list input-radio-styled">
                  <li>
                    <input type="radio" name="child-income-frequency" id="child-income-frequency-weekly" value="Weekly"> 
                    <label for="child-income-frequency-weekly">Weekly</label>
                  </li>
                  <li>
                    <input type="radio" name="child-income-frequency" id="child-income-frequency-biweekly" value="Bi-Weekly"> 
                    <label for="child-income-frequency-biweekly">Bi-Weekly</label>
                  </li>
                  <li>
                    <input type="radio" name="child-income-frequency" id="child-income-frequency-twiceamonth" value="2x A Month"> 
                    <label for="child-income-frequency-twiceamonth">2x A Month</label>
                  </li>
                  <li>
                    <input type="radio" name="child-income-frequency" id="child-income-frequency-monthly" value="Monthly">
                    <label for="child-income-frequency-monthly">Monthly</label>
                  </li>
                </ul>
                </fieldset>
                    <span class="input__error-message" role="alert"><span class="input__error-message--required">Please select a frequency for child income</span></span>
            </div>
-->












            <table id="child-income">
              <tr>
                <th id="child-column-name">Child&rsquo;s Name</th>
                <th id="child-column-income">Income <span class="required-marker">*</span><br/>
                  <span>
                    <a href="#" class="help-trigger">Earnings from Work</a>&nbsp;+&nbsp;
                    <div class="help-text">
                      <p>Salary or wages from a job.</p>
                    </div>
                  </span>
                  <span>
                    <a href="#" class="help-trigger">Social Security Benefits</a>&nbsp;+&nbsp;
                    <div class="help-text">
                      <p>Social Security benefits for the child&rsquo;s own blindness or disability, or because a parent is disabled, retired, or deceased.</p>
                      </ul>
                    </div>
                  </span>
                  <span>                  
                    <a href="#" class="help-trigger">Income from Other Household</a>&nbsp;+&nbsp;
                    <div class="help-text">
                      <p>Spending money or other income from a person outside the household such as an extended family member or friend.</p>
                      </ul>
                    </div>
                  </span>
                  <span>                  
                    <a href="#" class="help-trigger">Other Income</a>
                    <div class="help-text">
                      <p>Income from any other source such as from a private pension fund, annuity, or trust.</p>
                    </div>
                  </span>
                </th>
              </tr>
<!--
              <tr class="child-each">
                <td>
                  Jane Doe
                </td>
                <td>
                  <div class="child-income-section">
                    <label for="child-income-earnings-amount-1">Earnings from Work</label>
                    <div class="input-type-text__wrapper">
                      <input id="child-income-earnings-amount-1" name="child-income-earnings-amount-1" type="text" value="0" class="required required-pair-input-radio validate validate-number">
                      <span class="input-type-text__addon">$</span>
                      <span class="input__error-message" role="alert"><span class="input__error-message--required">Earnings amount is required (enter 0 if none)</span></span>
                    </div>
                    <label for="child-income-earnings-frequency-1" class="label-hidden">Earnings from Work Frequency</label>
                    <fieldset class="usa-fieldset-inputs usa-sans">          
                      <legend class="usa-sr-only">Child Earnings from Work Frequency</legend>
                      <ul class="usa-unstyled-list input-radio-styled">
                        <li>
                          <input type="radio" name="child-income-earnings-frequency-1" id="child-income-earnings-frequency-weekly-1" value="Weekly">
                          <label for="child-income-earnings-frequency-weekly-1">Weekly</label>
                        </li>
                        <li>
                          <input type="radio" name="child-income-earnings-frequency-1" id="child-income-earnings-frequency-biweekly-1" value="Bi-Weekly"> 
                          <label for="child-income-earnings-frequency-biweekly-1">Bi-Weekly</label>
                        </li>
                        <li>
                          <input type="radio" name="child-income-earnings-frequency-1" id="child-income-earnings-frequency-twiceamonth-1" value="2x A Month"> 
                          <label for="child-income-earnings-frequency-twiceamonth-1">2x A Month</label>
                        </li>
                        <li>
                          <input type="radio" name="child-income-earnings-frequency-1" id="child-income-earnings-frequency-monthly-1" value="Monthly"> 
                          <label for="child-income-earnings-frequency-monthly-1">Monthly</label>
                        </li>
                      </ul>
                    </fieldset>
                    <span class="input__error-message" role="alert"><span class="input__error-message--required">Please select a frequency for earnings</span></span>
                  </div>
                  <div class="child-income-section">
                    <label for="child-income-social-amount-1">Social Security Benefits</label>
                    <div class="input-type-text__wrapper">
                      <input id="child-income-social-amount-1" name="child-income-social-amount-1" type="text" value="0" class="required required-pair-input-radio validate validate-number">
                      <span class="input-type-text__addon">$</span>
                      <span class="input__error-message" role="alert"><span class="input__error-message--required">Social Security benefits amount is required (enter 0 if none)</span></span>
                    </div>
                    <label for="child-income-social-frequency-1" class="label-hidden">Social Security Benefits Frequency</label>
                    <fieldset class="usa-fieldset-inputs usa-sans">          
                      <legend class="usa-sr-only">Social Security Benefits Frequency</legend>
                      <ul class="usa-unstyled-list input-radio-styled">
                        <li>
                          <input type="radio" name="child-income-social-frequency-1" id="child-income-social-frequency-weekly-1" value="Weekly">
                          <label for="child-income-social-frequency-weekly-1">Weekly</label>
                        </li>
                        <li>
                          <input type="radio" name="child-income-social-frequency-1" id="child-income-social-frequency-biweekly-1" value="Bi-Weekly"> 
                          <label for="child-income-social-frequency-biweekly-1">Bi-Weekly</label>
                        </li>
                        <li>
                          <input type="radio" name="child-income-social-frequency-1" id="child-income-social-frequency-twiceamonth-1" value="2x A Month"> 
                          <label for="child-income-social-frequency-twiceamonth-1">2x A Month</label>
                        </li>
                        <li>
                          <input type="radio" name="child-income-social-frequency-1" id="child-income-social-frequency-monthly-1" value="Monthly">
                          <label for="child-income-social-frequency-monthly-1">Monthly</label>
                        </li>
                      </ul>
                    </fieldset>
                    <span class="input__error-message" role="alert"><span class="input__error-message--required">Please select a frequency for social security benefits</span></span>
                  </div>
                  <div class="child-income-section">
                    <label for="child-income-other-household-amount-1">Income from Other Household</label>
                    <div class="input-type-text__wrapper">
                      <input id="child-income-other-household-amount-1" name="child-income-other-household-amount-1" type="text" value="0" class="required required-pair-input-radio validate validate-number">
                      <span class="input-type-text__addon">$</span>
                      <span class="input__error-message" role="alert"><span class="input__error-message--required">Income from other household income amount is required (enter 0 if none)</span></span>
                    </div>
                    <label for="child-income-other-household-frequency-1" class="label-hidden">Income from Other Household</label>
                    <fieldset class="usa-fieldset-inputs usa-sans">          
                      <legend class="usa-sr-only">Income from Other Household Frequency</legend>
                      <ul class="usa-unstyled-list input-radio-styled">
                        <li>
                          <input type="radio" name="child-income-other-household-frequency-1" id="child-income-other-household-frequency-weekly-1" value="Weekly">
                          <label for="child-income-other-household-frequency-weekly-1">Weekly</label>
                        </li>
                        <li>
                          <input type="radio" name="child-income-other-household-frequency-1" id="child-income-other-household-frequency-biweekly-1" value="Bi-Weekly"> 
                          <label for="child-income-other-household-frequency-biweekly-1">Bi-Weekly</label>
                        </li>
                        <li>
                          <input type="radio" name="child-income-other-household-frequency-1" id="child-income-other-household-frequency-twiceamonth-1" value="2x A Month"> 
                          <label for="child-income-other-household-frequency-twiceamonth-1">2x A Month</label>
                        </li>
                        <li>
                          <input type="radio" name="child-income-other-household-frequency-1" id="child-income-other-household-frequency-monthly-1" value="Monthly"> 
                          <label for="child-income-other-household-frequency-monthly-1">Monthly</label>
                        </li>
                      </ul>
                    </fieldset>
                    <span class="input__error-message" role="alert"><span class="input__error-message--required">Please select a frequency for income from other household</span></span>
                  </div>
                  <div class="child-income-section">
                    <label for="child-income-other-amount-1">Other Income</label>
                    <div class="input-type-text__wrapper">
                      <input id="child-income-other-amount-1" name="child-income-other-amount-1" type="text" value="0" class="required required-pair-input-radio validate validate-number">
                      <span class="input-type-text__addon">$</span>
                      <span class="input__error-message" role="alert"><span class="input__error-message--required">Other income amount is required (enter 0 if none)</span></span>
                    </div>
                    <label for="child-income-other-frequency-1" class="label-hidden">Income from Other Household</label>
                    <fieldset class="usa-fieldset-inputs usa-sans">          
                      <legend class="usa-sr-only">Income from Other Household Frequency</legend>
                      <ul class="usa-unstyled-list input-radio-styled">
                        <li>
                          <input type="radio" name="child-income-other-frequency-1" id="child-income-other-frequency-weekly-1" value="Weekly">
                          <label for="child-income-other-frequency-weekly-1">Weekly</label>
                        </li>
                        <li>
                          <input type="radio" name="child-income-other-frequency-1" id="child-income-other-frequency-biweekly-1" value="Bi-Weekly"> 
                          <label for="child-income-other-frequency-biweekly-1">Bi-Weekly</label>
                        </li>
                        <li>
                          <input type="radio" name="child-income-other-frequency-1" id="child-income-other-frequency-twiceamonth-1" value="2x A Month"> 
                          <label for="child-income-other-frequency-twiceamonth-1">2x A Month</label>
                        </li>
                        <li>
                          <input type="radio" name="child-income-other-frequency-1" id="child-income-other-frequency-monthly-1" value="Monthly"> 
                          <label for="child-income-other-frequency-monthly-1">Monthly</label>
                        </li>
                      </ul>
                    </fieldset>
                    <span class="input__error-message" role="alert"><span class="input__error-message--required">Please select a frequency for other income</span></span>
                  </div>
                </td>
              </tr>
-->
            </table>

            <div class="form__section--instruction form__section--instruction-mobile">
              <ul>
                <li><strong>Earnings from Work</strong>: Salary or wages from a job.</li>
                <li><strong>Social Security Benefits</strong>: Social Security benefits for the child&rsquo;s own blindness or disability, or because a parent is disabled, retired, or deceased.</li>
                <li><strong>Income from Other Household</strong>: Spending money or other income from a person outside the household such as an extended family member or friend.</li>
                <li><strong>Other Income</strong>: Income from any other source such as from a private pension fund, annuity, or trust.</li>
              </ul>
            </div>
          </section>
  
          <section class="form__section--sub">
            <h4>ADULT INCOME</h4>
            <div class="form__section--instruction">
              <p>List all household members not listed above (including yourself) <em>even if they do not receive income</em>.</p>
              <p>Household members do not necessarily have to be your immediate family. For example, grandparents, cousins, or friends who live with you and share income and living expenses count as household members.</p>
              <p>For each adult household member listed, if they receive income, report <strong>gross</strong> total income for each source in whole dollars only (before taxes and deductions). If there is no income to report, leave the amount at 0.</p>
              <p>Bi-Weekly = every two weeks (26 paychecks a year).<br/>2x A Month = twice a month (24 paychecks a year).</p>
            </div>          
            <table id="adult-income">
              <tr>
                <th id="adult-column-first-name">Adult&rsquo;s First Name <span class="required-marker">*</span></th>
                <th id="adult-column-last-name">Last Name <span class="required-marker">*</span></th>
                <th id="adult-column-income">Income  <span class="required-marker">*</span><br/>
                  <span>
                    <a href="#" class="help-trigger">Earnings from Work</a>&nbsp;+&nbsp;
                    <div class="help-text">
                      <ul>
                        <li>Salary, wages, cash bonuses</li>
                        <li><em>Net</em> income from self-employment (farm or business)</li>
                        <li>Strike benefits</li>
                      </ul>
                      <p><strong>If you are in the U.S. Military:</strong></p>
                      <ul>
                        <li>Basic pay and cash bonuses (do NOT include combat pay, FSSA or privatized housing allowances)</li>
                        <li>Allowances for off-base housing, food, and clothing</li>
                      </ul>
                    </div>
                  </span>
                  <span>
                    <a href="#" class="help-trigger">Public Assistance/Child Support/Alimony</a>&nbsp;+&nbsp;
                    <div class="help-text">
                      <ul>
                        <li>Unemployment benefits</li>
                        <li>Worker&rsquo;s compensation</li>
                        <li>Supplemental Security Income (SSI)</li>
                        <li>Cash assistance from State or local government</li>
                        <li>Alimony payments</li>
                        <li>Child support payments</li>
                        <li>Veteran&rsquo;s benefits</li>
                      </ul>
                    </div>
                  </span>
                  <span>                  
                    <a href="#" class="help-trigger">Pensions/Retirement/All Other Income</a>
                    <div class="help-text">
                      <ul>
                        <li>Social Security (including railroad retirement and black lung benefits)</li>
                        <li>Private pensions or disability</li>
                        <li>Income from trusts or estates</li>
                        <li>Annuities</li>
                        <li>Investment income</li>
                        <li>Earned interest</li>
                        <li>Rental income</li>
                        <li>Regular cash payments from <em>outside</em> household</li>
                      </ul>
                    </div>
                  </span>
                </th>
              </tr>
              <tr class="adult">
                <td>
                  <label for="adult-first-name-1" class="label-hidden-text">Adult First Name</label>
                  <input id="adult-first-name-1" name="adult-first-name-1" type="text" class="required" value="jane">
                  <span class="input__error-message" role="alert"><span class="input__error-message--required">First name is required</span></span>
                </td>
                <td>
                  <label for="adult-last-name-1" class="label-hidden-text">Adult Last Name</label>
                  <input id="adult-last-name-1" name="adult-last-name-1" type="text" class="required" value="doe">
                  <span class="input__error-message" role="alert"><span class="input__error-message--required">Last name is required</span></span>
                </td>
                <td class="adult-each">
                  <div class="adult-income-section">
                    <label for="adult-income-earnings-amount-1">Earnings from Work</label>
                    <div class="input-type-text__wrapper">
                      <input id="adult-income-earnings-amount-1" name="adult-income-earnings-amount-1" type="text" value="0" class="required required-pair-input-radio validate validate-number">
                      <span class="input-type-text__addon">$</span>
                      <span class="input__error-message" role="alert"><span class="input__error-message--required">Earnings amount is required (enter 0 if none)</span></span>
                    </div>
                    <label for="adult-income-earnings-frequency-1" class="label-hidden">Earnings from Work Frequency</label>
                    <fieldset class="usa-fieldset-inputs usa-sans">          
                      <legend class="usa-sr-only">Adult Earnings from Work Frequency</legend>
                      <ul class="usa-unstyled-list input-radio-styled">
                        <li>
                          <input type="radio" name="adult-income-earnings-frequency-1" id="adult-income-earnings-frequency-weekly-1" value="Weekly">
                          <label for="adult-income-earnings-frequency-weekly-1">Weekly</label>
                        </li>
                        <li>
                          <input type="radio" name="adult-income-earnings-frequency-1" id="adult-income-earnings-frequency-biweekly-1" value="Bi-Weekly"> 
                          <label for="adult-income-earnings-frequency-biweekly-1">Bi-Weekly</label>
                        </li>
                        <li>
                          <input type="radio" name="adult-income-earnings-frequency-1" id="adult-income-earnings-frequency-twiceamonth-1" value="2x A Month"> 
                          <label for="adult-income-earnings-frequency-twiceamonth-1">2x A Month</label>
                        </li>
                        <li>
                          <input type="radio" name="adult-income-earnings-frequency-1" id="adult-income-earnings-frequency-monthly-1" value="Monthly"> 
                          <label for="adult-income-earnings-frequency-monthly-1">Monthly</label>
                        </li>
                      </ul>
                    </fieldset>
                    <span class="input__error-message" role="alert"><span class="input__error-message--required">Please select a frequency for earnings</span></span>
                  </div>
                  <div class="adult-income-section">
                    <label for="adult-income-assistance-amount-1">Public Assistance/Child Support/Alimony</label>
                    <div class="input-type-text__wrapper">
                      <input id="adult-income-assistance-amount-1" name="adult-income-assistance-amount-1" type="text" value="0" class="required required-pair-input-radio validate validate-number">
                      <span class="input-type-text__addon">$</span>
                      <span class="input__error-message" role="alert"><span class="input__error-message--required">Assistance amount is required (enter 0 if none)</span></span>
                    </div>
                    <label for="adult-income-assistance-frequency-1" class="label-hidden">Public Assistance/Child Support/Alimony Frequency</label>
                    <fieldset class="usa-fieldset-inputs usa-sans">          
                      <legend class="usa-sr-only">Adult Public Assistance Frequency</legend>
                      <ul class="usa-unstyled-list input-radio-styled">
                        <li>
                          <input type="radio" name="adult-income-assistance-frequency-1" id="adult-income-assistance-frequency-weekly-1" value="Weekly">
                          <label for="adult-income-assistance-frequency-weekly-1">Weekly</label>
                        </li>
                        <li>
                          <input type="radio" name="adult-income-assistance-frequency-1" id="adult-income-assistance-frequency-biweekly-1" value="Bi-Weekly"> 
                          <label for="adult-income-assistance-frequency-biweekly-1">Bi-Weekly</label>
                        </li>
                        <li>
                          <input type="radio" name="adult-income-assistance-frequency-1" id="adult-income-assistance-frequency-twiceamonth-1" value="2x A Month"> 
                          <label for="adult-income-assistance-frequency-twiceamonth-1">2x A Month</label>
                        </li>
                        <li>
                          <input type="radio" name="adult-income-assistance-frequency-1" id="adult-income-assistance-frequency-monthly-1" value="Monthly">
                          <label for="adult-income-assistance-frequency-monthly-1">Monthly</label>
                        </li>
                      </ul>
                    </fieldset>
                    <span class="input__error-message" role="alert"><span class="input__error-message--required">Please select a frequency for assistance</span></span>
                  </div>
                  <div class="adult-income-section">
                    <label for="adult-income-pension-amount-1">Pensions/Retirement/All Other Income</label>
                    <div class="input-type-text__wrapper">
                      <input id="adult-income-pension-amount-1" name="adult-income-pension-amount-1" type="text" value="0" class="required required-pair-input-radio validate validate-number">
                      <span class="input-type-text__addon">$</span>
                      <span class="input__error-message" role="alert"><span class="input__error-message--required">Pension amount is required (enter 0 if none)</span></span>
                    </div>
                    <label for="adult-income-pension-frequency-1" class="label-hidden">Pensions/Retirement/All Other Income</label>
                    <fieldset class="usa-fieldset-inputs usa-sans">          
                      <legend class="usa-sr-only">Adult Pension Frequency</legend>
                      <ul class="usa-unstyled-list input-radio-styled">
                        <li>
                          <input type="radio" name="adult-income-pension-frequency-1" id="adult-income-pension-frequency-weekly-1" value="Weekly">
                          <label for="adult-income-pension-frequency-weekly-1">Weekly</label>
                        </li>
                        <li>
                          <input type="radio" name="adult-income-pension-frequency-1" id="adult-income-pension-frequency-biweekly-1" value="Bi-Weekly"> 
                          <label for="adult-income-pension-frequency-biweekly-1">Bi-Weekly</label>
                        </li>
                        <li>
                          <input type="radio" name="adult-income-pension-frequency-1" id="adult-income-pension-frequency-twiceamonth-1" value="2x A Month"> 
                          <label for="adult-income-pension-frequency-twiceamonth-1">2x A Month</label>
                        </li>
                        <li>
                          <input type="radio" name="adult-income-pension-frequency-1" id="adult-income-pension-frequency-monthly-1" value="Monthly"> 
                          <label for="adult-income-pension-frequency-monthly-1">Monthly</label>
                        </li>
                      </ul>
                    </fieldset>
                    <span class="input__error-message" role="alert"><span class="input__error-message--required">Please select a frequency for pension</span></span>
                  </div>
                </td>
              </tr>
            </table>
            <div class="button_wrapper">
              <button class="usa-button-outline" id="adult-add">+ Add Another Adult</button>
            </div>
            <div class="form__section--instruction form__section--instruction-mobile">            
              <strong>Earnings from Work</strong>
              <ul>
                <li>Salary, wages, cash bonuses</li>
                <li><em>Net</em> income from self-employment (farm or business)</li>
                <li>Strike benefits</li>
              </ul>
              <p><strong>If you are in the U.S. Military:</strong></p>
              <ul>
                <li>Basic pay and cash bonuses (do NOT include combat pay, FSSA or privatized housing allowances)</li>
                <li>Allowances for off-base housing, food, and clothing</li>
              </ul>
              <strong>Public Assistance/Child Support/Alimony</strong>
              <ul>
                <li>Unemployment benefits</li>
                <li>Worker&rsquo;s compensation</li>
                <li>Supplemental Security Income (SSI)</li>
                <li>Cash assistance from State or local government</li>
                <li>Alimony payments</li>
                <li>Child support payments</li>
                <li>Veteran&rsquo;s benefits</li>
              </ul>
              <strong>Pensions/Retirement/All Other Income</strong>
              <ul>
                <li>Social Security (including railroad retirement and black lung benefits)</li>
                <li>Private pensions or disability</li>
                <li>Income from trusts or estates</li>
                <li>Annuities</li>
                <li>Investment income</li>
                <li>Earned interest</li>
                <li>Rental income</li>
                <li>Regular cash payments from <em>outside</em> household</li>
              </ul>
            </div>            
            <div id="household-summary">
              My household has <span id="total-household-members">2</span> members and earns $ <span id="total-household-income">0</span> annually.
            </div>
          </section>
                  
          <section class="form__section--sub">
            <h4>SOCIAL SECURITY INFORMATION</h4>
            <div class="form__section--instruction">
              <p>United States citizenship or immigration status is <strong>not</strong> a condition of eligibility for free and reduced price lunch benefits. Your children may still be eligible for this benefit even if you do not have a Social Security Number (SSN).</p>
              <p>If more than one person in your household has a SSN, please include only <strong>one</strong> number below. It does not matter which one you choose to include.</p>
            </div>
            <p><strong>Does the primary wage earner or another member in your household have a Social Security Number (SSN)?</strong></p>
            <fieldset class="usa-fieldset-inputs usa-sans">          
              <legend class="usa-sr-only">Social Security Number</legend>
              <ul class="usa-unstyled-list">
                <li>
                  <input id="ssn-y" type="radio" name="ssn" value="SSN" class="required">
                  <label for="ssn-y">Yes, a member in my household has a SSN</label>
                </li>
                <li class="input-indent">
                  <label for="ssn-number" class="">Last 4 digits of SSN <span class="required-marker">*</span></label>
                  <input id="ssn-number" name="ssn-number" type="text" maxlength="4" class="required-pair-radio-input validate validate-ssn">
                  <span class="input__error-message" role="alert"><span class="input__error-message--required">Since you indicated that you have a SSN, we need the last 4 digits of your SSN</span><span class="input__error-message--validation">Please make sure you enter a 4-digit number</span></span>
                </li>
                <li>
                  <input id="ssn-n" type="radio" name="ssn" value="No SSN" class="required" checked>
                  <label for="ssn-n">No, no one in my household has a SSN</label>
                </li>
              </ul>
            </fieldset>
            <span class="input__error-message" role="alert"><span class="input__error-message--required">SSN information is required</span></span>
            
          </section>

        </section>
      
      </section>


      <!-- PART 4 -->
      
      <section class="form__section" id="form__section-4">
      
        <section class="form__section--header">      
          <h2>Part 4: Adult Contact Information</h2>
          <h3>Provide your contact information</h3>
        </section>
        
        <section class="form__section--body">

          <section class="form__section--sub">
            <div class="group-fields input__wrapper">
              <div class="group-fields-section" id="group-fields-section--address">
                <label for="street-address">Street Address (if available)</label>
                <input id="street-address" name="street-address" type="text" value="">
              </div>
              <div class="group-fields-section">            
                <label for="apartment">Apt #</label>
                <input id="apartment" name="apartment" type="text">
              </div>
            </div>
            <div class="input__wrapper">
              <label for="city">City <span class="required-marker">*</span></label>
              <input id="city" name="city" type="text" class="required" value="oakland">
            <span class="input__error-message" role="alert"><span class="input__error-message--required">City is required</span></span>
            </div>
            <div class="input__wrapper">
              <label for="state">State <span class="required-marker">*</span></label>
              <select name="state" id="state" class="required">
                <option value="">(State)</option>
                <option value="AL">Alabama</option>
                <option value="AK">Alaska</option>
                <option value="AZ">Arizona</option>
                <option value="AR">Arkansas</option>
                <option value="CA" selected>California</option>
                <option value="CO">Colorado</option>
                <option value="CT">Connecticut</option>
                <option value="DE">Delaware</option>
                <option value="DC">District Of Columbia</option>
                <option value="FL">Florida</option>
                <option value="GA">Georgia</option>
                <option value="HI">Hawaii</option>
                <option value="ID">Idaho</option>
                <option value="IL">Illinois</option>
                <option value="IN">Indiana</option>
                <option value="IA">Iowa</option>
                <option value="KS">Kansas</option>
                <option value="KY">Kentucky</option>
                <option value="LA">Louisiana</option>
                <option value="ME">Maine</option>
                <option value="MD">Maryland</option>
                <option value="MA">Massachusetts</option>
                <option value="MI">Michigan</option>
                <option value="MN">Minnesota</option>
                <option value="MS">Mississippi</option>
                <option value="MO">Missouri</option>
                <option value="MT">Montana</option>
                <option value="NE">Nebraska</option>
                <option value="NV">Nevada</option>
                <option value="NH">New Hampshire</option>
                <option value="NJ">New Jersey</option>
                <option value="NM">New Mexico</option>
                <option value="NY">New York</option>
                <option value="NC">North Carolina</option>
                <option value="ND">North Dakota</option>
                <option value="OH">Ohio</option>
                <option value="OK">Oklahoma</option>
                <option value="OR">Oregon</option>
                <option value="PA">Pennsylvania</option>
                <option value="RI">Rhode Island</option>
                <option value="SC">South Carolina</option>
                <option value="SD">South Dakota</option>
                <option value="TN">Tennessee</option>
                <option value="TX">Texas</option>
                <option value="UT">Utah</option>
                <option value="VT">Vermont</option>
                <option value="VA">Virginia</option>
                <option value="WA">Washington</option>
                <option value="WV">West Virginia</option>
                <option value="WI">Wisconsin</option>
                <option value="WY">Wyoming</option>
              </select>
              <span class="input__error-message" role="alert"><span class="input__error-message--required">State is required</span></span>
            </div>
            <div class="input__wrapper">
              <label for="zip">ZIP Code <span class="required-marker">*</span></label>
              <input id="zip" name="zip" type="text" class="required" maxlength="5" value="12345">
              <span class="input__error-message" role="alert"><span class="input__error-message--required">ZIP code is required</span></span>
            </div>
            <div class="input__wrapper">
              <label for="phone">Phone Number</label>
              <input id="phone" name="phone" type="text" class="validate validate-phone" maxlength="12" value="510-123-4567">
              <span class="input__error-message" role="alert"><span class="input__error-message--validation">Phone number seems invalid; make sure it&rsquo;s formatted properly (e.g. 312-456-7890)</span></span>
            </div>
            <div class="input__wrapper">
              <label for="email">Email</label>
              <input id="email" name="email" type="text" class="validate validate-email" value="test@mail.com">
              <span class="input__error-message" role="alert"><span class="input__error-message--validation">Email seems to be invalid; make sure it&rsquo;s formatted properly (e.g. name@mail.com) </span></span>
            </div>
          </section>

<!--
          <section class="form__section--sub">
            <h4>ADULT SIGNATURE</h4>
            <div class="input__wrapper">
              <label for="signature-name">Name of adult completing this form <span class="required-marker">*</span></label>
              <input id="signature-name" name="signature-name" type="text" class="required" value="andy">
              <span class="input__error-message" role="alert"><span class="input__error-message--required">This field is required</span></span>
            </div>
            <div class="input__wrapper">
              <label for="date">Today&rsquo;s date</label>
              <p id="date">01/01/2016</p>
            </div>
          </section>
-->
          
        </section>
          
      </section>




      <!-- PART 5 -->
      
      <section class="form__section" id="form__section-5">

        <div id="loading">loading</div>
      
        <section class="form__section--header">      
          <h2>Part 5: Summary & Submit</h2>
          <h3>Review your application before you submit it</h3>
        </section>
        
        <section class="form__section--body">
                    
          <section class="form__section--sub">
            <h4>ADULT SIGNER <span><a href="#section-0" class="skip-to-section">Edit</a></span></h4>
            <div class="form__section--summary">
              <p><span id="adult-signer">No name provided.</span><br/><span id="date">01/01/2016</span></p>
            </div>
          </section>
          
          <section class="form__section--sub">
            <h4>CHILDREN INFORMATION <span><a href="#section-1" class="skip-to-section">Edit</a></span></h4>
            <div class="form__section--summary" id="form__section--summary-1">No information entered.</div>
          </section>
          
          <section class="form__section--sub">
            <h4>ASSISTANCE PROGRAMS <span><a href="#section-2" class="skip-to-section">Edit</a></span></h4>
            <p id="form__section--summary-assistance" class="form__section--summary-not-required">(Information not required)</p>            
            <div class="form__section--summary" id="form__section--summary-2">No information entered.</div>
          </section>
          
          <section class="form__section--sub">
            <h4>HOUSEHOLD INCOME <span><a href="#section-3" class="skip-to-section">Edit</a></span></h4>
            <p id="form__section--summary-income" class="form__section--summary-not-required">(Information not required)</p>
            <div class="form__section--summary" id="form__section--summary-3">
              <p>My household has <span id="form__section--summary-total-household-members">2</span> members and earns $ <span id="form__section--summary-total-household-income">0</span> annually.<br/><span id="form__section--summary-ssn">No SSN information entered.</span></p>
              <div class="form__section--summary-sub">
                <h5>Children Income</h5>
                <table id="form__section--summary-child-income"><td>No information entered.</td></table>
                <h5>Adult Income</h5>            
                <table id="form__section--summary-adult-income"><td>No information entered.</td></table>
              </div>
            </div>
          </section>
          
          <section class="form__section--sub">
            <h4>ADULT CONTACT INFORMATION <span><a href="#section-4" class="skip-to-section">Edit</a></span></h4>
            <div class="form__section--summary" id="form__section--summary-4">No information entered.</div>
          </section>

        </section>
          
      </section>



      <!-- PART 6 -->
      <section class="form__section form__section-intro form__section-thanks" id="form__section-6">
        <h1>Thank You!</h1>
        <div class="form__section--intro-logo">
          <img src="img/logo.png" alt="Springfield Academy">
        </div>
        <div class="form__section--intro-text">
          <p><strong>Your application has been submitted and you don&rsquo;t need to do anything further.</strong></p>
          <p>We will review your information and you will receive a letter in the mail if you are eligible for this benefit.</p>
          <p>In the meantime, please contact John Doe at 123-456-7890 or <a class="link-reverse" href="mailto:john.doe@springfield.edu">john.doe@springfield.edu</a> if you have questions.</p>
          <div class="button_wrapper">
            <a href="http://google.com" class="usa-button">GO TO SPRINGFIELD ACADEMY</a>
          </div>
        </div>
      </section>
      


      <div class="button_wrapper" id="button_wrapper--navigate">
        <button id="form__previous" >PREVIOUS</button>
        <button id="form__save">SAVE & CONTINUE</button>
        <button id="form__submit">SUBMIT MY APPLICATION</button>
        <span id="form__section--error">Please review errors in this section</span>

        <ul id="indicator__bar">
          <li>Section 1 of 5</li>
          <li>Section 2 of 5</li>
          <li>Section 3 of 5</li>
          <li>Section 4 of 5</li>
          <li>Section 5 of 5</li>
        </ul>

      </div>
  

      </form>
    </div>

  </body>

</html>