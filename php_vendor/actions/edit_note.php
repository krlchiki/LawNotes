<?php

    require_once __DIR__ . '/../helpers.php'; 

    $note_title = $_POST['note_title'] ;
    $note_text = $_POST['note_text'];
    $note_folder = $_POST['folder'] ;
    $note_id = $_POST['note_id'] ; 
    $active = $_POST['actile'] ;
    $note_date = date("Y-m-d H:i:s");

    $pdo = get_PDO();
      $query = "UPDATE note_info
      SET 
          note_title = IF(:note_title IS NOT NULL AND :note_title != '', :note_title, note_title),
          note_text = IF(:note_text IS NOT NULL AND :note_text != '', :note_text, note_text),
          note_folder = IF(:note_folder IS NOT NULL AND :note_folder != '', :note_folder, note_folder),
          note_date = IF(:note_date IS NOT NULL AND :note_date != '', :note_date, note_date),
          is_active = IF(:active IS NOT NULL AND :active != '', :active, is_active)

      WHERE id = :note_id;";

      $params = [
          ':note_id' => $note_id ,
          ':note_title' => $note_title,
          ':note_text' => $note_text,
          ':note_folder' => $note_folder,
          ':note_date' => $note_date,
          ':active' => $active
      ];
      $stmt = $pdo->prepare($query);
      try{
        $stmt -> execute($params);
      }catch (\Exception $e){
        die($e->getMessage());
      }


    redirect(path: '/work_note.php');