<table>
    <th>
        <?php foreach ($data["colonnes"] as $name => $colonnes):?>
            <td><?= $colonnes ?></td>
        <?php endforeach; ?>
    </th>
    <tbody>
    <?php foreach ($data["fields"] as $categorie => $elements):?>
        <?php foreach ($elements as $key => $fields): ?>
            <tr>
                <?php foreach ($fields as $key => $field): ?>
                    <td><?= $field ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    <?php endforeach; ?>
    </tbody>
</table>
