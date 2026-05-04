<?php
session_start();

include "../Model/db.php";

if(!isset($_SESSION["name"]) || !isset($_SESSION["password"]))
{
    Header("Location: ../View/login.php");
    exit();
}

$database = new db();
$connection = $database->connection();
$result = $database->signin($connection, "registration", $_SESSION["name"], $_SESSION["password"]);

$uploadedFilePath = "";
if($result && $result->num_rows > 0)
{
    $userData = $result->fetch_assoc();
    $uploadedFilePath = $userData["filepath"] ?? "";
}

$escapedFilePath = htmlspecialchars($uploadedFilePath);
$fileName = $uploadedFilePath !== "" ? htmlspecialchars(basename($uploadedFilePath)) : "";
$extension = strtolower(pathinfo($uploadedFilePath, PATHINFO_EXTENSION));
$isImage = in_array($extension, ["jpg", "jpeg", "png", "gif", "webp"], true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
<body>
    <h2>
        Welcome <?php echo htmlspecialchars($_SESSION["name"]); ?> to your Dashboard 
    </h2>
    <?php if($uploadedFilePath !== ""): ?>
        <p>Uploaded file: <a href="<?php echo $escapedFilePath; ?>" target="_blank"><?php echo $fileName; ?></a></p>
        <?php if($isImage): ?>
            <img src="<?php echo $escapedFilePath; ?>" alt="Uploaded file" style="max-width: 320px; height: auto; border: 1px solid #ccc; padding: 4px;">
        <?php endif; ?>
    <?php else: ?>
        <p>No uploaded file found in database for this account.</p>
    <?php endif; ?>
    <br><br>
    <button><a href="login.php">Logout</a></button><br><br>
    <button><a href="Registration.php">Go to Registration Page</a></button>
</body>
</html>