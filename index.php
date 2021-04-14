<?php include('./server.php');

session_start();

//IF YOU'RE NOT CONNECTED, BACK TO LOGIN PAGE
if (!isset($_SESSION['name'])) {
    header('location: login.php');
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
                <p class="name"><?= showWithoutBackslashes($_SESSION['name']) ?></p>
                <p class="signature"><?= showWithoutBackslashes($_SESSION['signature']) ?></p>
                <a class="logout" href="index.php?logout='1'">Log Out</a>
                <a class="delete" href="index.php?delete-verification='1'">Delete Account</a>
            </div>
            <?php  if (isset($_GET['delete-verification'])) { ?>
                <div class="delete-content">
                    <h3 class="delete-title">Delete your account?</h3>
                    <p class="delete-warn">This action is definitive</p>
                    <div class="delete-actions">
                        <a class="delete-back-btn" href="index.php">No, nevermind</a>
                        <a class="delete-yes-btn" href="index.php?delete='1'">delete</a>
                    </div>
                </div>
            <?php } ?>
        </section>
    </main>

</body>
</html>