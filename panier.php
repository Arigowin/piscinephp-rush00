<?php
session_start();
?>
<html>
  <head>
    <title>Listes des articles</title>
  </head>
<body>
  <h1>Liste des articles</h1>
  <table name="panier" class=ref>
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
    $quantite = $_GET[str_replace(' ', '_', $elem)];
    $qte[$name] = $quantite;
  }

  $panier = $_SESSION['panier'];

  foreach($fileContent as $elem)
  {
    foreach($qte as $key => $value)
    {
      if ($key === $elem['name'])
      {
        $panier[$key]['qte'] = $value;
        $panier[$key]['price'] = $elem['price'];
        unset($qte[$key]);
      }
    }
  }

  foreach ($panier as $key => $value)
  {
    if ($value['qte'] != 0)
    {
      $totale = ($value['qte'] * $value['price']);
      echo "<tr>\n
        <td>" . $key . "</td>\n
        <td>" . $value['price'] . " $</td>\n
        <td>" . $value['qte'] . " $</td>\n
        <td>$totale $</td>\n
        </tr>\n";
        $totales += $totale;
    }
  }
  $_SESSION['panier'] = $panier;
?>
</table>
<?php
  echo "<p>Totale : $totales $</p>";
}
?>
  <button name="Annuler" type="submit">Retourner a l'index</button>
</body>
</html>
