<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['korisnik_id'])) {
    header("Location: index.php");
    exit();
}

include 'php/connection.php';
include 'php/Dobavljac.php';

$dobavljac = new Dobavljac($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_supplier'])) {
    $dobavljac->create($_POST);
    header("Location: dobavljaci.php"); 
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_supplier'])) {
    $dobavljac->update($_POST['dobavljac_id'], $_POST);
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

if (isset($_GET['delete_id'])) {
      var_dump($_GET['delete_id']); 
    if ($dobavljac->delete($_GET['delete_id'])) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {
        echo "Neuspešno brisanje dobavljača.";
    }
    exit();
}

$dobavljaci = $dobavljac->read();
?>


    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Naziv</th>
            <th>Kontakt</th>
            <th>Akcije</th>
        </tr>
        </thead>
        <tbody>
        <?php while($row = $dobavljaci->fetch_assoc()): ?>
            <tr>
                <td><?= $row['dobavljac_id'] ?></td>
                <td><?= $row['naziv'] ?></td>
                <td><?= $row['kontakt'] ?></td>
                <td>
                    <form method="POST" action="" class="d-inline">
                        <input type="hidden" name="dobavljac_id" value="<?= $row['dobavljac_id'] ?>">
                        <input type="text" name="naziv" value="<?= $row['naziv'] ?>" required>
                        <input type="text" name="kontakt" value="<?= $row['kontakt'] ?>" required>
                        <button type="submit" name="update_supplier" class="btn btn-primary btn-sm">Izmeni</button>
                    </form>

                    <a href="dobavljaci.php?delete_id=<?= $row['dobavljac_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Da li ste sigurni da želite da obrišete ovog dobavljača?')">Obriši</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

