<table>
    <th>
        <?php
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
            <tr>
                <td></td>
                <?php foreach ($fields as $key => $field): ?>
                    <td><?= $field ?></td>
                <?php endforeach; ?>

                <td><a href="/settings/room/editForm?id=<?= $fields['id'] ?>">Modifier</a></td>
                <td><a href="/settings/room/delete?id=<?= $fields['id'] ?>">Supprimer</a></td>

            </tr>
        <?php endforeach; ?>
    <?php endforeach; ?>
    </tbody>
</table>
