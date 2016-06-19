<?php
  function error_msg($error)
  {
    session_start();
    if ($error == 1)
      $_SESSION['error'] = "wrong login/password\n";
    else if ($error == 2)
      $_SESSION['error'] = "An error has occured\n";
    else if ($error == 3)
      $_SESSION['error'] = $_POST['login'] . " already exists\n";
    else if ($error == 4)
      $_SESSION['error'] = "Unable to create file\n";
    else if ($error == 5)
      $_SESSION['error'] = "Unauthorized character(s)\n";
    else if ($error == 6)
      $_SESSION['error'] = "Could not open file\n";
    else
      $_SESSION['error'] = "";
  }
?>
