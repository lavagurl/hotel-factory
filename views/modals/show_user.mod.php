<?php

use HotelFactory\managers\RoleManager;
use HotelFactory\models\User;
?>
<?php foreach ($data["fields"] as $categorie => $elements) : ?>
    <?php foreach ($elements as $key => $fields) : ?>
        <form method="<?= $data["config"]["method"] ?>" action="<?= $data["config"]["action"] ?>" id="<?= $data["config"]["id"] ?>" class="<?= $data["config"]["class"] ?>">
            <div class="form-group row">
                <div class="col-sm-12">
                        <?php foreach ($fields as $key => $field) :
                            $user = new User();
                            $roleManager = new RoleManager();
                            $user = $user->hydrate($fields);
                            $role = $roleManager->find($user->getIdHfRole()); ?>

                            <?php if ($key == 'id') : ?>
                                <input hidden="hidden" type="number" value="<?= $fields[$key] ?>" name="<?= $key ?>" />
                            <?php elseif ($key == 'idHfRole') : ?>
                                <input style="margin-top: 5px; margin-bottom: 5px;" type="text" value="<?= $role->getCaption(); ?>" class="form-control form-control-user" disabled="disabled"/>
                            <?php elseif ($key == 'birthdate') : ?>
                                <input style="margin-top: 5px; margin-bottom: 5px;" type="date" value="<?= $fields[$key] ?>" name="<?= $key ?>" class="form-control form-control-user" />
                            <?php elseif ($key == 'creationDate') : ?>
                                <input style="margin-top: 5px; margin-bottom: 5px;" type="text" value="<?= $fields[$key] ?>" class="form-control form-control-user" disabled="disabled"/>
                            <?php else : ?>
                                <input style="margin-top: 5px; margin-bottom: 5px;" type="text" value="<?= $fields[$key] ?>" name="<?= $key ?>" class="form-control form-control-user" />
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <center><button type="submit" class="btn btn-success">Enregistrer</button></center>
                </div>
            </div>
        </form>
    <?php endforeach; ?>
<?php endforeach; ?>