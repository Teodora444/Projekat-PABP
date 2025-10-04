<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['korisnik_id'])) {
    header("Location: index.php");
    exit();
}

include 'php/connection.php';
include 'php/Narudzbina.php';

$narudzbina = new Narudzbina($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_order'])) {
    $narudzbina->create($_POST);
    header("Location: narudzbine.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_order'])) {
    $narudzbina->update($_POST['narudzbina_id'], $_POST);
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

if (isset($_GET['delete_id'])) { 
    $delete_id = (int)$_GET['delete_id'];
    if ($narudzbina->delete($delete_id)) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        echo "Neuspešno brisanje narudžbine: " . $conn->error;
    }
}
$narudzbine = $narudzbina->read();
?>


<table class="table table-striped">
    <thead>
    <tr>
        <th>ID</th>
        <th>Proizvod</th>
        <th>Datum</th>
        <th>Količina</th>
        <th>Akcije</th>
    </tr>
    </thead>
    <tbody>
    <?php while($row = $narudzbine->fetch_assoc()): ?>
        <tr>
            <td><?= $row['narudzbina_id'] ?></td>
            <td><?= htmlspecialchars($row['naziv']) ?></td>
            <td><?= $row['datum'] ?></td>
            <td><?= $row['kolicina'] ?></td>
            <td>
                <form method="POST" class="d-inline">
                    <input type="hidden" name="narudzbina_id" value="<?= $row['narudzbina_id'] ?>">
                    <input type="date" name="datum" value="<?= $row['datum'] ?>" required>
                    <input type="number" name="kolicina" value="<?= $row['kolicina'] ?>" required>
                    <button type="submit" name="update_order" class="btn btn-primary btn-sm">Izmeni</button>
                </form>
                <a href="narudzbine.php?delete_id=<?= $row['narudzbina_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Obrisati?')">Obriši</a>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

</div>
