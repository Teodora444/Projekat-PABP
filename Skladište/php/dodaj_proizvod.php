<?php
include_once 'connection.php';
include_once 'Proizvod.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $proizvod = new Proizvod($conn);

    $data = [
        'naziv' => $_POST['naziv'] ?? '',
        'opis' => $_POST['opis'] ?? '',
        'cena' => $_POST['cena'] ?? 0,
        'dobavljac_id' => $_POST['dobavljac_id'] ?? 0
    ];

    if ($proizvod->create($data)) {
        header("Location: ../index.php?stranica=proizvodi&msg=uspesno");
        exit();
    } else {
        echo "Greška pri dodavanju proizvoda: " . $conn->error;
    }
}
?>

