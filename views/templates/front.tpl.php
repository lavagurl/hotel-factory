<?php 
$routeCalled = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Hotel Factory</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link href="/script/css/styles.css" rel="stylesheet" />
  <link rel="shortcut icon" type="image/png" href="/script/images/favicon.ico"/>

<body><?php if ($this->view != "404") :  ?>
    <nav class="navbar navbar-expand-lg navbar-dark" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="/home"><img src="/script/images/logo_2.png" class="img-nav" alt="Home" /></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars ml-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item"><a class="nav-link js-scroll-trigger <?php echo ($routeCalled == "/se-connecter")? "active":"" ?>" href="/se-connecter">Se connecter</a></li>
            <li class="nav-item"><a class="nav-link js-scroll-trigger <?php echo ($routeCalled == "/s-inscrire")? "active":"" ?>" href="/s-inscrire">S'inscrire</a></li>
          </ul>
        </div>
      </div>
    </nav>
  <?php endif ?>
  <div>

    <?php include "views/" . $this->view . ".view.php"; ?>
  </div>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</html>
