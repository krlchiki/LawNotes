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
  <title>Рабочая страница</title>
</head>
<body>
  <div class="wrapper">
    <div class="left_bar">
      <div class="header_left">
        <div class="logo"><a href="work_note.html">LawNotes</a></div>
      </div>
      <div class="main_menu">
        <div class="main_menu_items">
          <div class="search_container">
            <input type="text" class="search menu_item menu_input" id="search" placeholder="Поиск">
            <button type="button" class="button_search" id="button_search">Искать</button >
          </div>
          <button type="button" class="active_notes menu_item"> <img class="svg_icon_menu" src="../svg/active.svg">Активные</button >
          <button type="button" class="active_notes menu_item"> <img class="svg_icon_menu" src="../svg/time.svg">Недавно изменные</button >
        </div>
      </div>
      <div class="left_bar_container">  
        <div class="work_space_bar">
          <div class="folders_title">
            <p5 >Папки</p5>
          </div>
          <div class="main_notes work_space_item"><img class="svg_icon" src="/svg/all.svg" alt=""> <button type="button" class="folders_btn" id="folders_btn">Все задачи</button > </div>
          <div class="main_notes work_space_item"><img class="svg_icon" src="/svg/main.svg" alt=""> <button type="button" class="folders_btn" id="folders_btn">Главные задачи</button > </div>
          <div class="plane_notes work_space_item"><img class="svg_icon" src="/svg/Planning.svg" alt=""><button type="button" class="folders_btn" id="folders_btn">Планируемые задачи</button > </div>
          <div class="daily_notes work_space_item"><img class="svg_icon" src="/svg/Daily.svg" alt=""><button type="button" class="folders_btn" id="folders_btn">Ежедневные задачи</button ></a></div>
          <div class="side_notes work_space_item"><img class="svg_icon" src="/svg/side.svg" alt=""><button type="button" class="folders_btn" id="folders_btn">Второстепенные задачи</button ></div>
        </div>
        <div class="profile_info">
        <div class="profile_info_items">
          <div class="login_profile"><?php echo $user['login']; ?></div>
          <div class="email_profile"><?php echo $user['email']; ?></div>
        </div>
        <div class="exit_logo">
          <form action="../php_vendor/actions/logout.php" method="POST"><button type="submit" class="logout_btn" name="logout_btn" id="logout_btn"></button ></form>
          <label for="logout_btn"><i class="exit_btn fa-solid fa-right-from-bracket fa-xl "></i></label>
        </div>
        </div> 
      </div>

      </div>



      <div class="right_bar">
        <div class="navbar_right">
          <div class="navbar_right_items">
            <button type="button" class="open_modal_window" name="open_modal_window" id="open_modal_window">+ Новая доска</button >
            <input type="date" class="date">
          </div>  
        </div>
        <div class="work_space">

          <!-- Заметка -->
          <?php foreach (get_notes($id_user) as $note):   ?>
            <div class="note_block">
              <div class="note_items">
                <div class="note_items_header">
                  <div class="note_type">
                    Заметка
                  </div>

    <form class="note_form" action="../php_vendor/actions/note_delete.php" method="POST"> 

                  <div class="button_note_block_container">


                    <div class="note_edit">
                      <!-- Кнопка редактирования -->
                      <button type="button" name="edit_note_open_modal" id="edit_note_open_modal" class="edit_note_open_modal btn_in_header_noteblock">
                        <i class="fa-solid fa-edit"></i>
                      </button>
                    </div>

                    <!-- Кнопка удаления -->
                    <div class="note_delete">
                        <button name="delete_note_btn" class="delete_note_btn btn_in_header_noteblock">
                          <i class="fa-solid fa-trash"></i>
                        </button>                                             
                    </div>
                  </div>
                </div>
                <div class="note_title">
                  <?= $note['note_title']?>
                </div>
                <div class="note_text">
                  <?= $note['note_text']?>
                </div>
                <div class="note_items_footer">
                  <div class="note_folder">
                    <?= $note['note_folder']?>
                  </div>
                  <div class="note_date">
                    <?= $note['note_date']?>
                  </div>
                  
                </div>
              </div>
            </div>   
              <div class="hidden">     
                <input class="hidden" name="note_id" value="<?= $note['id'] ?>" />
                <input class="hidden" name="user_id" value="<?= $note['user_id'] ?>" />
                <input class="hidden" name="note_title" value="<?= $note['note_title'] ?>" />
                <input class="hidden" name="note_text" value="<?= $note['note_text'] ?>" />
                <input class="hidden" name="note_folder" value="<?= $note['note_folder'] ?>" />
                <input class="hidden" name="note_date" value="<?= $note['note_date'] ?>" />
              </div>
          <!-- Модальное окно для редактирования -->
          <div class="modal" id="modal_edit_note">
          <div class="modal_box">
            <button type="button" class="modal_close_btn" id="edit_modal_close_btn"> 
              <svg class="svg_icon" height="311pt" viewBox="0 0 311 311.09867" width="311pt" xmlns="http://www.w3.org/2000/svg">
                <path d="m16.042969 311.097656c-4.09375 0-8.191407-1.554687-11.304688-4.691406-6.25-6.25-6.25-16.386719 0-22.636719l279.058594-279.058593c6.253906-6.253907 16.386719-6.253907 22.636719 0 6.25 6.25 6.25 16.382812 0 22.632812l-279.0625 279.0625c-3.136719 3.136719-7.230469 4.691406-11.328125 4.691406zm0 0"/>
                <path d="m295.125 311.097656c-4.09375 0-8.191406-1.554687-11.304688-4.691406l-279.082031-279.082031c-6.25-6.253907-6.25-16.386719 0-22.636719s16.382813-6.25 22.632813 0l279.0625 279.082031c6.25 6.25 6.25 16.386719 0 22.636719-3.136719 3.136719-7.230469 4.691406-11.308594 4.691406zm0 0"/>
              </svg>
            </button >
            <h2>Реактировать доску</h2>
              <div class="form_box">

                  <div class="note_title">
                    <input type="text" name="note_title" class="note_title_input" placeholder="Заголовок" value="<?= $note['note_title'] ?>">
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
                    <div contenteditable="true" id="text_input_edit_note" class="text_input" name="text_input" id="text-input"> <?= $note['note_text']?> </div>  
                  </div>

                  <div class="choose_folder">
                    
                    <select name="folder" id="folreds">
                      <option value="1">Все задачи</option>
                      <option value="2">Главные задачи</option>
                      <option value="3">Планируемые задачи</option>
                      <option value="4">Ежедневные задачи</option>
                      <option value="5">Второстепенные задачи</option>
                    </select>

                  </div>
                  
                  <div>
                    <button class="edit_note_btn" name="edit_note_btn" id="edit_note_btn" type="submit">Изменить доску</button>
                  </div>
          </div>
        </div>
        <!-- Модальное окно редактииования конец -->      
        </div>
              
    </form>

          <?php endforeach; ?>  
          <!-- Заметка конец   -->
        </div>


        <!-- Модальное окно для создания заметки -->
        <div class="modal" id="modal_create_note">
          <div class="modal_box">
            <button type="button" class="modal_close_btn" id="create_modal_close_btn"> 
              <svg class="svg_icon" height="311pt" viewBox="0 0 311 311.09867" width="311pt" xmlns="http://www.w3.org/2000/svg">
                <path d="m16.042969 311.097656c-4.09375 0-8.191407-1.554687-11.304688-4.691406-6.25-6.25-6.25-16.386719 0-22.636719l279.058594-279.058593c6.253906-6.253907 16.386719-6.253907 22.636719 0 6.25 6.25 6.25 16.382812 0 22.632812l-279.0625 279.0625c-3.136719 3.136719-7.230469 4.691406-11.328125 4.691406zm0 0"/>
                <path d="m295.125 311.097656c-4.09375 0-8.191406-1.554687-11.304688-4.691406l-279.082031-279.082031c-6.25-6.253907-6.25-16.386719 0-22.636719s16.382813-6.25 22.632813 0l279.0625 279.082031c6.25 6.25 6.25 16.386719 0 22.636719-3.136719 3.136719-7.230469 4.691406-11.308594 4.691406zm0 0"/>
              </svg>
            </button >
            <h2>Новая доска</h2>
              <div class="form_box">
                <form action="../php_vendor/actions/add_note.php" id="add_note_form" method="POST">

                  <div class="note_title">
                    <input type="text" name="note_title" class="note_title_input" placeholder="Заголовок">
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
                    <div contenteditable="true" id="text_input_create_note" name="text_input" class="text_input">Ваш текст...</div>  
                  </div>

                  <div class="choose_folder">
                    
                    <select name="folder" id="folreds">
                      <option value="1">Все задачи</option>
                      <option value="2">Главные задачи</option>
                      <option value="3">Планируемые задачи</option>
                      <option value="4">Ежедневные задачи</option>
                      <option value="5">Второстепенные задачи</option>
                    </select>

                  </div>
                  
                  <div>
                    <button class="create_note_btn" name="create_note_btn" id="create_note_btn" type="submit">Создать доску</button >
                  </div>
                </form>
          </div>
        </div>
        <!-- Модальное окно конец -->

        

      </div>
    </div>
  </div>

<script defer src="../js/script1.js"></script>

</body>

</html>
