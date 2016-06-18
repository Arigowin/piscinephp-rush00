<?php
function del_data(string $name)
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
        unset($fileContent[$i]);
        $fileContent = array_values($fileContent);
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

if ($_POST['submit'] === "Supprimer")
{
  if ($name === "")
  {
    echo "Le champ Nom est obligatoire !<br />";
  }
  else
  {
    if (del_data($name) === FALSE)
      echo "Produit : non trouve !<br />";
    else
      echo "Produit : $name suprime !<br />";
  }
}
?>
<body>
  <head>
  <title>Modification d'articles</title>
  </head>
  <body>
    <form action="del_data.php" method="post">
      Nom : <input type="text" name="name" value="" /><br />
      <br />
      <input type="submit" name="submit" value="Supprimer" />
    </form>
  </body>
</body>
