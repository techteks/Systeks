/*=======================================
  Control Panel - Evends js
  Brifcase: https://www.techteks.net
  Date: 11/03/2020
  @author Alejandro Quezada
  @version v1.0.0
=========================================*/
error_mensaje = $('#mensage_error');
danger_mensaje = '<div class="alert alert-danger text-center" role="alert">';
success_mensaje = '<div class="alert alert-success text-center" role="alert">';
close_button = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
/*==============================
          LOGIN FORM
===============================*/
$('#send_login').on('click', function(e){
  e.preventDefault();
  e.stopImmediatePropagation();
  result = true;
  var username = $('#username').val().toLowerCase();
  var password = $('#password').val().toLowerCase();
  // ======= Call functions ========
  validateUsername(username);
  validatePassword(password);
  // Condition to validate the result variable
  if(result){
    $('#send_login').val("Login");
    // LET PASS
  }else{
    $('#send_login').val("Login");
    return false;
  }
  $.ajax({
    url: 'modules/login.php',
    type: 'POST',
    data: $('#login_form').serialize(),
    beforeSend: function(){
      $('#send_login').val("Sending...");
    },
    success: function(res){
      if(res === ""){
        location.href="dashboard.php";
        // LET PASS
      }else{
        $('#send_login').val("Login");
        $('#login_form').trigger("reset");
        error_mensaje.html(danger_mensaje+res+close_button);
      }
    }
  });
});
/*==============================
          REGISTRY FORM
===============================*/
$('#send_registry').on('click', function(e){
  e.preventDefault();
  e.stopImmediatePropagation();
  result = true;
  var username = $('#username').val().toLowerCase();
  var full_name = $('#full_name').val().toLowerCase();
  var email = $('#email').val().toLowerCase();
  var adminType = $('#type').val().toLowerCase();
  var password = $('#password').val().toLowerCase();
  var confirm_password = $('#confirm_password').val().toLowerCase();
  // ======= Call functions ========
  validateUsername(username);
  validateFullName(full_name);
  validateEmail(email);
  validateAdminType(adminType);
  validatePassword(password);
  validateConfirmPassword(password, confirm_password);
  // Condition to validate the result variable
  if(result){
    $('html,body').animate({scrollTop:$('body').offset().top - 250},1500);
    $('#send_registry').val("Registry");
    error_mensaje.html("");
    // LET PASS
  }else{
    error_mensaje.html("");
    error_mensaje.html(danger_mensaje+'Error, the form is incomplete or have a invalid value.'+close_button);
    $('html,body').animate({scrollTop:$('body').offset().top - 250},1500);
    $('#send_registry').val("Registry");
    return false;
  }
  $.ajax({
    url: 'modules/registry.php',
    type: 'POST',
    data: $('#registry_form').serialize(),
    beforeSend: function(){
      $('#send_registry').val("Sending...");
    },
    success: function(res){
      if(res === ""){
        error_mensaje.html(success_mensaje+"Successful registration"+close_button);
        $('#send_registry').val("Registry");
        $('#registry_form').trigger("reset");
        // LET PASS
      }else{
        var mensage_split = res.split(" ", res.length);
        mensage_split.forEach(element => {
          if(element === "'username'"){
            $('#send_registry').val("Registry");
            error_mensaje.html("");
            $('#username_error').html("Username is already use.");
            error_mensaje.html(danger_mensaje+'Error the username is already use.'+close_button);
            return false;
          }else if(element === "'email'"){
            $('#send_registry').val("Registry");
            error_mensaje.html("");
            $('#email_error').html("Email is already use.");
            error_mensaje.html(danger_mensaje+'Error the email is already use.'+close_button);
            return false;
          }else{
            $('#send_registry').val("Registry");
            error_mensaje.removeClass('alert-success').addClass('alert-danger').css('display','block').html(res);
            return false;
          }
        });
      }
    }
  });
});
/*==============================================
      Event to filter administrators list
==============================================*/
$('#filter_button').on('click', function(e){
  e.preventDefault();
  e.stopImmediatePropagation();
  result = true;
  var admins_filter = $('#admins_filter').val();
  var admins_key = $('#admins_key').val().toLowerCase();
  validateAdminsFilter(admins_filter, admins_key, error_mensaje, danger_mensaje, close_button);
  if(result){
    $('html,body').animate({scrollTop:$('body').offset().top - 250},1500);
    error_mensaje.html("");
    // LET PASS
  }else{
    $('html,body').animate({scrollTop:$('body').offset().top - 250},1500);
    return false;
  }
  $.ajax({
    url: 'modules/administrators-filter.php',
    type: 'POST',
    data: $('#form_filter_admins').serialize(),
    success: function(res){
      if(res==""){
        error_mensaje.html(danger_mensaje+"No results were found."+close_button);
      }else{
        $('#admins_table').html(res);
      }
    }
  });
});
/*====================================================
  Event to Validate the form for registry a acount
======================================================*/
$('#registry_acount').on('click', function(e){
  e.preventDefault();
  e.stopImmediatePropagation();
  result = true;
  var name = $('#name').val().toLowerCase();
  var name_error = $('#name_error');
  var type = $('#type').val().toLowerCase();
  var type_error = $('#type_error');
  var description = $('#description').val().toLowerCase();
  var description_error = $('#description_error');
  var amount = $('#amount').val();
  var amount_error = $('#amount_error');

  validateCompanyName(name, name_error);
  validateTypeAcount(type, type_error);
  validateDescription(description, description_error);
  validateAmount(amount, amount_error);

  if(result){
    $('html,body').animate({scrollTop:$('body').offset().top - 250},1500);
    error_mensaje.html("");
    // LET PASS
  }else{
    $('html,body').animate({scrollTop:$('body').offset().top - 250},1500);
    return false;
  }
  if(type=="income"){
    $.ajax({
      url: 'modules/set-income.php',
      type: 'POST',
      data: $('#acount_form').serialize(),
      success: function(res){
        if(res==""){
          error_mensaje.html(danger_mensaje+"Error trying to save the income."+close_button);
        }else{
          $('#acount_form').trigger("reset");
          error_mensaje.html(success_mensaje+"Successful income registration"+close_button);
          $('#income_table').html(res);
          $.post("modules/balance.php", function(res){
            $('#balance').html(res);
          });
        }
      }
    });
  }else if(type=="expenses"){
    $.ajax({
      url: 'modules/set-expenses.php',
      type: 'POST',
      data: $('#acount_form').serialize(),
      success: function(res){
        if(res==""){
          error_mensaje.html(danger_mensaje+"Error trying to save the expenses"+close_button);
        }else{
          $('#acount_form').trigger("reset");
          error_mensaje.html(success_mensaje+"Successful expenses registration"+close_button);
          $('#expenses_table').html(res);
          $.post("modules/balance.php", function(res){
            $('#balance').html(res);
          });
        }
      }
    });
  }else{
    error_mensaje.html(danger_mensaje+"Error trying to save the acount"+close_button);
  }
});
/*======================================
    Event to show admin information
========================================*/
$('#admin_acount').on('click', function(e){
  e.preventDefault();
  location.href="admin-information.php";
});
/*=========================================
    Event to show edit admin information
===========================================*/
$('#edit').on('click', function(e){
  e.preventDefault();
  $.post("views/admin-edit.php", function(res){
    $('#admin').html(res);
  });
});
/*======================================
    Event to send edit admin acount
========================================*/
/*$('#send_edit').on('click', function(e){
  e.preventDefault();
  e.stopImmediatePropagation();
});*/
/*======================================
    Event to see income information
========================================*/
$('#income_table').on('click','tr', function(e){
  e.preventDefault();
  e.stopImmediatePropagation();
  target = $(this).attr('id');
  $.ajax({
    url: "modules/income-information.php",
    type: "POST",
    data: {id:target},
    success: function(res){
      $('body').css('overflow-y','hidden');
      $('#overlay').css('visibility', 'visible');
      $('#view_information_income_expenses').html(res);
    }
  });
});
/*======================================
    Event to see expense information
========================================*/
$('#expenses_table').on('click','tr', function(e){
  e.preventDefault();
  e.stopImmediatePropagation();
  var target = $(this).attr('id');
  $.ajax({
    url: "modules/expenses-information.php",
    type: "POST",
    data: {id:target},
    success: function(res){
      $('body').css('overflow-y','hidden');
      $('#overlay').css('visibility', 'visible');
      $('#view_information_income_expenses').html(res);
    }
  });
});
/*=====================================
  Event to delete expense information
=======================================*/
$('#delete_expenses').on('click','button', function(e){
  e.preventDefault();
  e.stopImmediatePropagation();
  var target = $(this).attr('id');
  console.log(target);
  /*$.ajax({
    url: "modules/delete_expenses-information.php",
    type: "POST",
    data: {id:target},
    success: function(res){
      $('body').css('overflow-y','hidden');
      $('#overlay').css('visibility', 'visible');
      $('#view_information_income_expenses').html(res);
    }
  });*/
});
/*===================================================
  Close the card of income and expenses information
=====================================================*/
$('#close').on('click', function(){
  $('body').css('overflow-y','scroll');
  $('#overlay').css('visibility', 'hidden');
});