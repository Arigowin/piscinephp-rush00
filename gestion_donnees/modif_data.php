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
?>
<body>
  <head>
  <title>Modification d'articles</title>
  </head>
  <body>
    <form action="modif_data.php" method="post">
      Nom : <input type="text" name="name" value="" /><br />
      Nouveau nom : <input type="text" name="newName" value="" /><br />
      Prix : <input type="text" name="price" value="" /><br />
      Categrorie : <input type="text" name="category" value="" /> (categorie1;categorie2;...)
      <br />
      Description : <br />
      <textarea name="description" value="" rows="4" cols="50"></textarea>
      <br />
      Image : <input type="file" name="img" value="" /><br />
      <input type="submit" name="submit" value="Modifier" />
    </form>
  </body>
</body>
