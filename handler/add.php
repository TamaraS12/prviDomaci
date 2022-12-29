<?php
require "../db.php";
require "../model/prijava.php";

if(isset($_POST['korisnikId']) && isset($_POST['smestajId']) && isset($_POST['brojOsoba']) && isset($_POST['datumOd']) && isset($_POST['datumDo']) && isset($_POST['ukupnaCena'])){

    $prijava= new Prijava(null, $_POST['brojOsoba'], $_POST['datumOd'], $_POST['datumDo'], $_POST['ukupnaCena'], $_POST['korisnikId'], $_POST['smestajId']);
    $status= Prijava::add($prijava,$conn);

    if($status){
        echo 'Success';
    }else{

        echo $status;
        echo 'Failed';
    }

}

?>