<table>
    <th>
        <?php
        use HotelFactory\managers\UserManager;
        use HotelFactory\models\Comment;

        foreach ($data["colonnes"] as $name => $colonnes):?>
            <?php if($colonnes != "Id" && $colonnes != "Active"): ?>
                <td><?= $colonnes ?></td>
            <?php else: ?>
                <td hidden="hidden"><?= $colonnes ?></td>
            <?php endif; ?>
        <?php endforeach; ?>
    </th>
    <tbody>
    <?php foreach ($data["fields"] as $categorie => $elements):?>
        <?php foreach ($elements as $key => $fields): ?>
                <tr>
                    <td></td>
                    <?php foreach ($fields as $key => $field):
                        if($fields['active'] == 1):
                        $comment = new Comment();
                        $userManager = new UserManager();
                        $comment = $comment->hydrate($fields);
                        $user = $userManager->find($comment->getIdHfUser());
                   ?>

                    <?php if($key != "id" && $key != "idHfUser" && $key != "active"): ?>
                        <td><?= $fields[$key] ?></td>
                    <?php elseif ($key == "id"): ?>
                        <td hidden="hidden"><input type="number" value="<?= $fields[$key] ?>" name="<?= $key ?>"/></td>
                    <?php elseif($key != "active") : ?>
                        <td><?= $user->getName().' '.$user->getFirstname() ?></td>
                    <?php endif;
                    endif;
                    endforeach; ?>
                </tr>
        <?php endforeach; ?>
    <?php endforeach; ?>
    </tbody>
</table>
