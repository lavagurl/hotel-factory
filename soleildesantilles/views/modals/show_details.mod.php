<div>
    <?php foreach ($data["fields"] as $categorie => $elements):?>
        <?php foreach ($elements as $key => $fields): ?>
                <?php foreach ($fields as $key => $field): ?>
                    <p><?= $field ?></p>
                <?php endforeach; ?>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>
