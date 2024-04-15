<?php

    require_once __DIR__ . '/php_vendor/helpers.php';

    check_auth();

    $user = current_user();

    $id_user= $_SESSION['user']['id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/normalize.min.css">
  <link rel="stylesheet" href="css/work_note_style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <?php
    require ("img/favicons/favicons.php")
  ?>
  <title>Редактирование</title>
</head>
<body>
    
</body>
</html>