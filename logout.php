<?php
$web_host='http://localhost/IT_BSC/index.php';
ob_start();
include ('session.php');
unset($_SESSION['LOGIN_username']);
exit("<script>window.location='".$web_host."';</script>");

// session_destroy();
?>