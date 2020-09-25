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
                <input
                    value="<?= (isset($configField["value"]))?$configField["value"]:'' ?>"
                    type="<?= $configField["type"]??'' ?>"
                    name="<?= $name??'' ?>"
                    placeholder="<?= $configField["placeholder"]??'' ?>"
                    class="<?= $configField["class"]??'' ?>"
                    id="<?= $configField["id"]??'' ?>"
                    <?=(!empty($configField["required"]))?"required='required'":""?>
                    <?=(!empty($configField["hidden"]))?"hidden='hidden'":""?> >
                <input hidden="hidden" name="idUser" value="<?= $_SESSION['id'] ?>" />
            </div>
        </div>
    <?php endforeach;?>



    <button class="btn btn-primary"><?= $data["config"]["submit"];?></button>
</form>
