<?php
  # ****************************************
  # Control Panel - Login
  # Brifcase: https://www.techteks.net
  # Date: 10/26/2020
  # @author Alejandro Quezada
  # @version v1.0.0
  #*****************************************
  session_start();
  # Connect to data base
  require_once 'config/db_connect.php';
  require_once 'modules/functions.php';

  if(!isset($_SESSION[ADMIN_TYPE])){
    header('Location: login.php');
  }else{
?>

<!DOCTYPE html>
<html lang="en">

<?php
  include("templates/head.php");
?>

<body>

  <?php
    include("templates/navbar.php");
  ?>
  <div id="mensage_error"></div>
  <div class="container">
    <div id="balance">
      <h3>BALANCE: </h3>
    </div>
  </div>
  <div class="container">
    <div class="row">

      <div class="col-sm-4">
        <div class="table-style">
          <h3>Income</h3>
          <div class="table-responsive">
            <table class="table table-sm table-hover">
              <thead>

                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Date</th>
                  <th scope="col">Total</th>
                </tr>

              </thead>

              <tbody id="income_table">
                <?php
                  require 'list/income-list.php';
                ?>
              </tbody>

            </table>
          </div>
          <caption><ion-icon name="analytics-outline"></ion-icon> Income</caption>
        </div>
      </div>

      <div class="col-sm-4">
        <div class="table-style">
          <h3>Expenses</h3>
          <div class="table-responsive">
            <table class="table table-sm table-hover">
              <thead>

                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Date</th>
                  <th scope="col">Total</th>
                </tr>

              </thead>

              <tbody id="expenses_table">
                <?php
                  require 'list/expenses-list.php';
                ?>
              </tbody>
            </table>
          </div>
          <caption><ion-icon name="analytics-outline"></ion-icon> Expenses</caption>
        </div>
      </div>

      <div class="col-sm-4" style="padding-top:20px; padding-bottom:25px;">
        <div class="card">
          <h3 class="card-header">Registry</h3>
          <div class="card-body">
            <form id="acount_form" action="" method="POST">
              <div class="form-group">
                <label>Name:</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Name">
                <small class="error" id="name_error"></small>
              </div>
              <div class="form-group">
                <label>What is?</label>
                <select id="type" name="type" class="form-control">
                  <option value="incomes">Income</option>
                  <option value="expenses">Expense</option>
                </select>
                <small class="error" id="type_error"></small>
              </div>
              <div class="form-group">
                <label>Description:</label>
                <input type="text" id="description" name="description" class="form-control" placeholder="Description">
                <small class="error" id="description_error"></small>
              </div>
              <div class="form-group">
                <label>Amount:</label>
                <input type="number" id="amount" name="amount" class="form-control" placeholder="Amount">
                <small class="error" id="amount_error"></small>
              </div>
              <input type="button" id="registry_acount" class="btn btn-success" value="Registry" name="registry_acount">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="overlay" id="overlay">
    <div class="card" style="width: 18rem;">
      <ul class="list-group list-group-flush">
        <li class="list-group-item"><h6 style="float:left;">Details</h6><i style="float:right;" id="close" class="lni lni-close hover-pointer"></i></li>
      </ul>
      <ul class="list-group list-group-flush" id="view_information_income_expenses"></ul>
    </div>';
  </div>
  
  <?php
    include("templates/footer.php");
  }
  ?>
</body>
</html>