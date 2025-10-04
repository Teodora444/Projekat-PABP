<?php

session_start();
include 'connection.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $lozinka = $_POST['password'];

    $sql = "SELECT * FROM korisnik WHERE email = '$email'";
    $rezultat = mysqli_query($conn, $sql);

    if (mysqli_num_rows($rezultat) === 1) {
        $korisnik = mysqli_fetch_assoc($rezultat);
        

        if (password_verify($lozinka, $korisnik['lozinka'])) {
            $_SESSION['korisnik_id'] = $korisnik['korisnik_id'];
            $_SESSION['ime'] = $korisnik['ime'];
            header("Location: ../index.php");
            exit();
        }
    }

    echo "Pogrešna email adresa ili lozinka.";
}
?>
