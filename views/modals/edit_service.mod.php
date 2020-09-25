<?php

$inputData = $GLOBALS["_".strtoupper($data["config"]["method"])];

use HotelFactory\managers\ServiceManager;
use HotelFactory\models\Service;
$service = new Service();
$serviceManager = new ServiceManager();
$service = $service->hydrate($data["fields"]);
$service = $serviceManager->find($_GET['id']);
$tab = (array)$service;

?>

<form method="<?= $data["config"]["method"]?>" action="/settings/service/edit">

    <?php foreach ($data["fields"] as $name => $configField):?>
        <div class="form-group row">
            <div class="col-sm-12">
                <input
                        value="<?= $tab["\0*\0".$name] ?>"
                        type="<?= $configField["type"]??'' ?>"
                        name="<?= $name??'' ?>"
                        class="<?= $configField["class"]??'' ?>"
                        placeholder="<?= $configField["placeholder"]??'' ?>"
                    <?=(!empty($configField["required"]))?"required='required'":""?>
                    <?=(!empty($configField["hidden"]))?"hidden='hidden'":""?>>
            </div>
        </div>
    <?php endforeach;?>



    <button class="btn btn-primary"><?= $data["config"]["submit"];?></button>
</form>
