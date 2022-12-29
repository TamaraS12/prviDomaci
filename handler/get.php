<?php
require "../db.php";
require "../model/smestaj.php";


if (isset($_POST['id'])) {
    $prijava = Smestaj::getById($_POST['id'], $conn);
    echo json_encode($prijava);
}

?>