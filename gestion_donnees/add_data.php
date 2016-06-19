<?php
function add_data(string $name, int $price, array $category, string $description, string $img)
{
  $path = "../htdocs/private";
  $file = "../htdocs/private/data";

  if (isset($name) && isset($price) && isset($category) && isset($description) && isset($img))
  {
    if (!file_exists($path))
      mkdir($path, 0777, TRUE);
    if (file_exists($file))
    {
      $fileContent = unserialize(file_get_contents($file));
      if ($fileContent === FALSE)
        return (FALSE);
    }

    if ($fileContent)
    {
      foreach ($fileContent as $elem)
      {
        if ($elem['name'] === $name)
          return (FALSE);
      }
    }

    $new['name'] = $name;
    $new['price'] = $price;
    $new['category'] = $category;
    $new['description'] = $description;
    $new['img'] = $img;
    $fileContent[] = $new;

    if (file_put_contents($file, serialize($fileContent)) === FALSE)
      return (FALSE);

    return (TRUE);
  }
  return (FALSE);
}

$admin = $_SESSION['admin'];
$name = htmlentities($_POST['name']);
$price = htmlentities($_POST['price']);
$category = htmlentities($_POST['category']);
$description = htmlentities($_POST['description']);
$img = htmlentities($_POST['img']);

if ($admin == TRUE)
{
  if ($_POST['submit'] === "Ajouter")
  {
    if ($price === "" && $name === "")
    {
      echo "Les champs Nom et Prix sont obligatoire ! <br />";
    }
    else
    {
      $category = explode(";", $category);
      if (add_data($name, $price, $category, $description, $img) === FALSE)
        echo "Produit : existe deja ! <br />";
      else
        echo "Produit : $name ajoute !<br />";
    }
  }
?>
<body>
  <head>
  <title>Ajout d'articles</title>
  </head>
  <body>
    <form action="add_data.php" method="post">
      Nom : <input type="text" name="name" value="" />
      <br />
      Prix : <input type="text" name="price" value="" />
      <br />
      Categrorie : <input type="text" name="category" value="" /> (categorie1;categorie2;...)
      <br />
      Description : <br />
      <textarea name="description" value="" rows="4" cols="50"></textarea>
      <br />
      Image : <input type="text" name="img" value="" /> (img/xxx.png)
      <br />
      <input type="submit" name="submit" value="Ajouter" />
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
