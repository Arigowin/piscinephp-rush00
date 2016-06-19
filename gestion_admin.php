<?php
session_start();
include("./error.php");
?>
<html>
  <head>
    <title>Gestion des articles</title>
  </head>

  <body>
<?php
$admin = $_SESSION['admin'];
if ($admin == TRUE)
{
?>
    <h1>Gestion des articles</h1>
    <form method="link" action="gestion_donnees/add_data.php">
      <input type="submit" value="Ajouter un article"></input>
    </form>
<?php if ($_SESSION['error'] !== "")
{
  echo $_SESSION['error'];
  error_msg(-1);
}
?>
    <form method="link" action="gestion_donnees/modif_data.php">
      <input type="submit" value="Modifier un article"></input>
    </form>
    <form method="link" action="gestion_donnees/del_data.php">
      <input type="submit" value="Supprimer un article"></input>
    </form>
    <form method="link" action="gestion_log/del_account_by_name.php">
      <input type="submit" value="Supprimer un compte"></input>
    </form>
    <form method="link" action="index.php">
      <input type="submit" value="Accueil"></input>
    </form>
<?php
}
else
  echo "<p>Cette page est privee !</p>\n";
?>
  </body>
</html>
