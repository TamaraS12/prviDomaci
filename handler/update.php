
<?php
require "../db.php";
require "../model/prijava.php";

if (isset($_POST['prijavaId']) && isset($_POST['smestajId']) && isset($_POST['brojOsoba']) && isset($_POST['datumOd']) && isset($_POST['datumDo']) && isset($_POST['ukupnaCena'])) {
    $prijava = new Prijava(null, $_POST['brojOsoba'], $_POST['datumOd'], $_POST['datumDo'], $_POST['ukupnaCena'], $_POST['korisnikId'], $_POST['smestajId']);

    $status = $prijava->update($_POST['prijavaId'], $conn);

    

    if ($status) {
        echo 'Success';
    } else {
        echo 'Failed';
    }
}

?>