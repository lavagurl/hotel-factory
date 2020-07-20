<?php if(isset($id)): ?>
<div>
    <h1>Administration de mon hotel</h1>
    <a href="/settings/room/form">Créer une chambre</a>
    <a href="/settings/room/list">Liste des chambres</a>
    <br>
    <a href="/settings/service/form">Créer un service</a>
    <a href="/settings/service/list">Liste des services</a>
</div>
<?php else : ?>
<div>
    <h1>Creation de mon hotel</h1>
    <?php $this->addModal("form_hotel", $configFormHotel); ?>
</div>
<?php endif;
