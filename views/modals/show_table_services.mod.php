<table class="data-table">
    <thead>
        <tr>
            <?php
            foreach ($data["colonnes"] as $name => $colonnes) : ?>
                <?php if ($colonnes != "Id") : ?>
                    <th><?= $colonnes ?></th>
                <?php endif; ?>
            <?php endforeach; ?>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data["fields"] as $categorie => $elements) : ?>
            <?php foreach ($elements as $key => $fields) : ?>
                <tr>
                    <?php foreach ($fields as $key => $field) : ?>
                        <?php if ($key != 'id' && $key != 'status' && $key != 'idHotel') : ?>
                            <td><?= $field ?></td>
                            
                        <?php elseif($key == 'status'): ?>
                            <td><?php echo ($fields[$key]!=1)? 'Activé': 'Désactivé'; ?></td>
                        <?php endif; ?> 
                        <?php endforeach; ?>

                    <td>
                        <a href="/settings/service/editForm?id=<?= $fields['id'] ?>">Modifier</a> / 
                        <?php if ($fields["status"] == 1) { ?>
                            <a href="/settings/service/status?id=<?= $fields['id'] ?>&status=<?= $fields['status'] ?>">Activer le service</a> / 
                        <?php  } else { ?>
                            <a href="/settings/service/status?id=<?= $fields['id'] ?>&status=<?= $fields['status'] ?>">Desactiver le service</a> / 
                        <?php } ?>
                    <a href="/settings/service/delete?id=<?= $fields['id'] ?>">Supprimer</a>
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