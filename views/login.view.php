<div>
  <h1>Connexion</h1>
    <?php use HotelFactory\core\Helper;

    $this->addModal("form", $configFormUser); ?>
    </br>
    <a href="<?= Helper::getUrl("User","forgotPassword")?>">Mot de passe oublié</a>
    </br></br>
    <a href="/home">Retour à l'accueil</a>
</div>
