<?php 
use HotelFactory\managers\UserManager;

$userManager = new UserManager();
$user = $userManager->count(array("idHfCompany" => $_SESSION['hotel'], "idHfRole" => 2));

?>
    <h1>Administration de mon hotel</h1><br>
<div style="padding-top: 2rem;" class="row">
    <div style="padding-top: 2rem;" class="col-lg-2">
        <ul class="list-group">
            <li class="list-group-item"><a href="/settings/room/form">Créer une chambre</a></li>
            <li class="list-group-item"><a href="/settings/room/list">Liste des chambres</a></li>
            <li class="list-group-item"><a href="/settings/service/form">Créer un service</a></li>
            <li class="list-group-item"><a href="/settings/service/list">Liste des services</a></li>
            </br>
            </br>
            </br>
            <?php if($user > 0 && $user < 2){ ?>
                <form method="post" action="/settings/hotel/delete">
                    <input type="submit" class="btn btn-danger" value="Supprimer mon hotel"></input>
                </form>
            <?php }else{ ?>
                <form method="post" action="/settings/hotel/delete">
                    <input type="submit" class="btn btn-danger" disabled="disabled" value="Supprimer mon hotel"></input>
                </form>
            <?php } ?>
        </ul>
    </div>
    <div class="col-lg-2"></div>
