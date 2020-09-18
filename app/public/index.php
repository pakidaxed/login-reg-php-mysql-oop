<?php
require '../bootloader.php';
$action = $_GET['action'] ?? '';

if ($action === 'register' && is_logged_in()) header('Location: secure.php');
if ($action === 'login' && is_logged_in()) header('Location: secure.php');

if (isset($_POST['submit']) && $action === 'register') {
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    $newUser = new UserValidate($_POST);
    $errors = $newUser->validateRegister();

    if (!$errors) {
        $user = new User();
        $user->setData($_POST);
        $userExists = $user->userExists($_POST['email'], $errors['email']);
        if (!$userExists) {
            $reg_success = $user->userRegister();
        }
    }
}
if (isset($_POST['submit']) && $action === 'login') {
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    $checkUser = new UserValidate($_POST);
    $errors = $checkUser->validateLogin();

    if (!$errors) {
        $user = new User();
        $user->setData($_POST);
        $userLogin = $user->userLogin();
        if ($userLogin) {
            header('Location: secure.php');
        } else {
            $errors['login'] = 'Login failed';
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>intellectus.lt - REGISTER/LOGIN</title>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
<?php
require '../templates/header/nav.php';
?>
<div class="container">
    <?php
    switch ($action) {
        case 'login':
            require '../templates/login.php';
            break;
        case 'register':
            require '../templates/register.php';
            break;
        case 'logout':
            require '../templates/logout.php';
            break;
        case 'secret':
            require '../templates/secret.php';
            break;
        default:
            require '../templates/main.php';
    }
    ?>
</body>
</html>
