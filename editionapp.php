<?php

session_start();

$bdd = new PDO('mysql:host=localhost;dbname=espace_membre;charset=utf8', 'root', '');
if(isset($_SESSION['id']))
{
  $requser = $bdd->prepare("SELECT * FROM ajouter WHERE id = ?");
  $requser->execute(array($_SESSION['id']));
  $user = $requser->fetch();
  if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail'])
  {
    $newmail = htmlspecialchars($_POST['newmail']);
    $reqnewmail = $bdd->prepare("SELECT * FROM ajouter WHERE mail = ?");
    $reqnewmail->execute(array($newmail));
    $newmailexist = $reqnewmail->rowCount();
    if ($newmailexist == 0) {
      $insertmail = $bdd->prepare("UPDATE ajouter SET mail = ? WHERE id = ?");
      $insertmail->execute(array($newmail, $_SESSION['id']));
      header('Location: profil.php?id='.$_SESSION['id']);

      if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2']))
      {
        $mdp1 = sha1($_POST["newmdp1"]);
        $mdp2 = sha1($_POST["newmdp2"]);

        if ($mdp1 == $mdp2)
        {
          $insertmdp = $bdd->prepare("UPDATE ajouter SET motdepasse = ? WHERE id = ?");
          $insertmdp->execute(array($mdp1, $_SESSION['id']));
          header('Location: profil.php?id='.$_SESSION['id']);
        }
        else
        {
          $msg = "Vos deux mot de passe ne correspondent pas !";
        }
      }
    }
    else {
      $msg = "Cette adresse mail est déjà utilisée !";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Modifier</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="vendors/fontawesome/css/font-awesome.min.css">
  </head>
  <body>
    <form action="" method="post">
      <table>
        <tr>
          <td>
            <label for="mail">Adresse mail :</label>
          </td>
          <td>
            <input type="email" name="mailmodif" placeholder="Nouveau mail" value="">
          </td>
        </tr>
        <tr>
          <td>
            <label for="motdepasse">Mot de passe :</label>
          </td>
          <td>
            <input type="password" name="mdpmodif" placeholder="Nouveau mot de passe" value="">
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
            <input type="submit" value="Mettre à jour">
          </td>
        </tr>
      </table>
    </form>
    <a href="profil.php">Retour à ton profil !</a>
  </body>
</html>
