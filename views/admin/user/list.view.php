<h1>Permissions</h1>
<div class="row" style="padding-bottom: 1.5rem;">

    <div class="col-lg-4">
        <ul class="list-group">
            <li class="list-group-item"><a href="<?= ($_SESSION['hotel'] == 1) ? "/dashboard" : "/settings" ?>/user/moderator">Ajouter un moderateur</a></li>
        </ul>
    </div>
</div>

<?php $this->addModal("show_table_users", $configTableUser); ?>