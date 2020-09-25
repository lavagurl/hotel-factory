<?php

use HotelFactory\managers\HotelManager;
use HotelFactory\models\Hotel;
?>
<table class="data-table">
    <thead>
        <tr>
            <?php foreach ($data["colonnes"] as $name => $colonnes) : ?>
                <?php if ($colonnes != "Id") : ?>
                    <th><?= $colonnes ?></th>
                <?php endif; ?>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($data["fields"] as $categorie => $elements) : ?>
            <?php foreach ($elements as $key => $fields) : ?>
                <tr>
                    <?php foreach ($fields as $key => $field) :
                        $hotel = new Hotel();
                        $hotelManager = new HotelManager();
                        $hotel = $hotel->hydrate($fields); ?>
                        <?php if ($key == "name") : ?>
                            <td><?= $field ?></td>
                        <?php elseif ($key == "status") :
                                if ($fields["status"] == 0) {
                            ?>
                                    <td><center><a href="/dashboard/details_hotel?id=<?= $fields['id'] ?>">Confirmer</a></center></td>
                        <?php   }else{ ?>
                                    <td><center>Oui</center></td>
                        <?php   }
                            elseif ($key == "route") : ?>
                                <td><center><a href="https://<?= $fields["route"] ?>.hotel-factory.com" target="_blank">Par ici !</a></center></td>
                        <?php
                            endif;

                            endforeach; 
                        ?>

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