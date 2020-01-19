<?php
include("config.php");

$customerFirstName = $_POST["customerFirstName"];
$customerLastName = $_POST["customerLastName"];
$customerEmail = $_POST["customerEmail"];
$customerPassword1 = $_POST["customerPassword1"];
$customerStreetAddress = $_POST["customerStreetAddress"];
$customerHouseNumber = $_POST["customerHouseNumber"];
$customerCity = $_POST["customerCity"];

$sql = "INSERT INTO customers(`First_Name`, `Last_Name`, `Email`, `Password`, `Street_Address`, `House_Number`, `City`) 
VALUES ('$customerFirstName','$customerLastName','$customerEmail','$customerPassword1','$customerStreetAddress','$customerHouseNumber','$customerCity')";

if ( $conn->query($sql) === TRUE) {
        echo "New record created successfully";
} else {
        echo "No record was created";
        header('Location:home.php');
}

?>