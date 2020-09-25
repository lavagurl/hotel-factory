
        <?php   use HotelFactory\managers\RoleManager;
        use HotelFactory\models\User;
        ?>

        <table>
    <tbody>
    <?php foreach ($data["fields"] as $categorie => $elements):?>
        <?php foreach ($elements as $key => $fields): ?>
            <form method="POST" action="/dashboard/update">
                <tr>
                    <td></td>
                    <?php foreach ($fields as $key => $field):?>

                        <?php if($key != "id" && $key != "status"): ?>
                        <input type="text" value="<?= $fields[$key] ?>" name="<?= $key ?>" class="form-control form-control-user" required="required"/>
                        </br>
                    <?php elseif ($key == "id" ): ?>
                        <td hidden="hidden"><input type="number" value="<?= $fields[$key] ?>" name="<?= $key ?>"/></td>
                        <?php elseif ($key == "status"): ?>
                            <td hidden="hidden"><input type="number" value="1" name="status"/>   </td>
                         <?php endif;
                    endforeach; ?>
                    <input type="submit" value="Valider l'hotel"/>

                </tr>
            </form>
        <?php endforeach; ?>
    <?php endforeach; ?>
    </tbody>
</table>
