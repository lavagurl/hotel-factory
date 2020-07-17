<table>
    <th>
        <?php
        use HotelFactory\managers\UserManager;
        use HotelFactory\models\Comment;

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
            <form method="post" action="/dashboard/comment_active">
                <tr>
                    <td></td>
                    <?php foreach ($fields as $key => $field):
                        $comment = new Comment();
                        $userManager = new UserManager();
                        $comment = $comment->hydrate($fields);
                        $user = $userManager->find($comment->getIdHfUser());
                   ?>

                    <?php if($key != "id" && $key != "idHfUser" && $key != "active"): ?>
                        <td><?= $fields[$key] ?></td>
                    <?php elseif ($key == "active" && $fields["active"] == 0): ?>
                        <td>Inactive</td>
                    <?php elseif ($key == "active" && $fields["active"] == 1): ?>
                        <td>Active</td>
                    <?php elseif ($key == "id"): ?>
                        <td hidden="hidden"><input type="number" value="<?= $fields[$key] ?>" name="<?= $key ?>" /></td>
                    <?php else : ?>
                        <td><?= $user->getName().' '.$user->getFirstname() ?></td>
                    <?php endif;
                    endforeach; ?>

                    <?php if($fields['active'] == 0): ?>
                    <td><input type="radio" value="1" name="active"/>Actif</td>
                    <td><input type="radio" value="0" name="active" checked/>Inactif</td>
                        <td><input type="submit" value="Enregistrer"/></td>
                    <?php else: ?>
                    <td><input type="radio" value="1" name="active" checked/>Actif</td>
                    <td><input type="radio" value="0" name="active" />Inactif</td>
                        <td><input type="submit" value="Enregistrer"/></td>

                    <?php endif; ?>
                </tr>
            </form>
        <?php endforeach; ?>
    <?php endforeach; ?>
    </tbody>
</table>
