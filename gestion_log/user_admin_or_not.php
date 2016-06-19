<?php
include('../error.php');
$private = '../htdocs/private/passwd';

$admin = $_SESSION['admin'];
$login = $_POST['login'];
if ($admin == TRUE)
{
  if ($login && $_POST['submit'] === "Donner/Enlever les droits admin")
  {
    if (file_exists($private))
    {
      $file = unserialize(file_get_contents($private));
      if ($file)
      {
        for ($i = 0; $file[$i]; $i++)
        {
          if ($file[$i]['login'] === $login)
          {
            $file[$i]['admin'] = ($file[$i]['admin'] == TRUE)?FALSE:TRUE;
            if (file_put_contents($private, serialize($file)) !== FALSE)
            {
              if ($file[$i]['admin'])
                echo "<p>$login est devenue admin !</p>\n";
              else
                echo "<p>$login a perdu ces droits admin !</p>\n";
            }
          }
        }
      }
    }
    else
    {
      error_msg(6);
      header('Location: ../index.php');
    }
  }

?>
<body>
  <head>
  <title>Ajout d'articles</title>
  </head>
  <body>
    <form action="user_admin_or_not.php" method="post">
      Login : <input type="text" name="login" value="" />
      <br />
      <input type="submit" name="submit" value="Donner/Enlever les droits admin" />
    </form>
    <form method="link" action="../gestion_admin.php">
      <input type="submit" value="Retour a la page de gestion"></input>
    </form>
  </body>
</body>
<?php
}
else
{
?>
<body>
  <head>
  <title>Ajout d'articles</title>
  </head>
  <body>
    <p>Cette page est privee !</p>
  </body>
</body>
<?php
}
?>
