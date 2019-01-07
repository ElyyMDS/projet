<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=espace_membre;charset=utf8', 'root', '');

if(isset($_POST['formconnexion']))
{

  $mailconnect = htmlspecialchars($_POST['mailconnect']);
  $mdpconnect = sha1($_POST['mdpconnect']);
  if (!empty($mailconnect) AND !empty($mdpconnect))
  {
    $requser = $bdd->prepare("SELECT * FROM membre WHERE mail = ? AND motdepasse = ?");
    $requser->execute(array($mailconnect, $mdpconnect));
    $userexist = $requser->rowCount();
    if ($userexist == 1)
    {
      $userinfo = $requser->fetch();
      $_SESSION['id'] = $userinfo['id'];
      $_SESSION['pseudo'] = $userinfo['pseudo'];
      $_SESSION['mail'] = $userinfo['mail'];
      header("Location: profil.php?id=".$_SESSION['id']);
    }
    else
    {
      $erreur = "Mauvais mail ou mot de passe";
    }
  }
  else
  {
    $erreur = "Tous les champs doivent être complétés !";
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="vendors/fontawesome/css/font-awesome.min.css">

  <title>Page de connexion</title>
</head>
<body>
  <div class="block-zone block-vide"></div>

  <div align="center" class="block-connexion">
    <div class="titre">
      <p><img src="img/logo-fond.png" alt="" class=""></p>
      <h3 class="title pepin">Plus de pépins avec vos mots de passe !</h3>
      <h2 class="title inscription">Connexion</h2>
    </div>
    <div class="formulaire">
      <form action="" method="post">
        <input class="input" type="email" name="mailconnect" placeholder="Mail">
        <input class="input" type="password" name="mdpconnect" placeholder="Mot de passe">
        <input class="submit" type="submit" name="formconnexion" value="Se connecter !">
      </form>
    </div>
    <div class="accueil">
      <a href="index.php">Retour à la page d'accueil</a>
    </div>

    <?php
    if(isset($erreur))
    {
      echo $erreur;
    }
    ?>
  </div>

  <div class="block-zone block-video2">
    <h2 class="title title1">Comment ça marche ?</h2>
    <h3 class="acces">Connectez vous une fois et accéder à tous vos mots de passe !</h3>
    <div class="inner">
      <div class="left">
        <iframe width="800" height="470" src="https://www.youtube.com/embed/dVpcDbCUNLg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
      <div class="texte">
        <h2 class="title title2">Adaptable sur tous vos écrans !</h2>
        <div class="droite texte">
          <p>Pas de panique, personne ne peut avoir accès à vos comptes !</p>
          <p>Enregistrer et utiliser vos mots de passe en toute sécurité.</p>
        </div>
        <div class="multimedia">
          <img src="img/ecrans.png" alt="">
        </div>
      </div>
    </div>
  </div>
  <div class="block-zone block-bas">

    <div class="inner">
      <div class="new-account">
        <h2>Pas encore inscrit ?</h2>
        <h3>Rejoignez-nous !</h3>
        <p class="nouveau-compte"><a href="inscription.php">Créer un nouveau compte</a></p>
      </div>
      <!-- <div class="photo">
        <img src="img/Cercle.png" alt="">
      </div> -->
      <div class="inner">
        <div class="social-icons">
        <h3>Suivez-nous sur les réseaux sociaux !</h3>
          <a href="https://www.facebook.com/PassTec-306489529968280/?modal=admin_todo_tour"><i class="fa fa-facebook"></i></a>
          <a href="https://twitter.com/Pass_Tec"><i class="fa fa-twitter"></i></a>
          <!-- <a href="#"><i class="fa fa-google-plus"></i></a>
          <a href="#"><i class="fa fa-linkedin"></i></a> -->
        </div>
      </div>
    </div>

  </div>
</body>
</html>
