<?php
require "db.php";
require "model/smestaj.php";

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$rezultat = Smestaj::getAll($conn);

if (!$rezultat) {

    echo "Nastala je greska prilikom izvodjenja upita <br>";
    die();
}

if ($rezultat->num_rows == 0) {

    echo "Nema prijava na kolokvijume";
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
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <title>Arijel</title>
    </head>

    <body>

    <nav class="navbar navbar-expand-lg bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="img/ariel-face.png" alt="Bootstrap" width="36" height="45">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="home.php">Smestaj</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="prijave.php">Prijave</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Hello Tamara !
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Profil</a></li>
                                <li><a class="dropdown-item" href="#">Promena lozinke</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Odjavi se</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Pretrazi po nazivu" aria-label="Search" id="searchInput">
                        <!-- <button class="btn btn-outline-success" type="submit">Search</button> -->
                    </form>
                </div>
            </div>
        </nav>

        <div class="container table-card">
            <div class="card">
                <div class="card-body">
                    <h3>Smestaj</h3>

                    <table id="myTable" class="table table-hover table-striped" style="color: black; margin-top: 30px;">
                        <thead class="thead">
                            <tr>
                                <th scope="col">Naziv</th>
                                <th scope="col">Tip</th>
                                <th scope="col">Kapacitet</th>
                                <th scope="col">Cena po osobi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            while ($red = $rezultat->fetch_array()) :

                            ?>

                                <tr>
                                    <td><?php echo $red["naziv"] ?></td>
                                    <td><?php echo $red["tip"] ?></td>
                                    <td><?php echo $red["kapacitet"] ?></td>
                                    <td><?php echo $red["cena_po_osobi"] ?> RSD</td>
                                    <td>
                                        <button id=<?php echo $red["id"] ?> type="button" class="btn btn-outline-success btn-sm btn-booking" data-bs-toggle="modal" data-bs-target="#exampleModal">Book</button>
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

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Prijavljivanje</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container prijava-form">
                            <form action="#" method="post" id="dodajForm">
                                <div class="row">
                                    <div class="col-md-11 ">
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
                                                <input type="date" style="border: 1px solid black" name="datumOd" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Datum do</label>
                                                <input type="date" style="border: 1px solid black" name="datumDo" class="form-control" />
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

        <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="js/main.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>

    </html>