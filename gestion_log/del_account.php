<?php
  include("../error.php");
  session_start();
  $private = "../htdocs/private/passwd";
  if (isset($_SESSION['login']) && $_SESSION['login'] !== "")
  {
    if (file_exists($private))
    {
      $file = unserialize(file_get_contents($private));
      if ($file)
      {
        for ($i = 0; $file[$i]; $i++)
        {
          if ($file[$i]['login'] === $_SESSION['login'])
          {

              unset($file[$i]);
              $file = array_values($file);
              if (file_put_contents($private, serialize($file)) !== FALSE)
              {
                header('Location: logout.php');
                return ;
              }
              else
              {
                error_msg(2);
                header('Location: ../index.php');
                return ;
              }
              header('Location: logout.php');
            }

          }
        }
      }

    }


 ?>
