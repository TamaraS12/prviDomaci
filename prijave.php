<?php
require "db.php";
require "model/prijava.php";

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$rezultat = Prijava::getByUserId($_SESSION['user_id'], $conn);

if (!$rezultat) {

    echo "Nastala je greska prilikom izvodjenja upita <br>";
    die();
}

if ($rezultat->num_rows == 0) {

    echo "Nemate prijeve ";
    die();
} else {


?>




    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/home.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <title>Arijel</title>
    </head>

    <body>

        <?php include 'includes/navBar.php'; ?>


        <div class="container table-card">
            <div class="card">
                <div class="card-body">
                    <h3>Moje prijave</h3>

                    <table id="myTable" class="table table-hover table-striped" style="color: black; margin-top: 30px;">
                        <thead class="thead">
                            <tr>
                                <th scope="col">Smestaj</th>
                                <th scope="col">Mesto</th>
                                <th scope="col">Broj osoba</th>
                                <th scope="col">Datum od</th>
                                <th scope="col">Datum do</th>
                                <th scope="col">Cena</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            while ($red = $rezultat->fetch_array()) :

                            ?>

                                <tr>
                                    <td><?php echo $red["smestaj"] ?></td>
                                    <td><?php echo $red["mesto"] ?></td>
                                    <td><?php echo $red["broj_osoba"] ?></td>
                                    <td><?php echo $red["datum_od"] ?></td>
                                    <td><?php echo $red["datum_do"] ?></td>
                                    <td><?php echo $red["cena"] ?> RSD</td>
                                    <td>
                                        <button id=<?php echo $red["prijava_id"] ?> type="button" class="btn btn-outline-success btn-sm btn-update-booking" data-bs-toggle="modal" data-bs-target="#izmeniModal">Izmeni</button>
                                        <button id=<?php echo $red["prijava_id"] ?> type="button" class="btn btn-outline-danger btn-sm btn-delete">Obrisi</button>
                                    </td>

                                </tr>
                        <?php
                            endwhile;
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        <!-- Izmeni modal -->
        <div class="modal fade" id="izmeniModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Izmeni prijavu</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container prijava-form">
                            <form action="#" method="post" id="izmeniForm">
                                <div class="row">
                                    <div class="col-md-11 ">
                                    <div class="form-group">
                                            <label for="">Prijava ID</label>
                                            <input id="prijavaId" type="text" style="border: 1px solid black" name="prijavaId" class="form-control" readonly />
                                        </div>
                                        <div class="form-group" hidden>
                                            <label for="">Korisnik ID</label>
                                            <input id="korisnikId" value=<?php echo $_SESSION['user_id'] ?> type="text" style="border: 1px solid black" name="korisnikId" class="form-control" readonly />
                                        </div>
                                        <div class="form-group">
                                            <label for="">Korisnik</label>
                                            <input id="korisnik" value=<?php echo $_SESSION['username'] ?> type="text" style="border: 1px solid black" name="korisnik" class="form-control" readonly />
                                        </div>
                                        <div class="form-group" hidden>
                                            <label for="">Smestaj ID</label>
                                            <input id="smestajId" type="text" style="border: 1px solid black" name="smestajId" class="form-control" readonly />
                                        </div>
                                        <div class="form-group">
                                            <label for="">Smestaj</label>
                                            <input id="smestaj" type="text" style="border: 1px solid black" name="smestaj" class="form-control" readonly />
                                        </div>
                                        <div class="form-group">
                                            <label for="">Br. osoba</label>
                                            <input type="number" style="border: 1px solid black" name="brojOsoba" class="form-control" id="brojOsoba" />
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Datum od</label>
                                                <input type="date" style="border: 1px solid black" name="datumOd" class="form-control" id="datumOd"/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Datum do</label>
                                                <input type="date" style="border: 1px solid black" name="datumDo" class="form-control" id="datumDo"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Cena po osobi</label>
                                            <input type="number" style="border: 1px solid black" name="cenaPoOsobi" class="form-control" id="cenaPoOsobi" readonly />
                                        </div>
                                        <div class="form-group">
                                            <label for="">Ukupna cena</label>
                                            <input type="number" style="border: 1px solid black" name="ukupnaCena" class="form-control" id="ukupnaCena" readonly />
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button id="btnDodaj" type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="js/main.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>

    </html>