<?php include('server.php') 

//IF YOU DELETE YOUR ACCOUNT?, BACK TO LOGIN PAGE
if (isset($_GET['delete'])) {
    killSessionAndRedirect();
    deleteAccount();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Delete account</title>
</head>
<body>
    <main class="delete-container">
        <section class="delete">
            <h1>Delete your account?</h1>
            <form class="delete-form" method="get" action="delete-account.php">
                <a href="delete-account.php?delete='1'">Delete</a>
            </form>
        </section>
    </main>
</body>
</html>