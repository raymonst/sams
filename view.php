<?php

  include('database.php');

  // create connection
  $conn = new mysqli($servername, $username, $password, $database);

  // check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } 

  $household = "SELECT * FROM household";
  $householdResult = $conn->query($household);

  $children = "SELECT * FROM children";
  $childrenResult = $conn->query($children);

  $adults = "SELECT * FROM adults";
  $adultsResult = $conn->query($adults);
  
?>

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
    <div id="view">

      <div class="view__title">
        <h2>Household Information</h2>
        <a href="download.php?table=household" class="usa-button">DOWNLOAD CSV</a>
      </div>

      <table>
        <tr>
          <th>Household ID</th>
          <th>Household Income</th>
          <th>Household Size</th>
          <th colspan="2">Assistance</th>
          <th colspan="5">Address</th>
          <th>Phone</th>
          <th>Email</th>
          <th>Adult Signer</th>
          <th colspan="2">Social Security</th>
          <th>Ethnicity</th>
          <th>Race</th>
          <th>Date</th>
        </tr>
        <tr>
          <th class="table__header--secondary"></th>
          <th class="table__header--secondary"></th>
          <th class="table__header--secondary"></th>
          <th class="table__header--secondary">Status</th>
          <th class="table__header--secondary">Case Number</th>
          <th class="table__header--secondary">Street</th>
          <th class="table__header--secondary">Apt</th>
          <th class="table__header--secondary">City</th>
          <th class="table__header--secondary">State</th>
          <th class="table__header--secondary">ZIP</th>
          <th class="table__header--secondary"></th>
          <th class="table__header--secondary"></th>
          <th class="table__header--secondary"></th>
          <th class="table__header--secondary">Status</th>
          <th class="table__header--secondary">Number</th>
          <th class="table__header--secondary"></th>
          <th class="table__header--secondary"></th>
          <th class="table__header--secondary"></th>
        </tr>
      
        <?php 
          
          if ($householdResult->num_rows > 0) {
            while($row = $householdResult->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . $row[householdID] . "</td>";
              echo "<td>" . $row[householdIncome] . "</td>";
              echo "<td>" . $row[householdSize] . "</td>";
              echo "<td>" . $row[assistanceStatus] . "</td>";
              echo "<td>" . $row[assistanceCaseNumber] . "</td>";
              echo "<td>" . $row[contactInfoStreet] . "</td>";
              echo "<td>" . $row[contactInfoApt] . "</td>";
              echo "<td>" . $row[contactInfoCity] . "</td>";
              echo "<td>" . $row[contactInfoState] . "</td>";
              echo "<td>" . $row[contactInfoZIP] . "</td>";
              echo "<td>" . $row[contactInfoPhone] . "</td>";
              echo "<td>" . $row[contactInfoEmail] . "</td>";
              echo "<td>" . $row[contactInfoName] . "</td>";
              echo "<td>" . $row[ssnStatus] . "</td>";
              echo "<td>" . $row[ssnNumber] . "</td>";
              echo "<td>" . $row[ethnicity] . "</td>";
              echo "<td>" . $row[race] . "</td>";
              echo "<td>" . $row[date] . "</td>";
              echo "</tr>";
            }
          };

        ?>
        
      </table>

      <div class="view__title">
        <h2>Children Information</h2>
        <a href="download.php?table=children" class="usa-button">DOWNLOAD CSV</a>
      </div>
      
      <table>
        <tr>
          <th>Household ID</th>
          <th>First Name</th>
          <th>Middle Initial</th>
          <th>Last Name</th>
          <th>Student Status</th>
          <th>Foster Status</th>
          <th>Head Start Status</th>
          <th>Homeless/Migrant/Runaway Status</th>
          <th colspan="2">Earnings from Work</th>
          <th colspan="2">Social Security Benefits</th>
          <th colspan="2">Income from Other Household</th>
          <th colspan="2">Other Income</th>
          <th>Annual Total Income</th>
        </tr>
        <tr>
          <th class="table__header--secondary"></th>
          <th class="table__header--secondary"></th>
          <th class="table__header--secondary"></th>
          <th class="table__header--secondary"></th>
          <th class="table__header--secondary"></th>
          <th class="table__header--secondary"></th>
          <th class="table__header--secondary"></th>
          <th class="table__header--secondary"></th>
          <th class="table__header--secondary">Amount</th>
          <th class="table__header--secondary">Frequency</th>
          <th class="table__header--secondary">Amount</th>
          <th class="table__header--secondary">Frequency</th>
          <th class="table__header--secondary">Amount</th>
          <th class="table__header--secondary">Frequency</th>
          <th class="table__header--secondary">Amount</th>
          <th class="table__header--secondary">Frequency</th>
          <th class="table__header--secondary"></th>
        </tr>

        <?php
          
          if ($childrenResult->num_rows > 0) {
            
            $childrenRowspan = 1;
            $childrenHHID = "";
            
            while($child = $childrenResult->fetch_assoc()) {
              
              echo "<tr>";
              if ($child[householdID] == $childrenHHID) {
                $childrenRowspan++;
                echo "<td class='dupe'>" . $child[householdID] . "</td>";
              } else {
                echo "<td>" . $child[householdID] . "</td>";
              };
              $childrenHHID = $child[householdID];
              echo "<td>" . $child[firstName] . "</td>";
              echo "<td>" . $child[middleInitial] . "</td>";
              echo "<td>" . $child[lastName] . "</td>";
              echo "<td>" . $child[studentStatus] . "</td>";
              echo "<td>" . $child[fosterStatus] . "</td>";
              echo "<td>" . $child[headstartStatus] . "</td>";
              echo "<td>" . $child[homelessMigrantRunawayStatus] . "</td>";
              echo "<td>" . $child[earningsAmount] . "</td>";
              echo "<td>" . $child[earningsFrequency] . "</td>";
              echo "<td>" . $child[socialAmount] . "</td>";
              echo "<td>" . $child[socialFrequency] . "</td>";
              echo "<td>" . $child[otherHouseholdAmount] . "</td>";
              echo "<td>" . $child[otherHouseholdFrequency] . "</td>";
              echo "<td>" . $child[otherAmount] . "</td>";
              echo "<td>" . $child[otherFrequency] . "</td>";
              echo "<td>" . $child[annual] . "</td>";
              echo "</tr>";

            }
          };
          
        ?>

      </table>
  
      <div class="view__title">
        <h2>Adults Information</h2>
        <a href="download.php?table=adults" class="usa-button">DOWNLOAD CSV</a>
      </div>

      <table>
        <tr>
          <th>Household ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th colspan="2">Earnings from Work</th>
          <th colspan="2">Public Assistance/Child Support/Alimony</th>
          <th colspan="2">Pensions/Retirement/All Other Income</th>
          <th>Annual Total Income</th>
        </tr>
        <tr>
          <th class="table__header--secondary"></th>
          <th class="table__header--secondary"></th>
          <th class="table__header--secondary"></th>
          <th class="table__header--secondary">Amount</th>
          <th class="table__header--secondary">Frequency</th>
          <th class="table__header--secondary">Amount</th>
          <th class="table__header--secondary">Frequency</th>
          <th class="table__header--secondary">Amount</th>
          <th class="table__header--secondary">Frequency</th>
          <th class="table__header--secondary"></th>
        </tr>

        <?php
          
          if ($adultsResult->num_rows > 0) {
            
            $adultsRowspan = 1;
            $adultsHHID = "";
            
            while($adult = $adultsResult->fetch_assoc()) {
              
              echo "<tr>";
              if ($adult[householdID] == $adultsHHID) {
                $adultsRowspan++;
                echo "<td class='dupe'>" . $adult[householdID] . "</td>";
              } else {
                echo "<td>" . $adult[householdID] . "</td>";
              };
              $adultsHHID = $adult[householdID];
              echo "<td>" . $adult[firstName] . "</td>";
              echo "<td>" . $adult[lastName] . "</td>";
              echo "<td>" . $adult[earningsAmount] . "</td>";
              echo "<td>" . $adult[earningsFrequency] . "</td>";
              echo "<td>" . $adult[assistanceAmount] . "</td>";
              echo "<td>" . $adult[assistanceFrequency] . "</td>";
              echo "<td>" . $adult[pensionAmount] . "</td>";
              echo "<td>" . $adult[pensionFrequency] . "</td>";
              echo "<td>" . $adult[annual] . "</td>";
              echo "</tr>";

            }
          };
          
        ?>

      </table>

    </div>
    
  </body>

</html>