<?php
include_once 'connection.php';
include_once 'Dobavljac.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_supplier'])) {
    $dobavljac = new Dobavljac($conn);

    $data = [
        'naziv' => $_POST['naziv'] ?? '',
        'kontakt' => $_POST['kontakt'] ?? ''
    ];

    if ($dobavljac->create($data)) {
        header("Location: ../index.php?stranica=dobavljaci&msg=uspesno");
        exit();
    } else {
        echo "Greška pri dodavanju dobavljača: " . $conn->error;
    }
}
?>
