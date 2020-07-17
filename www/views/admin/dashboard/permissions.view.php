<div>
  <h1>Permissions</h1>

      <?php if(isset($datas) && !(empty($datas))) { ?>
        <table>
          <thead>
            <td>Prenom Nom</td>
            <td>Email</td>
            <td>Role</td>
          </thead>
          <tbody>
        <?php foreach ($datas as $user) {
            echo("<tr><td>".$user->getFirstname()."</td>");
            echo("<td></td></tr>");
            } ?>
          </tbody>
        </table>

<?php  } else { echo "<p>Il n'y a pas d'utilisateur</p>"; } ?>
</div>
