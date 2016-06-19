<?php
session_start();
?>
<html>
  <head>
    <title>Listes des articles</title>
  </head>
<body>
  <h1>Liste des articles</h1>
  <table name=\"product\">
  <tr>
    <th>Image</th>
    <th>Nom</th>
    <th>Prix</th>
    <th>Category</th>
    <th>Description</th>
    <th></th>
    </tr>
<?php
$panier = $_SESSION['panier'];

$file = "./htdocs/private/data";
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
  echo "  <form methode='get' name='qte' action='panier.php'>";

  $cat = $_GET['cat'];
  if (!isset($cat) || $cat === "")
  {
    foreach ($fileContent as $elem)
    {
      foreach($elem['category'] as $cate)
      {
        if ($cate !== "")
        {
          $category .= $cate . "<br />\n";
        }
      }
      $tabName[] = $elem['name'];
      $img = ($elem['img'] !== "")?"<img src=\"" . $elem['img'] . "\" />":"";
      echo "<tr>\n
        <td>$img</td>\n
        <td>" . $elem['name'] . "</td>\n
        <td>" . $elem['price'] . " $</td>\n
        <td>" . $category . "</td>\n
        <td>" . $elem['description'] . "</td>\n
        <td>
            <input type=number name='" . $elem['name'] . "' value='" . ($panier[$elem['name']]['qte'] + 0) . "' min='0' max='99'/>
        </td>\n
        </tr>\n";
      $category = "";
    }
    $_SESSION['listesArticles'] = $tabName;
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
          <td>$img</td>\n
          <td>" . $elem['name'] . "</td>\n
          <td>" . $elem['price'] . " $</td>\n
          <td>" . $category . "</td>\n
          <td>" . $elem['description'] . "</td>\n
          <td>
              <input type=number name='" . $elem['name'] . "' value='" . ($panier[$elem['name']]['qte'] + 0) . "' min='0' max='99'/>
          </td>\n
          </tr>\n";
        $category = "";
      }
    }
  }
}
?>
  </table>
  <input name="submit" type="submit" value="Valider et acceder au panier" />
  </form>
</body>
</html>
