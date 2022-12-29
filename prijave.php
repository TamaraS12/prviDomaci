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
                                        <button id=<?php echo $red["prijava_id"] ?> type="button" class="btn btn-outline-success btn-sm btn-booking" data-bs-toggle="modal" data-bs-target="#exampleModal">Izmeni</button>
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

        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="js/main.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>

    </html>