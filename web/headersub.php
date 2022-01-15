<?php
session_start();
?>

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="../">
                <img width="40" src="../img/logo.png" alt="logo">
                Film reviews</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../">Home</a>
                    </li>
                    <?php
                    if (isset($_SESSION["id"])) {
                        echo "<li class='nav-item'><a href='../../profile.php'>Profiel pagina</a></li>";
                        echo "<li class='nav-item'><a href='../../includes/logout.inc.php'>Log out</a></li>";
                        echo "<li class='nav-item'><a href='../../includes/reset-password.inc.php'>Wachtwoord resetten</a></li>";
                    }
                    else {
                        echo "<li class='nav-item'><a href='../../login.php'>Login</a></li>";
                        echo "<li class='nav-item'><a href='../../signup.php'>Registreer</a></li>";
                    }
                    ?>
                </ul>
                <form class="d-flex" action="javascript:searchBox('home')" method="post">
                    <input class="form-control me-2" type="search" placeholder="Zoek naar een film" aria-label="Search" id="query">
                    <button class="btn btn-outline-dark" type="submit">🔎︎</button>
                </form>
            </div>
        </div>
    </nav>
</header>