<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Login</title>
</head>
<body>
    <main>
        <section class="login">
            <h1>Login</h1>
            <form class="login-form" method="post" action="login.php">
                <div class="input-group">
                    <input type="text" name="name" placeholder="Name *" value="<?php echo $name; ?>">
                    <span class="error"><?= $nameError; ?></span>
                </div>
                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password">
                </div>
                <div class="input-group">
                    <button type="submit" class="btn" name="login_user">Login</button>
                </div>
                <p>Not yet a member? <a href="./register.php">Register here</a></p>
            </form>
        </section>
    </main>
</body>
</html>