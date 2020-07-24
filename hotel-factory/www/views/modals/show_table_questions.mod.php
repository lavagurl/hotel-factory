<?php
use HotelFactory\managers\AnswerManager;
use HotelFactory\managers\UserManager;
use HotelFactory\models\Question;
?>
<table>
    <th>
        <?php foreach ($data["colonnes"] as $name => $colonnes): ?>
        <?php if($colonnes != "Id" && $colonnes != "Status"): ?>
    <td><?= $colonnes ?></td>
    <?php endif; ?>
    <?php endforeach; ?>
    </th>
    <tbody>
    <?php foreach ($data["fields"] as $categorie => $elements):?>
        <?php foreach ($elements as $key => $fields): ?>
            <form method="post" action="/dashboard/faq/update" id="<?= $data["config"]["id"]?>" class="<?= $data["config"]["class"]?>">
                <tr>
                    <?php foreach ($fields as $key => $field):
                        $question = new Question();
                        $userManager = new UserManager();
                        $question = $question->hydrate($fields);
                        $user = $userManager->find($question->getIdHfUser());

                        $answerManager = new AnswerManager();
                        $answer = $answerManager->findBy(array("idHfFaqQuestion" =>$fields['id']));

                        switch ($key):
                            case "id":
                                echo '<td><input type="number" hidden="hidden" name="'.$key.'" value="'.$fields[$key].'"/></td>';
                                break;
                            case "idHfUser":
                                echo "<td>".$user->getFirstname().' '.$user->getName()."</td>";
                                break;
                            case "status":
                                echo '<td hidden="hidden"></td>';
                                break;
                            case "question":
                                echo "<td>".$fields[$key]."</td>";
                                break;
                        endswitch;
                    endforeach;
                    if(!(empty($answer))):
                        echo "<td>".$answer[0]->getAnswer()."</td>";
                    else:
                        echo "<td></td>";
                    endif;


                    if(($_SESSION['role'] == 1 || $_SESSION['role'] == 3) && empty($_GET)):
                        if(empty($answer)):
                            echo '<td><a href="/dashboard/faq/answer/show?id='.$fields['id'].'">Répondre</a></td>';
                        else:
                            echo "<td></td>";
                        endif;
                        if($fields['status'] == 1): ?>
                            <td><input type="radio" value="0" name="active"/>Cacher</td>
                            <td><input type="radio" value="1" name="active" checked/>Afficher</td>
                        <?php elseif($fields['status'] == 0): ?>
                            <td><input type="radio" value="0" name="active" checked>Cacher</input></td>
                            <td><input type="radio" value="1" name="active">Afficher</button></td>
                        <?php endif;?>
                        <td><input type="submit" value="Enregistrer"/></td>
                    <?php endif; ?>
                </tr>
            </form>
        <?php endforeach; ?>
    <?php endforeach; ?>
    </tbody>
</table>