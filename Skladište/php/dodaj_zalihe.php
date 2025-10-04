<?php
include_once 'connection.php';
include_once 'Zaliha.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_stock'])) {
    $zaliha = new Zaliha($conn);

    $data = [
        'proizvod_id' => $_POST['proizvod_id'] ?? 0,
        'kolicina' => $_POST['kolicina'] ?? 0,
        'lokacija' => $_POST['lokacija'] ?? '',
        'datum_azuriranja' => date('Y-m-d H:i:s')
    ];

    if ($zaliha->create($data)) {
        header("Location: ../index.php?stranica=zalihe&msg=uspesno");
        exit();
    } else {
        echo "Greška pri dodavanju zaliha: " . $conn->error;
    }
}
?>
