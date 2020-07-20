<?php
require_once('../functions.php');
db_connect();
$sql = "SELECT patientId, password FROM patients WHERE emailId = ?";
$statement = $conn->prepare($sql);
$statement->bind_param('s', $_POST['email']);
$statement->execute();
$statement->store_result();
$statement->bind_result($patientId, $password);
$statement->fetch();
if (strcmp($_POST['password'], $password) == 0) {
    $_SESSION['patientId'] = $patientId;
    redirect_to("../patient_portal.php");
} else {
    redirect_to("../index.php?login_error=true");
}
