<?php

    include_once "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Reset your password</h1>
    <p>An e-mail will be send to your with instructions on how to reset your password</p>
    <form action="includes/reset-request.inc.php" method="post">
        <input type="text" name="email" placeholder= "Enter your e-mail address...">
        <br><br>
        <button type="submit" name="reset-request-submit">Recive new password</button>
    </form>
        <?php
            if (isset($_GET["reset"])) {  //Proveravamo da li get[reset]  success
                if ($_GET["reset"] == "success") {
                    echo '<p class="signupsuccess">Chechk your e-mail!</p>';
                }
            }
        ?>
</body>
</html>