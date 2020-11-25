<?php
  #****************************************
  # Control Panel - Income list
  # Brifcase: https://www.techteks.net
  # Date: 11/05/2020
  # @author Alejandro Quezada
  # @version v1.0.0
  #*****************************************
  if(isset($_SESSION[ADMIN_TYPE])){
    $list = 'incomes';
    print_list($dbQuery, $list);
  }