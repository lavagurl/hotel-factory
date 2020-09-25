
<table class="data-table">
    <thead>
        <tr>
            <?php
            foreach ($data["colonnes"] as $name => $colonnes) : ?>
                <?php if ($colonnes != "Id" && $colonnes != "Hotel" ) : ?>
                    <th><?= $colonnes ?></th>
                <?php endif; ?>
            <?php endforeach; ?>
                <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data["fields"] as $categorie => $elements) : ?>
            <?php foreach ($elements as $key => $fields) : ?>
                <tr>
                    <?php foreach ($fields as $key => $field) : ?>
                        <?php if ($key != 'status' && $key != 'id' && $key != 'idHotel') { ?>
                            <td><?= $field ?></td>
                        <?php } ?>
                    <?php endforeach; ?>

                    <td>
                        <a href="/settings/room/editForm?id=<?= $fields['id'] ?>">Modifier</a> / 
                        <?php if ($fields["status"] == 1) : ?>
                            <a href="/settings/room/status?id=<?= $fields['id'] ?>&status=<?= $fields['status'] ?>">Activer la chambre</a> / 
                        <?php else : ?>
                            <a href="/settings/room/status?id=<?= $fields['id'] ?>&status=<?= $fields['status'] ?>">Desactiver la chambre</a> / 
                        <?php endif; ?>
                    <a href="/settings/room/delete?id=<?= $fields['id'] ?>">Supprimer</a>
                </td>

                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        var table = $('.data-table').DataTable({
                retrieve: true,
                paging: false,
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