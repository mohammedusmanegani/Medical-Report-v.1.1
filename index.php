<?php
require_once('functions.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Report - Login</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <!-- Costome CSS -->
    <link rel="stylesheet" href="assets/css/login_signup_costome.css">

    <!-- Logo -->
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
</head>

<body>
    <div class="col-md-4" id="loginbox">
        <?php
        if (isset($_SESSION['accountCreated'])) {
            unset($_SESSION['accountCreated']);
        ?>
            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                <strong>Account Created!</strong> Login to See your Dashboard
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php
        }
        ?>

        <?php
        if (isset($_SESSION['loggedOut'])) {
            unset($_SESSION['loggedOut']);
        ?>
            <div class="alert alert-info alert-dismissible fade show mt-4" role="alert">
                <strong>Logged Out!</strong> You have been successfully Logged Out.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php
        }
        ?>

        <?php
        if (isset($_SESSION['pleaseLogin'])) {
            unset($_SESSION['pleaseLogin']);
        ?>
            <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
                <strong>Please Login!</strong> You are not Logged In.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php
        }
        ?>

        <?php
        if (isset($_GET['login_error'])) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                <strong>Authentication Error!</strong> Email ID or Password Is Incorrect.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php
        }
        ?>
        <div class="shadow p-5">
            <form class="form-signin" action="php/login.php" method="POST">
                <h1 class="h3 mb-4 font-weight-normal text-center">Login</h1>
                <div class="mb-2">
                    <label for="inputEmail">Email address:</label>
                    <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
                </div>
                <div class="mb-4">
                    <label for="inputPassword">Password:</label>
                    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="mb-4 text-center">
                    <button class="btn btn-md btn-primary" type="submit">Login</button>
                </div>
                <div class="text-center">
                    <span>If you are new to us? <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show(); changePageTitleToSignup()">Sign
                            up</a></span>
                </div>
            </form>
        </div>
    </div>

    <div class="shadow p-5 mt-4 mb-4 col-md-6" id="signupbox" style="display:none;">
        <form class="form-signin" action="php/signUp.php" method="POST" enctype="multipart/form-data">
            <h1 class="h3 mb-4 font-weight-normal text-center">Sign Up</h1>
            <div class="row">
                <div class="col-lg-6 mb-2">
                    <label for="inputFirstName">Patient First Name: <span class="important-field">*</span></label>
                    <input type="text" id="inputFirstName" name="fname" class="form-control" placeholder="Patient First Name" autofocus required>
                </div>
                <div class="col-lg-6 mb-2">
                    <label for="inputLastName">Patient Last Name: <span class="important-field">*</span></label>
                    <input type="text" id="inputLastName" name="lname" class="form-control" placeholder="Patient Last Name" required>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mb-2">
                    <label for="email">Email: <span class="important-field">*</span></label>
                    <input type="email" id="email" name="emailID" class="form-control" placeholder="Email" required>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-6 mb-2">
                    <label for="password">Password: <span class="important-field">*</span></label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="col-lg-6 mb-2">
                    <label for="confirmpassword">Confirm Password: <span class="important-field">* </span> <span id='message'></span></label>
                    <input type="password" id="confirmpassword" class="form-control" placeholder="Confirm Password" required>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-2">
                    <label for="sex">Sex: <span class="important-field">*</span></label>
                    <select id="sex" class="form-control" name="sex" required>
                        <option selected disabled>Patient Gender</option>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Rather Not Say</option>
                    </select>
                </div>
                <div class="col-lg-6 mb-2">
                    <label for="age">Patient DOB: <span class="important-field">*</span></label>
                    <input type="date" id="age" name="dob" class="form-control date-own" placeholder="Date Of Birth" required>
                </div>
            </div>



            <div class="mb-4 text-center mt-4">
                <button class="btn btn-md btn-primary" type="submit">Sign up</button>
            </div>
            <div class="text-center">
                <span>Already have an account? <a href="#" onclick="$('#signupbox').hide(); $('#loginbox').show(); changePageTitleToLogin()">Login</a></span>
            </div>
        </form>
    </div>

    <!-- Optional JavaScript -->

    <!-- Change The Title To Signup -->
    <script type="text/javascript">
        function changePageTitleToLogin() {
            newPageTitle = 'Medical Report - Login';
            document.title = newPageTitle;
        }

        function changePageTitleToSignup() {
            newPageTitle = 'Medical Report - Signup';
            document.title = newPageTitle;
        }
    </script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/jquery/jquery-3.5.1.slim.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        $('#password, #confirmpassword').on('keyup', function() {
            if ($('#password').val() == $('#confirmpassword').val()) {
                $('#message').html('Correct').css('color', 'green');
            } else
                $('#message').html('Not Matching').css('color', 'red');
        });
    </script>
</body>
</body>

</html>