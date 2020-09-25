<?php
use HotelFactory\managers\HotelManager;

$hotelManager = new HotelManager(); 
$hotel = $hotelManager->find($_SESSION['hotel']);
?>

<table class="data-table">
    <thead>
        <tr>
            <?php foreach ($data["colonnes"] as $name => $colonnes) : ?>
                <?php if ($colonnes != "Id") : ?>
                    <th><?= $colonnes ?></th>
                <?php endif; ?>
            <?php endforeach; ?>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data["fields"] as $categorie => $elements) : ?>
            <?php foreach ($elements as $key => $fields) : ?>
                <form method="post" action="#">
                    <tr>
                        <?php foreach ($fields as $key => $field) : ?>
                            <?php if ($key != 'id' && $key != 'status' && $key != 'address') : ?>
                                <td><?= $fields[$key] ?></td>
                            <?php endif; ?>

                        <?php endforeach; ?>
                        <td>
                            <a href="https://<?= $hotel->getRoute() ?>.hotel-factory.com<?= $fields['address'] ?>" target="__blank">Voir</a> /
                            <a href="/settings/page/formpage?id=<?= $fields['id'] ?>">Modifier</a> / 
                            <?php if ($fields["status"] == 1) { ?>
                                <a href="/settings/page/status?id=<?= $fields['id'] ?>&status=<?= $fields['status'] ?>">Activer la page</a>
                            <?php  } else { ?>
                                <a href="/settings/page/status?id=<?= $fields['id'] ?>&status=<?= $fields['status'] ?>">Desactiver la page</a>
                            <?php } ?>

                        </td>
                    </tr>

                </form>
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