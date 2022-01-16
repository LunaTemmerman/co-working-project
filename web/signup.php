<?php
// Include config file
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'luna.temmerman');
define('DB_PASSWORD', '@zerty!123');
define('DB_NAME', 'coproject');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($link === false) {
    die("ERROR: Kon niet verbinden: " . mysqli_connect_error());
}

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "De gebruikersnaam kan enkel letters, nummers en lage streepjes bevatten!";
    } else{
        $sql = "SELECT id FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = trim($_POST["username"]);

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Deze gebruikersnaam is al in gebruik!";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops, er liep iets mis! Probeer later opnieuw...";
            }

            mysqli_stmt_close($stmt);
        }
    }

    if(empty(trim($_POST["mail"]))) {
        $mail_err = "Vul een email in!";
    } else {
        $mail = trim($_POST["mail"]);
    }

    if(empty(trim($_POST["password"]))){
        $password_err = "Vul een wachtwoord in!";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Het wachtwoord moet minstens 6 karakters bevatten!";
    } else{
        $password = trim($_POST["password"]);
    }

    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Bevestig uw wachtwoord aub!";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Wachtwoorden komen niet overeen!";
        }
    }

    if(empty($username_err) && empty($mail_err) && empty($password_err) && empty($confirm_password_err)){

        $sql = "INSERT INTO users (username, mail, password) VALUES (?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_mail, $param_password);

            $param_username = $username;
            $param_mail = $mail;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            if(mysqli_stmt_execute($stmt)){
                header("location: ./login.php");
            } else{
                echo "Oops, er ging iets mis! Probeer later opnieuw...";
            }

            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
<?php
include_once './header.php';
?>
<div class="wrapper">
    <h2>Registreer</h2>
    <p>Vul dit formulier in om een account te maken.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>Gebruikersnaam
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </label>
        </div>
        <div class="form-group">
            <label>Email
                <input type="email" name="mail" class="form-control <?php echo (!empty($mail_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $mail; ?>">
                <span class="invalid-feedback"><?php echo $mail_err; ?></span>
            </label>
        </div>
        <div class="form-group">
            <label>Wachtwoord
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </label>
        </div>
        <div class="form-group">
            <label>Herhalen wachtwoord
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </label>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-secondary ml-2" value="Reset">
        </div>
        <p>Heeft u al een account? <a href="./login.php">Log dan hier in!</a>.</p>
    </form>
</div>
</body>
</html>