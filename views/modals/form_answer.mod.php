<?php

$inputData = $GLOBALS["_".strtoupper($data["config"]["method"])];

?>

<form method="<?= $data["config"]["method"]?>"
      action="<?= $data["config"]["action"]?>"
      id=""
      class="">

    <?php foreach ($data["fields"] as $name => $configField):?>
        <div class="form-group row">
            <div class="col-sm-12">
                <input hidden="hidden" type="number" value="<?= $_SESSION['id'] ?>" name="idHfUser"/>
                <input hidden="hidden" type="number" value="<?= $_GET['id'] ?>" name="idHfFaqQuestion"/>

                <textarea
                        value="<?= (isset($inputData[$name]) && $configField["type"]!="password")?$inputData[$name]:'' ?>"
                        type="<?= $configField["type"]??'' ?>"
                        name="<?= $name??'' ?>"
                        placeholder="<?= $configField["placeholder"]??'' ?>"
                        rows="<?= $configField["rows"]??'' ?>"
                        cols="<?= $configField["cols"]??'' ?>"
                <?=(!empty($configField["required"]))?"required='required'":""?> ></textarea>
            </div>
        </div>
    <?php endforeach;?>



    <button class="btn btn-primary"><?= $data["config"]["submit"];?></button>
</form>
