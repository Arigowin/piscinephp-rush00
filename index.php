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
    <div>
      <div class="transbox">

        <div class="boxright">
    <?php if (isset($_SESSION['login']) && $_SESSION['login'] !== "") {?>

      <p class="login"> Bonjour <?php if (isset($_SESSION['login'])) echo $_SESSION['login'];?></p>

      <a href="gestion_log/logout.php"><button class="btn" type="submit" >Se déconnecter</button></a>

        <a href="gestion_log/del_account.php"><button class="btn" type="submit" >Supprimer mon compte</button></a>

        <a href="gestion_log/modif.html"><button class="btn"  >Modifier mon mot de passe</button></a>

      <?php if ($_SESSION['admin'] == TRUE) { ?>
      <a href="gestion_admin.php"><button class="btn" type="submit" >Accéder à la page Administrateur</button></a>
<?php }
    }
        else {?>
          <form action="gestion_log/login.html">
            <center><input class="btn" type="submit" value="Se connecter"></input></center>
          </form>
          <form method="link" action="gestion_log/create.html">
            <center><input class="btn" type="submit" value="Nouveau compte"></input></center>

      <?php } ?>
        </div>

      <div class="boxleft">
      <div class="text">
        <a href="articles.php" class="link">Tout voir</a> </br>
      </div>
      <div class="text">
          <a href="articles.php?cat=Raquettes" class="link">Raquettes</a></br>
      </div>
      <div class="text">
        <a href="articles.php?cat=cordage" class="link">Cordages</a></br>
      </div>
      <div class="text">
        <a href="articles.php?cat=balles" class="link">Balles</a></br>
      </div>
      </div>
      <div class="box_cart">
        <h2>Mon panier</h2>
      </div>
      <div classe="images">
        <img class="raquette" src="http://protennistips.net/wp-content/uploads/2015/05/Babolat-Pure-Drive-Review.jpg"/>
        </br>
        <p>La meilleure raquette? La pure Drive bien sûr! <a href="articles.php">Allez voir!</a></p>
      </div>
      <div class="right_text"><p>Notre site est un peu pourri? Aller voir nos concurerents en cliquant <a href="https://fr.wikipedia.org/wiki/Caca">ICI</a></p></div>
      </div>



</div>
  </body>
</html>
