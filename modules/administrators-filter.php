<?php
  # ****************************************
  # Control Panel - Administrators filter
  # Brifcase: https://www.techteks.net
  # Date: 11/05/2020
  # @author Alejandro Quezada
  # @version v1.0.0
  #*****************************************
  session_start();
  # Connect to data base
  require_once '../config/db_connect.php';
  if(isset($_POST['key'])){

    $key = $_POST['key'];
    $filter = $_POST['filter'];

    switch($filter){
      case 0: $query = "SELECT * FROM admins ORDER BY id ASC";
              break;
      case 1: $query = "SELECT * FROM admins WHERE username='".$key."' ORDER BY id ASC";
              break;
      case 2: $query = "SELECT * FROM admins WHERE type='".$key."' ORDER BY id ASC";
              break;
      case 3: $query = "SELECT * FROM admins WHERE email='".$key."' ORDER BY id ASC";
              break;
    }
    $result = mysqli_query($dbQuery, $query) or die ("Error in the query of administrators -> ".mysqli_error($dbQuery));
    
    while($admins = mysqli_fetch_array($result)){
      echo '<tr>
              <td><strong>'.$admins['id'].'</strong></td>
              <td>'.$admins['username'].'</td>
              <td>'.$admins['full_name'].'</td>
              <td>'.$admins['email'].'</td>
              <td>'.$admins['type'].'</td>
            </tr>';
    } // End while
  }