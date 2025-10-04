<?php
session_start();

if (isset($_SESSION['korisnik_id'])) {
    session_unset(); 
    session_destroy(); 
}

header("Location: /Skladište/index.php");
exit();
?>

