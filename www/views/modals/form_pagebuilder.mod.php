<?php

?>

<script src="https://cdn.tiny.cloud/1/uutmuvrof7egv7f2oluc5xpomx8iqt1ukkqdqy03tq8raaye/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<form method="<?= $data["config"]["method"] ?>"
action="<?= $data["config"]["action"] ?>"
id="<?= $data['config']['id']?>"
class="<?= $data['config']['class']?>">

    <?php foreach ($data['fields'] as $name=> $configField): ?>
    <div class="form-group-row">
        <div class="col-sm-12">

            <input
                type="<?= $configField['type'] ?>"
                placeholder="<?= $configField['placeholder'] ?>"
                id="<?= $configField['id'] ?>"
                <?=(!empty($configField["required"]))?"required='required'":""?> />
        </div>
    </div>
    <?php endforeach; ?>
    <?php foreach ($data['contentfield'] as $name=> $configContent): ?>
    <div class="form-group-row">
        <div class="col-sm-12">
            <textarea
                type="<?= $configContent['type'] ?>"
                placeholder="<?= $configContent['placeholder'] ?>"
                id="<?= $configContent['id'] ?>"
                <?=(!empty($configField["required"]))?"required='required'":""?> >
                Ma page
                </textarea>

        </div>
    </div>
    <?php endforeach; ?>
    <button class="btn btn-primary"><?= $data["config"]["submit"];?></button>
</form>
<script>
    tinymce.init({
        selector: 'textarea',
        language: 'fr_FR',
        plugins: [
            'advlist autolink link image imagetools lists charmap print preview hr anchor pagebreak spellchecker',
            'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
            'table template paste help autosave'
        ],
        toolbar: 'undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist outdent indent | link image | preview media fullpage | ' +
            'forecolor backcolor | help',
        menu: {
            favs: {title: 'My Favorites', items: 'code visualaid | searchreplace | spellchecker | emoticons'}
        },
        menubar: 'favs file edit view insert format tools table help',
        content_css: 'css/content.css',
        autosave_interval : '60s'
    });
    //let content = tinymce.get("textarea").getContent();
</script>
