<?php
use HotelFactory\core\Helper;
?>
<?php //include('templates/navbar.tpl.php'); ?>

<div class="row">
    <div  class="col">
    </div>

    <div style="padding-top: 1.5rem;" class="col">
        <h1 style="text-align: center;">Mot de passe oublié</h1>
        <?php $this->addModal("form", $configFormUser); ?>
        </br>
       <center><a href="<?= Helper::getUrl("Home","default")?>">Retour à l'accueil</a></center>
    </div>


<div class="col">
</div>

</div>