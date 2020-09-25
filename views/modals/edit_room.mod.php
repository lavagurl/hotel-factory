<?php

$inputData = $GLOBALS["_".strtoupper($data["config"]["method"])];

use HotelFactory\managers\RoomManager;
use HotelFactory\models\Room;
$room = new Room();
$roomManager = new RoomManager();
$room = $room->hydrate($data["fields"]);
$room = $roomManager->find($_GET['id']);
$tab = (array)$room;

?>

<form method="<?= $data["config"]["method"]?>" action="/settings/room/edit">

    <?php foreach ($data["fields"] as $name => $configField):?>
        <div class="form-group row">
            <div class="col-sm-12">
                <input
                        value="<?= $tab["\0*\0".$name] ?>"
                        type="<?= $configField["type"]??'' ?>"
                        name="<?= $name??'' ?>"
                        placeholder="<?= $configField["placeholder"]??'' ?>"
                        class="<?= $configField["class"]??'' ?>"
                    <?=(!empty($configField["required"]))?"required='required'":""?>
                    <?=(!empty($configField["hidden"]))?"hidden='hidden'":""?>>
            </div>
        </div>
    <?php endforeach;?>



    <button class="btn btn-primary"><?= $data["config"]["submit"];?></button>
</form>
