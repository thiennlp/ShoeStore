<?php

// start session
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);

// Connect database
$dbname = 'jac_jean';
$mysqli = mysqli_connect("localhost", "root", "", $dbname);
mysqli_set_charset($mysqli, 'UTF8');
if (mysqli_connect_errno()) {
    echo 'Failed to connect to Mysql : ' . $mysqli_connect_errno();
}