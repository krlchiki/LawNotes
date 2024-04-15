<?php

    require_once __DIR__ . '/../helpers.php'; 

    $note_id = $_POST['note_id'];
    $user_id = $_POST['user_id'];
    $note_title = $_POST['note_title'];
    $note_text = $_POST['note_text'];
    $note_folder = $_POST['note_folder'];
    $note_date = $_POST['note_date'];

    var_dump($_POST);


    if (isset($_POST['delete_note'])) {
      // Обработка нажатия кнопки удаления
      $pdo = get_PDO();

      $query = "DELETE FROM note_info WHERE `note_info`.`id` = :note_id";
      $params = [
          ':note_id' => $note_id,
      ];
      $stmt = $pdo->prepare($query);
      try{
        $stmt -> execute($params);
      }catch (\Exception $e){
        die($e->getMessage());
      }

      redirect(path: '/work_note.php');
    } 
    
    
    
    elseif (isset($_POST['edit_note'])) {
      // Обработка нажатия кнопки 2
      echo "Кнопка 2 была нажата";
    }

