<?php
session_start();
require_once '../db.php';
require_once '../models/User.php';

$userModel = new User($pdo);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($userModel->login($_POST['username'], $_POST['password'])) {
        $_SESSION['admin'] = true;
        header('Location: admin.php');
        exit;
    } else {
        $error = "Invalid credentials";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <?= isset($error) ? "<p>$error</p>" : "" ?>
</body>

</html>