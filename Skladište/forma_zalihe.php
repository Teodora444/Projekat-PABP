<?php
// forma_zalihe.php
// Forma za dodavanje zaliha
include 'php/connection.php';
?>

<div class="container mt-4">
    <h2>Dodavanje zaliha</h2>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Unesite podatke o zalihama</h5>
            <form method="POST" action="php/dodaj_zalihe.php">
                <div class="form-group">
                    <label for="proizvod_id">Proizvod</label>
                    <select id="proizvod_id" class="form-control" name="proizvod_id" required>
                        <?php 
                        $proizvodi = $conn->query("SELECT * FROM proizvod");
                        while($p = $proizvodi->fetch_assoc()): ?>
                            <option value="<?= $p['proizvod_id'] ?>"><?= htmlspecialchars($p['naziv']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="kolicina">Količina</label>
                    <input type="number" id="kolicina" class="form-control" name="kolicina" required>
                </div>
                <div class="form-group">
                    <label for="lokacija">Lokacija</label>
                    <input type="text" id="lokacija" class="form-control" name="lokacija" required>
                </div>
                <div class="form-group">
                    <label for="datum_azuriranja">Datum ažuriranja</label>
                    <input type="date" id="datum_azuriranja" class="form-control" name="datum_azuriranja" required>
                </div>
                <button type="submit" name="add_stock" class="btn btn-success">Dodaj zalihu</button>
            </form>
        </div>
    </div>
</div>
