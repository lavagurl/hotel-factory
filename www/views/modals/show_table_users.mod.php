<table>
    <th>
        <?php   use HotelFactory\managers\RoleManager;
                use HotelFactory\models\User;

        foreach ($data["colonnes"] as $name => $colonnes):?>
            <?php if($colonnes != "Id"): ?>
                <td><?= $colonnes ?></td>
            <?php else: ?>
                <td hidden="hidden"><?= $colonnes ?></td>
            <?php endif; ?>
        <?php endforeach; ?>
    </th>
    <tbody>
    <?php foreach ($data["fields"] as $categorie => $elements):?>
        <?php foreach ($elements as $key => $fields): ?>
            <form method="POST" action="/dashboard/perm_modify">
                <tr>
                    <td></td>
                    <?php foreach ($fields as $key => $field):
                        $user = new User();
                        $roleManager = new RoleManager();
                        $user = $user->hydrate($fields);
                        $role = $roleManager->find($user->getIdHfRole()); ?>

                    <?php if($key != "id" && $key != "idHfRole"): ?>
                        <td><input type="text" value="<?= $fields[$key] ?>" name="<?= $key ?>"/></td>
                        <?php elseif ($key == "id"): ?>
                        <td hidden="hidden"><input type="number" value="<?= $fields[$key] ?>" name="<?= $key ?>"/></td>
                        <?php else : ?>
                        <td><input type="text" value="<?= $role->getCaption() ?>" name="<?= $key ?>"/></td>
                        <?php endif;
                            endforeach; ?>


                        <?php if($fields['idHfRole'] == 1): ?>
                            <td><input type="radio" value="2" name="role"/>User</td>
                            <td><input type="radio" value="3" name="role"/>Moderator</td>
                            <td><input type="submit" value="Enregistrer"/></td>
                        <?php elseif($fields['idHfRole'] == 2): ?>
                            <td><input type="radio" value="1" name="role">Admin</input></td>
                            <td><input type="radio" value="3" name="role">Moderator</button></td>
                            <td><input type="submit" value="Enregistrer"/></td>
                        <?php elseif($fields['idHfRole'] == 3): ?>
                            <td><input type="radio" value="1" name="role">Admin</input></td>
                            <td><input type="radio" value="2" name="role">User</button></td>
                            <td><input type="submit" value="Enregistrer"/></td>
                        <?php endif; ?>
                </tr>
            </form>
        <?php endforeach; ?>
    <?php endforeach; ?>
    </tbody>
</table>
