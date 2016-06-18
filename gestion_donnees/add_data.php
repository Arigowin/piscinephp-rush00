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
//$cat[] = "humain";
//$cat[] = "debile";
//add_data("toto", 1, $cat, "Un petit toto debile", "");
?>
