<?php
  # ****************************************
  # Control Panel - Set expenses
  # Brifcase: https://www.techteks.net
  # Date: 11/05/2020
  # @author Alejandro Quezada
  # @version v1.0.0
  #*****************************************
  session_start();
  # Connect to data base
  require_once '../config/db_connect.php';
  require_once '../modules/functions.php';

  if(isset($_POST['name'])){
    $name = $_POST['name'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];

    $query = "INSERT INTO expenses (name, description, amount, by_username, date, date_time, visibility) VALUES('".$name."','".$description."','".$amount."','".$_SESSION[ADMIN_USERNAME]."', CURDATE(), NOW(),'yes')";
    $result = mysqli_query($dbQuery, $query) or die ("Error in the query of insert a expenses -> ".mysqli_error($dbQuery));
    #Print expenses list
    $list = 'expenses';
    print_list($list);
  }