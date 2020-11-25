<?php
  # ****************************************
  # Control Panel - Expenses information
  # Brifcase: https://www.techteks.net
  # Date: 11/16/2020
  # @author Alejandro Quezada
  # @version v1.0.0
  #*****************************************
  session_start();
  # Connect to data base
  require_once '../config/db_connect.php';
  require_once '../modules/functions.php';

  if(isset($_POST['id'])){
    $id = $_POST['id'];
    $list = 'expenses';
    view_income_expenses($dbQuery, $list, $id);
  }else{
    echo 'No';
  }