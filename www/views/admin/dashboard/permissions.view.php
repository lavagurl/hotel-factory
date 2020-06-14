<div>
  <h1>Permissions</h1>
  <table>
    <thead>
      <td>Prenom Nom</td>
      <td> Email </td>
      <td> Role </td>
    </thead>
    <tbody>
      <?php if(!(isset($result)) && !(empty($result))) { foreach ($result as $user) { ?>
      <tr>
        <td><?php echo($user['firstname']." ".$user['name']); ?></td>
        <td><?php echo($user['email']); ?></td>
        <td><?php echo($user['']); ?></td>
      </tr>
    <?php  } } else { ?>
      <tr>
        <td>Il n'y a pas d'utilisateur</td>
      </tr>
    <? } ?>
    </tbody>
  </table>

</div>
