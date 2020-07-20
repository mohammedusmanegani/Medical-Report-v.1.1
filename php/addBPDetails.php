<?php
    require_once('../functions.php');
    db_connect();
    $sql = "INSERT INTO bloodPressure(patientId,dateOfEntry,timeOfEntry,systole,diastole,pulse) VALUES (?,?,?,?,?,?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param('ssssss',$_SESSION['patientId'],$_POST['date-of-bp'],$_POST['time-of-bp'],$_POST['sys'],$_POST['dia'],$_POST['pulse']);
    $statement->execute();
    redirect_to('../patient_portal.php');