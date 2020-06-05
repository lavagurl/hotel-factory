
 <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
 <div class="carousel-inner">

 <?php
    foreach ($data["listOfPictures"] as $key => $url):?>

    <div class="carousel-item <?= ($key==0)?"active":""?>">
    <img src="<?= $url;?>" class="d-block w-180">
    </div>

    <?php endforeach;?>


 <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
   <span class="carousel-control-prev-icon" aria-hidden="true"></span>
   <span class="sr-only">Previous</span>
 </a>
 <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
   <span class="carousel-control-next-icon" aria-hidden="true"></span>
   <span class="sr-only">Next</span>
 </a>
</div>