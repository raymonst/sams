<?php

  $table = $_GET["table"];
  $tableName = "download-".$table;
  
  include('database.php');

  // create connection
  $conn = new mysqli($servername, $username, $password, $database);

  // check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } 

  // query
  $household = "SELECT * FROM $table";
  $householdResult = $conn->query($household);
  $fieldHeaders = $householdResult->fetch_fields();
  $fields = $householdResult->fetch_assoc();

  // build header
  $csvHeader = '';  
  foreach($fieldHeaders as $header) {
  	$csvHeader .= '"' . $header->name . '",';
  };
  $csvHeader .= "\n";

  // build rows
  $csvRow = '';
  while($row = $householdResult->fetch_assoc()) {

    foreach($fieldHeaders as $header) {
    	$csvRow .= '"' . $row[$header->name] . '",';
    };
  	$csvRow .= "\n";

  };

  // build csv and download
  header('Content-type: application/csv');
  header('Content-Disposition: attachment; filename='.$tableName.'.csv');
  echo $csvHeader . $csvRow;
  exit;

?>