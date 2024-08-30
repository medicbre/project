<?php
    include_once "classes/passwordReset-contr.classes.php";
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
    
<?php
var_dump($_GET);
    // Proveravamo da li postoje tokeni u URL-u pre nego što im pristupimo
    if (isset($_GET["selector"]) && isset($_GET["validator"])) 
    {
        //Proveravamo da li postoji token u URL-u
        $selector = $_GET["selector"];
        $validator = $_GET["validator"]; //validator je token kojim validujemo usera

        //Proveravamo da li tokeni postoje u URL-u
        if (empty($selector) || empty($validator)) {
            echo "Could not validate your request!";
        }
        else {
            //Proveravamo da li je hexadecimalni token zapravo hexadecimalan
            if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) { //Proveravamo da li nije jednak false
?>

            <form action="includes/reset-password.inc.php" method="post">
                <input type="hidden" name="selector" value="<?php echo htmlspecialchars($selector); ?>">

                <input type="hidden" name="validator" value="<?php echo htmlspecialchars($validator); ?>">

                <input type="password" name="pwd" placeholder="Enter a new password...">
                
                <input type="password" name="pwd-repeat" placeholder="Repeat new password...">

                <button type="submit" name="reset-password-submit">Reset password</button>

            </form>
<?php
        
            }
        }
    }
    else {
        // Ako nisu postavljeni u URL-u, prikazujemo poruku o grešci
        throw new Exception("Invalid request. Missing tokens.");
        //echo "Invalid request. Missing tokens.";
    }
?>
</body>
</html>
