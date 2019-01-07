<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=espace_membre;charset=utf8', 'root', '');

if(isset($_POST['modifapp']))
{
  $mail = htmlspecialchars($_POST['mailmodif']);
  $mdp = htmlspecialchars($_POST['mdpmodif']);

  if(!empty($_POST['mailmodif']) AND !empty($_POST['mdpmodif']))
  {
    $maillength = strlen($mail);
    if($maillength <= 255)
    {
      if(filter_var($mail, FILTER_VALIDATE_EMAIL))
      {
        $reqmail = $bdd->prepare("SELECT * FROM ajouter WHERE mail = ?");
        $reqmail->execute(array($mail));
        $mailexist = $reqmail->rowCount();
        if($mailexist == 0)
        {
          $insertapp = $bdd->prepare("INSERT INTO ajouter(mail, motdepasse) VALUES(?, ?)");
          $insertapp->execute(array($mail, $mdp));
          $erreur = "Vos renseignements ont bien été ajouté !";
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
        $erreur = "Votre adresse mail ne doit pas dépasser 255 caractères";
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
    <title></title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="block-zone block-top">
      <div class="header">
        <img src="img/logo-fond.png" alt="">
          <div class="edit">
            <p class="bvn">Bienvenue !
          </div>
        </div>
        <div class="titre">
          <h2>Ajouter un nouveau mot de passe</h2>
        </div>
      </div>
      <div class="block-zone block-mdp">
        <div class="inner">
          <form action="" method="post">
            <table>
              <tr>
                <td>
                  <label for="mail">Nom de l'application :</label>
                </td>
                <td>
                  <input class="input" type="text" name="addapp" placeholder="Nom de l'application" value="">
                </td>
              </tr>
              <tr>
                <td>
                  <label for="mail">Adresse mail :</label>
                </td>
                <td>
                  <input class="input" type="email" name="mailmodif" placeholder="Nouveau mail" value="">
                </td>
              </tr>
              <tr>
                <td>
                  <label for="motdepasse">Mot de passe :</label>
                </td>
                <td>
                  <input class="input" type="password" name="mdpmodif" placeholder="Nouveau mot de passe" value="">
                </td>
              </tr>
              <tr>
                <td></td>

                <td>
                  <input class="submit "type="submit" name="modifapp" value="Ajouter">
                </td>
              </tr>
            </table>
          </form>
        </div>
      </div>
      <div class="block-zone block-vide"></div>
      <div class="block-accueil">
        <a href="index.php">Retour à la page d'accueil</a>
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
