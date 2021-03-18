<?php include('./server.php');
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Register</title>
</head>
<body>
    <main class="register-container">
        <section class="register">
            <h1>Create an account</h1>
            <form class="register-form" method="post" action="register.php">
                <div class="input-group">
                    <input type="text" name="name" placeholder="Name *" value="<?php showWithoutBackslashes($name); ?>">
                    <span class="error"><?= $nameError; ?></span>
                </div>
                <div class="input-group">
                    <input type="text" name="signature" placeholder="Signature" value="<?= showWithoutBackslashes($signature); ?>">
                    <span class="error"><?= $signatureError; ?></span>
                </div>
                <div class="input-group">
                    <input type="email" name="email" placeholder="Email *" value="<?php echo $email; ?>">
                    <span class="error"><?= $emailError; ?></span>
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Password *">
                    <span class="error"><?= $passwordError; ?></span>
                </div>
                <div class="input-group">
                    <button type="submit" class="btn" name="register_user">Register</button>
                </div>
                <p class="go-to-login">Alrealdy have an account? <a href="./login.php">Login here.</a></p>
            </form>
        </section>
    </main>
</body>
</html>