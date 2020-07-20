<?php
    require_once('../functions.php');
    session_destroy();
    $_SESSION['loggedOut'] = TRUE;
    redirect_to('../index.php');
