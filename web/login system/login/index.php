<?php
include "connection.php";
?>
<html>
<head>
    <title>login</title>
    <link type="text/css"  href="#" >
</head>
<body>
<header>
    <h1>Log in</h1>
    <ul>
        <li>
            <label>Gebruikersnaam:</label>
            <input type="text" name="username" value="" required>
        </li>
        <li>
            <label>Voornaam en naam:</label>
            <input type="text" name="nickname" value="" required>
        </li>
        <li>
            <label>Geboortedatum:</label>
            <input type="date" name="age" value="" required>
        </li>
        <li>
            <label>Wachtwoord:</label>
            <input type="text" name="password" value="" required>
        </li>
        <li>
            <label>Wachtwoord herhalen:</label>
            <input type="text" name="password" value="" required>
        </li>
    </ul>
</header>
<main>

</main>
<footer>

</footer>
</body>
</html>
