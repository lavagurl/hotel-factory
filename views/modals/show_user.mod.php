<?php

use HotelFactory\managers\RoleManager;
use HotelFactory\models\User;

?>
<table>
    <th>
        <?php foreach ($data["colonnes"] as $name => $colonnes):?>
        <?php if($name != "Id"): ?>
                <td><?= $colonnes ?></td>
        <?php  endif; ?>
        <?php endforeach; ?>
    </th>
    <tbody>
    <?php foreach ($data["fields"] as $categorie => $elements):?>
        <?php foreach ($elements as $key => $fields): ?>
            <form method="post"
                  action="/profile/update"
                  id="<?= $data["config"]["id"] ?>"
                  class="<?= $data["config"]["class"] ?>">
                <tr>
                    <?php foreach ($fields as $key => $field):
                        $user = new User();
                        $roleManager = new RoleManager();
                        $user = $user->hydrate($fields);
                        $role = $roleManager->find($user->getIdHfRole());?>

                    <?php if($key == 'id'):?>
                        <td><input hidden="hidden" type="number" value="<?= $fields[$key] ?>" name="<?= $key ?>"/></td>
                    <?php elseif($key == 'idHfRole'): ?>
                        <td><?= $role->getCaption(); ?></td>
                    <?php elseif($key == 'creationDate'): ?>
                        <td><?= $fields[$key] ?></td>
                    <?php else: ?>
                        <td><input type="text" value="<?= $fields[$key] ?>" name="<?= $key ?>"/></td>
                    <?php endif; ?>
                        <?php endforeach; ?>
                    <td><input type="submit" value="Modifier"/></td>
                </tr>
            </form>
        <?php endforeach; ?>
    <?php endforeach; ?>
    </tbody>
</table>
