<?php
require_once('../functions.php');
db_connect();
$sql = "INSERT INTO patients(patientFirstName,patientLastName,emailId,password,dob,sex) VALUES (?,?,?,?,?,?)";
$statement = $conn->prepare($sql);
$statement->bind_param('ssssss', $_POST['fname'], $_POST['lname'], $_POST['emailID'], $_POST['password'], $_POST['dob'], $_POST['sex']);
if ($statement->execute()) {
    $_SESSION['accountCreated'] = TRUE;
    redirect_to('../');
}
