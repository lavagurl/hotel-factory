<?php
use HotelFactory\managers\UserManager;
use HotelFactory\models\Question;
?>
<table>
    <th>
        <?php foreach ($data["colonnes"] as $name => $colonnes):?>
                <td><?= $colonnes ?></td>
        <?php endforeach; ?>
    </th>
    <tbody>
    <?php foreach ($data["fields"] as $categorie => $elements):?>
        <?php foreach ($elements as $key => $fields): ?>
            <form method="<?= $data["config"]["method"]?>"
                  action="<?= $data["config"]["action"]?>"
                  id="<?= $data["config"]["id"]?>"
                  class="<?= $data["config"]["class"]?>">
                <tr>
                    <td></td>
                    <?php foreach ($fields as $key => $field):
                        $question = new Question();
                        $userManager = new UserManager();
                        $question = $question->hydrate($fields);
                        $user = $userManager->find($question->getIdHfUser()); ?>

                    <?php if($key == "id"): ?>
                    <td><input type="number" value="<?= $fields[$key] ?>" name="<?= $key ?>"/></td>
                    <?php elseif($key == "idHfUser"): ?>
                        <td><input hidden="hidden" type="text" value="<?= $fields[$key] ?>" name="<?= $key ?>"/><?= $user->getFirstname().' '.$user->getName() ?> </td>
                    <?php else: ?>
                    <td><input type="text" value="<?= $fields[$key] ?>" name="<?= $key ?>"/></td>
                    <?php endif; ?>
                        <?php endforeach; ?>
                    <td><a href="/dashboard/faq/answer"></a></td>
                </tr>
            </form>
        <?php endforeach; ?>
    <?php endforeach; ?>
    </tbody>
</table>
