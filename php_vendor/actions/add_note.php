<?php

    require_once __DIR__ . '/../helpers.php'; 

    $user_id = $_SESSION['user']['id'] ?? null ;
    $note_title = $_POST['note_title'] ?? null;
    $note_text = $_POST['note_text'] ?? null;
    $folder = $_POST['folder'] ?? null;
    $note_date = date("Y-m-d H:i:s");



    // if (empty($note_title)){
    //     add_validation_error('note_title', 'Это поле не может быть пустым');
    // }

    // if (empty($note_text)){
    //     add_validation_error('note_text', 'Это поле не может быть пустым');
    // }


    // if ($_SESSION['validation']) {
    //     add_old_value('note_title', $note_title);
    //     add_old_value('note_text', $note_text);
    //     redirect(path:'/work_note.php');
    // }

    $pdo = get_PDO();

    $query = "INSERT INTO note_info (user_id, note_title, note_text, note_date, note_folder) VALUES (:user_id, :note_title, :note_text, :note_date,:note_folder)";
    $params = [
        'user_id' => $user_id,
        'note_title' => $note_title,
        'note_text' => $note_text,
        'note_date' => $note_date,
        'note_folder' => $folder
    ];

    $stmt = $pdo->prepare($query);
    try{
        $stmt ->execute($params);
    }catch (\Exception $e){
        die($e->getMessage());
    }

    redirect(path: '/work_note.php');