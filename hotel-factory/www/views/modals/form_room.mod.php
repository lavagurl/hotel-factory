<?php

$inputData = $GLOBALS["_".strtoupper($data["config"]["method"])];
print_r($data["fields"]["idHotel"]);
?>

<form method="<?= $data["config"]["method"]?>"
      action="<?= $data["config"]["action"]?>"
      id="<?= $data["config"]["id"]?>"
      class="<?= $data["config"]["class"]?>">

    <?php foreach ($data["fields"] as $name => $configField):?>
        <div class="form-group row">
            <div class="col-sm-12">
                <?php if($name == "idHotel"): ?>
                <input hidden=hidden type="text" value="<?= $data["fields"]["idHotel"] ?>" name="idHotel"/>
                <?php endif; ?>
                <input
                    value="<?= (isset($inputData[$name]) && $configField["type"]!="password")?$inputData[$name]:'' ?>"
                    type="<?= $configField["type"]??'' ?>"
                    name="<?= $name??'' ?>"
                    placeholder="<?= $configField["placeholder"]??'' ?>"
                    class="<?= $configField["class"]??'' ?>"
                    id="<?= $configField["id"]??'' ?>"
                    <?=(!empty($configField["required"]))?"required='required'":""?> >
            </div>
        </div>
    <?php endforeach;?>



    <button class="btn btn-primary"><?= $data["config"]["submit"];?></button>
</form>
