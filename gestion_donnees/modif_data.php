<?php
function modif_data(string $name, string $newName = "", int $price = -1, array $category = NULL, string $description = "", string $img = "")
{
  $file = "../htdocs/private/data";

  if (isset($name))
  {
    if (!file_exists($file))
      return (FALSE);
    $fileContent = unserialize(file_get_contents($file));
    if ($fileContent === FALSE)
      return (FALSE);

    $OK = FALSE;
    for ($i = 0 ; $fileContent[$i] ; $i++)
    {
      if ($fileContent[$i]['name'] === $name)
      {
        if ($newName != "")
          $fileContent[$i]['name'] = $newName;
        if ($price != -1)
          $fileContent[$i]['price'] = $price;
        if ($category != NULL)
          $fileContent[$i]['category'] = $category;
        if ($description != "")
          $fileContent[$i]['description'] = $description;
        if ($img != "")
          $fileContent[$i]['img'] = $img;
        $OK = TRUE;
      }
    }

    if ($OK)
    {
      if (file_put_contents($file, serialize($fileContent)) === FALSE)
        return (FALSE);
      return (TRUE);
    }
  }
  return (FALSE);
}

$name = htmlentities($_POST['name']);
$newName = htmlentities($_POST['newName']);
$price = (int)htmlentities($_POST['price']);
$category = htmlentities($_POST['category']);
$description = htmlentities($_POST['description']);
$img = htmlentities($_POST['img']);

if ($_POST['submit'] === "Modifier")
{
  if ($name === "")
  {
    echo "Le champ Nom est obligatoire !<br />";
  }
  else
  {
    if ($prix === "")
      $prix = -1;
    else
      $prix = (int)$prix;
    if ($category === "")
      $category = NULL;
    $category = explode(";", $category);
    if (modif_data($name, $newName, $price, $category, $description, $img) === FALSE)
      echo "Produit : non trouve ! <br />";
    else
      echo "Produit : $name modifier !<br />";
  }
}
echo "<body>\n" .
"  <head>\n" .
"  <title>Modification d'articles</title>\n" .
"  </head>\n" .
"  <body>\n" .
"    <form action=\"modif_data.php\" method=\"post\" id='modif'>\n" .
"      Nom : <select name=\"nameNb\" onchange=\"document.forms['modif'].submit();\">\n";
$file = "../htdocs/private/data";
if (!file_exists($file))
  return (FALSE);
$fileContent = unserialize(file_get_contents($file));
if ($fileContent === FALSE)
  return ;

$first = TRUE;
for ($i = 0 ; $fileContent[$i] ; $i++)
{
  if ($file == TRUE)
    $selected = ' selected="selected"';
  echo "<option value=\"" . $i . "\" $selected>" . $fileContent[$i]['name'] . "</option>\n";
  $file = FALSE;
  $selected = "";
}
echo "      </select>\n" .
"      <br />\n" .
"      Nouveau nom : <input type=\"text\" name=\"newName\" value=\"" . $_POST['nameNb'] . "\" />\n" .
"      <br />\n" .
"      Prix : <input type=\"text\" name=\"price\" value=\"\" />\n" .
"      <br />\n" .
"      Categrorie : <input type=\"text\" name=\"category\" value=\"\" /> (categorie1;categorie2;...)\n" .
"      <br />\n" .
"      Description : <br />\n" .
"      <textarea name=\"description\" value=\"\" rows=\"4\" cols=\"50\"></textarea>\n" .
"      <br />\n" .
"      Image : <input type=\"text\" name=\"img\" value=\"\" /> (img/xxx.png)\n" .
"      <br />\n" .
"      <input type=\"submit\" name=\"submit\" value=\"Modifier\" />\n" .
"    </form>\n" .
"  </body>";
?>
