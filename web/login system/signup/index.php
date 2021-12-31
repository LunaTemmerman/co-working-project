<?php

// Show all errors (for educational purposes)
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

// Constanten (connectie-instellingen databank)
define('DB_HOST', 'localhost');
define('DB_USER', 'LunaTemmerman');
define('DB_PASS', 'BeLeLuRo_!123');
define('DB_NAME', 'accounthost');

date_default_timezone_set('Europe/Brussels');

// Verbinding maken met de databank
try {
    $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Verbindingsfout: ' . $e->getMessage();
    exit;
}

$username = isset($_POST['username']) ? (string)$_POST['username'] : '';
$mail = isset($_POST['mail']) ? (string)$_POST['mail']: '';
$password = isset($POST['password']) ? (string)$_POST['password']: '';
$msgName = '';
$msgMail = '';
$msgPassword = '';
// form is sent: perform formchecking!
if (isset($_POST['btnSubmit'])) {

    $allOk = true;

    // name not empty
    if (trim($username) === '') {
        $msgName = 'Please enter a name';
        $allOk = false;
    }

    if (trim($mail) === '') {
        $msgMail = 'Please enter a birthdate';
        $allOk = false;
    }

    if (trim($password) === '') {
        $msgPassword = 'Please enter a password';
        $allOk = true;
    }

    // end of form check. If $allOk still is true, then the form was sent in correctly
    if ($allOk) {
        $stmt = $db->exec('INSERT INTO login (username, mail, password, added_on) VALUES (\'' . $username . '\',\'' . $mail . '\',\'' . $password . '\',\'' . (new DateTime())->format('Y-m-d H:i:s') . '\')');

        // the query succeeded, redirect to this very same page
        if ($db->lastInsertId() !== 0) {
            header('Location: formchecking.php?name=' . urlencode($username));
            exit();
        } // the query failed
        else {
            echo 'Databankfout.';
            exit;
        }

    }

}

?><!DOCTYPE html>
<html lang="nl">
<head>
    <title>Testform</title>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" type="text/css" href="../../css/styles.css"/>
</head>
<body>
<header>
</header>
<main class="container">
    <section class="firstscreen whitetext">
        <h1>CONTACT</h1>
    </section>
    <section>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <h1>Testform</h1>
            <p class="message">All fields are obligated, unless indicated differently.</p>

            <div>
                <label for="username">your username</label>
                <input type="text" id="username" name="username" value="<?php echo $username; ?>" class="input-text"/>
                <span class="message error"><?php echo $msgName; ?></span>
            </div>

            <div>
                <label for="mail">your e-mail</label>
                <input type="email" id="mail" name="mail" value="<?php echo $mail; ?>" class="input-text"/>
                <span class="message error"><?php echo $msgMail; ?></span>
            </div>

            <div>
                <label for="password">your password</label>
                <input type="text" id="password" name="password" value="<?php echo $password; ?>" class="input-text"/>
                <span class="message error"><?php echo $msgPassword; ?></span>
            </div>

            <input type="submit" id="btnSubmit" name="btnSubmit" value="Submit"/>
        </form>
        <p>Heeft u al een account? <a href="../login">Log hier in.</a></p>
    </section>
</main>
<footer>
</footer>
</body>
</html>
