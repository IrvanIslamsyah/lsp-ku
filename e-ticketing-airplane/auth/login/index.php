<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div class="kotak-login">
        <h3>E - Ticketing</h3>
        <h4>Login Your Account</h4>

        <form action="process.php" method="POST">
            <label for="username">Username</label><br>
            <input type="text" name="username" id="username"><br><br>

            <label for="password">Password</label><br>
            <input type="password" name="password" id="password"><br><br>

            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>