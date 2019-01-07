<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=espace_membre;charset=utf8', 'root', '');

if(isset($_GET['id']) AND $_GET['id'] > 0)
{
  $getid = intval($_GET['id']);
  $requser = $bdd->prepare('SELECT * FROM membre WHERE id = ?');
  $requser->execute(array($getid));
  $userinfo = $requser->fetch();
  ?>

  <!DOCTYPE html>
  <html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="vendors/fontawesome/css/font-awesome.min.css">
    <title>Profil</title>
  </head>
  <body>
    <div class="block-zone block-top">
      <div class="header">
        <img src="img/logo-fond.png" alt="">

          <div class="edit">
            <p class="bvn">Bienvenue <?php echo $userinfo['pseudo']; ?> !
            <div class="deco">
              <a href="editionprofil.php">Editer mon profil</a>
              <a href="deconnexion.php">Se déconnecter</a>
            </div>
          </div>
        </div>
        <div class="titre">
          <h2>Tableau de bord</h2>
          <p>Bienvenue sur votre tableau de bord, ici sont listés tous les identifiants que vous avez sauvegardé !</p>
        </div>
      </div>
      <div class="block-zone block-add">
        <div class="inner">

        <div class="item inscrire">
          <a href="ajouter.php">Ajouter</a>
        </div>
        <div class="item connexion">
          <a href="#">Supprimer</a>
        </div>
      </div>
    </div>


    <div class="block-zone block-wrapper">
      <p class="enregistrement">Vos enregistrements</p>
      <div class="ligne ligne1">
        <div class="card facebook">
          <div class="front"><h2>Facebook</h2><img src="img/facebook.png" alt=""></div>
          <div class="back">
            <div class="details">
                <p class="mdp">Mot de passe : <?php echo $userinfo['pseudo']; ?></p>
                <p class="mail">Mail : <?php echo $userinfo['mail']; ?></p>
                <a href="editionapp.php">Modifier</a>
            </div>
          </div>
        </div>
        <div class="card twitter">
          <div class="front"><h2>Twitter</h2><img src="img/twitter.png" alt=""></div>
          <div class="back">
            <div class="details">
                <p class="mdp">Mot de passe : <?php echo $userinfo['pseudo']; ?></p>
                <p class="mail">Mail : <?php echo $userinfo['mail']; ?></p>
                <a href="editionapp.php">Modifier</a>
            </div>
          </div>
        </div>
        <div class="card google">
          <div class="front"><h2>Google</h2><img src="img/search.png" alt=""></div>
          <div class="back">
            <div class="details">
                <p class="mdp">Mot de passe : <?php echo $userinfo['pseudo']; ?></p>
                <p class="mail">Mail : <?php echo $userinfo['mail']; ?></p>
                <a href="editionapp.php">Modifier</a>
            </div>
          </div>
        </div>
      </div>
      <div class="ligne ligne2">
        <div class="card wifi">
          <div class="front"><h2>Code Wi-fi</h2><img src="img/wifi-signal.png" alt=""></div>
          <div class="back">
            <div class="details">

                <p class="mdp">Code wi-fi :</p>
                <p class="mail">Mail :</p>
                <a href="editionapp.php">Modifier</a>

            </div>
          </div>
        </div>
        <div class="card insta-icon">
          <div class="front"><h2>Instagram</h2><img src="img/instagram.png" alt=""></div>
          <div class="back">
            <div class="details">

                <p class="mdp">Mot de passe :</p>
                <p class="mail">Mail :</p>
                <a href="editionapp.php">Modifier</a>

            </div>
          </div>
        </div>
        <div class="card linkedin">
          <div class="front"><h2>Linkedin</h2><img src="img/linkedin.png" alt=""></div>
          <div class="back">
            <div class="details">

                <p class="mdp">Mot de passe :</p>
                <p class="mail">Mail :</p>
                <a href="editionapp.php">Modifier</a>

            </div>
          </div>
        </div>
      </div>
      <div class="ligne ligne3">
        <div class="card facebook">
          <div class="front"><h2>Facebook</h2><img src="img/facebook.png" alt=""></div>
          <div class="back">
          <div class="details">

                <p class="mdp">Mot de passe :</p>
                <p class="mail">Mail :</p>
                <a href="editionapp.php">Modifier</a>

            </div>
          </div>
        </div>
        <div class="card twitter">
          <div class="front"><h2>Twitter</h2><img src="img/twitter.png" alt=""></div>
          <div class="back">
            <div class="details">

                <p class="mdp">Mot de passe :</p>
                <p class="mail">Mail :</p>
                <a href="editionapp.php">Modifier</a>

            </div>
          </div>
        </div>
        <div class="card google">
          <div class="front"><h2>Google</h2><img src="img/search.png" alt=""></div>
          <div class="back">
            <div class="details">

                <p class="mdp">Mot de passe :</p>
                <p class="mail">Mail :</p>
                <a href="editionapp.php">Modifier</a>

            </div>
          </div>
        </div>
      </div>
      </div>

    <!-- <div class="info">
      <br /><br />
      Pseudo : <?php echo $userinfo['pseudo']; ?>
      <br />
      Mail : <?php echo $userinfo['mail']; ?>
      <br />
    </div> -->
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


    <?php
    if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id'])
    {
      ?>

      <?php
    }
    ?>
  </div>


</body>
</html>
<?php
}
?>
