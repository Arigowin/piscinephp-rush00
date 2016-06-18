<?php
  session_start();
?>

<html>
  <head>
    <title>Accueil </title>
  </head>

  <body>
    <form method="link" action="gestion_log/create.html">
      <input type="submit" value="Nouveau compte"></input>
    </form>
    <?php if (isset($_SESSION['login']) && $_SESSION['login'] !== "") {?>
    <form action="gestion_log/logout.php">
        <input type="submit" value="Se deconnecter"></input>
    </form><?php }
    else {?>
      <form action="gestion_log/login.html">
          <input type="submit" value="Se connecter"></input>
      </form>
      <?php } ?>
    <p> <?php if (isset($_SESSION['login'])) echo $_SESSION['login'];?></p>
  </body>
</html>
