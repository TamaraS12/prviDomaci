<?php
require "../db.php";
require "../model/prijava.php";


if (isset($_POST['id'])) {
    $prijava = Prijava::getById($_POST['id'], $conn);
    echo json_encode($prijava);
}

?>