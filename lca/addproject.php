<?php
// Start session
session_start();

// Store form data in session variables
$_SESSION['projectname'] = $_POST['projectname'];
$_SESSION['description'] = $_POST['description'];
$_SESSION['qty'] = $_POST['qty'];
$_SESSION['unit'] = $_POST['unit'];
$_SESSION['midpoint'] = $_POST['midpoint'];
$_SESSION['midpoint_unit'] = $_POST['midpoint_unit'];
$_SESSION['netoutput'] = $_POST['netoutput'];

// Redirect or display success message
header("location:step.php?step=1");
die();
?>