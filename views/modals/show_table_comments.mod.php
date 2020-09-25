<table class="data-table">
    <thead>
        <tr>
            <?php

            use HotelFactory\managers\UserManager;
            use HotelFactory\models\Comment;

            foreach ($data["colonnes"] as $name => $colonnes) : ?>
                <?php if ($colonnes != "Id" && $colonnes != "Active") : ?>
                    <th><?= $colonnes ?></th>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php if ($_SESSION["hotel"] == 1) : ?>
                <th>Changer Status</th>
                <th>Modifier</th>
                <th>Suppression</th>
            <?php else : ?>
                <th>Signaler</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data["fields"] as $categorie => $elements) : ?>
            
            <?php foreach ($elements as $key => $fields) : ?>
                <form method="post" action="/dashboard/comment_active">
                    <tr>

                        <?php foreach ($fields as $key => $field) :
                            $comment = new Comment();
                            $userManager = new UserManager();
                            $comment = $comment->hydrate($fields);
                            $user = $userManager->find($comment->getIdHfUser());
                        ?>

                            <?php if ($key != "id" && $key != "idHfUser" && $key != "active") : ?>
                                <td><?= $fields[$key] ?></td>
                            <?php elseif ($key == "idHfUser") : //Prénom et Nom 
                            ?>
                                <td><?= $user->getName() . ' ' . $user->getFirstname() ?></td>
                            <?php elseif ($key == "IdHotel") : ?>
                                <td><?= $fields["IdHotel"] ?></td>
                        <?php endif;
                        endforeach; ?>

                        <?php
                        if ($_SESSION["hotel"] == 1) {


                            if ($fields['active'] == 0) : ?>
                                <td>
                                    <input id="<?php echo $fields['id'] ?>" name="1" class="form-check-input" type="checkbox">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Actif
                                    </label>
                                </td>
                            <?php else : ?>
                                <td>
                                    <input id="<?php echo $fields['id'] ?>" name="0" class="form-check-input" type="checkbox">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Inactif
                                    </label>
                                </td>

                            <?php endif; ?>
                            <td><button type="button" class="btn btn-light">Enregistrer</button></td>
                            <td><a href="/dashboard/comment/delete?id=<?= $fields['id'] ?>">Supprimer</a></td>

                            <?php  } else {

                            if ($fields['active'] == 0) { ?>
                                <td><button id="<?= $fields['id'] ?>" type="button" name="1" class="btn btn-light">Signaler</button></td>
                    <?php   }else{ ?>
                                <td>Signalé</td>
                    <?php   }
                        }
                        ?>
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

        $('.data-table tbody').on('click', 'button', function() {
            var row = $(this).closest('tr').children()
            var id = $(row[3]).children("input[type='checkbox']:first").attr('id')
            var checked = $(row[3]).children("input[type='checkbox']:first").is(':checked')
            var status = $(row[3]).children("input[type='checkbox']:first").attr('name')
            //console.log(status)
            if (checked) {
                var form = $('<form action="/dashboard/comment_active" method="post">' +
                    '<input type="radio" hidden="hidden" value="' + id + '-' + status + '" name="active" checked></input>' +
                    '</form>');
                $('body').append(form);
                form.submit();
            } else {
                id = $(row[3]).children("button[type='button']:first").attr('id')
                if (id != undefined) {
                    status = $(row[3]).children("button[type='button']:first").attr('name')
                    var form = $('<form action="/settings/comment_active" method="post">' +
                        '<input type="radio" hidden="hidden" value="' + id + '-' + status + '" name="active" checked></input>' +
                        '</form>');
                    $('body').append(form);
                    form.submit();
                }
            }
        });

    });
</script>