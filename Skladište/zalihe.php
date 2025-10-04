<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['korisnik_id'])) {
    header("Location: index.php");
    exit();
}

include 'php/connection.php';
include 'php/Zaliha.php';

$zaliha = new Zaliha($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_stock'])) {
    $zaliha->create($_POST);
    header("Location: zalihe.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_stock'])) {
    $zaliha->update($_POST['zaliha_id'], $_POST);
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

if (isset($_GET['delete_id'])) {
    $delete_id = (int)$_GET['delete_id'];
    if ($zaliha->delete($delete_id)) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        echo "Neuspešno brisanje zalihe: " . $conn->error;
    }
}

$zalihe = $zaliha->read();
?>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Proizvod ID</th>
            <th>Količina</th>
            <th>Lokacija</th>
            <th>Datum ažuriranja</th>
            <th>Akcije</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $zalihe->fetch_assoc()): ?>
            <tr>
                <td><?= $row['zaliha_id'] ?></td>
                <td><?= $row['proizvod'] ?> (ID: <?= $row['proizvod_id'] ?>)</td>
                <td><?= $row['kolicina'] ?></td>
                <td><?= $row['lokacija'] ?></td>
                <td><?= $row['datum_azuriranja'] ?></td>
                <td>
                    <form method="POST" class="d-inline">
                        <input type="hidden" name="zaliha_id" value="<?= $row['zaliha_id'] ?>">
                        <input type="number" name="kolicina" value="<?= $row['kolicina'] ?>" required>
                        <input type="text" name="lokacija" value="<?= $row['lokacija'] ?>" required>
                        <input type="hidden" name="datum_azuriranja" value="<?= date('Y-m-d H:i:s') ?>">
                        <button type="submit" name="update_stock" class="btn btn-primary btn-sm">Izmeni</button>
                    </form>
                    <a href="zalihe.php?delete_id=<?= $row['zaliha_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Obrisati?')">Obriši</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</div>

