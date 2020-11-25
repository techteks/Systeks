<?php
  # ****************************************
  # Control Panel - Expenses list
  # Brifcase: https://www.techteks.net
  # Date: 11/05/2020
  # @author Alejandro Quezada
  # @version v1.0.0
  #*****************************************
  # Print all list of expenses
  if(isset($_SESSION[ADMIN_TYPE])){
    $list = 'expenses';
    print_list($dbQuery, $list);
  }