<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>signup</title>
</head>
<body>
<header>

</header>
<main>
    <h1>Maak een account</h1>
    <p>Vul de velden in</p>
    <form>
        <label for="username">Begruikersnaam:</label>
        <input type="text" id="username" name="username">
        <label for="birthdate">Geboortedatum:</label>
        <input type="date" id="birthdate" name="birthdate">
        <label for="password">Wachtwoord:</label>
        <input type="text" id="password" name="password">
        <label for="hpass">Herhaling wachtwoord:</label>
        <input type="text" id="hpass" name="hpass">
        <input type="submit" name="Submit" id="Submit" value="Submit">
    </form>
</main>
<footer>

</footer>
</body>
</html>

<?php
$servername="localhost";
$username="root";
$password="BeLeLuRo123";
$database="filmreviewacc";
$conn = new mysqli($servername,$username,$password,$database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$username=$_POST['username'];
$password=$_POST['password'];
$birthdate=$_POST['birthdate'];

$sql = "INSERT INTO `login` (`Id`, `username`, `password`, `birthdate`) VALUES ('0', '$username', '$password', '$birthdate')";
$rs = mysqli_query($conn, $sql);

if($rs)
{
    echo "Contact Records Inserted";
}

?>