<?php

    require_once __DIR__ . '/../helpers.php'; 

    $email = $_POST['email'] ?? null;
    $login = $_POST['login'] ?? null;
    $password = $_POST['password'] ?? null;
    $password_again = $_POST['password_again'] ?? null;

    $_SESSION['validation'] =[];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        add_validation_error('email', 'Указана не правильная почта');
    }

    if (empty($login)){
        add_validation_error('login', 'Это поле не может быть пустым');
    }

    if ($password !== $password_again){
        add_validation_error('password', 'Пароли не совпадают');
    }
    if (empty($password)){
        add_validation_error('password', 'Это поле не может быть пустым');
    }

    if ($_SESSION['validation']) {
        add_old_value('email', $email);
        add_old_value('login', $login);
        redirect(path:'/registration.php');
    }

    $pdo = get_PDO();

    $query = "INSERT INTO user_info (email, login, password) VALUES (:email, :login, :password)";
    $params = [
        ':email' => $email,
        ':login' => $login,
        ':password' => password_hash($password, PASSWORD_DEFAULT)
    ];

    $stmt = $pdo->prepare($query);
    try{
        $stmt ->execute($params);
    }catch (\Exception $e){
        die($e->getMessage());
    }

    redirect(path: '/work_note.php');