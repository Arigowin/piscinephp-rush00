<?php
  session_start();
  include('error.php');
?>

<html>
  <head>
    <link rel="stylesheet" type="text/css" href="index.css" />
    <meta charset="utf-8">
    <title>Accueil </title>
    <h1 class="home">This is Tennis</h1>
  </head>

  <body class="fond">

    </form>
    <?php if ($_SESSION['error'] !== "")
    {
      echo $_SESSION['error'];
      error_msg(-1);
    }
    ?>
        <div class="boxright">
    <?php if (isset($_SESSION['login']) && $_SESSION['login'] !== "") {?>

      <p class="login"> Bonjour <?php if (isset($_SESSION['login'])) echo $_SESSION['login'];?></p>
      <form action="gestion_log/logout.php">
          <center><input class="btn" type="submit" value="Se déconnecter"></input></center>
      </form>
      <form action="gestion_log/del_account.php">
          <center><input class="btn" type="submit" value="Supprimer mon compte"></input></center>
      </form>
      <form action="gestion_log/modif.html">
        <center><input class="modif" type="submit" value="Modifier mon mot de passe"></input></center>
      </form>
      <?php }
        else {?>
          <form action="gestion_log/login.html">
            <center><input class="btn" type="submit" value="Se connecter"></input></center>
          </form>
          <form method="link" action="gestion_log/create.html">
            <center><input class="btn" type="submit" value="Nouveau compte"></input></center>

      <?php } ?>
  </div>
  </body>
</html>
