<?php

include 'php/connection.php';

if (!isset($_SESSION['korisnik_id'])) {
    header("Location: index.php");
    exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Unesite ispravan format email adrese.";
    }
    elseif (strlen($new_password) < 6) {
        $message = "Lozinka mora imati najmanje 6 karaktera.";
    } else {
        $sql = "SELECT * FROM korisnik WHERE korisnik_id = ? AND email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $_SESSION['korisnik_id'], $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $korisnik = $result->fetch_assoc();

            if (password_verify($old_password, $korisnik['lozinka'])) {
                $new_hashed = password_hash($new_password, PASSWORD_DEFAULT);

                $update = $conn->prepare("UPDATE korisnik SET lozinka = ? WHERE korisnik_id = ?");
                $update->bind_param("si", $new_hashed, $_SESSION['korisnik_id']);

                if ($update->execute()) {
                    $message = "✅ Lozinka uspešno promenjena!";
                } else {
                    $message = "Došlo je do greške prilikom promene lozinke.";
                }
            } else {
                $message = "Stara lozinka nije tačna.";
            }
        } else {
            $message = "Email adresa nije pronađena.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Promena lozinke</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>


<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Promena lozinke</h5>

            <?php if ($message) : ?>
                <div class="alert alert-info"><?= $message ?></div>
            <?php endif; ?>

            <form method="POST" action="">
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
        </div>
    </div>
</div>
</body>
</html>

