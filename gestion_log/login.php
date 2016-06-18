<?php
  include("./auth.php");
  include('../error.php');
  session_start();
  $login = $_POST['login'];

  $passwd = $_POST['passwd'];
  if ($login && $passwd && auth($login, $passwd))
  {
     $_SESSION['login'] = $login;
     header ('Location: ../index.php');
   }
  else
  {
    $_SESSION['login'] = "";
    error_msg(1);
    header ('Location: ../index.php');
  }

?>
