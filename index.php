<?php include('./server.php');

session_start();

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
                <a class="delete" href="index.php?delete='1'">Delete Account</a>
            </div>
        </section>
    </main>

</body>
</html>