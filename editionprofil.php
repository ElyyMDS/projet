<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=espace_membre;charset=utf8', 'root', '');

if(isset($_SESSION['id']))
{
  $requser = $bdd->prepare("SELECT * FROM membre WHERE id = ?");
  $requser->execute(array($_SESSION['id']));
  $user = $requser->fetch();

  if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo'])
  {
    $newpseudo = htmlspecialchars($_POST['newpseudo']);
    $reqnewpseudo = $bdd->prepare("SELECT * FROM membre WHERE pseudo = ?");
    $reqnewpseudo->execute(array($newpseudo));
    $newpseudoexist = $reqnewpseudo->rowCount();
    if ($newpseudoexist == 0) {
      $insertpseudo = $bdd->prepare("UPDATE membre SET pseudo = ? WHERE id = ?");
      $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
      header('Location: profil.php?id='.$_SESSION['id']);

      if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail'])
      {
        $newmail = htmlspecialchars($_POST['newmail']);
        $reqnewmail = $bdd->prepare("SELECT * FROM membre WHERE mail = ?");
        $reqnewmail->execute(array($newmail));
        $newmailexist = $reqnewmail->rowCount();
        if ($newmailexist == 0) {
          $insertmail = $bdd->prepare("UPDATE membre SET mail = ? WHERE id = ?");
          $insertmail->execute(array($newmail, $_SESSION['id']));
          header('Location: profil.php?id='.$_SESSION['id']);

          if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2']))
          {
            $mdp1 = sha1($_POST["newmdp1"]);
            $mdp2 = sha1($_POST["newmdp2"]);

            if ($mdp1 == $mdp2)
            {
              $insertmdp = $bdd->prepare("UPDATE membre SET motdepasse = ? WHERE id = ?");
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
    else {
      $msg = "Pseudo déjà utilisé";
    }
  }

  ?>

  <!DOCTYPE html>
  <html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="vendors/fontawesome/css/font-awesome.min.css">

    <title></title>
  </head>
  <body>
    <div class="block-zone block-edit">
      <div class="header">
        <img src="img/logo-fond.png" alt="">
        <div class="titre">
          <h2>Edition de mon profil</h2>
        </div>
      </div>

      <div class="formu">
        <form action="" method="post">
          <table>
            <tr>
              <td>
                <label for="pseudo">Identifiant :</label>
              </td>
              <td></td>
              <td></td>

              <td>
                <input class="input" type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $user['pseudo'] ?>" /> <br />
              </td>
            </tr>
            <tr>
              <td>
                <label for="mail">Mail :</label>
              </td>
              <td></td>
              <td></td>



              <td>
                <input class="input" type="text" name="newmail" placeholder="Mail" value="<?php echo $user['mail'] ?>" /> <br />
              </td>
            </tr>
            <tr>
              <td>
                <label class="case mdp">Mot de passe :</label>
              </td>
              <td></td>
              <td></td>



              <td>
                <input class="input" type="password" name="newmdp1" placeholder="Mot de passe" /> <br />
              </tr>
              <tr>
                <td>
                  <label class="case mdp2">Confirmer votre mot de passe :</label>
                </td>
                <td></td>
                <td></td>

                <td>
                  <input class="input" type="password" name="newmdp2" placeholder="Votre mot de passe" /> <br />
                </td>
                <td></td>
                <td></td>
              </tr>
            </table>
            <table class="maj">
              <tr>
                <td>
                  <input class="sub"type="submit" value="Mettre à jour mon profil"/> <br />
                </td>
              </tr>
            </table>
          </form>
        <?php if(isset($msg)) { echo $msg; } ?>
        </div>
        <div class="accueil">
          <a href="connexion.php">Retour à la page de connexion</a>
        </div>
        <div class="block-zone block-services">
          <h1 class="title">Nos différents services</h1>
          <div class="inner">
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
            <div class="cercle">
              <img src="img/Cercle.png" alt="">
            </div>
          </div>
        </div>
        <div class="block-zone block-footer">
          <div class="inner">
            <div class="social-icons">
              <p>Suivez-nous sur les réseaux sociaux !</p>
              <a href="https://www.facebook.com/PassTec-306489529968280/?modal=admin_todo_tour"><i class="fa fa-facebook"></i></a>
              <a href="https://twitter.com/Pass_Tec"><i class="fa fa-twitter"></i></a>
              <!-- <a href="#"><i class="fa fa-google-plus"></i></a>
              <a href="#"><i class="fa fa-linkedin"></i></a> -->
            </div>
            <P>Projet réalise par des élèves de 1ère année Bachelor WebDesign à MyDigitalSchool !</p>
          </div>
        </div>
      </div>

    </body>
    </html>
    <?php
  }
  else
  {
    header("Location: connexion.php");
  }
  ?>
