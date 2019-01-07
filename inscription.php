<?php

$bdd = new PDO('mysql:host=localhost;dbname=espace_membre;charset=utf8', 'root', '');

if(isset($_POST['forminscription']))
{
  $pseudo = htmlspecialchars($_POST['pseudo']);
  $mail = htmlspecialchars($_POST['mail']);
  $mail2 = htmlspecialchars($_POST['mail2']);
  $mdp = sha1($_POST['mdp']);
  $mdp2 = sha1($_POST['mdp2']);

  if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
  {
    $pseudolength = strlen($pseudo);
    if($pseudolength <= 255)
    {
      if($mail == $mail2)
      {
        if(filter_var($mail, FILTER_VALIDATE_EMAIL))
        {
          $reqmail = $bdd->prepare("SELECT * FROM membre WHERE mail = ?");
          $reqmail->execute(array($mail));
          $mailexist = $reqmail->rowCount();
          if($mailexist == 0)
          {
            if($mdp == $mdp2)
            {
              $insertmbr = $bdd->prepare("INSERT INTO membre(pseudo, mail, motdepasse) VALUES(?, ?, ?)");
              $insertmbr->execute(array($pseudo, $mail, $mdp));
              $valide = "Votre compte a bien été crée !";
            }
            else
            {
              $erreur = "Vos mots de passe ne correspondent pas !";
            }
          }
          else
          {
            $erreur = "Adresse mail déjà utilisée !";
          }
        }
        else
        {
          $erreur = "Votre adresse mail n'est pas valide !";
        }
      }
      else
      {
        $erreur = "Vos adresses mail ne correspondent pas !";
      }
    }
    else
    {
      $erreur = "Votre pseudo ne doit pas dépasser 255 caractères";
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
  <title>Formulaire d'inscription</title>
</head>
<body>
  <div class="block-zone block-vide"></div>

  <div class="block-zone block-ensemble">
    <!-- <div class="block-zone block-vide"></div> -->
    <div class="wrapper">
      <div class="block-zone block-inscription">
        <div class="logo">
          <p><img src="img/logo-fond.png" alt="" class=""></p>
          <h3 class="title pepin">Plus de pépins avec vos mots de passe !</h3>
        <div class="titre">
          <h2 class="title inscription">Inscription</h2>
        </div>
        <div class="inner">
          <div class="block-left">
            <div class="formulaire">
              <form action="" method="post">
                <table>
                  <tr>
                    <td>
                      <label for="pseudo">Identifiant :</label>
                    </td>
                    <td></td>
                    <td></td>

                    <td>
                      <input class="input" type="text" placeholder="Votre identifiant" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>"/><br />
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <label for="mail">Mail :</label>
                    </td>
                    <td></td>
                    <td></td>

                    <td>
                      <input class="input" type="email" placeholder="Votre mail" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail; } ?>"/><br />
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <label for="mail2">Confirmation du mail :</label>
                    </td>
                    <td></td>
                    <td></td>

                    <td>
                      <input class="input" type="email" placeholder="Confirmer votre mail" id="mail2" name="mail2" value="<?php if(isset($mail2)) { echo $mail2; } ?>"/><br />
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <label class="case mdp">Mot de passe :</label>
                    </td>
                    <td></td>
                    <td></td>

                    <td>
                      <input class="input" type="password" placeholder="Votre mot de passe" id="mdp" name="mdp"/><br />
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <label class="case mdp2">Confirmer votre mot de passe :</label>
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                      <input class="input" type="password" placeholder="Votre mot de passe" id="mdp2" name="mdp2" /><br />
                    </td>
                  </tr>
                  <tr>
                    <td class="sub">
                      <input class="submit" type="submit" name="forminscription" value="Je m'inscris">
                    </td>
                  </tr>
                </table>
                <div class="erreur">
                  <?php
                  if(isset($erreur))
                  {
                    echo $erreur;
                  }
                  ?>
                </div>
                <div class="valide">
                  <?php
                  if(isset($valide))
                  {
                    echo $valide;
                  }
                  ?>
                </div>
              </form>
            </div>
          </div>

          <div class="block-zone block-mid">
            <div class="barre">
            </div>
          </div>
          <div class="block-zone block-connect">
            <div class="inner">
              <h2 class="inscrit">Déjà inscrit ?</h2>
              <h3 class="info">Connectez-vous pour accéder à vos informations.</h3>
            </div>
            <div class="item connexion">
              <a href="connexion.php">Se connecter</a>
            </div>
            <div class="inner">
              <p>Suivez-nous sur les réseaux sociaux !</p>
              <div class="social-icons">
                <a href="https://www.facebook.com/PassTec-306489529968280/?modal=admin_todo_tour"><i class="fa fa-facebook"></i></a>
                <a href="https://twitter.com/Pass_Tec"><i class="fa fa-twitter"></i></a>
                <!-- <a href="#"><i class="fa fa-google-plus"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a> -->
              </div>
            </div>
          </div>
        </div>
        <div class="accueil">
          <a href="index.php">Retour à la page d'accueil</a>
        </div>
      </div>
    </div>
    <div class="block-zone block-vide"></div>

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
</div>
    <div class="block-zone block-vide"></div>
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


  </body>
  </html>
