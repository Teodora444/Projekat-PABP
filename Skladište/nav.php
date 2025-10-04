<?php
$currentPage = $_GET['stranica'] ?? 'proizvodi';
?>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #007bff;">
    <a class="navbar-brand" href="#">Skladište</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link <?= ($currentPage == 'proizvodi') ? 'active' : '' ?>" href="index.php?stranica=proizvodi">Proizvodi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($currentPage == 'dobavljaci') ? 'active' : '' ?>" href="index.php?stranica=dobavljaci">Dobavljači</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($currentPage == 'narudzbine') ? 'active' : '' ?>" href="index.php?stranica=narudzbine">Narudžbine</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($currentPage == 'zalihe') ? 'active' : '' ?>" href="index.php?stranica=zalihe">Zalihe</a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <?php if (isset($_SESSION['korisnik_id'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="php/logout.php">Odjavi se (<?= $_SESSION['ime'] ?>)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($currentPage == 'change_password') ? 'active' : '' ?>" href="index.php?stranica=change_password">Promeni lozinku</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>




