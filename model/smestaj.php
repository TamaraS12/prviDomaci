<?php

class Smestaj{

public $id;
public $tip;
public $naziv;
public $kapacitet;
public $cenaPoOsobi;

public function __construct($id=null,$tip=null,$naziv=null,$kapacitet=null,$cenaPoOsobi=null){

  $this->id= $id;
  $this->tip= $tip;
  $this->naziv= $naziv;
  $this->kapacitet= $kapacitet;
  $this->cenaPoOsobi= $cenaPoOsobi;
}

public static function getAll($conn){

 $query= "SELECT * FROM smestaj";
 return $conn->query($query);
}

public static function getById($id, mysqli $conn){

    $query= "SELECT * FROM smestaj WHERE id= $id";
    $rezultat= $conn->query($query);
    $myArray= array();
    if($rezultat){
        while($red= $rezultat->fetch_array()){
            $myArray[]= $red;
         }
    }
    
    return $myArray;
}
public static function sortiraj(mysqli $conn, $direction){

    
  $q = "SELECT * FROM smestaj ORDER BY cena_po_osobi $direction";
  $rezultat= $conn->query($q);
  $myArray= array();
  if($rezultat){
      while($red= $rezultat->fetch_array()){
          $myArray[]= $red;
       }
  }
  
  return $myArray;

}

  
}
