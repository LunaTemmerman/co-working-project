<?php

// Show all errors (for educational purposes)
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

// Constanten (connectie-instellingen databank)
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'BeLeLuRo');
define('DB_NAME', 'filmreviewacc');

date_default_timezone_set('Europe/Brussels');

// Verbinding maken met de databank
try {
    $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Verbindingsfout: ' . $e->getMessage();
    exit;
}

$name = isset($_POST['name']) ? (string)$_POST['name'] : '';
$mail = isset($_POST['mail']) ? (string)$_POST['mail']: '';
$birth = isset($POST['birth']) ? (string)$_POST['birth']: '';
$password = isset($POST['password']) ? (string)$_POST['password']: '';
$msgName = '';
$msgMail = '';
$msgBirth = '';
$msgPassword = '';
// form is sent: perform formchecking!
if (isset($_POST['btnSubmit'])) {

    $allOk = true;

    // name not empty
    if (trim($name) === '') {
        $msgName = 'Please enter a name';
        $allOk = false;
    }

    if (trim($mail) === '') {
        $msgMail = 'Please enter an email adress';
        $allOk = false;
    }

    if (trim($mail) === '') {
        $msgMail = 'Please enter a birthdate';
        $allOk = false;
    }

    if (trim($password) === '') {
        $msgPassword = 'Please enter a password';
        $allOk = false;
    }

    // end of form check. If $allOk still is true, then the form was sent in correctly
    if ($allOk) {
        $stmt = $db->exec('INSERT INTO login (sender, mail, birth, password, added_on) VALUES (\'' . $name . '\',\'' . $mail . '\',\'' . $birth . '\',\'' . $password . '\',\'' . (new DateTime())->format('Y-m-d H:i:s') . '\')');

        // the query succeeded, redirect to this very same page
        if ($db->lastInsertId() !== 0) {
            header('Location: formchecking_thanks.php?name=' . urlencode($name));
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
    <link rel="stylesheet" type="text/css" href="styles.css"/>
</head>
<body>
<header>
</header>
<main class="container">
    <section class="firstscreen whitetext">
        <h1>CONTACT</h1>
    </section>
    <section class="flexcontainer twelve">
        <div class="childcolumn eight blacktext">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <h1>Testform</h1>
                <p class="message">All fields are obligated, unless indicated differently.</p>

                <div>
                    <label for="name">your name</label>
                    <input type="text" id="name" name="name" value="<?php echo $name; ?>" class="input-text"/>
                    <span class="message error"><?php echo $msgName; ?></span>
                </div>

                <div>
                    <label for="mail">your e-mail</label>
                    <input type="email" id="mail" name="mail" value="<?php echo $mail; ?>" class="input-text"/>
                    <span class="message error"><?php echo $msgMail; ?></span>
                </div>

                <div>
                    <label for="message">your birthdate</label>
                    <input type="date" id="birth" name="birth" value="<?php echo $birth; ?>" class="input-text"/>
                    <span class="message error"><?php echo $msgBirth; ?></span>
                </div>

                <div>
                    <label for="name">your password</label>
                    <input type="text" id="password" name="password" value="<?php echo $password; ?>" class="input-text"/>
                    <span class="message error"><?php echo $msgPassword; ?></span>
                </div>

                <input type="submit" id="btnSubmit" name="btnSubmit" value="Submit"/>
            </form>
        </div    </section>
</main>
<footer>
</footer>
</body>
</html>
