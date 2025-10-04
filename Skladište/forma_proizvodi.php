<?php
// forma_proizvodi.php
// Forma za dodavanje proizvoda
?>

<div class="container mt-4">
    <h2>Dodavanje proizvoda</h2>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Unesite podatke o proizvodu</h5>
            <form method="POST" action="php/dodaj_proizvod.php">
                <div class="form-group">
                    <label for="naziv">Naziv</label>
                    <input type="text" id="naziv" class="form-control" name="naziv" required>
                </div>
                <div class="form-group">
                    <label for="opis">Opis</label>
                    <textarea id="opis" class="form-control" name="opis" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="cena">Cena</label>
                    <input type="number" step="0.01" id="cena" class="form-control" name="cena" required>
                </div>
                <div class="form-group">
    <label for="dobavljac_id">Dobavljač</label>
    <select id="dobavljac_id" class="form-control" name="dobavljac_id" required>
        <?php
        include_once __DIR__ . '/php/connection.php';

        $dobavljaci = $conn->query("SELECT dobavljac_id, naziv FROM dobavljac");

        if ($dobavljaci && $dobavljaci->num_rows > 0) {
            while ($d = $dobavljaci->fetch_assoc()) {
                echo "<option value='" . htmlspecialchars($d['dobavljac_id']) . "'>" . htmlspecialchars($d['naziv']) . "</option>";
            }
        } else {
            echo "<option disabled>Nema dobavljača</option>";
        }
        ?>
    </select>
</div>


<button type="submit" name="add_product" class="btn btn-success">Dodaj proizvod</button>
            </form>
        </div>
    </div>
</div>


