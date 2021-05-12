<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="index.php?page=news">La Fleur</a>

    <?php 
    require_once("ConnexionBase.php");

    if (isset($_SESSION['login'])) { ?>

      <a class="navbar-brand" href="index.php?page=profil">| <?php echo ($_SESSION['prenom'] . " " . $_SESSION['nom'] . " (" . ($_SESSION['groupe']) . ")");
                                                            } ?></a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php?page=news">Accueil
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=fleurs&a=voirFleurs">Catalogue</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=contact">Contact</a>
          </li>

          <?php

          if (isset($_SESSION['login'])) { ?>
            <li class="nav-item">
              <a class="nav-link" href="index.php?page=profil">Mon compte</a>
            </li>

            <?php
            if (EtreAdministrateur()) { ?>

              <li class="nav-item">
                <div class="btn-group">
                  <button type="button" class="btn-sm btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-top:4.8px; margin-left:9px">
                    Gestion
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="index.php?page=news&a=gestionnews">News</a>
                    <a class="dropdown-item" href="index.php?page=fleurs&a=gestionFleurs">Fleurs</a>
                    <a class="dropdown-item" href="index.php?page=utilisateurs&a=gestionUtilisateurs">Utilisateurs</a>
                  </div>
              </li>

            <?php
            } ?>

            <li class="nav-item">
              <a href="index.php?page=connexion&a=Deconnexion" class="btn btn-danger btn-sm active" role="button" aria-pressed="true" style="margin-top:4.8px; margin-left:8px">Se déconnecter</a>
            </li>

          <?php } else { ?>

            <li class="nav-item">
              <a class="nav-link" href="index.php?page=connexion&a=Connexion">Connexion</a>
            </li>

          <?php } ?>

          <li class="nav-item" style="margin-left: 10px">
            <a href='index.php?page=panier&a=voirPanier' type='button' class='btn btn-sm btn-primary' style="margin-top:4.8px"><i class='fas fa-shopping-cart'> <?php $panier = $_SESSION['panier']->getNbProd(); echo $panier; //var_dump($_SESSION['panier']); ?></i></a>
          </li>

        </ul>
      </div>
  </div>
</nav>