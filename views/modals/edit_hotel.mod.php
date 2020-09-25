<?php

$inputData = $GLOBALS["_" . strtoupper($data["config"]["method"])];

use HotelFactory\managers\HotelManager;
use HotelFactory\models\Hotel;

$hotel = new Hotel();
$hotelManager = new HotelManager();
$hotel = $hotel->hydrate($data["fields"]);
$hotel = $hotelManager->find($_SESSION['hotel']);
$tab = (array)$hotel;

?>

    
        <form method="<?= $data["config"]["method"] ?>" action="/settings/hotel/edit" id="<?= $data["config"]["id"] ?>" class="<?= $data["config"]["class"] ?>">

            <?php foreach ($data["fields"] as $name => $configField) : ?>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input value="<?= $tab["\0*\0" . $name] ?>" 
                                type="<?= $configField["type"] ?? '' ?>" 
                                name="<?= $name ?? '' ?>" 
                                class="<?= $configField["class"] ?? '' ?>" 
                                id="<?= $configField["id"] ?? '' ?>" 
                                placeholder="<?= $configField["placeholder"] ?? '' ?>" 
                                <?= (!empty($configField["required"])) ? "required='required'" : "" ?> 
                                <?= (!empty($configField["hidden"])) ? "hidden='hidden'" : "" ?>>
                    </div>
                </div>
            <?php endforeach; ?>



            <center><button class="btn btn-primary"><?= $data["config"]["submit"]; ?></button></center>
        </form>
    </div>
</div>