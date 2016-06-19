<?php
include("./auth.php");
include('../error.php');
session_start();
function  isAdmin($login)
{
  if (isset($login))
  {
    $file = unserialize(file_get_contents("../htdocs/private/passwd"));
    foreach ($file as $value)
    {
      if ($value['login'] === $login)
        return  $value['admin'];
    }
  }
  return (FALSE);
}

$login = $_POST['login'];

$passwd = $_POST['passwd'];
if ($login && $passwd && auth($login, $passwd))
{
  $_SESSION['login'] = $login;
  if (isAdmin($login))
    $_SESSION['admin'] = TRUE;
  else
    $_SESSION['admin'] = FALSE;
  header ('Location: ../index.php');
}
else
{
  $_SESSION['login'] = "";
  $_SESSION['admin'] = FALSE;
  error_msg(1);
  header ('Location: ../index.php');
}

?>
