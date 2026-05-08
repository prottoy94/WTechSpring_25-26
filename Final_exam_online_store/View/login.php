<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <div class="container">
            <form method="post" action="../Controller/login_validation.php">
                <label for="username">Username: </label>
                <input type="text" id="username" name="username" required><br><br>

                <label for="password">Password: </label>
                <input type="password" id="password" name="password"><br><br>

                <button type="submit">Login</button><br><br>
            </form>
    </body>
</html>