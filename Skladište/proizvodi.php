<?php

if (!isset($_SESSION['korisnik_id'])) {
    header("Location: index.php");
    exit();
}

include 'php/connection.php';
include 'php/Proizvod.php';

$proizvod = new Proizvod($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $proizvod->create($_POST);
    header("Location: proizvodi.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_product'])) {
    $proizvod->update($_POST['proizvod_id'], $_POST);
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

if (isset($_GET['delete_id'])) {
    $proizvod->delete($_GET['delete_id']);
     header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

$proizvodi = $proizvod->read();
?>


<table class="table table-striped">
    <thead>
    <tr>
        <th>ID</th>
        <th>Naziv</th>
        <th>Opis</th>
        <th>Cena</th>
        <th>Dobavljač</th>
        <th>Akcije</th>
    </tr>
    </thead>
    <tbody>
    <?php while($row = $proizvodi->fetch_assoc()): ?>
        <tr>
            <td><?= $row['proizvod_id'] ?></td>
            <td><?= $row['naziv'] ?></td>
            <td><?= $row['opis'] ?></td>
            <td><?= $row['cena'] ?></td>
            <td><?= $row['dobavljac_id'] ?></td> <!-- ovde -->
            <td>
                <form method="POST" class="d-inline">
                    <input type="hidden" name="proizvod_id" value="<?= $row['proizvod_id'] ?>">
                    <input type="text" name="naziv" value="<?= $row['naziv'] ?>" required>
                    <input type="text" name="opis" value="<?= $row['opis'] ?>" required>
                    <input type="number" step="0.01" name="cena" value="<?= $row['cena'] ?>" required>
                    <input type="number" name="dobavljac_id" value="<?= $row['dobavljac_id'] ?>" required>
                    <button type="submit" name="update_product" class="btn btn-primary btn-sm">Izmeni</button>
                </form>
                <a href="?delete_id=<?= $row['proizvod_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Obrisati?')">Obriši</a>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

</div>


