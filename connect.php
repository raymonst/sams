<?php
  
  include('database.php');

  // create connection
  $conn = new mysqli($servername, $username, $password, $database);

  // check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } 

  // summary object
  $summary = $_POST["summary"];

  // check that summary object isn't empty
  if (isset($summary)) {

    // decode json
    $data = json_decode($summary, true);
    
    // today's date
    $today = date('Y-m-d');

    // race data; pre-processed because it's an array
    $race = implode(', ', $data[raceEthnicity][race]);

    // enter data into "household" table
    $queryHousehold = "
      INSERT INTO household (householdIncome, householdSize, assistanceStatus, assistanceCaseNumber, contactInfoStreet, contactInfoApt, contactInfoCity, contactInfoState, contactInfoZIP, contactInfoPhone, contactInfoEmail, contactInfoName, ssnStatus, ssnNumber, ethnicity, race, date) VALUES ("
      .$data[household][income]
      .",".$data[household][size]
      .",'".$data[assistance][status]."'"
      .",'".$data[assistance][caseNumber]."'"
      .",'".$data[contactInfo][street]."'"
      .",'".$data[contactInfo][apartment]."'"
      .",'".$data[contactInfo][city]."'"
      .",'".$data[contactInfo][state]."'"
      .",'".$data[contactInfo][zip]."'"
      .",'".$data[contactInfo][phone]."'"
      .",'".$data[contactInfo][email]."'"
      .",'".$data[contactInfo][name]."'"
      .",'".$data[ssn][status]."'"
      .",'".$data[ssn][number]."'"
      .",'".$data[raceEthnicity][ethnicity]."'"
      .",'".$race."'"
      .",'".$today."'"
      .");"
    ;
    $conn->query($queryHousehold);



    // grab the householdID, to be used in "adults" & "children" tables
    $last_id = $conn->insert_id;
    //$last_id = mysqli_insert_id($conn);



    // enter data into "children" table
    $queryChildren = "INSERT INTO children (householdID, firstName, middleInitial, lastName, studentStatus, fosterStatus, headstartStatus, homelessMigrantRunawayStatus, earningsAmount, earningsFrequency, socialAmount, socialFrequency, otherHouseholdAmount, otherHouseholdFrequency, otherAmount, otherFrequency, annualEarnings, annualSocial, annualOtherHousehold, annualOther, annual) VALUES";
    
    for ($i = 0; $i < count($data[children]); $i++) {
      $queryChildren .= "("
      .$last_id
      .",'".$data[children][$i][firstName]."'"
      .",'".$data[children][$i][middleInitial]."'"
      .",'".$data[children][$i][lastName]."'"
      .",'".$data[children][$i][studentStatus]."'"
      .",'".$data[children][$i][fosterStatus]."'"
      .",'".$data[children][$i][headstartStatus]."'"
      .",'".$data[children][$i][homelessMigrantRunawayStatus]."'"
      .",".$data[childIncome][$i][earningsAmount]
      .",'".$data[childIncome][$i][earningsFrequency]."'"
      .",".$data[childIncome][$i][socialAmount]
      .",'".$data[childIncome][$i][socialFrequency]."'"
      .",".$data[childIncome][$i][otherHouseholdAmount]
      .",'".$data[childIncome][$i][otherHouseholdFrequency]."'"
      .",".$data[childIncome][$i][otherAmount]
      .",'".$data[childIncome][$i][otherFrequency]."'"
      .",".$data[childIncome][$i][annualEarnings]
      .",".$data[childIncome][$i][annualSocial]
      .",".$data[childIncome][$i][annualOtherHousehold]
      .",".$data[childIncome][$i][annualOther]
      .",".$data[childIncome][$i][annual];
            
      if ($i < (count($data[children])-1)) {
        $queryChildren .= "),";
      } else {
        $queryChildren .= ");";
      };      

    };

    $conn->query($queryChildren);



    // enter data into "adults" table
    $queryAdults = "INSERT INTO adults (householdID, firstName, lastName, earningsAmount, earningsFrequency, assistanceAmount, assistanceFrequency, pensionAmount, pensionFrequency, annualEarnings, annualAssistance, annualPension, annual) VALUES";

    for ($i = 0; $i < count($data[adults]); $i++) {
      $queryAdults .= "("
      .$last_id
      .",'".$data[adults][$i][firstName]."'"
      .",'".$data[adults][$i][lastName]."'"
      .",".$data[adultIncome][$i][earningsAmount]
      .",'".$data[adultIncome][$i][earningsFrequency]."'"
      .",".$data[adultIncome][$i][assistanceAmount]
      .",'".$data[adultIncome][$i][assistanceFrequency]."'"
      .",".$data[adultIncome][$i][pensionAmount]
      .",'".$data[adultIncome][$i][pensionFrequency]."'"
      .",".$data[adultIncome][$i][annualEarnings]
      .",".$data[adultIncome][$i][annualAssistance]
      .",".$data[adultIncome][$i][annualPension]
      .",".$data[adultIncome][$i][annual];

      if ($i < (count($data[adults])-1)) {
        $queryAdults .= "),";
      } else {
        $queryAdults .= ");";
      };      

    };

    $conn->query($queryAdults);

  } else {

  // if object is empty, throw an error
    echo "error ";
  }

  // close the connection
  $conn->close();

?>