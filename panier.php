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
    <th>Nom</th>
    <th>Prix unitaire</th>
    <th>Quantite</th>
    <th>Prix total</th>
  </tr>
<?php
$file = "./htdocs/private/data";
if (file_exists($file))
{
  $fileContent = unserialize(file_get_contents($file));
  if ($fileContent === FALSE)
    return (FALSE);

  $listesArticles = $_SESSION['listesArticles'];

  foreach($listesArticles as $elem)
  {
    $name = $elem;
    $quantite = $_GET[$elem];
    $qte[$name] = $quantite;
  }

  $totale = 0;
  foreach ($fileContent as $elem)
  {
    if ($qte[$elem['name']] != 0)
    {
      echo "<tr>\n
        <td>" . $elem['name'] . "</td>\n
        <td>" . $elem['price'] . " $</td>\n
        <td>" . $qte[$elem['name']] . " $</td>\n
        <td>" . $totale += ($qte[$elem['name']] * $elem['price']) . " $</td>\n
        </tr>\n";
    }
  }
?>
</table>
<?php
  echo "<p>Totale : $totale $</p>";
}
?>
</body>
</html>
