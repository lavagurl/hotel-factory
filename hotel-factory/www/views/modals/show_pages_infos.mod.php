<table>
    <th>
        <?php foreach ($data["colonnes"] as $name => $colonnes):?>
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
            <form method="post" action="#">
                <tr>
                    <td></td>
                    <?php foreach ($fields as $key => $field):
                        if($key == 'id'): ?>
                            <td hidden='hidden'><?= $fields[$key] ?></td>
                        <?php else: ?>

                            <td><?= $fields[$key] ?></td>

                        <?php endif; ?>

                    <?php endforeach; ?>
                    <td>
                        <!--<button type="submit">Modifier la page</button>-->
                        <a href="/dashboard/page/formpage?id=<?=$fields['id'] ?>">Modifier</a>
                    </td>
                </tr>

            </form>
        <?php endforeach; ?>
    <?php endforeach; ?>
    </tbody>
</table>