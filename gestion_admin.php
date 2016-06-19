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
<?php
  if ($_SESSION['error'] !== "")
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
      <form method="link" action="gestion_log/del_account_by_name.php">
        <input type="submit" value="Supprimer un compte"></input>
      </form>
      <form method="link" action="gestion_log/user_admin_or_not.php">
        <input type="submit" value="Donner/Supprimer les droits admin"></input>
      </form>
      <form method="link" action="index.php">
        <input type="submit" value="Accueil"></input>
      </form>
<?php
  $file = "./htdocs/private/data";

  echo "<table name=\"product\">\n";
  echo "<tr>\n
    <th>Nom</th>\n
    <th>Prix</th>\n
    <th>Category</th>\n
    <th>Description</th>\n
    <th>Image</th>\n
    </tr>\n";
if (file_exists($file))
{
  $fileContent = unserialize(file_get_contents($file));
  if ($fileContent === FALSE)
    return (FALSE);

  foreach ($fileContent as $elem)
  {
    foreach($elem['category'] as $cat)
      $category .= $cat . ";";
    echo "<tr>\n
      <td>" . $elem['name'] . "</td>\n
      <td>" . $elem['price'] . " $</td>\n
      <td>" . $category . "</td>\n
      <td>" . $elem['description'] . "</td>\n
      <td>" . $elem['img'] . "</td>\n
      </tr>\n";
  }
}
echo "</table>\n";

$file2 = "./htdocs/private/passwd";
echo "<table name=\"product\">\n";
echo "<tr>\n
  <th>Login</th>\n
  <th>Admin</th>\n
  </tr>\n";
if (file_exists($file2))
{
  $fileContent = unserialize(file_get_contents($file2));
  if ($fileContent === FALSE)
    return (FALSE);
  foreach ($fileContent as $elem)
  {
    $admin = ($elem['admin'])?"admin":"user";
    echo "<tr>\n
      <td>" . $elem['login'] . "</td>\n
      <td>" . $admin . "</td>\n
      </tr>\n";
  }
}
echo "</table>\n";
}
else
{
  echo "<p>Cette page est privee !</p>\n";
}
?>
  </body>
  </html>
