<div class="container mt-4">
    <h2>Dodavanje narudžbine</h2>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Unesite podatke narudžbine</h5>
            <form method="POST" action="php/dodaj_narudzbinu.php">
                <div class="form-group">
                    <label for="proizvod_id">Proizvod</label>
                    <select id="proizvod_id" class="form-control" name="proizvod_id" required>
                        <?php
                        include_once __DIR__ . '/php/connection.php';
                        $proizvodi = $conn->query("SELECT * FROM proizvod");
                        while ($p = $proizvodi->fetch_assoc()):
                        ?>
                            <option value="<?= $p['proizvod_id'] ?>"><?= htmlspecialchars($p['naziv']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="datum">Datum</label>
                    <input type="date" id="datum" class="form-control" name="datum" required>
                </div>

                <div class="form-group">
                    <label for="kolicina">Količina</label>
                    <input type="number" id="kolicina" class="form-control" name="kolicina" required>
                </div>

                <button type="submit" name="add_order" class="btn btn-success">Dodaj narudžbinu</button>
            </form>
        </div>
    </div>
</div>

