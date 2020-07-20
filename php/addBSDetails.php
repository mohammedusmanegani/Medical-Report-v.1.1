<?php
    require_once('../functions.php');
    db_connect();
    $sql = "INSERT INTO bloodSugar(patientId,dateOfEntry,timeOfEntry,beforeFasting,afterFasting) VALUES (?,?,?,?,?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param('sssss',$_SESSION['patientId'],$_POST['date-of-bs'],$_POST['time-of-bs'],$_POST['fbs'],$_POST['ppbs']);
    $statement->execute();
    redirect_to('../patient_portal.php');
?>