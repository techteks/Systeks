<?php
  # ****************************************
  # Control Panel - Module for login
  # Brifcase: https://www.techteks.net
  # Date: 10/26/2020
  # @author Alejandro Quezada
  # @version v1.0.0
  #*****************************************
  # Constants of authentication for the login session
  DEFINE('ADMIN_ID','ADMIN_ID');
  DEFINE('ADMIN_USERNAME','ADMIN_USERNAME');
  DEFINE('ADMIN_NAME','ADMIN_NAME');
  DEFINE('ADMIN_TYPE', 'ADMIN_TYPE');
  # Constants for the database connection
  DEFINE('HOST','localhost');
  DEFINE('USER','root');
  DEFINE('PASS','root');
  DEFINE('DBNAME', 'systeks_db');

  $dbQuery = mysqli_connect(HOST, USER, PASS, DBNAME) or die("COULD NOT ESTABLISH A CONNECTION WITH THE DATABASE: ".mysqli_connect_error());
