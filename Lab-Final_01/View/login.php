<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/style.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h2>Login Form</h2>
        <form method="post" action="../Controller/loginValidation.php">
            
                <label for="name">User Name: <label>
                <input type="text" name="name" required><br><br>

                <label for="password">Password: <label>
                <input type="password" name="password" required><br><br>
                <button type="submit">Login</button>
        </form>
    </div>
    
</body>
</html>
