<html>
  <head>
    <title>Listes des articles</title>
  </head>
<body>
<?php
$file = "./htdocs/private/data";
?>
  <h1>Liste des articles</h1>
  <table name=\"product\">
  <tr>
    <th>Nom</th>
    <th>Prix</th>
    <th>Category</th>
    <th>Description</th>
    <th>Image</th>
    </tr>
<?php
if (file_exists($file))
{
  $fileContent = unserialize(file_get_contents($file));
  if ($fileContent === FALSE)
    return (FALSE);

  $listeCat = Array();
  foreach ($fileContent as $elem)
  {
    foreach($elem['category'] as $cat)
    {
      if (array_search($cat, $listeCat) === FALSE)
        $listeCat[] = $cat;
    }
  }
  echo "<form method='get' name='cat' action=\"articles.php\">\n";
  echo "<button name=\"cat\" type=\"submit\" formaction=\"articles.php\" formmethod='get' value=\"\">All</button>\n";
  foreach($listeCat as $cat)
  {
    if ($cat !== "")
      echo "<button name=\"cat\" type=\"submit\" formaction=\"articles.php\" formmethod='get' value=$cat>" .$cat . "</button>\n";
  }
  echo "</form>\n";

  $cat = $_GET['cat'];
  if (!isset($cat) || $cat === "")
  {
    foreach ($fileContent as $elem)
    {
      foreach($elem['category'] as $cate)
      {
        if ($cate !== "")
          $category .= $cate . "<br />\n";
      }
      $img = ($elem['img'] !== "")?"<img src=\"" . $elem['img'] . "\" />":"";
      echo "<tr>\n
        <td>" . $elem['name'] . "</td>\n
        <td>" . $elem['price'] . " $</td>\n
        <td>" . $category . "</td>\n
        <td>" . $elem['description'] . "</td>\n
        <td>$img</td>\n
        </tr>\n";
$category = "";
    }
  }
  else
  {
    foreach ($fileContent as $elem)
    {
      if ($id = array_search($cat, $elem['category']) !== FALSE)
      {
        foreach($elem['category'] as $cate)
        {
          if ($cate !== "")
            $category .= $cate . "<br />\n";
        }
        $img = ($elem['img'] !== "")?"<img src=\"" . $elem['img'] . "\" />":"";
        echo "<tr>\n
          <td>" . $elem['name'] . "</td>\n
          <td>" . $elem['price'] . " $</td>\n
          <td>" . $category . "</td>\n
          <td>" . $elem['description'] . "</td>\n
          <td>$img</td>\n
          </tr>\n";
$category = "";
      }
    }
  }
}
?>
  </table>
</body>
</html>
