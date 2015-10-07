<?php
//Initializing the session function
session_start();
//Define SESSION Global variable as an empty array
$_SESSION = array();
//Distroying the session
session_destroy();
header('Location: index.php');