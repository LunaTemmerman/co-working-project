<?php

$username = isset($_GET['username']) ? $_GET['username'] : false;

?><!DOCTYPE html>
<html lang="en">
<head>
    <title>Testform</title>
    <meta charset="UTF-8" />
</head>
<body>

<?php

// Name sent in
if ($username) {
    echo '<p>Thank you ' . htmlentities($username). '</p>';
}

// Nothing sent in
else {
    echo '<p>Thank you, stranger</p>';
}

?>

<div id="debug">

    <?php

    /**
     * Helper Functions
     * ========================
     */

    /**
     * Dumps a variable
     * @param mixed $var
     * @return void
     */
    function dump($var) {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    }


    /**
     * Main Program Code
     * ========================
     */

    // dump $_GET
    dump($_GET);

    ?>

</div>

</body>
</html>
