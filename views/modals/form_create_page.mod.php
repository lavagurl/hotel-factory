<?php

$inputData = $GLOBALS["_".strtoupper($data["config"]["method"])];
?>

<form method="<?= $data["config"]["method"]?>"
      action="<?= $data["config"]["action"]?>"
      id="<?= $data["config"]["id"]?>"
      class="<?= $data["config"]["class"]?>">

    <?php foreach ($data["fields"] as $name => $configField):?>
        <div class="form-group row">
            <div class="col-sm-12">
                <input hidden=hidden type="text" value="<?= $_SESSION['hotel'] ?>" name="idHotel"/>
                <input
                    value="<?= (isset($inputData[$name]))?$inputData[$name]:'' ?>"
                    type="<?= $configField["type"]??'' ?>"
                    name="<?= $name??'' ?>"
                    class="<?= $configField["class"]??'' ?>"
                    placeholder="<?= $configField["placeholder"]??'' ?>"
                    <?=(!empty($configField["required"]))?"required='required'":""?>
                    <?=(!empty($configField["hidden"]))?"hidden='hidden'":""?> >

            </div>
        </div>
    <?php endforeach;?>



    <button class="btn btn-primary"><?= $data["config"]["submit"];?></button>
</form>
