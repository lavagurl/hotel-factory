<table class="data-table">
    <thead>
        <tr>
            <?php

            use HotelFactory\managers\RoleManager;
            use HotelFactory\models\User;

            foreach ($data["colonnes"] as $name => $colonnes) : ?>
                <?php if ($colonnes != "Id" && $colonnes != "Role") : ?>
                    <th><?= $colonnes ?></th>
                <?php endif; ?>
            <?php endforeach; ?>
            <th>Changer role</th>
            <th>Valider</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data["fields"] as $categorie => $elements) : ?>
            <?php foreach ($elements as $key => $fields) : ?>
                <?php if($_SESSION["id"]!=$fields["id"]):?>
                <form method="POST" action="<?= ($_SESSION['hotel'] == 1) ? "/dashboard/perm_modify" : "/settings/perm_modify" ?>">
                    <tr>
                        <?php foreach ($fields as $key => $field) :
                            if ($fields['idHfRole'] != 4) :
                                $user = new User();
                                $roleManager = new RoleManager();
                                $user = $user->hydrate($fields);
                                $role = $roleManager->find($user->getIdHfRole()); ?>

                                <?php if ($key != "id" && $key != "idHfRole") : ?>
                                    <td><?= $field ?></td>
                        <?php endif;
                            endif;
                        endforeach; ?>
                        <?php if ($fields['idHfRole'] == 1 || $fields['idHfRole'] == 2) : ?>
                            <td> <input id="<?php echo $fields['id'] ?>" name="3" class="form-check-input" type="checkbox">
                                <label class="form-check-label" for="defaultCheck1">
                                    Moderator
                                </label>
                            </td>
                        <?php elseif ($fields['idHfRole'] == 3 && $_SESSION['hotel'] != 1) : ?>
                            <td>
                                <input id="<?php echo $fields['id'] ?>" name="2" class="form-check-input" type="checkbox">
                                <label class="form-check-label" for="defaultCheck1">
                                    Admin
                                </label>
                            </td>
                        <?php elseif ($fields['idHfRole'] == 3 && $_SESSION['hotel'] == 1) : ?>
                            <td>
                                <input id="<?php echo $fields['id'] ?>" name="1" class="form-check-input" type="checkbox">
                                <label class="form-check-label" for="defaultCheck1">
                                    Admin
                                </label>
                            </td>
                        <?php endif; ?>
                        <td><button type="button" class="btn btn-light">Enregistrer</button></td>
                    </tr>
                </form>
                        <?php endif;?>
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
                var id = $(row[5]).children("input[type='checkbox']:first").attr('id')
                var checked = $(row[5]).children("input[type='checkbox']:first").is(':checked')
                var role = $(row[5]).children("input[type='checkbox']:first").attr('name')
                 if (checked) {
                    var form = $('<form action="<?= ($_SESSION['hotel'] == 1) ? "/dashboard/perm_modify" : "/settings/perm_modify" ?>" method="post">' +
                        '<input type="radio" hidden="hidden" value="' + id + '-' + role + '" name="role" checked></input>' +
                        '</form>');
                    $('body').append(form);
                    form.submit();
                }
            });

    });
</script>