<?php
include 'php/connection.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ime = trim($_POST['ime']);
    $prezime = trim($_POST['prezime']);
    $email = trim($_POST['email']);
    $lozinka = trim($_POST['lozinka']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Email format nije validan.";
    } elseif (strlen($lozinka) < 6) {
        $message = "Lozinka mora imati najmanje 6 karaktera.";
    } else {
        $hash_lozinka = password_hash($lozinka, PASSWORD_DEFAULT);

        $sql_check = "SELECT * FROM korisnik WHERE email='$email'";
        $result = $conn->query($sql_check);

        if ($result->num_rows > 0) {
            $message = "Email već postoji. Molimo prijavite se ili koristite drugi email.";
        } else {
            $sql = "INSERT INTO korisnik (ime, prezime, email, lozinka) 
                    VALUES ('$ime', '$prezime', '$email', '$hash_lozinka')";

            if ($conn->query($sql) === TRUE) {
                $message = "✅ Uspešno ste registrovali korisnika. <a href='index.php'>Prijavite se</a>";
            } else {
                $message = "Greška: " . $conn->error;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Registracija</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Registracija korisnika</h5>
            <?php if ($message) echo "<div class='alert alert-info'>$message</div>"; ?>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="ime">Ime</label>
                    <input type="text" class="form-control" name="ime" required>
                </div>
                <div class="form-group">
                    <label for="prezime">Prezime</label>
                    <input type="text" class="form-control" name="prezime" required>
                </div>
                <div class="form-group">
                    <label for="email">Email adresa</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label for="lozinka">Lozinka (min. 6 karaktera)</label>
                    <input type="password" class="form-control" name="lozinka" required>
                </div>
                <button type="submit" class="btn btn-success">Registruj se</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>

