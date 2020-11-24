<?php
/*
* -------------------- SET AN INCOME -------------------------
*
* Esta funcion se llama por medio de AJAX y solo se ejecuta
* cuando se envia un income por medio del formulario en el 
* dashboard. Esta funcion tiene como objetivo almacenar
* el income proveniente del dashboard. Esta funcion imprime
* la tabla de incomes de vuelta, para no fatigar y evitar errores
* en inconme-list.php.
*
* @author Alejandro Quezada
* @date 07/11/2020
*/
session_start();
# Connect to data base
require_once '../config/db_connect.php';
require_once '../modules/functions.php';

if(isset($_POST['name'])){
    $name = $_POST['name'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];

    $query = "INSERT INTO income (name, description, amount, by_username, date, date_time, visibility) VALUES('".$name."','".$description."','".$amount."','".$_SESSION['username']."', CURDATE(), NOW(),'yes')";
    $result = mysqli_query($dbQuery, $query) or die ("Error in the query of insert a income -> ".mysqli_error($dbQuery));

    # Print all list of income
    $list = 'income';
    print_list($list);
  }