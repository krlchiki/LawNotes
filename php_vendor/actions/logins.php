<?php

    require_once __DIR__ . '/../helpers.php'; 

    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    if (empty($email) || filter_var($email, FILTER_VALIDATE_EMAIL) === false){
        add_old_value('email', $email);
        add_validation_error('error', 'Неверный формат электронной почты');
        add_old_value('email', $email);
        set_message('error', 'Указана не правильная почта');
        redirect(path: '/login.php');
    }

    $user = find_user($email);

    if (!$user){
        set_message('error', "Пользователь $email не найден");
        redirect(path: '/login.php');
    }

    if (!password_verify($password, $user['password'])){
        set_message('error', 'Неверный пароль');
        redirect(path: '/login.php');
    }

    $_SESSION['user']['id'] = $user['id'];

    redirect(path: '/work_note.php');