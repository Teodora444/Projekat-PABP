<?php
// forma_dobavljaci.php
// Forma za dodavanje dobavljača
?>

<div class="container mt-4">
    <h2>Dodavanje dobavljača</h2>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Unesite podatke dobavljača</h5>
            <form method="POST" action="php/dodaj_dobavljaca.php">
                <div class="form-group">
                    <label for="naziv">Naziv</label>
                    <input type="text" id="naziv" class="form-control" name="naziv" required>
                </div>
                <div class="form-group">
                    <label for="kontakt">Kontakt</label>
                    <input type="text" id="kontakt" class="form-control" name="kontakt" required>
                </div>
                <button type="submit" name="add_supplier" class="btn btn-success">Dodaj dobavljača</button>
            </form>
        </div>
    </div>
</div>
