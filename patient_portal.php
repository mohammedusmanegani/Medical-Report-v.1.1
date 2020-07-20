<?php
require_once('functions.php');
db_connect();
if (!isset($_SESSION['patientId'])) {
    $_SESSION['pleaseLogin'] = TRUE;
    redirect_to('index.php');
}
$sql = "SELECT patientFirstName,patientLastName,emailId,dob,sex FROM patients WHERE patientId = ?";
$statement = $conn->prepare($sql);
echo $conn->error;
$statement->bind_param('s', $_SESSION['patientId']);
$statement->execute();
$statement->store_result();
$statement->bind_result($patientFirstName, $patientLastName, $emailId, $dob, $sex);
$statement->fetch();
$dob = date("d-m-Y", strtotime($dob));
$from = new DateTime($dob);
$to = new DateTime('today');
$age = $from->diff($to)->y;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Report - Patient Portal</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <!-- Costome CSS -->
    <link rel="stylesheet" href="assets/css/patient_portal_costome.css">

    <!-- Logo -->
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">

    <!-- Fontawesome Icons -->
    <link rel="stylesheet" href="assets/icons/css/all.min.css">
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
        <a class="navbar-brand mr-auto" href="#">
            <img src="assets/images/logo.png" width="35" height="30"> Medi Care
        </a>
        <button class="btn btn-outline-success my-2 my-sm-0 float-left" type="button" data-toggle="modal" data-target="#profile">Profile</button>
        <a href="#" class="btn btn-outline-danger my-2 my-sm-0 ml-3 float-left" data-toggle="modal" data-target="#staticBackdrop"><i class="fas fa-power-off"></i></a>
    </nav>

    <!-- Profile Modal -->
    <div class="modal fade" id="profile" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Patient Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="patient-image text-center">
                        <img src="assets/images/default-avatar.png" height="150px" width="150px">
                    </div>
                    <div class="mt-4">
                        <h5>Name: <span style="color: green;"><?php echo $patientFirstName . " " . $patientLastName; ?></span></h5>
                        <h6>Date Of Birth: <?php echo $dob; ?></h6>
                        <h6>Age: <?php echo $age; ?></h6>
                        <h6>Sex: <?php echo $sex ?></h6>
                        <h6>Email ID: <?php echo $emailId; ?></h6>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Logout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to logout.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <a href="php/logout.php" class="btn btn-primary">Yes</a>
                </div>
            </div>
        </div>
    </div>


    <div class="row m-2">
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-header">
                    Blood Sugar
                </div>
                <div class="card-body">
                    <p class="card-text">A fasting blood sugar level less than 100 mg/dL (5.6 mmol/L) is normal. A
                        fasting blood sugar level from 100 to 125 mg/dL (5.6 to 6.9 mmol/L) is considered prediabetes.
                        If it's 126 mg/dL (7 mmol/L) or higher on two separate tests, you have diabetes.</p>
                    <form action="php/addBSDetails.php" method="POST">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="bsdate">Date: </label>
                                <input type="date" name="date-of-bs" class="form-control" id="bsdate" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="bstime">Time: </label>
                                <input type="time" name="time-of-bs" class="form-control" id="bstime" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="bsbf">Before Fasting Blood Sugar ( mg/dL ) :</label>
                                <input type="text" name="fbs" class="form-control" id="bsbf" placeholder="mg/dL" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="bsaf">After Fasting Blood Sugar ( mg/dL ) : </label>
                                <input type="text" name="ppbs" class="form-control" id="bsaf" placeholder="mg/dL" required>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Add Record</button>
                        <button class="btn btn-outline-info ml-2" type="button" data-toggle="modal" data-target="#bs-report">Get Report</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Blood Sugar Report Modal -->
    <div class="modal fade" id="bs-report" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Blood Sugar Report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-responsive-xl table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Sl.No</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Before Fasting</th>
                                <th scope="col">After Fasting</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $id = $_SESSION['patientId'];
                            $sql = "SELECT dateOfEntry,timeOfEntry,beforeFasting,afterFasting FROM bloodSugar WHERE patientId = $id";
                            $result = $conn->query($sql);
                            if ($result) {
                                while ($row = $result->fetch_assoc()) {
                                    $i++;
                            ?>
                                    <tr>
                                        <th scope="row"><?php echo $i; ?></th>
                                        <td><?php echo $row['dateOfEntry']; ?></td>
                                        <td><?php echo $row['timeOfEntry']; ?></td>
                                        <td><?php echo $row['beforeFasting'] . " mg/dL"; ?></td>
                                        <td><?php echo $row['afterFasting'] . " mg/dL"; ?></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row m-2">
        <div class="col-lg-12 mt-3 mb-3">
            <div class="card">
                <div class="card-header">
                    Blood Pressure
                </div>
                <div class="card-body">
                    <p class="card-text">As a general guide: ideal blood pressure is considered to be between 90/60mmHg
                        and 120/80mmHg. high blood pressure is considered to be 140/90mmHg or higher. low blood pressure
                        is considered to be 90/60mmHg or lower.</p>
                    <form action="php/addBPDetails.php" method="POST">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="bsdate">Date: </label>
                                <input type="date" name="date-of-bp" class="form-control" id="bsdate" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="bstime">Time: </label>
                                <input type="time" name="time-of-bp" class="form-control" id="bstime" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="bpbf">Systole ( mmHg ) :</label>
                                <input type="text" name="sys" class="form-control" id="bpbf" placeholder="mmHg" required>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="bpaf">Diastole ( mmHg ) : </label>
                                <input type="text" name="dia" class="form-control" id="bpaf" placeholder="mmHg" required>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="bpaf">Pulse ( /min ) : </label>
                                <input type="text" name="pulse" class="form-control" id="bpaf" placeholder="/min" required>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Add Record</button>
                        <button class="btn btn-outline-info ml-2" type="button" data-toggle="modal" data-target="#bp-report">Get Report</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Blood Pressure Report Modal -->
    <div class="modal fade" id="bp-report" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Blood Pressure Report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-responsive-xl table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Sl.No</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Systole</th>
                                <th scope="col">Diastole</th>
                                <th scope="col">Pulse</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $id = $_SESSION['patientId'];
                            $sql = "SELECT dateOfEntry,timeOfEntry,systole,diastole,pulse FROM bloodPressure WHERE patientId = $id";
                            $result = $conn->query($sql);
                            if ($result) {
                                while ($row = $result->fetch_assoc()) {
                                    $i++;
                                    $time = date("g:i a", strtotime($row['timeOfEntry']));
                            ?>
                                    <tr>
                                        <th scope="row"><?php echo $i; ?></th>
                                        <td><?php echo $row['dateOfEntry']; ?></td>
                                        <td><?php echo $time; ?></td>
                                        <td><?php echo $row['systole'] . " mmHg"; ?></td>
                                        <td><?php echo $row['diastole'] . " mmHg"; ?></td>
                                        <td><?php echo $row['pulse'] . " /min"; ?></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center">
        <div class="card-footer text-muted">
            <p class="mt-4">Designed And Developed with &#10084; By <a href="https://bit.ly/meet-usman" target="_blank">Mohammed
                    Usman E
                    Gani</a></p>
            <p>&copy; Copyright. All rights reserved</p>
        </div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/jquery/jquery-3.5.1.slim.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
</body>
</body>

</html>