<?php
if(!(empty($page[0])) || isset($page[0])):
    if($_SESSION['hotel'] == $page[0]->getIdHotel()):
        echo($page[0]->getContent());
    endif;
endif;
