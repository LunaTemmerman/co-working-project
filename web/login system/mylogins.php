<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'luna.temmerman');
define('DB_PASSWORD', '@zerty!123');
define('DB_NAME', 'coproject');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Opvragen van alle taken uit de tabel tasks
$stmt = $db->prepare('SELECT * FROM users ORDER BY added_on DESC');
$stmt->execute();
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);


?><!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <title>Mijn berichten</title>
</head>
<body>
<?php if (sizeof($items) > 0) { ?>
    <ul>
        <?php foreach ($items as $item) { ?>
            <li><?php echo $item['username']; ?>: <?php echo $item['mail']; ?>  <?php echo $item['password']; ?> (<?php echo (new Datetime($item['added_on']))->format('d-m-Y H:i:s'); ?>)</li>
        <?php } ?>
    </ul>
    <?php
} else {
    echo '<p>Nog geen berichten ontvangen.</p>' . PHP_EOL;
}
?>
</body>
