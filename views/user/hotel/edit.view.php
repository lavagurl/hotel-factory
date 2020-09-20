<div>
    <h1>Administration de mon hotel</h1>
    <a href="/settings/room/form">Créer une chambre</a>
    <a href="/settings/room/list">Liste des chambres</a>
    <br>
    <a href="/settings/service/form">Créer un service</a>
    <a href="/settings/service/list">Liste des services</a>
</div>

<div>
    <h1>Modification des informations de mon hotel </h1>
    <?php $this->addModal("edit_hotel", $configFormHotel); ?>
</div>