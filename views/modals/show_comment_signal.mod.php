<?php

use HotelFactory\managers\HotelManager;
?>
<table class="data-table">
    <thead>
        <tr>
            <?php
            foreach ($data["colonnes"] as $name => $colonnes) : ?>
                <?php if ($colonnes != "Id" && $colonnes != "User" && $colonnes != "Active" && $colonnes != 'IdHotel') : ?>
                    <th><?= $colonnes ?></th>
                <?php endif; ?>
            <?php endforeach; ?>
            <th>Hotel</th>
            <th>Validation</th>
            <th>Suppression</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data["fields"] as $categorie => $elements) : ?>
            <?php foreach ($elements as $key => $fields) : ?>
                <?php
                $hotelManager = new HotelManager();
                $hotel = $hotelManager->find($fields["idHotel"]);

                ?>
                <tr>
                    <?php foreach ($fields as $key => $field) : ?>
                        <?php if ($key != 'id' && $key != 'idHfUser' && $key != 'active' && $key != 'idHotel') : ?>
                            <td><?= $field ?></td>
                        <?php elseif ($key == 'idHotel') :  ?>
                            <td><?= $hotel->getName() ?></td>
                        <?php endif; ?>

                    <?php endforeach; ?>
                    <td><a href="/dashboard/comment/valid?id=<?= $fields['id'] ?>">Valider</a></td>
                    <td><a href="/dashboard/comment/delete?id=<?= $fields['id'] ?>&signal=true">Supprimer</a></td>

                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        var table = $('.data-table').DataTable({
            "language": {
                "lengthMenu": "Afficher les _MENU_ enregistrements par page",
                "zeroRecords": "Rien trouvé - désolé",
                "info": "Affichage de la page _PAGE_ sur _PAGES_",
                "infoEmpty": "Aucun enregistrement disponible",
                "infoFiltered": "(filtré à partir du total des enregistrements _MAX_)",
                "search": "Recherche",
                "paginate": {
                    "previous": "Precédent",
                    "next": "suivant"
                }
            }
        });
    });
</script>