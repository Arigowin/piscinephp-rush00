<?php
include ("../error.php");
if (!$_POST['login'] || !$_POST['passwd'] || $_POST['submit'] !== "OK")
{
  error_msg(2);
  header('Location: ../index.php');
  return ;
}
if (!preg_match("/[a-zA-Z0-9_\-]+/", $_POST['login']))
{
  error_msg(5);
  header('Location: ../index.php');
  return ;
}
if ($_POST['login'] && $_POST['passwd'] && $_POST['submit'] === "OK")
{
  $private = '../htdocs/private/passwd';
  $passwd = hash('whirlpool', $_POST['passwd'], FALSE);
  if (file_exists($private))
  {
    $file = unserialize(file_get_contents($private));
    foreach ($file as $user)
    {
      foreach ($user as $key => $value)
      {
        if ($key === 'login' && $value === $_POST['login'])
        {
          error_msg(3);
          header('Location: ../index.php');
          return ;
        }
      }
    }
  }
  else
  {
    if (!file_exists('../htdocs/private'))
      mkdir('../htdocs/private', 0777, TRUE);
  }
  $file[] = [
    'login'		=>	$_POST['login'],
    'passwd'	=>	$passwd,
    'admin'		=>	FALSE,
  ];
  if (file_put_contents($private, serialize($file)) === FALSE)
  {
    error_msg(4);
    header('Location: ../index.php');
    return ;
  }
  session_start();
  $_SESSION['login'] = $_POST['login'];
  header('Location: ../index.php');
}
?>
