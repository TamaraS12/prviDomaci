<?php
require "../db.php";
require "../model/smestaj.php";

if (isset($_POST['direction'])) {

    $sortiranSmestaj= Smestaj::sortiraj($conn, $_POST['direction']);

    if ($sortiranSmestaj) {
        echo json_encode($sortiranSmestaj);
    } else {
        echo 'Failed';
    }
    
}


?>