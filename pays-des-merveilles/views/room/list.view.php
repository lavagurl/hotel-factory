<?php
if($_SESSION['hotel'] == $page[0]->getIdHotel()):
    echo($page[0]->getContent());
endif;
$this->addModal('show_table', $config);
