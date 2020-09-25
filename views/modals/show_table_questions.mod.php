<?php

use HotelFactory\managers\AnswerManager;
use HotelFactory\managers\UserManager;
use HotelFactory\models\Question;
$routeCalled = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
?>
<table id="" class="<?php echo($routeCalled != '/dashboard/faq/answer/show')?'data-table':'table'; ?>" >
    <thead>
        <tr>
            <?php foreach ($data["colonnes"] as $name => $colonnes) : ?>
                <?php if ($colonnes != 'Id') : ?>
                    <th><?= $colonnes ?></th>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php if (($_SESSION['role'] == 1 || $_SESSION['role'] == 3) && empty($_GET)) : ?>
                <th>
                    <center>Actions</center>
                </th>
                <th></th>
            <?php endif ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data["fields"] as $categorie => $elements) : ?>
            <?php foreach ($elements as $key => $fields) : ?>
                <form method="<?= $data["config"]["method"] ?>" action="<?= $data["config"]["action"] ?>" class="<?= $data["config"]["class"] ?>">
                    <tr>
                        <?php foreach ($fields as $key => $field) :
                            $question = new Question();
                            $userManager = new UserManager();
                            $question = $question->hydrate($fields);
                            $user = $userManager->find($question->getIdHfUser());

                            $answerManager = new AnswerManager();
                            $answer = $answerManager->findBy(array("idHfFaqQuestion" => $fields['id']));

                            switch ($key):
                                case "idHfUser":
                                    echo "<td>" . $user->getFirstname() . ' ' . $user->getName() . "</td>";
                                    break;
                                case "question":
                                    echo "<td>" . $fields[$key] . "</td>";
                                    break;
                            endswitch;
                        endforeach;

                        if (($_SESSION['role'] == 1 || $_SESSION['role'] == 3) && empty($_GET)) :
                            if (empty($answer)) :
                                echo '<td><a href="/dashboard/faq/answer/show?id=' . $fields['id'] . '">Répondre</a></td>';
                            else :
                                echo "<td>" . $answer[0]->getAnswer() . "</td>";
                            endif;

                            if ($fields['status'] == 1) : ?>

                                <td>
                                    <input id="<?php echo $fields['id'] ?>" name="0" class="form-check-input" type="checkbox">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Caché
                                    </label>
                                </td>
                            <?php else : ?>
                                <td><input id="<?php echo $fields['id'] ?>" name="1" class="form-check-input" type="checkbox">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Afficher
                                    </label>
                                </td>
                            <?php endif; ?>
                            <td><button type="button" class="btn btn-light">Enregistrer</button></td>

                        <?php else : echo (!empty($answer)) ? "<td>" . $answer[0]->getAnswer() . "</td>" : '<td></td>'; ?>
                        <?php endif; ?>
                    </tr>
                </form>
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
        

        <?php if ($_SESSION['role'] != 2) : ?>

            $('.data-table tbody').on('click', 'button', function() {
                var row = $(this).closest('tr').children()
                var id = $(row[3]).children("input[type='checkbox']:first").attr('id')
                var checked = $(row[3]).children("input[type='checkbox']:first").is(':checked')
                var status = $(row[3]).children("input[type='checkbox']:first").attr('name')
                //console.log(status)
                if (checked) {
                    var form = $('<form action="<?php echo $data["config"]["action"] ?>" method="post">' +
                        '<input type="radio" hidden="hidden" value="' + id + '-' + status + '" name="active" checked></input>' +
                        '</form>');
                    $('body').append(form);
                    form.submit();
                }
            });

        <?php endif; ?>

    });
</script>