<?php
session_start();
include 'php/connection.php';

if (!isset($_SESSION['korisnik_id'])) {
    ?>
    <!DOCTYPE html>
    <html lang="sr">
    <head>
        <meta charset="UTF-8">
        <title>Prijava korisnika</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Prijava korisnika</h4>
                    </div>
                    <div class="card-body">
                        <form action="php/log.php" method="POST">
                            <div class="form-group">
                                <label for="email">Email adresa</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Lozinka</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Prijavi se</button>
                        </form>
                        <p class="mt-3 text-center">
                            Nemaš nalog? <a href="register.php">Registruj se</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
    </html>
    <?php
    exit();
}
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Sistem za upravljanje skladištem</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body { margin: 0; background: #f4f6f8; font-family: Arial, sans-serif; }
    
    .container-flex {
        display: flex;
        height: calc(100vh - 60px);
        gap: 20px;
        padding: 20px;
        box-sizing: border-box;
    }

    .left-panel {
        width: 300px;
        padding: 20px;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        border: 1px solid #ddd;
        display: flex;
        flex-direction: column;
    }

    .left-panel h4 {
        margin-bottom: 20px;
        text-align: center;
        font-weight: bold;
    }

    .left-panel .btn {
        width: 100%;
        margin-bottom: 10px;
        border-radius: 8px;
        font-weight: 500;
    }

    .right-panel {
        flex: 1;
        padding: 20px;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        border: 1px solid #ddd;
        overflow-y: auto;
    }

    .right-panel h3 {
        font-weight: 600;
        color: #333;
    }
</style>

</head>
<body>

<?php include 'nav.php'; ?>

<div class="container-flex">
    <div class="left-panel">
        <h4>Zdravo, <?= htmlspecialchars($_SESSION['ime'] ?? 'Korisniče') ?> 👋</h4>

        <button class="btn btn-primary" onclick="loadForm('proizvodi')">➕ Dodaj proizvod</button>
        <button class="btn btn-success" onclick="loadForm('zalihe')">📦 Dodaj zalihu</button>
        <button class="btn btn-warning" onclick="loadForm('narudzbine')">📝 Dodaj narudžbinu</button>
        <button class="btn btn-info" onclick="loadForm('dobavljaci')">🚚 Dodaj dobavljača</button>
    </div>

    <div class="right-panel" id="right-panel">
        <?php
        $stranica = $_GET['stranica'] ?? 'proizvodi';

        $allowed_pages = ['proizvodi','dobavljaci','narudzbine','zalihe','change_password'];

        if (in_array($stranica, $allowed_pages)) {
            include $stranica . '.php';
        } else {
            echo "<h3>Izaberi akciju sa leve strane ili klikni na tab u navigaciji.</h3>";
        }
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
function loadForm(formName) {
    fetch('forma_' + formName + '.php')
        .then(response => response.text())
        .then(html => {
            document.getElementById('right-panel').innerHTML = html;
        })
        .catch(err => {
            console.error('Greška pri učitavanju forme:', err);
            document.getElementById('right-panel').innerHTML = "<p>Forma nije pronađena.</p>";
        });
}

document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('nav a[href^="#"]').forEach(function(a){
        a.addEventListener('click', function(e){
            e.preventDefault();
            var id = this.getAttribute('href').replace('#','');
            if(id) {
                window.location.href = window.location.pathname + '?stranica=' + encodeURIComponent(id);
            }
        });
    });

    if (!window.location.search && window.location.hash) {
        var id = window.location.hash.replace('#','');
        if (id) {
            window.location.href = window.location.pathname + '?stranica=' + encodeURIComponent(id);
        }
    }
});
</script>

</body>
</html>

