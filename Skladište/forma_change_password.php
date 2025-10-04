<?php
session_start();
$message = $_GET['message'] ?? "";
?>

<h4>Promena lozinke</h4>

<?php if ($message) : ?>
    <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<form method="POST" action="php/change_password.php">
    <div class="form-group">
        <label for="email">Email adresa</label>
        <input type="email" class="form-control" name="email" required>
    </div>
    <div class="form-group">
        <label for="old_password">Stara lozinka</label>
        <input type="password" class="form-control" name="old_password" required>
    </div>
    <div class="form-group">
        <label for="new_password">Nova lozinka</label>
        <input type="password" class="form-control" name="new_password" required>
        <small class="form-text text-muted">Minimalno 6 karaktera.</small>
    </div>
    <button type="submit" class="btn btn-success">Promeni lozinku</button>
</form>
