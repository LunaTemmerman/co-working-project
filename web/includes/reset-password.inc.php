<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'luna.temmerman');
define('DB_PASSWORD', '@zerty123!');
define('DB_NAME', 'coproject');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Vul een nieuw wachtwoord in.";
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Het wachtwoord moet minstens 6 karakters bevatten.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }

    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Bevestig uw wachtwoord aub.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Wachtwoorden komen niet overeen!";
        }
    }

    if(empty($new_password_err) && empty($confirm_password_err)){
        $sql = "UPDATE `users` SET `password`=? WHERE `id`=?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);

            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];

            if(mysqli_stmt_execute($stmt)){
                session_destroy();
                header("location: ../login.php");
                exit();
            } else{
                echo "Oop, er liep iets mis! Probeer later opnieuw...";
            }

            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($link);

}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film Review - Reset Password</title>
    <script src="../js/index.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="shortcut icon" href="../img/logo.png" type="image/png">
</head>
<body>
<?php
include_once './headersub.php';
?>
<main>
    <div class="container ms-2">
        <div class="row">
            <h2>Wachtwoord resetten</h2>
            <p>Vul dit formulier in om uw wachtwoord te resetten.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="col">
                <div class="form-group">
                    <label>Nieuw wachtwoord
                        <input type="password" name="new_password" class="form-control mb-3 <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                        <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
                    </label>
                </div>
                <div class="form-group">
                    <label>Herhaal nieuw wachtwoord
                        <input type="password" name="confirm_password" class="form-control mb-3 <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                    </label>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a class="btn btn-link ml-2 mb-3" href="welcome.inc.php">Annuleren</a>
                </div>
            </form>
        </div>
    </div>
</main>
<?php
include_once '../footer.php'
?>
</body>
</html>