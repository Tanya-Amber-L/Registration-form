<?php include('./server.php');
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['name'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout-btn'])) {
    session_destroy();
    unset($_SESSION['name']);
    unset($_SESSION['signature']);
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Registration form</title>
</head>
<body>

    <main>
        <section class="profile">
            <div class="profile-banner">
                <h1>Your Profile</h1>
            </div>
            <div class="profile-content">
                <h2 class="profile-info-title">Your profile information</h2>
                <p class="name"><?= $_SESSION['name'] ?></p>
                <p class="signature"><?= $_SESSION['signature'] ?></p>
                <button type="submit" class="logout-btn" name="logout_user">Log Out</button>
            </div>
        </section>
    </main>

</body>
</html>