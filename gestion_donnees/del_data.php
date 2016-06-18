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
  <title>Suppression d'articles</title>
  </head>
  <body>
    <form action="del_data.php" method="post">
      Nom : <input type="text" name="name" value="" /><br />
      <br />
      <input type="submit" name="submit" value="Supprimer" />
    </form>
  </body>
</body>


<form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post" id="chgdept">
<fieldset style="border: 3px double #333399">
<legend>Sélectionnez une région</legend>
<select name="region" id="region" onchange="document.forms['chgdept'].submit();">
  <option value="-1">- - - Choisissez une région - - -</option>
    <?php
    for($i = 0; $i < $nb_regions; $i++)
    {
?>
  <option value="<?php echo($code_region[$i]); ?>"<?php echo((isset($idr) && $idr == $code_region[$i])?" selected=\"selected\"":null); ?>><?php echo($region[$i]); ?></option>
<?php
    }
    ?>
</select>
<select name="departement" id="departement">
            <?php  
            for($d = 0; $d<$nd; $d++)
            {
                ?>
  <option value="<?php echo($code_dept[$d]); ?>"<?php echo((isset($dept_selectionne) && $dept_selectionne == $code_dept[$d])?" selected=\"selected\"":null); ?>><?php echo($nom_dept[$d]." (". $code_dept[$d] .")"); ?></option>
                <?php
            }
?>
</select>
<br /><input type="submit" name="ok" id="ok" value="Envoyer" />
</fieldset>
</form>
