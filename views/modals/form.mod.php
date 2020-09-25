<?php

$inputData = $GLOBALS["_".strtoupper($data["config"]["method"])];

?>

<form method="<?= $data["config"]["method"]?>"
action="<?= $data["config"]["action"]?>"
id="<?= $data["config"]["id"]??''?>"
class="<?= $data["config"]["class"]??''?>">

<?php foreach ($data["fields"] as $name => $configField):?>
        <div class="form-group row">
          <div class="col-sm-12">

              <?php if($configField["type"] == "captcha"): ?>
                  <img src="script/captcha.php" style="padding-bottom: 1rem;">
              <?php endif;?>

            <input
                value="<?php if(isset($inputData[$name]) && $configField["type"]!="password"){
                  echo $inputData[$name];
                  }elseif(isset($configField["value"]) && !empty($configField["value"])){
                    echo $configField["value"];
                  }else{
                    echo '';
                  }?>"
                type="<?= $configField["type"]??'' ?>"
                name="<?= $name??'' ?>"
                placeholder="<?= $configField["placeholder"]??'' ?>"
                class="<?= $configField["class"]??'' ?>"
                id="<?= $configField["id"]??'' ?>"
                <?=(!empty($configField["required"]))?"required='required'":""?>
                <?=(!empty($configField["hidden"]))?"hidden='hidden'":""?> >
        </div>
      </div>
      <?php endforeach;?>



  <button class="btn btn-primary"><?= $data["config"]["submit"];?></button>
</form>

<?php

if (isset($_SESSION['errors_form'])) {
  foreach ($_SESSION['errors_form'] as $error) {
  ?>
    <h6 style="color: red"><?= $error ?></h6><br>
  <?php
  }
  unset($_SESSION['errors_form']);
}
?>
