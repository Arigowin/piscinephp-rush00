<?php
include("../error.php");
session_start();

$admin = $_SESSION['admin'];
$name = $_POST['name'];
$private = "../htdocs/private/passwd";
if ($admin == TRUE)
{
  if ($_POST['submit'] === "Supprimer")
  {
    $private = "../htdocs/private/passwd";
    if (isset($name) && $name !== "")
    {
      if (file_exists($private))
      {
        $file = unserialize(file_get_contents($private));
        if ($file)
        {
          for ($i = 0; $file[$i]; $i++)
          {
            if ($file[$i]['login'] === $name)
            {
              unset($file[$i]);
              $file = array_values($file);
              if (file_put_contents($private, serialize($file)) !== FALSE)
              {
                echo "<p>Le compte de $name est supprimer</p>\n";
              }
            }
          }
          echo "$i" . count($file);
          if ($i == count($file))
            echo "<p>Le login $name est inexistant !</p>\n";
        }
      }
      else
      {
        error_msg(6);
        header('Location: ../gestion_admin.php');
        return ;
      }
    }
  }
?>
<body>
  <head>
  <title>Ajout d'articles</title>
  </head>
  <body>
    <form action="del_account_by_name.php" method="post">
      Nom : <input type="text" name="name" value="" />
      <br />
      <input type="submit" name="submit" value="Supprimer"></input>
    </form>
    <form method="link" action="../gestion_admin.php">
      <input type="submit" value="Retour a la page de gestion des articles"></input>
    </form>
  </body>
</body>
<?php
}
else
  echo "<p>Cette page est privee !</p>\n";
?>
