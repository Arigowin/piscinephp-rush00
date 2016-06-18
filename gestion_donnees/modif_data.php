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
//modif_data("toto", "toto2", -1, NULL, "", "");
?>
