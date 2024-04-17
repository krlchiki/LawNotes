<?php

session_start();

require_once __DIR__ . '/config.php';

function redirect(string $path){
    header("Location: $path");
    die();
}

function has_validation(string $field_name):bool{
    return isset($_SESSION['validation'][$field_name]);
}

function validation_error_attr(string $field_name){
    echo isset($_SESSION['validation'][$field_name]) ? 'aria-invalid="true"' : '';
}

function validation_error_message(string $field_name){
    $message = $_SESSION['validation'][$field_name] ?? '';
    unset($_SESSION['validation'][$field_name]);
    return $message;
    
}

function add_validation_error(string $field_name, string $message){
    $_SESSION['validation'][$field_name] = $message;
}

function add_old_value(string $key, mixed $value){
    $_SESSION['old'][$key] = $value;
}

function old (string $key){
    $value = $_SESSION['old'][$key] ?? '';
    unset($_SESSION['old'][$key]);
    return $value;
}

function get_PDO(): PDO{
    try{
        return new \PDO(
            'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
    }catch (\PDOException $e){
        die($e->getMessage());
    }
}

// redirect(path: '/login.php');

function set_message (string $key,string $message): void{
    $_SESSION['message'][$key] = $message;
}

function has_message (string $key): bool{
    return isset($_SESSION['message'][$key]);
}

function get_message (string $key): string{
    $message = $_SESSION['message'][$key] ?? '';
    unset($_SESSION['message'][$key]);
    return $message;
}

function find_user(string $email) : array|bool
{
    $pdo = get_PDO();

    $stmt = $pdo->prepare("SELECT * FROM `user_info` WHERE `email` = :email");
    $stmt->execute(['email' => $email]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
}

function current_user() : array|false
{
    $pdo = get_PDO();

    if (!isset($_SESSION['user'])) {
        return false;
    }
    $user_id = $_SESSION['user']['id'] ?? null;

    $stmt = $pdo->prepare("SELECT * FROM `user_info` WHERE `id` = :id");
    $stmt->execute(['id' => $user_id]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);

}

function logout(){
    unset($_SESSION['user']['id']);
    redirect(path: '/login.php');
}

function check_auth(): void{
    if (!isset($_SESSION['user']['id'])) {
        redirect(path: '/login.php');
    }
} 

function check_guest(): void{ 
    if (isset($_SESSION['user']['id'])) 
        redirect(path: '/work_note.php');
    }

function get_notes($id_user) {

    $pdo = get_PDO();

    $query = "SELECT * FROM note_info WHERE user_id = :user_id ORDER BY `note_date` DESC";

    $params = [
        ':user_id' => $id_user
    ];

    $stmt = $pdo->prepare($query);
    try{
        $stmt ->execute($params);
    }catch (\Exception $e){
        die($e->getMessage());
    }

    $notes = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    return $notes;
}


function get_single_note($id_note) {

    $pdo = get_PDO();

    $query = "SELECT * FROM note_info WHERE id = $id_note";

    $stmt = $pdo->prepare($query);
    try{
        $stmt ->execute();
    }catch (\Exception $e){
        die($e->getMessage());
    }

    $notes = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    return $notes;
}