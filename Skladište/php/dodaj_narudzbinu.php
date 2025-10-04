<?php
include_once 'connection.php';
include_once 'Narudzbina.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_order'])) {
    $narudzbina = new Narudzbina($conn);

    $data = [
        'proizvod_id' => $_POST['proizvod_id'] ?? 0,
        'datum' => $_POST['datum'] ?? '',
        'kolicina' => $_POST['kolicina'] ?? 0
    ];

    if ($narudzbina->create($data)) {
        header("Location: ../index.php?stranica=narudzbine&msg=uspesno");
        exit();
    } else {
        echo "Greška pri dodavanju narudžbine: " . $conn->error;
    }
}
?>
