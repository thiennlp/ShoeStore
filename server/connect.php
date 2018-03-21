<?php
      // start session
      session_start();
      // Turn off error reporting
      // error_reporting(0);

      // Report runtime errors
      error_reporting(E_ERROR | E_WARNING | E_PARSE);

      // Report all errors
      // error_reporting(E_ALL);

      // Same as error_reporting(E_ALL);
      // ini_set("error_reporting", E_ALL);

      // Report all errors except E_NOTICE
      // error_reporting(E_ALL & ~E_NOTICE);

      // Connect database
      $dbname = 'jac_jean';
      $mysqli = mysqli_connect("localhost", "root", "", $dbname);
      mysqli_set_charset($mysqli, 'UTF8');
      if (mysqli_connect_errno()) {
      echo 'Failed to connect to Mysql : '.$mysqli_connect_errno();
      };
?>