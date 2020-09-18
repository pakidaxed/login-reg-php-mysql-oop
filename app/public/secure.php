<?php
require '../bootloader.php';
if (!is_logged_in()) header('Location: index.php?action=login');
$action = $_GET['action'] ?? '';

$user = new User();
$user_data = $user->getUser($_SESSION['email']);

if ($action === 'logout') {
    $user->logout();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SECURE PAGE</title>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
<?php
require '../templates/header/nav.php';
?>
<div class="container">
<h1>Hello, <?= $user_data['name'] ?></h1>
    <h3>Your info:</h3>
    <ul>
        <li>Email: <?= $user_data['email']; ?></li>
        <li>First name: <?= $user_data['name']; ?></li>
        <li>Last name: <?= $user_data['last_name']; ?></li>
        <li>Phone: <?= $user_data['phone']; ?></li>
        <li>Secure password: <?= $user_data['password']; ?></li>
        <li>Registered: <?= $user_data['registered_at']; ?></li>
        <li>Last Login: <?= $user_data['last_login_at']; ?></li>
    </ul>
    <h3>And here is the code:</h3>
    <a class="btn-download" href="#">Download</a>
</div>
</body>
</html>