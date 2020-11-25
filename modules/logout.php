<?php
  # ****************************************
  # Control Panel - Module for logput
  # Brifcase: https://www.techteks.net
  # Date: 11/04/2020
  # @author Alejandro Quezada
  # @version v1.0.0
  #*****************************************

  session_start();
  unset($_SESSION[ADMIN_ID]);
  unset($_SESIION[ADMIN_USERNAME]);
  unset($_SESSION[ADMIN_NAME]);
  unset($_SESSION[ADMIN_TYPE]);
  session_destroy();
  header("Location: ../index.php");
  exit;