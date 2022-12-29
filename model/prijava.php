<?php

class Prijava
{

  public $id;
  public $brojOsoba;
  public $datumOd;
  public $datumDo;
  public $cena;
  public $korisnikId;
  public $smestajId;

  public function __construct($id = null, $brojOsoba = null, $datumOd = null, $datumDo = null, $cena = null, $korisnikId = null, $smestajId = null)
  {

    $this->id = $id;
    $this->brojOsoba = $brojOsoba;
    $this->datumOd = $datumOd;
    $this->datumDo = $datumDo;
    $this->cena = $cena;
    $this->korisnikId = $korisnikId;
    $this->smestajId = $smestajId;
  }

  public static function add(Prijava $prijava, mysqli $conn)
  {

    $q = "INSERT INTO prijava(broj_osoba,datum_od,datum_do,cena,korisnik_id,smestaj_id) VALUES('$prijava->brojOsoba','$prijava->datumOd','$prijava->datumDo','$prijava->cena','$prijava->korisnikId','$prijava->smestajId')";
    return $conn->query($q);
  }

  public static function getByUserId($korisnik_id, $conn)
  {

    $query = "SELECT p.id AS prijava_id, s.naziv AS smestaj, mesto, broj_osoba, datum_od, datum_do, cena FROM prijava AS p JOIN smestaj AS s ON p.smestaj_id=s.id WHERE p.korisnik_id='$korisnik_id'";
    return $conn->query($query);
  }

  public function deleteById(mysqli $conn)
  {

    $query = "DELETE FROM prijava WHERE id= $this->id";

    return $conn->query($query);
  }
}
