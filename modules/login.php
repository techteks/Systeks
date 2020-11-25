<?php
  # ****************************************
  # Control Panel - Module for login
  # Brifcase: https://www.techteks.net
  # Date: 10/26/2020
  # @author Alejandro Quezada
  # @version v1.0.0
  #*****************************************
  session_start();
  # Connect to data base
  require_once '../config/db_connect.php';

  if(isset($_POST['username'])){ # Check if the variable session_start exit of the login form
    # Store variables of tried to login for post method
    $username = $_POST['username'];
    $password = $_POST['password'];
    # Create a query for subtract credentials of the user
    $query = "SELECT * FROM admins WHERE username = '".$username."'";
    $result = mysqli_query($dbQuery,$query) or die ("Error in the query of login -> ".mysqli_error($dbQuery));
    $admins = mysqli_fetch_array($result);
    if(isset($admins['username'])){
      # Verify if the password of user is equals the password entered
      if(password_verify($password, $admins['password'])){
        # We assign session variables
        $_SESSION[ADMIN_ID] = $admins['id'];
        $_SESSION[ADMIN_USERNAME] = $admins['username'];
        $_SESSION[ADMIN_NAME] = $admins['full_name'];
        $_SESSION[ADMIN_TYPE] = $admins['user_type'];
      }else{
        echo 'Username or password invalid!';
      }
    }else{
      echo 'Username or password invalid!';
    }
  }else{
    echo 'Username or password invalid!';
  }