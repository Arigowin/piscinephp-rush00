<?php
  function error_msg($error)
  {
    session_start();
    if ($error == 1)
      $_SESSION['error'] = "wrong login/password\n";
    else
      $_SESSION['error'] = "";
  }
?>
