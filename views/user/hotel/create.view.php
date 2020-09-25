
<div>
<?php if(isset($bool) && $bool == true): ?>
    <h1>Creation de mon hotel</h1>
    <?php $this->addModal("form_hotel", $configFormHotel); ?>
<?php elseif(isset($valid) && $valid == true): ?>
    <h1>Votre hotel est validé</h1>
    <p>Reconnectez vous pour pouvoir administrer celui-ci !</p>
<?php else: ?>
    <h1>En attente</h1>
    <p>En attente d'une validation d'un administrateur...</p>
<?php endif; ?>
</div>
