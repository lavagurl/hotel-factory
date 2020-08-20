<?php
    use HotelFactory\core\Helper;
    if(isset($id)): 
?>
<div>
    <h1>Administration de mon hotel</h1>
    <a href="<?= Helper::getUrl("Room","formRoom")?>">Créer une chambre</a>
    <a href="<?= Helper::getUrl("Room","list")?>">Liste des chambres</a>
    <br>
    <a href="<?= Helper::getUrl("Service","formService")?>">Créer un service</a>
    <a href="<?= Helper::getUrl("Service","list")?>">Liste des services</a>
</div>
<?php else : ?>
<div>
    <h1>Creation de mon hotel</h1>
    <?php $this->addModal("form_hotel", $configFormHotel); ?>
</div>
<?php endif;
