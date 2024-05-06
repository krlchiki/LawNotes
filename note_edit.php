<?php

    require_once __DIR__ . '/php_vendor/helpers.php';

    check_auth();

    $user = current_user();

    $id_user = $_SESSION['user']['id'];

    $id_note = $_GET['note_id'];

    $note = get_single_note($id_note);
    $nested_array = $note[0];

    $note_text = $nested_array['note_text'];
    $note_title = $nested_array['note_title'];
    $folder = $nested_array['note_folder'];
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
  <div class="modal visible" id="modal_create_note">
          <div class="modal_box">
            </button >
            <h2>Редактирование</h2>
              <div class="form_box">
                <form action="../php_vendor/actions/edit_note.php" id="add_note_form" method="POST">

                  <div class="note_title">
                    <input type="text" name="note_title" class="note_title_input" placeholder="Заголовок"
                    value="<?php echo $note_title; ?>">
                  </div>

                  <div class="note_text_box">
                    <div class="options">

                      <!-- Формат текста -->

                      <button type="button" class="option_button format btn_in_textblock" id="bold" type="button">
                        <i class="fa-solid fa-bold"></i>
                      </button >
                      <button type="button" class="option_button format btn_in_textblock" id="italic" type="button">
                        <i class="fa-solid fa-italic"></i>
                      </button >
                      <button type="button" class="option_button format btn_in_textblock" id="underline" type="button">
                        <i class="fa-solid fa-underline"></i>
                      </button >
                      <button type="button" class="option_button format btn_in_textblock" id="strikethrough" type="button">
                        <i class="fa-solid fa-strikethrough"></i>
                      </button >

                      <!-- Лист -->

                      <button type="button" id="insertOrderedList" class="option_button btn_in_textblock">
                        <i class="fa-solid fa-list-ol"></i>
                      </button >
                      <button type="button" id="insertUnorderedList" class="option_button btn_in_textblock">
                        <i class="fa-solid fa-list"></i>
                      </button >

                      <!-- Отменить/повторить -->

                      <button type="button" id="undo" class="option_button btn_in_textblock">
                        <i class="fa-solid fa-rotate-left"></i>
                      </button >
                      <button type="button" id="redo" class="option_button btn_in_textblock">
                        <i class="fa-solid fa-rotate-right"></i>
                      </button >

                      <!-- Заголовки -->

                      <select id="formatBlock" class="adv_option_button">
                        <option value="H1">H1</option>
                        <option value="H2">H2</option>
                        <option value="H3">H3</option>
                        <option value="H4">H4</option>
                        <option value="H5">H5</option>
                        <option value="H6">H6</option>
                      </select>

                      <!-- Шрифт -->

                      <select id="fontName" class="adv_option_button"></select>
                      <select id="fontSize" class="adv_option_button"></select>

                      <!-- Цвет -->

                      <div class="input_wrapper">
                        <input type="color" id="foreColor" class="adv_option_button" />
                        <label for="foreColor">Цвет шрифта</label>
                      </div>
                      <div class="input_wrapper">
                        <input type="color" id="backColor" class="adv_option_button" />
                        <label for="backColor">Цвет фона</label>
                      </div>
                    </div>
                    <div contenteditable="true" id="text_input_create_note" name="text_input" class="text_input"> <?php echo $note_text; ?> </div>  
                  </div>

                  <div class="choose_folder">
                    
                    <select name="folder" id="folreds"  value="<?php echo $folder; ?>">
                      <option value="Все задачи">Все задачи</option>
                      <option value="Главные задачи">Главные задачи</option>
                      <option value="Планируемые задачи">Планируемые задачи</option>
                      <option value="Ежедневные задачи">Ежедневные задачи</option>
                      <option value="Второстепенные задачи">Второстепенные задачи</option>
                    </select>

                  </div>
                  
                  <div>
                    <button class="create_note_btn" name="edit_note_btn" id="edit_note_btn" type="submit">Изменить доску</button >
                  </div>
                </form>
          </div>
        </div>
        <!-- Модальное окно конец -->
<script defer src="../js/script2.js"></script>        
</body>
</html>