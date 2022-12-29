<?php
require "../db.php";
require "../model/prijava.php";

if(isset($_POST['id'])) {
    $prijava = new Prijava($_POST['id']);
    $status = $prijava->deleteById($conn);

    if ($status) {
        echo 'Success';
    } else {
        echo 'Failed';
    }
}

?>