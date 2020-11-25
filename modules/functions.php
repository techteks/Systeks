<?php
  # ****************************************
  # Control Panel - Functions
  # Brifcase: https://www.techteks.net
  # Date: 11/17/2020
  # @author Alejandro Quezada
  # @version v1.0.0
  #*****************************************
  # Print all list of expenses and incomes
  function print_list($dbQuery, $list){
    $query = "SELECT * FROM $list WHERE visibility='yes' ORDER BY id DESC";
    $result = mysqli_query($dbQuery, $query) or die ("Error in the query of expenses -> ".mysqli_error($dbQuery));
    
    while($list_table = mysqli_fetch_array($result)){
      if($list=='expenses'){
        echo '
          <tr class="hover-pointer" id="'.$list_table['id'].'">
            <td><strong>'.$list_table['id'].'</strong></td>
            <td>'.$list_table['name'].'</td>
            <td>'.$list_table['date'].'</td>
            <td style="color:#ff0000;"><strong>-$'.number_format($list_table['amount'],2).'</strong></td>
          </tr>';
      }else{
        echo '
          <tr class="hover-pointer" id="'.$list_table['id'].'">
            <td><strong>'.$list_table['id'].'</strong></td>
            <td>'.$list_table['name'].'</td>
            <td>'.$list_table['date'].'</td>
            <td style="color:#0000cd;"><strong>+$'.number_format($list_table['amount'],2).'</strong></td>
          </tr>';
      }
    } // End while
  }
  // Function to show income or expenses information in the card
  function view_income_expenses($dbQuery, $list, $id){
    $query = "SELECT * FROM $list WHERE id=".$id;
    $result = mysqli_query($dbQuery, $query) or die ("Error in the query for see income information -> ".mysqli_error($dbQuery));
    $information_card = mysqli_fetch_array($result);
    if($list=='incomes'){
      echo '
        <li class="list-group-item"><h6 style="float:left;">'.$information_card['name'].'</h6><p style="color:#0000cd;float:right;"><strong>+$'.number_format($information_card['amount'],2).'</strong></p></li>
        <li class="list-group-item"><h6 style="float:left;">Description</h6><p style="clear:both;">'.$information_card['description'].'</p></li>
        <li class="list-group-item"><h6 style="float:left;">Date</h6><p style="float:right;">'.$information_card['date'].'</p></li>
        <li class="list-group-item"><h6 style="float:left;">Time</h6><p style="float:right;">'.$information_card['time'].'</p></li>
        <li class="list-group-item"><button type="button" class="btn btn-outline-danger btn-sm" id="delete_income" name="'.$information_card['id'].'" style="float:left;">DELETE</button><small style="float: right;color: #808080;">'.$information_card['by_username'].'</small></li>';
    }elseif($list=='expenses'){
      echo '
        <li class="list-group-item"><h6 style="float:left;">'.$information_card['name'].'</h6><p style="color:#ff0000;float:right;"><strong>-$'.number_format($information_card['amount'],2).'</strong></p></li>
        <li class="list-group-item"><h6 style="float:left;">Description</h6><p style="clear:both;">'.$information_card['description'].'</p></li>
        <li class="list-group-item"><h6 style="float:left;">Date</h6><p style="float:right;">'.$information_card['date'].'</p></li>
        <li class="list-group-item"><h6 style="float:left;">Time</h6><p style="float:right;">'.$information_card['time'].'</p></li>
        <li class="list-group-item"><button type="button" class="btn btn-outline-danger btn-sm" id="delete_expenses" name="'.$information_card['id'].'" style="float:left;">DELETE</button><small style="float: right;color: #808080;">'.$information_card['by_username'].'</small></li>';
    }else{
      echo 'No results were found.';
    }
  }
  // Function to change the visibility in income or exoenses table
  function delete_income_expenses($dbQuery, $list, $id){

  }