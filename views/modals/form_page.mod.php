<?php
use HotelFactory\core\Helper;
?>

<script src="https://cdn.tiny.cloud/1/uutmuvrof7egv7f2oluc5xpomx8iqt1ukkqdqy03tq8raaye/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<table>
    <tbody>
    <?php foreach ($data["fields"] as $categorie => $elements):?>
        <?php foreach ($elements as $key => $fields): ?>
            <form method="post" action="<?= Helper::getUrl("Page","update")?>">
                <tr>
                    <td></td>
                    <?php foreach ($fields as $key => $field):
                        if($key == 'id'): ?>
                            <input name="id" type="hidden" value="<?= $fields[$key] ?>">
                        <?php else: ?>

                            <textarea name="content" rows="20"><?= $fields[$key] ?></textarea>

                        <?php endif; ?>

                    <?php endforeach; ?>
                    <button type="submit">Modifier la page</button>
                </tr>

            </form>
        <?php endforeach; ?>
    <?php endforeach; ?>
    </tbody>
</table>
<script>
    tinymce.init({
        selector: 'textarea',
        language: 'fr_FR',
        plugins: [
            'advlist autolink link lists charmap print hr anchor pagebreak',
            'searchreplace wordcount code fullscreen insertdatetime nonbreaking',
            'table paste help autosave'
        ],
        toolbar: 'undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist outdent indent | ' +
            'forecolor backcolor | help',
        menu: {
            favs: {title: 'Mes favoris', items: 'code visualaid | searchreplace | emoticons'}
        },
        menubar: 'favs file edit view insert format tools table help',
        content_css: 'css/content.css',
        autosave_interval : '60s'
    });
    //let content = tinymce.get("textarea").getContent();
</script>