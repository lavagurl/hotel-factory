<table>
    <th>
        <?php use HotelFactory\managers\HotelManager;
        use HotelFactory\models\Hotel;

        foreach ($data["colonnes"] as $name => $colonnes): ?>
        <?php if ($colonnes != "Id"): ?>
    <td><?= $colonnes ?></td>
    <?php else: ?>
        <td hidden="hidden"><?= $colonnes ?></td>
    <?php endif; ?>
    <?php endforeach; ?>
    </th>
    <tbody>
    <?php foreach ($data["fields"] as $categorie => $elements): ?>
        <?php foreach ($elements as $key => $fields): ?>
                <tr>
                    <?php foreach ($fields as $key => $field):
                        $hotel = new Hotel();
                        $hotelManager = new HotelManager();
                        $hotel = $hotel->hydrate($fields); ?>
                        <?php if ($key == "name"): ?>
                        <td><?= $field ?></td>
                    <?php elseif ($key == "id"): ?>
                        <td><input hidden="hidden" type="number" value="<?= $fields[$key] ?>" name="<?= $key ?>"/></td>
                    <?php

                    elseif ($key == "status"):
                        if ($fields["status"] == 0)
                            : ?>
                            <td><a href="/dashboard/details_hotel?id=<?= $fields['id'] ?>">Non</a></td>
                        <?php endif;
                        if ($fields["status"] == 1)
                            : ?>
                            <td><a href="/dashboard/details_hotel?id=<?= $fields['id']?>">Oui</a></td>
                        <?php endif;
                    elseif ($key == "route"): ?>
                        <td><a href="https://<?= $fields["route"] ?>.hotel-factory.com" target="_blank">Par ici !</a></td>
                    <?php
                    endif;

                    endforeach; ?>

                </tr>
        <?php endforeach; ?>
    <?php endforeach; ?>
    </tbody>
</table>
