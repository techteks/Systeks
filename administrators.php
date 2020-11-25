<?php
  # ****************************************
  # Control Panel - Administrator
  # Brifcase: https://www.techteks.net
  # Date: 11/04/2020
  # @author Alejandro Quezada
  # @version v1.0.0
  #*****************************************
  session_start();
  # Connect to data base
  require_once 'config/db_connect.php';

  if(!isset($_SESSION[ADMIN_TYPE])){
    header('Location: login.php');
  }
?>

<!DOCTYPE html>
<html lang="en">

<?php
  include("templates/head.php");
?>

<body>

  <?php
    include("templates/navbar.php");
    if($_SESSION[ADMIN_TYPE] != 'principal'){
      echo '<div class="alert alert-danger text-center" role="alert">You do not have permissions to view this list.</div>';
    }else{
  ?>
  <div id="mensage_error"></div>
  <div class="container" style="padding-top:10px;">
    <form class="form-inline" id="form_filter_admins" action="" method="">
      <input type="text" class="form-control mr-sm-2" id="admins_key" placeholder="Key" style="margin:2px 8px 0 8px;" name="key">
      <select class="custom-select mr-sm-2" id="admins_filter" style="margin:2px 8px 0 8px;" name="filter">
        <option value="0">All</option>
        <option value="1">Username</option>
        <option value="2">Type</option>
        <option value="3">Email</option>
      </select>
      <input type="button" id="filter_button" class="btn btn-success" value="Filter">
    </form>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="table-style">
          <div class="table-responsive">
            <table class="table table-sm table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Username</th>
                  <th scope="col">Full name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Type</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>

              <tbody id="admins_table">
                <?php
                  require 'list/administrators-list.php';
                  ?>
              </tbody>
            </table>
          </div>
          <caption><ion-icon name="people-outline" style="font-size: 20px;"></ion-icon> Administrators</caption>
        </div>
      </div>
    </div>
  </div>
  
  <?php
    }
    include("templates/footer.php");
  ?>
</body>
</html>